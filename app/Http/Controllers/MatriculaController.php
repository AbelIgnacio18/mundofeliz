<?php

namespace App\Http\Controllers;
use App\Models\Aula;
use App\Models\Anolectivo;
use App\Models\Estudiante;
use App\Models\Mese;
use App\Models\Matricula;
use App\Models\Concepto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;//importaciones a excel....EstudianteExport

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request) {

            $searchText = trim($request->get('searchText'));
            $anolect = Anolectivo::where('estado', 1)->first();
            // Obtener solo los estudiantes sin matrícula
            //$estudiantes = Estudiante::whereDoesntHave('matricula')->get();
            // $estudiante=Estudiante::all();
            $estudiantesMatriculados = Matricula::where('idanolectivo', $anolect->id)->pluck('idestudiante');

            // Obtener los que NO están en esa lista
            $estudiantesDisponibles = Estudiante::whereNotIn('id', $estudiantesMatriculados)->get();
            // Obtener los que NO están en esa lista
            $estudiante = Estudiante::whereNotIn('id', $estudiantesMatriculados)->get();
            $estudiante2 = Estudiante::whereNotIn('id', $estudiantesMatriculados)->get();

            // dd($estudiante);
            $anolect = Anolectivo::where('estado', 1)->first();
            $concepto = Concepto::orderBy('codigo', 'asc')->orderBy('concepto', 'desc')->get();

            $searchText = trim($request->get('searchText'));

            $matricula = Matricula::where('idanolectivo', $anolect->id)
                ->whereHas('estudiantes', function ($q) use ($searchText) {
                    $q->where('nombre', 'LIKE', '%' . $searchText . '%')
                        ->orWhere('apellidos', 'LIKE', '%' . $searchText . '%');
                })
                ->with('estudiante')
                ->with('aula')
                ->with('meses')
                ->with('concepto')
                ->paginate(50);
            /// dd($matricula);
            $aula = Aula::get();
            return view('pages.matricula.index', compact('estudiante', 'aula', 'matricula', 'concepto','searchText'));
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
    public function store(Request $request)
    {

        $estudianteid = $request->get('estudiante_id');
        $aula = $request->get('aula_id');
        $concepto = $request->get('concepto');

    
        $anolectivo = Anolectivo::where('estado', 1)->first();
        // dd($estudianteid, $aula,$anolectivo->id);
        $cont = 0;
        while ($cont < count($estudianteid)) {
            $matricula = new Matricula;
            $matricula->idestudiante = $estudianteid[$cont];
            $matricula->idanolectivo = $anolectivo->id;
            $matricula->idaula = $aula;
            $matricula->idconcepto = $concepto;
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


    public function showaula($id)
    {
         $anolect = Anolectivo::where('estado', 1)->first();
         $aula=Aula::where('id',$id)->first();
         $matricula=Matricula::where('idanolectivo',$anolect->id)->where('idaula', $id)->with('estudiante')->with('aula')->with('meses')->with('concepto')->get();
     
     

        //  dd($matricula);
        return view("pages.matricula.showaula", compact('matricula','aula'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $matricula)
    {
        $matricula=Matricula::find($matricula);  
   
        $matricula->idaula=$request->get('aula_id');  
        $matricula->idconcepto=$request->get('concepto');  
         $matricula->estado=$request->get('estado'); 
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
        $pdf->setPaper('A4', 'landscape'); //Formato de hoha A4 en horizontal
        return $pdf->stream('lista_matriculado_'.' $anolect'.'.pdf');
    }
    public function admisiontraslado(Request $request){

       




    }
}
