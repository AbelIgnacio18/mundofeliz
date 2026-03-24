<?php

namespace App\Http\Controllers;

use App\Models\Asistenciaest;
use App\Http\Requests\StoreAsistenciaestRequest;
use App\Http\Requests\UpdateAsistenciaestRequest;
use App\Models\Anolectivo;
use App\Models\Aula;
use App\Models\Horario;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Matricula;
use Illuminate\Support\Facades\DB;
use App\Models\Estudiante;
use App\Models\Apoderado;
use Illuminate\Http\Request; // importacion
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Google\Client;
use App\Services\FcmService;
use Illuminate\Support\Facades\Auth;

class AsistenciaestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
{
    $user = auth()->user();
    $anolect = Anolectivo::where('estado', 1)->first();
    $fecha = $request->get('fecha') ?? date('Y-m-d');
    $idaula = $request->get('idaula');
    $estado = $request->get('estado');

    // Traer matrículas filtradas por sedes del usuario
    $matriculaQuery = Matricula::with('estudiante', 'aula')
        ->where('idanolectivo', $anolect->id);

    if (!$user->esSuperAdmin()) {
        $matriculaQuery->whereIn('idsede', $user->getSedesIds());
    }

    $matricula = $matriculaQuery->get();

    // Traer aulas filtradas por sedes del usuario
    $aulaQuery = Aula::query();
    if (!$user->esSuperAdmin()) {
        $aulaQuery->whereIn('idsede', $user->getSedesIds());
    }
    $aula = $aulaQuery->get();

    // 🔹 Asistencias filtradas
    $items = Asistenciaest::with(['matricula.estudiante', 'matricula.aula'])
        ->whereDate('fechaentrada', $fecha)
        ->where('idanolectivo', $anolect->id)
        ->when($estado !== '' && $estado !== null, fn($q) => $q->where('estado', $estado))
        ->when($idaula, fn($q) => $q->whereHas('matricula', fn($mq) => $mq->where('idaula', $idaula)))
        ->whereHas('matricula', function($q) use ($user) {
            if (!$user->esSuperAdmin()) {
                $q->whereIn('idsede', $user->getSedesIds());
            }
        })
        ->get();

