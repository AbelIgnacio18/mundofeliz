<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;// importacion 
use App\Models\Docente;
use App\Models\Contrato;
use App\Http\Requests\StoreDocenteRequest;
use App\Http\Requests\UpdateDocenteRequest;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        if ($request) {
       
             $items=Docente::with('contrato')->get();
            //  dd($items);
      $contrato=Contrato::all();
      return view('pages.docente.index',compact('items','contrato')
      );
           
        }
    
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
    public function store(StoreDocenteRequest $request)
    {
        $estudiante = new Docente;
        $apellidop = $request->get('apellidop');
        $apellidom = $request->get('apellidom');
        $estudiante->nombre = strtoupper($request->get('nombre'));
        $estudiante->apellidos = strtoupper($apellidop . ' ' . $apellidom);
        $estudiante->dni = strtoupper($request->get('dni'));
        $estudiante->codigo = strtoupper($request->get('codigo'));
        // $estudiante->idcontrato = $request->get('idcargo');
        $estudiante->celular = strtoupper($request->get('celular'));
        $estudiante->save();
        return back()->with('message', 'Registro Exítoso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Docente $docente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Docente $docente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDocenteRequest $request, $item)
    {
        $estudiante=Docente::find($item);
      
        $apellidop = $request->get('apellidop');
        $apellidom = $request->get('apellidom');
        $estudiante->nombre = strtoupper($request->get('nombre'));
        $estudiante->apellidos = strtoupper($request->get('apellidos'));
        $estudiante->dni = strtoupper($request->get('dni'));
        $estudiante->codigo = strtoupper($request->get('codigo'));
        // $estudiante->idcontrato = $request->get('idcargo');
        $estudiante->celular = strtoupper($request->get('celular'));
        $estudiante->update();
       
        return back()->with('message', 'Actualización Exítosa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $docente)
    {
        $item=Docente::find($docente);
        $item->delete();
        return back()->with('message', 'Archivo Eliminado ');
    }
}
