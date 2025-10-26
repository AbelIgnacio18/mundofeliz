<?php

namespace App\Http\Controllers;

use App\Models\Articulo;
use App\Http\Requests\StoreArticuloRequest;
use App\Http\Requests\UpdateArticuloRequest;
use App\Models\Categoria;
use Illuminate\Http\Request;// importacion 

class ArticuloController extends Controller
{

    public function index(Request $request)
    {
        
        if ($request) {
         
            $articulo=Articulo::all();
              $categoria=Categoria::all();


            return view('pages.articulo.index',compact('articulo','categoria'));
        
        }
    
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticuloRequest $request)
    {
        $articulo=new Articulo;

        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');  
       $articulo->preciocosto=$request->get('preciocosto');   
      $articulo->precioventa=$request->get('precioventa');
        $articulo->idcategoria=$request->get('idcategoria'); 
        $articulo->save();
        return back()->with('message', 'Actualización Exítosa');
    }
  

   

    public function update(UpdateArticuloRequest $request,  $articulo)
    {
        $articulo=Articulo::find($articulo);
      
        $articulo->nombre=$request->get('nombre');
        $articulo->stock=$request->get('stock');  
        $articulo->preciocosto=$request->get('preciocosto');   
        $articulo->precioventa=$request->get('precioventa');    
         $articulo->idcategoria=$request->get('idcategoria'); 
        $articulo->update();
       
        return back()->with('message', 'Actualización Exítosa');
    }
    

 
    public function destroy($articulo)
    {

        $articulo=Articulo::find($articulo);
        $articulo->delete();
        return back()->with('message', 'Archivo Eliminado ');
    }
}
