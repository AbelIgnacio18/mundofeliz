<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Docente;
use App\Models\Anolectivo;
use App\Http\Requests\StoreAsistenciaRequest;
use App\Http\Requests\UpdateAsistenciaRequest;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items=Asistencia::with('docentes')->get();
        $docente = Docente::all();

    return view('pages.asistencia.index',compact('items','docente'));
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
}
