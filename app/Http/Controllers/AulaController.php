<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAulaRequest;
use App\Http\Requests\UpdateAulaRequest;
use App\Models\Aula;

class AulaController extends Controller
{
    public function __construct()
    {
       
    }
    
    public function index(Request $request)
    {

        $items=Aula::all();
        return view('pages.aula.index',compact('items'));

        }


        public function store(StoreAulaRequest $request)
        {
            $items=new Aula();

        $items->nivel = $request->get('nivel');
        $items->grado = $request->get('grado');
        $items->seccion = $request->get('seccion');
        $items->vacantes = $request->get('vacantes');
        $items->horaentrada = $request->get('hraentrada');
        $items->horatarde = $request->get('hratarde');
        $items->horafalta = $request->get('hrafalta');
        $items->horasalida = $request->get('hrasalida');
        $items->save();
            return back()->with('message', 'Actualización Exítosa');
        }
      
    
       
    
        public function update(UpdateAulaRequest $request,  $items)
        {
        $items = Aula::find($items);

        $items->nivel = $request->get('nivel');
        $items->vacantes = $request->get('vacantes');
        $items->horaentrada = $request->get('hraentrada');
      $items->horatarde = $request->get('hratarde');
        $items->horafalta = $request->get('hrafalta');
        $items->horasalida = $request->get('hrasalida');
            $items->update();
           
            return back()->with('message', 'Actualización Exítosa');
        }
        
    
     
        public function destroy($items)
        {
    
            $items=Aula::find($items);
            $items->delete();
            return back()->with('message', 'Archivo Eliminado ');
        }
    
}