    return view('pages.asistenciaest.index', compact('matricula', 'aula', 'items', 'fecha', 'estado', 'idaula'));
}

    /**
     * Show the form for creating a new resource.
     */


    /**
     * Store a newly created resource in storage.
     */
    private function enviarNotificacionPush($apoderado, $estudiante, $tipo)
    {
        $fcmToken = $apoderado->fcm_token;
        // dd($fcmToken);
        if (empty($fcmToken)) {
            logger()->info("El estudiante {$estudiante->nombre} no tiene un token registrado.");
            return;
        }

        app(FcmService::class)->send(
            $fcmToken,
            'Asistencia registrada',
            'Estudiante ' . $estudiante->nombre . ' ' . $estudiante->apellidos . ' Marco ' . $tipo,
            [
                'tipo' => 'asistencia',
                'alumno_id' => $estudiante->id,
                'hora' => now()->format('H:i:s'),
            ]

        );
    }

    public function store(StoreAsistenciaestRequest $request)
{
    $idmatriculas = $request->get('matricula_id');
    $hora = $request->get('hora-entrada');
    $anolect = Anolectivo::where('estado', 1)->first();
    $tipo = $request->has('tipo_registro') ? 'salida' : 'entrada';
    $fechaHoy = date('Y-m-d');

    // Traemos todas las matrículas de una sola vez, con estudiante, apoderado y aula
    $matriculas = Matricula::with(['estudiante.apoderado', 'aula'])
        ->whereIn('id', $idmatriculas)
        ->where('idanolectivo', $anolect->id)
        ->get();

    foreach ($matriculas as $matricula) {
        $estudiante = $matricula->estudiante;
        $apoderado = $estudiante->apoderado;
        $aula = $matricula->aula;

        // Revisamos si ya existe registro de asistencia hoy
        $asistencia = Asistenciaest::where('idmatricula', $matricula->id)
            ->where('fechaentrada', $fechaHoy)
            ->first();

        if (!$asistencia) {
            if ($tipo === 'entrada') {
                $asistencia = new Asistenciaest();
                $asistencia->idanolectivo = $anolect->id;
                $asistencia->idmatricula = $matricula->id;
                $asistencia->fechaentrada = $fechaHoy;
                $asistencia->horaentrada = $hora;
                // Determina si es asistencia o tarde según horario de aula
                $asistencia->estado = $hora< Carbon::parse($aula->horatarde)->format('H:i:s') ? 1 : 0;
                $asistencia->save();

                $this->enviarNotificacionPush($apoderado, $estudiante, "entrada");
            }
        } else {
            // Si ya existe registro, registramos salida
            
            $asistencia->horasalida = $hora;
            $asistencia->update();

            $this->enviarNotificacionPush($apoderado, $estudiante, "salida");
        }
    }

    return back()->with('message', 'Registro Exitoso');
}


    public function update(Request $request, $id)
    {
        $asistencia = Asistenciaest::find($id);

        if (!$asistencia) {
            return response()->json(['mensaje' => 'Registro no encontrado']);
        };

        $asistencia->estado = $request->estado;
        if ($asistencia->estado === 4) {
            $asistencia->horaentrada = date('H:i:s');
        }

        $asistencia->save();

        // 🔥 Regla automática
        // if($request->estado == 0){ // si es tardanza

        //     $tardanzas = Asistenciaest::where('idmatricula', $asistencia->idmatricula)
        //         ->where('estado', 0)
        //         ->count();

        //     if($tardanzas >= 3){

        //         // convertir 3 tardanzas en 1 falta
        //         $asistencia->estado = 2; // falta
        //         $asistencia->save();

        //         return response()->json([
        //             'mensaje' => '3 tardanzas acumuladas → convertida en falta'
        //         ]);
        //     }
        // }
        return response()->json([
            'mensaje' => 'Asistencia Actualizada'
        ]);
    }

    public function ActualizarObservacion(Request $request, $id)
    {
        $asistencia = Asistenciaest::find($id);

        if ($request->has('observacion')) {
            $asistencia->observacion = $request->observacion;
        }

        if ($request->has('observacion')) {
            $asistencia->observacion = $request->observacion;
        }

        $asistencia->save();


        return response()->json([
            'mensaje' => 'Asistencia Actualizada'
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $anolect = Anolectivo::where('estado', 1)->first();

        $items = Matricula::where('id', $id)
            ->where('idanolectivo', $anolect->id)
            ->with('asistenciahoy')
            ->with('estudiante')
            ->get();

        return view('pages.asistenciaest.show', compact('items'));
    }
    public function asistenciaindividual($id)
    {

        $anolect = Anolectivo::where('estado', 1)->first();

        $fechaInicio = Carbon::parse($anolect->inicio);
        $fechaFin = Carbon::parse(date("Y-m-d"));
        $dias = [];
        $meses = [];
        $fechaActual = $fechaInicio->copy();
        $fechaActual2 = $fechaInicio->copy();
        while ($fechaActual->lte($fechaFin)) {
            $dias[] = $fechaActual->format('Y-m-d'); // Formato día-mes-año
            $fechaActual->addDay();
        }
        while ($fechaActual2->lte($fechaFin)) {

            $meses[] = $fechaActual2->format('Y-m'); // Formato Mes Año
            $fechaActual2->addMonth();
        }
        //dd($meses);
        // 
        $items = Matricula::where('idestudiante', $id)->where('idanolectivo', $anolect->id)->with('asistenciahoy')->with('estudiante')
            ->get();
        $estudiante = Estudiante::where('id', $id)->first();
        $asistio = 0;
        $tarde = 0;
        $falta = 0;
        $tardejus = 0;
        $faltajus = 0;

        foreach ($items as $item) {
            foreach ($item->asistenciahoy as $asis) {

                if ($asis->estado == 1) $asistio++;
                if ($asis->estado == 0) $tarde++;
                if ($asis->estado == 4) $falta++;
                if ($asis->estado == 2) $tardejus++;
                if ($asis->estado == 3) $faltajus++;
            }
        }

        $total = $asistio + $tarde + $falta + $faltajus + $tardejus;

        $porcentaje = $total > 0 ? round(($asistio / $total) * 100) : 0;
        //dd($items);
        $pdf = Pdf::loadView(
            'pages.asistenciaest.asistenciaindividual',
            compact('items', 'dias', 'meses', 'estudiante', 'asistio', 'tarde', 'falta', 'total', 'porcentaje', 'faltajus', 'tardejus')
        );
        $pdf->setPaper('A4', 'landscape'); //Formato de hoha A4 en horizontal
        return $pdf->stream('lista_asistencia.pdf');
    }




    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asistenciaest $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($asistencia)
    {
        $item = Asistenciaest::find($asistencia);
        $item->delete();
        return back()->with('message', 'Archivo Eliminado ');
    }


    public function control(Request $request)
    {

        $this->validate($request, [
            'estado' => 'required',

        ]);
        $item = Horario::find(1);
        $estado = $request->get('estado');
        //  dd( $item->estado);
        $item->estado = $estado;
        $item->update();
        return back()->with('message', 'Actualización Exítosa');
    }

    public function filtrarasistencia(Request $request)
    {

        if ($request) {


            $query = trim($request->get('idaula'));
            $fecha = trim($request->get('fecha'));
            $searchText = trim($request->get('searchText'));


            if ($fecha == "") {
                $fecha = date('Y-m-d');
            }
            $turno = Aula::get();
            $aula = Aula::all();
            $anolect = Anolectivo::where('estado', 1)->first();
            $horario = Horario::first();


            $items = DB::table('matriculas as m')
                ->join('estudiantes as e', 'm.idestudiante', '=', 'e.id')
                ->join('asistenciaests as a', 'm.id', '=', 'a.idmatricula')
                ->join('aulas as au', 'm.idaula', '=', 'au.id')
                ->select('a.id', 'e.nombre', 'e.apellidos', 'e.id as idestudiante', 'au.nivel', 'au.grado', 'au.seccion', 'a.created_at', 'a.updated_at', 'a.fechaentrada', 'a.estado', 'a.idanolectivo')
                ->when($query, fn($q) => $q->where('m.idaula', $query))
                ->whereDate('a.fechaentrada', $fecha)
                ->where('a.idanolectivo', $anolect->id)
                ->when($searchText, function ($q) use ($searchText) {
                    $q->where(function ($sub) use ($searchText) {
                        $sub->where('e.nombre', 'LIKE', "%$searchText%")
                            ->orWhere('e.apellidos', 'LIKE', "%$searchText%");
                    });
                })
                ->orderBy('e.apellidos')
                ->paginate(10);



            $matricula = Matricula::where('idanolectivo', $anolect->id)->with('estudiante')->get();
            return view('pages.asistenciaest.asistenciaest', compact('items', 'aula', 'horario', 'fecha', 'query', 'turno', 'matricula', 'searchText'));
        }
    }


    public function registrarfalta(Request $request)
    {

        if ($request) {

            $request->validate([
                'turno' => 'required'
            ]);

            $turno = $request->get('turno');

            $anolectivo = Anolectivo::where('estado', 1)->first();
            $matricula = Matricula::where('idanolectivo', $anolectivo->id)->where('idaula', $turno)->with('asistenciahoy')->get();


            for ($i = 0; $i < count($matricula); $i++) {

                if (empty($matricula[$i]->asistenciahoy()->wheredate('fechaentrada', date('Y-m-d'))->first()) == true) {
                    $asistencia = new Asistenciaest;
                    $asistencia->idanolectivo = $anolectivo->id;
                    $asistencia->idmatricula = $matricula[$i]->id;
                    $asistencia->fechaentrada = date("Y-m-d");

                    $asistencia->estado = null;

                    $asistencia->save();
                };
            }


            return back()->with('message', 'Actualización Exítosa');
        }
    }

    public function listarfalta(Request $request)
    {

        if ($request) {


            $query = trim($request->get('idaula'));
            $fecha = trim($request->get('fecha'));
            $falto = trim($request->get('falto'));

            if ($fecha == "") {
                $fecha = date('Y-m-d');
            }

            $aula = Aula::all();
            $anolect = Anolectivo::where('estado', 1)->first();

            $items = DB::table('matriculas as m')
                ->join('estudiantes as e', 'm.idestudiante', '=', 'e.id')
                ->join('asistenciaests as a', 'm.id', '=', 'a.idmatricula')
                ->join('aulas as au', 'm.idaula', '=', 'au.id')
                ->select('m.id', 'au.nivel', 'au.grado', 'au.seccion', 'e.nombre', 'e.apellidos', 'e.id as idestudiante', 'e.celular', 'a.created_at', 'a.updated_at', 'a.fechaentrada', 'a.estado', 'a.idanolectivo')

                ->where('idaula', 'LIKE', '%' . $query . '%')
                ->where('a.fechaentrada', 'LIKE', '%' . $fecha . '%')
                ->where('a.idanolectivo', $anolect->id)
                ->where('a.estado', null)
                ->orderBy('e.apellidos', 'asc')
                ->get();

            return view('pages.asistenciaest.asistenciaestfalta', compact('items', 'aula',  'fecha', 'query'));
        }
    }

    public function reporteasistencia(Request $request)
    {
        $request->validate(['turno' => 'required']);
        $idaula = $request->get('turno');

        $anolect = Anolectivo::where('estado', 1)->first();
        $nombreaula = Aula::find($idaula);

        // 1. Generar rango de días y meses
        $fechaInicio = Carbon::parse($anolect->inicio);
        $fechaFin = Carbon::parse($anolect->fin);
        $fechaHoy = Carbon::now();
        $fechaFin = $fechaHoy->lt($fechaFin) ? $fechaHoy : $fechaFin;


        $dias = [];
        $meses = [];
        $tempFecha = $fechaInicio->copy();

        while ($tempFecha->lte($fechaFin)) {
            $dias[] = $tempFecha->format('Y-m-d');
            $mesMes = $tempFecha->format('Y-m');
            if (!in_array($mesMes, $meses)) {
                $meses[] = $mesMes;
            }
            $tempFecha->addDay();
        }

        // 2. Obtener datos con relación
        $items = Matricula::where('idaula', $idaula)
            ->where('idanolectivo', $anolect->id)
            ->with(['estudiante', 'asistenciahoy'])
            ->get();

        // 3. Indexar asistencia (ESTO EVITA LA PANTALLA BLANCA)
        foreach ($items as $item) {
            $item->asistencia_indexada = $item->asistenciahoy->mapWithKeys(function ($asis) {
                // Usamos la fecha como llave para búsqueda directa
                $fechaKey = Carbon::parse($asis->fechaentrada)->format('Y-m-d');
                return [$fechaKey => $asis];
            });
        }

        if (ob_get_contents()) ob_end_clean();

        $pdf = Pdf::loadView('pages.asistenciaest.invocepdf', compact('items', 'dias', 'meses', 'nombreaula'));

        // Forzamos el papel y la orientación aquí
        return $pdf->setPaper('a4', 'landscape')->stream('reporte_asistencia.pdf');
    }

    //vista de registro de asistencia
    public function vistaasistencia()
    {

        $asistencia = Asistenciaest::with('matricula.estudiante')
            ->latest()
            ->first();
        // dd($asistencia);

        return view('pages.vistaasistencia.vistaasistencia', compact('asistencia'));
    }


    public function ultimaAsistencia()
    {
        $asistencia = Asistenciaest::with('matricula.estudiante')
            ->orderBy('created_at', 'desc')
            ->first();

        if (!$asistencia) {
            return response()->json([
                'existe' => false
            ]);
        }

        return response()->json([
            'existe' => true,
            'id' => $asistencia->id, // 👈 ESTE ES EL QUE NECESITAS
            'nombre' => $asistencia->matricula->estudiante->nombre,
            'apellidos' => $asistencia->matricula->estudiante->apellidos,
            'hora' => \Carbon\Carbon::parse($asistencia->created_at)->format('h:i A'),
            'estado' => $asistencia->estado,
        ]);
    }
}
