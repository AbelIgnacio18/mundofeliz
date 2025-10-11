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
       


        $docente = $request->get('docente');
        $entrada = $request->get('fecha-entrada');

        $docente = Docente::where('id', $docente)->first();
        $anolect = Anolectivo::where('estado', 0)->first();

        $asistencia = new Asistencia;
        $asistencia->idañolectivo = $anolect->id;
        $asistencia->iddocente = $docente->id;
        $asistencia->fechaentrada = $entrada;
        $asistencia->mes = date("m");
        $asistencia->a = date("d");       
        $asistencia->save();
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
