<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;
use Illuminate\Http\Request;// importacion

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        
        if ($request) {
         
            $categoria=Categoria::all();


            return view('pages.categoria.index',compact('categoria'));
        
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
    public function store(StoreCategoriaRequest $request)
    {
          $categoria=new Categoria;

        $categoria->nombre=$request->get('nombre');
         
        $categoria->save();
        return back()->with('message', 'Actualización Exítosa');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, $categoria)
    {
       $categoria=Categoria::find($categoria);

        $categoria->nombre=$request->get('nombre');
         
        $categoria->update();
        return back()->with('message', 'Actualización Exítosa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
