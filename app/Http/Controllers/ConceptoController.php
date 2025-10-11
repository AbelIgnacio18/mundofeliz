<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;// importacion
use App\Models\Concepto;
use App\Http\Requests\StoreConceptoRequest;
use App\Http\Requests\UpdateConceptoRequest;
use Illuminate\Support\Facades\Redirect;


class ConceptoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        if ($request) {
         
            $concepto=Concepto::all();


            return view('pages.concepto.index',compact('concepto'));
        
        }
    
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreConceptoRequest $request)
    {
        $concepto=new Concepto;

        $concepto->codigo=$request->get('codigo');
        $concepto->concepto=$request->get('concepto');  
        $concepto->monto=$request->get('monto');   
        $concepto->save();
        return back()->with('message', 'Actualización Exítosa');
    }
  

   

    public function update(UpdateConceptoRequest $request,  $concepto)
    {
        $concepto=Concepto::find($concepto);
      
        $concepto->codigo=$request->get('codigo');
        $concepto->concepto=$request->get('concepto');
        $concepto->monto=$request->get('monto');   
        $concepto->update();
       
        return back()->with('message', 'Actualización Exítosa');
    }
    

 
    public function destroy($concepto)
    {

        $concepto=Concepto::find($concepto);
        $concepto->delete();
        return back()->with('message', 'Archivo Eliminado ');
    }
    
}
