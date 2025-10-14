<?php

namespace App\Http\Controllers;
use App\Models\Aula;
use App\Models\Anolectivo;
use App\Models\Estudiante;
use App\Models\Matricula;
use Illuminate\Http\Request;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */ 
    public function index()
    {
        $estudiante=Estudiante::all();
        // dd($estudiante);
        $anolect = Anolectivo::where('estado', 1)->first();
      
        $matricula=Matricula::where('idanolectivo',$anolect->id)->with('estudiante')->with('aula')->with('meses')->get();
        // dd($matricula);
        $aula=Aula::get();
        return view('pages.matricula.index',compact('estudiante','aula','matricula'));
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
    public function store(Request $request)
    {

        $estudianteid = $request->get('estudiante_id');
        $aula = $request->get('aula_id');
    
        $anolectivo = Anolectivo::where('estado', 1)->first();
        // dd($estudianteid, $aula,$anolectivo->id);
        $cont = 0;
        while ($cont < count($estudianteid)) {
            $matricula = new Matricula;
            $matricula->idestudiante = $estudianteid[$cont];
            $matricula->idanolectivo = $anolectivo->id;
            $matricula->idaula = $aula;
            $matricula->save();
            $cont = $cont + 1;
        }

        return back()->with('message', 'Registro Exítosa');
    }

    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $matricula)
    {
        $matricula=Matricula::find($matricula);  
   
        $matricula->idaula=$request->get('aula_id');  
        $matricula->update();
       
        return back()->with('message', 'Actualización Exítosa');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($matricula)
    {
        $matricula=Matricula::find($matricula);
        $matricula->delete();
        return back()->with('message', 'Registro Eliminado ');
    }
}
