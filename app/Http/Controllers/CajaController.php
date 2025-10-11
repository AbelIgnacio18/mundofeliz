<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;// importacion
use App\Models\Caja;
use App\Http\Requests\StoreCajaRequest;
use App\Http\Requests\UpdateCajaRequest;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        if ($request) {
         
            $caja=Caja::all();


            return view('pages.caja.index',compact('caja'));
        
        }
    
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCajaRequest $request)
    {
        $caja=new Caja;
        $caja->monto=$request->get('monto');   
        $caja->save();
        return back()->with('message', 'Actualización Exítosa');
    }
  

   

    public function update(UpdateCajaRequest $request,  $caja)
    {
        $caja=Caja::find($caja);
      
      
        $caja->monto=$request->get('monto');   
        $caja->update();
       
        return back()->with('message', 'Actualización Exítosa');
    }
    

 
    public function destroy($caja)
    {

        $caja=Caja::find($caja);
        $caja->delete();
        return back()->with('message', 'Archivo Eliminado ');
    }
    
}

