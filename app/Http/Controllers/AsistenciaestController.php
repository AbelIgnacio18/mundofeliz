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
use Illuminate\Http\Request; // importacion
use Carbon\Carbon;

class AsistenciaestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anolect = Anolectivo::where('estado', 1)->first();
        $items = DB::table('matriculas as m')
            ->join('estudiantes as e', 'm.idestudiante', '=', 'e.id')
            ->join('asistenciaests as a', 'm.id', '=', 'a.idmatricula')
            ->select('a.id', 'e.nombre', 'e.apellidos','e.id as idestudiante', 'a.created_at', 'a.updated_at', 'a.fechaentrada', 'a.estado', 'a.idanolectivo')->where('a.fechaentrada', date('Y-m-d'))->where('a.idanolectivo', $anolect->id)
            ->orderBy('e.apellidos', 'asc')
            ->get();

        $control = Horario::first();
        $turno = Aula::get();

        $matricula = Matricula::where('idanolectivo', $anolect->id)->with('estudiante')->get();

        return view('pages.asistenciaest.index', compact('items', 'matricula', 'control', 'turno'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAsistenciaestRequest $request)
    {

        $idmatriculas = $request->get('matricula_id');
        $entrada = $request->get('fecha-entrada');
        $anolect = Anolectivo::where('estado', 1)->first();
        // dd($estudianteid, $aula,$anolectivo->id);
        $cont = 0;
        while ($cont < count($idmatriculas)) {
            $asistencia = new Asistenciaest();
            $asistencia->idanolectivo = $anolect->id;
            $asistencia->idmatricula = $idmatriculas[$cont];
            $asistencia->fechaentrada = date('Y-m-d');
            if ($entrada < "08:00:00") {
                $asistencia->estado = 1;
            } else {
                $asistencia->estado = 0;
            }

            $asistencia->save();
            $cont = $cont + 1;
        }

        return back()->with('message', 'Registro Exítosa');
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

            $items = Matricula::where('idestudiante',$id )->where('idanolectivo', $anolect->id)->with('asistenciahoy')->with('estudiantes')
            ->get();
        //dd($items);


        return view('pages.asistenciaest.show',compact('items', 'dias', 'meses'));

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
        $item = Control::find(1);
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


            if ($fecha == "") {
                $fecha = date('Y-m-d');
            }
            $turno = Aula::get();
            $aula = Aula::all();
            $anolect = Anolectivo::where('estado', 1)->first();
            $control = Control::first();
            $items = DB::table('matriculas as m')
                ->join('estudiantes as e', 'm.idestudiante', '=', 'e.id')
                ->join('asistenciaests as a', 'm.id', '=', 'a.idmatricula')
                ->select('a.id', 'e.nombre', 'e.apellidos','e.id as idestudiante', 'a.created_at', 'a.updated_at', 'a.fechaentrada', 'a.estado', 'a.idanolectivo')
                ->where('idaula', 'LIKE', '%' . $query . '%')
                ->where('a.fechaentrada', 'LIKE', '%' . $fecha . '%')
                ->where('a.idanolectivo', $anolect->id)
                ->orderBy('e.apellidos', 'asc')
                ->paginate(50);


            return view('pages.asistenciaest.asistenciaest', compact('items', 'aula', 'control', 'fecha', 'query', 'turno'));
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
            $control = Control::first();
            $items = DB::table('matriculas as m')
                ->join('estudiantes as e', 'm.idestudiante', '=', 'e.id')
                ->join('asistenciaests as a', 'm.id', '=', 'a.idmatricula')
                ->select('m.id', 'e.nombre', 'e.apellidos', 'e.id as idestudiante','e.celular', 'a.created_at', 'a.updated_at', 'a.fechaentrada', 'a.estado', 'a.idanolectivo')
                ->where('idaula', 'LIKE', '%' . $query . '%')
                ->where('a.fechaentrada', 'LIKE', '%' . $fecha . '%')
                ->where('a.idanolectivo', $anolect->id)
                ->where('a.estado', null)
                ->orderBy('e.apellidos', 'asc')
                ->get();

            return view('pages.asistenciaest.asistenciaestfalta', compact('items', 'aula', 'control', 'fecha', 'query'));
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
            ->with('estudiantes')
            ->get();
        //dd($items);

        $pdf = Pdf::loadView('pages.asistenciaest.invocepdf', compact('items', 'dias', 'meses', 'nombreaula'));
        $pdf->setPaper('A4', 'landscape'); //Formato de hoha A4 en horizontal
        return $pdf->stream('lista_asistencia.pdf');
    }
}