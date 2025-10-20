<?php

namespace App\Http\Controllers;
use App\Models\Aula;
use App\Models\Anolectivo;
use App\Models\Estudiante;
use App\Models\Mese;
use App\Models\Matricula;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;//importaciones a excel....EstudianteExport

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

     public function show($id)
    {
        $matricula = Matricula::where('id', $id)->with('estudiante')->first();
        $mes = Mese::where('idmatricula', $id)->get();
        $avancepen = count($mes);



        $otros = DB::table('pagos as p')
        ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
        ->join('pensions as pen', 'p.id', '=', 'pen.idpago')
        ->join('conceptos as c', 'pen.idconcepto', '=', 'c.id')
        ->select('p.idestudiante', 'c.concepto', 'p.created_at as fecha', 'p.montototal', 'pen.cantidad', 'pen.monto')->where('p.idestudiante', $matricula->idestudiante)->get();

        $articulo = DB::table('pagos as p')
        ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
        ->join('detallepagos as det', 'p.id', '=', 'det.idpago')
        ->join('articulos as a', 'det.idarticulo', '=', 'a.id')
        ->select('p.idestudiante', 'a.nombre as articulo', 'p.created_at as fecha', 'det.cantidadar as cantidad', 'det.montoar')->where('p.idestudiante', $matricula->idestudiante)->get();


        //  dd($matricula);
        return view("pages.matricula.show", compact('matricula', 'mes', 'avancepen', 'otros', 'articulo'));
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


     public function reportematricula(Request $request)
    {
        $request->validate([
            'aula' => 'required'
        ]);
         $idaula = $request->get('aula');
        if($idaula=="todos"){
//dd($idaula);
        $anolect = Anolectivo::where('estado', 1)->first();
        $matricula=Matricula::where('idanolectivo',$anolect->id)->with('estudiante')->with('aula')->with('meses')->orderBy('idaula','desc')->get();

        $pdf = Pdf::loadView('pages.matricula.invocepdf', compact('matricula', 'anolect'));
        //$pdf->setPaper('A4', 'landscape');
        return $pdf->stream('lista_matriculado_'.' $anolect'.'.pdf');


        }
 $anolect = Anolectivo::where('estado', 1)->first();
    $matricula=Matricula::where('idanolectivo',$anolect->id)->where('idaula',$idaula)->with('estudiante')->with('aula')->with('meses')->get();

        $pdf = Pdf::loadView('pages.matricula.invocepdf', compact('matricula', 'anolect'));
        //$pdf->setPaper('A4', 'landscape');
        return $pdf->stream('lista_matriculado_'.' $anolect'.'.pdf');
    }
}
