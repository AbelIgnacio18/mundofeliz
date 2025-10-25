<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Docente;
use App\Models\Anolectivo;
use App\Http\Requests\StoreAsistenciaRequest;
use App\Http\Requests\UpdateAsistenciaRequest;
use Illuminate\Http\Request; // importacion
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request) {
           
        $fecha = trim($request->get('fecha'));
         if ($fecha == "") {
                $fecha = date('Y-m-d');
            }
        $items=Asistencia::with('docentes')->where('fechaentrada',$fecha)->get();
        $docente = Docente::all();

    return view('pages.asistencia.index',compact('items','docente','fecha'));

        }
        
    }

    /**
     * Show the form for creating a new resource.
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


        $anolect = Anolectivo::where('estado', 1)->first();
      
        $items = Docente::where('id',$id)->with('asistenciadocentehoy')
            ->get();
        //dd($items);

       
         return view('pages.asistencia.show',compact('items', 'dias', 'meses'));
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAsistenciaRequest $request)
    {
       


        $iddocente = $request->get('docente');
        $entrada = $request->get('fecha-entrada');

    
        $anolect = Anolectivo::where('estado', 1)->first();


          $cont = 0;
        while ($cont < count($iddocente)) {
            $asistencia = new Asistencia();
            $asistencia->idanolectivo = $anolect->id;
            $asistencia->iddocente = $iddocente[$cont];
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
  

    /**
     * Update the specified resource in storage.
     */
  

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($asistencia)
    {
        $item=Asistencia::find($asistencia);
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
      
        $items = Docente::where('estado',1)->with('asistenciadocentehoy')
            ->get();
        //dd($items);

        $pdf = Pdf::loadView('pages.asistencia.invocepdf', compact('items', 'dias', 'meses'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('lista_asistencia_docentes.pdf');
    }

    public function registrarfalta(Request $request)
    {

        if ($request) {

        

            $anolectivo = Anolectivo::where('estado', 1)->first();
            $docente = Docente::where('estado', 1)->with('asistenciadocentehoy')->get();


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
