<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;// importacion 
use App\Models\Estudiante;
use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;

use App\Models\Mese;


use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\EstudianteExport;
use App\Imports\EstudianteImport;
use App\Models\Aula;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;//importaciones a excel....EstudianteExport

class EstudianteController extends Controller
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
               $searchText = trim($request->get('searchText'));
       
             $items=Estudiante::where('nombre', 'LIKE', '%' . $searchText . '%')
                        ->orWhere('apellidos', 'LIKE', '%' . $searchText . '%')->orderBy('id', 'desc')->paginate(50);
            //  dd($items);
      $aula=Aula::all();
      return view('pages.estudiante.index',compact('items','aula','searchText'));
           
        }
    
    }

 

    protected function pdffiltrado(Request $request)
    {

        if ($request) {
            $nivel=trim($request->get('filtronivel'));
            $grado=trim($request->get('filtrogrado'));
            $seccion=trim($request->get('filtroseccion')); 
          
            // dd($nivel,$grado,$seccionf);
           

        $estudiante = Estudiante::with('meses')->with('seccion')->with('nivel')->with('grado')->where('idnivel', 'LIKE', '%' . $nivel . '%')->where('idgrado', 'LIKE', '%' . $grado . '%')->where('idseccion', 'LIKE', '%' . $seccion . '%')->get();
        
        

        $pdf = Pdf::loadView('pages.estudiante.mostrarfiltro',compact('estudiante','seccion'));
        

       if($nivel!="" && $grado!="" && $seccion!=""){
        $nivelb=Nivel::find($nivel);
        $gradob=Grado::find($grado);
        $seccionb=Seccion::find($seccion);
        return $pdf->stream('' . $nivelb->nombre . '-' . $gradob->grado .'-'.$seccionb->nombre. '.pdf');
       }else{
        return $pdf->stream('lista-estudiantes.pdf');
       }
       

      
    }
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstudianteRequest $request)
    {
        $estudiante = new Estudiante;
        $apellidop = $request->get('apellidop');
        $apellidom = $request->get('apellidom');
        $celularp = $request->get('celularp');
        $celularm = $request->get('celularm');

        $estudiante->nombre = strtoupper($request->get('nombre'));
        $estudiante->apellidos = strtoupper($apellidop . ' ' . $apellidom);
        $estudiante->dni = strtoupper($request->get('dni'));      
        $estudiante->celular = strtoupper($celularp . ' / ' . $celularm);
        $estudiante->direccion = strtoupper($request->get('direccion')); 
        $estudiante->nombreapoderado = strtoupper($request->get('apoderado')); 
        $estudiante->observaciones = strtoupper($request->get('observaciones')); 
        $estudiante->codigo = $request->get('codigo');
        $estudiante->save();
        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'!bien hecho!',
            'text'=>'!Estudiante Resgitrado correctamente!',
        ]);
        return back()->with('message', 'Registro Exítoso');
    }

    public function show($id)
    {
        $estudiante = Estudiante::where('id', $id)->first();
        $mes = Mese::where('idmatricula', $id)->get();
        $avancepen = count($mes);



        $otros = DB::table('pagos as p')
        ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
        ->join('pensions as pen', 'p.id', '=', 'pen.idpago')
        ->join('conceptos as c', 'pen.idconcepto', '=', 'c.id')
        ->select('p.idestudiante', 'c.concepto', 'p.created_at as fecha', 'p.montototal', 'pen.cantidad', 'pen.monto')->where('p.idestudiante', $id)->get();

        $articulo = DB::table('pagos as p')
        ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
        ->join('detallepagos as det', 'p.id', '=', 'det.idpago')
        ->join('articulos as a', 'det.idarticulo', '=', 'a.id')
        ->select('p.idestudiante', 'a.nombre as articulo', 'p.created_at as fecha', 'det.cantidadar as cantidad', 'det.montoar')->where('p.idestudiante', $id)->get();


        //   dd($articulo);
        return view("pages.estudiante.show", compact('estudiante', 'mes', 'avancepen', 'otros', 'articulo'));
    }
   

    public function update(UpdateEstudianteRequest $request,  $item)
    {
        $estudiante=Estudiante::find($item);      
      
        $estudiante->nombre = strtoupper($request->get('nombre'));
        $estudiante->apellidos = strtoupper($request->get('apellidos'));
        $estudiante->dni = strtoupper($request->get('dni'));    
        $estudiante->celular = strtoupper($request->get('celular'));      
        $estudiante->direccion = strtoupper($request->get('direccion')); 
        $estudiante->nombreapoderado = strtoupper($request->get('apoderado')); 
        $estudiante->observaciones = strtoupper($request->get('observaciones')); 
        $estudiante->codigo = $request->get('codigo');
       
        $estudiante->update();
        session()->flash('swal',[
            'icon'=>'success',
            'title'=>'!bien hecho!',
            'text'=>'!Estudiante Actualización correctamente!',
        ]);
        return back()->with('message', 'Actualización Exítosa');
    }
    

 
    public function destroy($estudiante)
    {

        $estudiante=Estudiante::find($estudiante);
        $estudiante->delete();
        return back()->with('message', 'Archivo Eliminado ');
    }

    public function exportsexcel()
    {
        return Excel::download(new EstudianteExport, 'lista-estudiantes.xlsx');
    }

    public function importexcel(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            Excel::import(new EstudianteImport, $file);
            return back()->with('message', 'Archivo Importado ');
        }else{
            return back()->with('message', 'Proceso no Ejecutado ');
        }
    
    }
}
