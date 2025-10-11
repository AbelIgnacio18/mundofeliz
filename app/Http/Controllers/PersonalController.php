<?php

namespace App\Http\Controllers;

use App\Exports\EstudianteExport;
use Illuminate\Http\Request;// importacion 
use App\Http\Requests\StorePersonalRequest;
use App\Http\Requests\UpdatePersonalRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\PersonalExport;
use App\Imports\PersonalImport;
use App\Models\Personal;
use App\Models\Contrato;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;//importaciones a excel....PersonalExport

class PersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  

    public function __construct()
    {
       
    }
    
    public function index(Request $request)
    {
        
        if ($request) {
       
             $items=Personal::get();
            //  dd($items);
            $contrato=Contrato::all();
      return view('pages.Personal.index',compact('items','contrato'));
           
        }
    
    }

 

    protected function pdffiltrado(Request $request)
    {

        if ($request) {
          

        $Personal = Personal::get();
        
        

        $pdf = Pdf::loadView('pages.Personal.mostrarfiltro',compact('Personal','seccion'));
        

     
        return $pdf->stream('lista-Personals.pdf');
       
       

      
    }
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonalRequest $request)
    {
        $personal = new Personal;
        $apellidop = $request->get('apellidop');
        $apellidom = $request->get('apellidom');
        $personal->nombre = strtoupper($request->get('nombre'));
        $personal->apellidos = strtoupper($apellidop . ' ' . $apellidom);
        $personal->dni = strtoupper($request->get('dni'));
        $personal->codigo = strtoupper($request->get('codigo'));
        $personal->idcontrato = $request->get('idcargo');
        $personal->celular = strtoupper($request->get('celular'));
        $personal->save();
        return back()->with('message', 'Registro Exítoso');
    }

    public function show($id)
    {
        $Personal = Personal::where('id', $id)->first();
        
     
    }
   

    public function update(UpdatePersonalRequest $request,  $item)
    {
        $personal=Personal::find($item);
      
        $apellidop = $request->get('apellidop');
        $apellidom = $request->get('apellidom');
        $personal->nombre = strtoupper($request->get('nombre'));
        $personal->apellidos = strtoupper($apellidop . ' ' . $apellidom);
        $personal->dni = strtoupper($request->get('dni'));
        $personal->codigo = strtoupper($request->get('codigo'));
        $personal->idcontrato = $request->get('idcargo');
        $personal->celular = strtoupper($request->get('celular'));
        $personal->update();
       
        return back()->with('message', 'Actualización Exítosa');
    }
    

 
    public function destroy($Personal)
    {

        $Personal=Personal::find($Personal);
        $Personal->delete();
        return back()->with('message', 'Archivo Eliminado ');
    }

  
  
}
