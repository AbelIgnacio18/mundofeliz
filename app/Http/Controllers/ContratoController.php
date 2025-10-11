<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Http\Requests\StoreContratoRequest;
use App\Http\Requests\UpdateContratoRequest;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items=Contrato::all();
        return view('pages.contrato.index',compact('items'));
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
    public function store(StoreContratoRequest $request)
    {
        $items=new Contrato();
    
        $items->cargo=$request->get('cargo');
        $items->remuneracion=$request->get('remuneracion');  
        $items->tiempo=$request->get('tiempo'); 
  
        $items->save();
        return back()->with('message', 'Actualización Exítosa');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contrato $contrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contrato $contrato)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContratoRequest $request, $items)
    {
        $items=Contrato::find($items);
          
        $items->cargo=$request->get('cargo');
        $items->remuneracion=$request->get('remuneracion');  
        $items->tiempo=$request->get('tiempo'); 
     
        $items->update();
       
        return back()->with('message', 'Actualización Exítosa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($items)
    {
        $items=Contrato::find($items);
            $items->delete();
            return back()->with('message', 'Archivo Eliminado ');
    }
}
