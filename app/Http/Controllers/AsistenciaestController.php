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


class AsistenciaestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request) {
            $idaula = trim($request->get('idaula'));
            $fecha = trim($request->get('fecha'));
              $estado = trim($request->get('estado'));
            // $searchText = trim($request->get('searchText'));
           
            if ($fecha == "") {
                $fecha = date('Y-m-d');
            }
            $anolect = Anolectivo::where('estado', 1)->first();
            $items = DB::table('matriculas as m')
                ->join('estudiantes as e', 'm.idestudiante', '=', 'e.id')
                ->join('asistenciaests as a', 'm.id', '=', 'a.idmatricula')
                ->join('aulas as au', 'm.idaula', '=', 'au.id')
                ->select('a.id', 'e.nombre', 'e.apellidos', 'e.id as idestudiante', 'au.nivel', 'au.grado', 'au.seccion', 'a.created_at', 'a.updated_at', 'a.fechaentrada', 'a.estado', 'a.idanolectivo','a.observacion')
                ->when($idaula, fn($q) => $q->where('m.idaula', $idaula))
                ->when($estado !== null && $estado !== '', function ($q) use ($estado) {

                    if ($estado === 'null') {
                        $q->whereNull('a.estado'); // Falta
                    } else {
                        $q->where('a.estado', $estado); // 0 o 1
                    }
                })
                ->whereDate('a.fechaentrada', $fecha)
                ->where('a.idanolectivo', $anolect->id)->orderBy('e.apellidos', 'asc')
                ->get();


            $aula = Aula::get();

            $matricula = Matricula::where('idanolectivo', $anolect->id)->with('estudiante')->get();
        }
        return view('pages.asistenciaest.index', compact('items', 'matricula', 'aula','fecha','estado','idaula'));
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


        $cont = 0;
        while ($cont < count($idmatriculas)) {
            $matricula = Matricula::where('id', $idmatriculas[$cont])->where('idanolectivo', $anolect->id)->first();
            $estudiante = Estudiante::where('id', $matricula->idestudiante)->first();
            $idapoderado = Apoderado::where('id', $estudiante->idapoderado)->first();
            $aula = Aula::where('id', $matricula->idaula)->first();
            if (empty(Asistenciaest::where('idmatricula', $matricula->id)->where('fechaentrada', date("Y-m-d"))->first()) == true) {
                $asistencia = new Asistenciaest();
                $asistencia->idanolectivo = $anolect->id;
                $asistencia->idmatricula = $idmatriculas[$cont];
                $asistencia->fechaentrada = date('Y-m-d');
                $asistencia->estado =  $hora < ($aula->tarde) ? 1 : 0;
                $asistencia->save();
              
                $this->enviarNotificacionPush($idapoderado, $estudiante, "entrada");
            }
              $cont = $cont + 1;
        }
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'bien hecho',
            'text' => 'Estudiante Actualización correctamente',
            'timer' => '1000',
            ' showConfirmButton' => 'false'
        ]);
       
        return back()->with('message', 'Registro Exítosa');
    }
    public function update(Request $request, $id)
    {
        $asistencia = Asistenciaest::find($id);

        if (!$asistencia) {
            return response()->json(['mensaje' => 'Registro no encontrado']);
        };

        $asistencia->estado = $request->estado;
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

        $items = Matricula::where('idestudiante', $id)->where('idanolectivo', $anolect->id)->with('asistenciahoy')->with('estudiante')
            ->get();
        //dd($items);


        return view('pages.asistenciaest.show', compact('items', 'dias', 'meses'));
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
        $request->validate([
            'turno' => 'required'
        ]);

        $anolect = Anolectivo::where('estado', 1)->first();

        $fechaInicio = Carbon::parse($anolect->inicio);
        $fechaFin = Carbon::parse($anolect->fin);
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

        $idaula = trim($request->get('turno'));


        $aula = Aula::all();
        $anolect = Anolectivo::where('estado', 1)->first();
        $nombreaula = Aula::where('id', $idaula)->first();
        $items = Matricula::where('idaula', 'LIKE', '%' . $idaula . '%')->where('idanolectivo', $anolect->id)->with('asistenciahoy')->with('asistenciahoy')
            ->with('estudiante')
            ->get();
        //dd($items);

        $pdf = Pdf::loadView('pages.asistenciaest.invocepdf', compact('items', 'dias', 'meses', 'nombreaula'));
        $pdf->setPaper('A4', 'landscape'); //Formato de hoha A4 en horizontal
        return $pdf->stream('lista_asistencia.pdf');
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
