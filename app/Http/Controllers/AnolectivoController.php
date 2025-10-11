<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;// importacion
use App\Models\Anolectivo;
use App\Http\Requests\StoreAnolectivoRequest;
use App\Http\Requests\UpdateAnolectivoRequest;

class AnolectivoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        if ($request) {
         
            $items=Anolectivo::all();


            return view('pages.anolectivo.index',compact('items'));
        
        }
    
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnolectivoRequest $request)
    {

         $anolect = Anolectivo::all();
        for ($i = 0; $i < count($anolect); $i++) {

            $anolect[$i]->estado=0;
            $anolect[$i]->update();
        }

        Anolectivo::create($request->all());

        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'!bien hecho!',
            'text'=>'!Resgitrado correctamente!',
        ]);
        return back()->with('message', 'Actualización Exítosa');
    }
  

   

    public function update(UpdateAnolectivoRequest $request,  $items)
    {

        $anolect = Anolectivo::all();
        for ($i = 0; $i < count($anolect); $i++) {

            $anolect[$i]->estado=0;
            $anolect[$i]->update();
        }
        
        $items=Anolectivo::find($items);
        $items->update($request->all());
        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'!bien hecho!',
            'text'=>'!Actualizado correctamente!',
        ]);
        return back()->with('message', 'Actualización Exítosa');
    }
     

 
    public function destroy($items)
    {

        $items=Anolectivo::find($items);
        $items->delete();
        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'!bien hecho!',
            'text'=>'!Dato Eliminado correctamente!',
        ]);
        return back()->with('message', 'Archivo Eliminado ');
    }
    
}

