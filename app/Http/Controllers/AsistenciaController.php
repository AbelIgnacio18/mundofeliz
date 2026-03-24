<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Docente;
use App\Models\Anolectivo;
use App\Http\Requests\StoreAsistenciaRequest;
use App\Http\Requests\UpdateAsistenciaRequest;
use Illuminate\Http\Request; // importacion
use Carbon\Carbon;
use App\Models\User;
use App\Models\Horario;
use Barryvdh\DomPDF\Facade\Pdf;

class AsistenciaController extends Controller
{
    /** 
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request) {

            $horario = Horario::first();
            $fecha = trim($request->get('fecha'));
            if ($fecha == "") {
                $fecha = date('Y-m-d');
            }
            $items = Asistencia::with('user')->where('fechaentrada', $fecha)->get();
          
              $user = User::with(['docente', 'administrativo'])->get();

            return view('pages.asistencia.index', compact('items', 'user', 'fecha', 'horario'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function show($id)
    {


        $anolect = Anolectivo::where('estado', 1)->first();

        $items = User::where('id', $id)->with('asistenciauserhoy')
            ->get();
        //dd($items);

        return view('pages.asistencia.show', compact('items'));
    }

    public function asistenciaindividual($id)
    {

        $anolect = Anolectivo::where('estado', 1)->first();

        $fechaInicio = Carbon::parse($anolect->inicio);
        $fechaFin = Carbon::parse(date("Y-m-d"));
        $dias = [];
        $meses = [];
        $resumenMes = [];
        $calendarioMes = [];

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
        foreach ($meses as $me) {

    $inicio = \Carbon\Carbon::parse($me.'-01');
    $fin = $inicio->copy()->endOfMonth();

    $semanas = [];
    $semana = [];

    // espacios antes del primer día
    for ($i = 1; $i < $inicio->dayOfWeekIso; $i++) {
        $semana[] = null;
    }

    for ($dia = 1; $dia <= $fin->day; $dia++) {

        $fecha = $inicio->copy()->day($dia);

        $semana[] = $fecha;

        if (count($semana) == 7) {
            $semanas[] = $semana;
            $semana = [];
        }
    }

    if (count($semana) > 0) {

        while (count($semana) < 7) {
            $semana[] = null;
        }

        $semanas[] = $semana;
    }

    $calendarioMes[$me] = $semanas;
}
        //dd($meses);
        // 
       $user = User::with('asistenciauserhoy')
    ->findOrFail($id);
        //    dd($items);
        $asistio = 0;
        $tarde = 0;
        $falta = 0;
        $minutos_tarde = 0;


        foreach ($user->asistenciauserhoy as $asis) {

            $mes = \Carbon\Carbon::parse($asis->fechaentrada)->format('Y-m');

            if (!isset($resumenMes[$mes])) {
                $resumenMes[$mes] = [
                    'asistio' => 0,
                    'tarde' => 0,
                    'falta' => 0,
                    'minutos_tarde' => 0
                ];
            }

            if ($asis->estado == 1) {
                $resumenMes[$mes]['asistio']++;
            }

            if ($asis->estado == 0) {
                $resumenMes[$mes]['tarde']++;
                $resumenMes[$mes]['minutos_tarde'] += $asis->minutos_tarde;
            }

            if ($asis->estado == 4) {
                $resumenMes[$mes]['falta']++;
            }
        }

        //dd($items);
        $pdf = Pdf::loadView(
            'pages.asistencia.asistenciaindividual',
            compact('user', 'dias', 'meses', 'resumenMes','calendarioMes')
        );
        $pdf->setPaper('A4', 'landscape'); //Formato de hoha A4 en horizontal
        return $pdf->stream('lista_asistencia_docente.pdf');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAsistenciaRequest $request)
    {
        $anolect = Anolectivo::where('estado', 1)->first();

        $iduser = $request->get('user');
        $entrada1 = $request->get('hora-entrada');

        $cont = 0;
        while ($cont < count($iduser)) {

            $user = User::where('id', $iduser[$cont])->first();
            if (!$user) {
                return back()->with('message', 'Docente no encontrado');
            }
            $dia = strtolower(\Carbon\Carbon::now()->locale('es')->dayName);
            $horario = Horario::where('iduser', $user->id)
                ->where('dia_semana', $dia)
                ->first();
            if (!$horario) {
                return back()->with('danger', 'No exíste Horario,registre el Horario');
            }

            $existe = Asistencia::where('iduser', $user->id)
                ->whereDate('fechaentrada', today())
                ->first();
            //  $horaActual = now()->format('H:i:s');
            if (!$existe) {

                $entrada = Carbon::parse($horario->hora_ingreso);
                $tolerancia = $horario->tolerancia;



                $minutos = $entrada->diffInMinutes($entrada1, false);

                if ($minutos <= 0) {
                    $estado = 1; // puntual
                    $minutos_tarde = 0;
                } elseif ($minutos <= $tolerancia) {
                    $estado = 1; // tolerancia
                    $minutos_tarde = 0;
                } else {
                    $estado = 0; // tarde
                    $minutos_tarde = $minutos;
                }
                $asistencia = new Asistencia;
                $asistencia->idanolectivo = $anolect->id;
                $asistencia->iduser = $user->id;
                $asistencia->fechaentrada = date("Y-m-d");
                $asistencia->horaentrada = $entrada1;
                $asistencia->minutos_tarde = $minutos_tarde;
                $asistencia->estado = $estado;
                $asistencia->save();
            }

            $cont = $cont + 1;
        }
        return back()->with('message', 'Registro Exítosa');
    }

    /**
     * Display the specified resource.
     */


    /**
     * Update the specified resource in storage.
     */


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($asistencia)
    {
        $item = Asistencia::find($asistencia);
        $item->delete();
        return back()->with('message', 'Archivo Eliminado ');
    }

    public function reporteasistencia(Request $request)
    {

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

        $anolect = Anolectivo::where('estado', 1)->first();

        $items = User::where('estado', 1)->with('asistenciauserhoy')->orderBy('apellidos', 'asc')
            ->get();

        //dd($items);

        $pdf = Pdf::loadView('pages.asistencia.invocepdf', compact('items', 'dias', 'meses'));
        $pdf->setPaper('A4', 'landscape'); //Formato de hoha A4 en horizontal
        return $pdf->stream('lista_asistencia_docentes.pdf');
    }

    public function registrarfalta(Request $request)
    {

        if ($request) {



            $anolectivo = Anolectivo::where('estado', 1)->first();
            $docente = User::where('estado', 1)->with('asistenciauserhoy')->get();


            for ($i = 0; $i < count($docente); $i++) {

                if (empty($docente[$i]->asistenciadocentehoy()->wheredate('fechaentrada', date('Y-m-d'))->first()) == true) {
                    $asistencia = new Asistencia;
                    $asistencia->idanolectivo = $anolectivo->id;
                    $asistencia->iddocente = $docente[$i]->id;
                    $asistencia->fechaentrada = date("Y-m-d");
                    $asistencia->estado = null;

                    $asistencia->save();
                };
            }


            return back()->with('message', 'Actualización Exítosa');
        }
    }
}
