<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;// importacion
use App\Models\Concepto;
use App\Models\Pagos;
use App\Models\User;
use App\Models\Estudiante;
use App\Models\Matricula;
use App\Models\Anolectivo;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use carbon\Carbon;


class PanelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function fechameses(){
        
    }
    public function index(Request $request)
    {

        if ($request) {

      
            $date = Carbon::now()->locale('es');
            // dd(date('m'));
           $anolect = Anolectivo::where('estado', 1)->first();
            $usuarios=User::all();

            $estudiante = Matricula::where('idanolectivo',$anolect)->get();// cantidad de estudiante
            $mesesporcentaje=DB::table('meses as me')->join('matriculas as m','me.idmatricula','=','m.id')->join('estudiantes as est','m.idestudiante','=','est.id')->select('me.mes',DB::raw('count(*) as cantidad'),DB::raw('count(est.id) as estudiante'))->groupBy('mes')->orderBy('cantidad','desc')->get();
            //  dd($mesesporcentaje);


            $pagosarticulos = DB::table('pagos as p')
            ->join('detallepagos as dt','p.id','=','dt.idpago')
            ->join('articulos as art','dt.idarticulo','=','art.id')
            ->join('categorias as c', 'art.idcategoria', '=', 'c.id')
            ->select('art.nombre','c.nombre as categoria',DB::raw('sum(dt.cantidadar) as cantidad'),DB::raw('sum(dt.montoar) as monto'))->groupBy('art.nombre','c.nombre')->get();//ventas de productos de todos los products General


            $pagosadministrativos = DB::table('pagos as p')
            ->join('pensions as pen','p.id','=','pen.idpago')
            ->join('conceptos as con','pen.idconcepto','=','con.id')
            ->select('con.concepto',DB::raw('sum(pen.cantidad) as cantidad'),DB::raw('sum(pen.monto) as monto'))->groupBy('con.concepto')->get();//pagos de todos los concepts administrativ incluyendo pensiones general
    
    
            $pagospensiones = DB::table('pagos as p')
            ->join('pensions as pen','p.id','=','pen.idpago')
            ->join('conceptos as con','pen.idconcepto','=','con.id')
            ->select('con.id','con.concepto',DB::raw('sum(pen.cantidad) as cantidad'),DB::raw('sum(pen.monto) as monto'))->where('con.id',1)->groupBy('con.concepto','con.id')->get();//pagos de pensiones-------
            
         
            $pagosventas = DB::table('pagos as p')->select(DB::raw('sum(p.montototal) as montototal'))->get();

            $pagosventasmes = DB::table('pagos as p')->select(DB::raw('sum(p.montototal) as montototal'))->whereMonth('created_at', date('m'))->get();
            //  dd($pagosventas);

            $pagosingresos = DB::table('ingresos as i')->select(DB::raw('sum(i.montototal) as montototal'))->get();
            $pagosingresosmes = DB::table('ingresos as i')->select(DB::raw('sum(i.montototal) as montototal'))->whereMonth('created_at', date('m'))->get();
            
   
        }

      

        return view('pages.dashboard', compact('date','estudiante','pagosarticulos','pagospensiones','pagosventas','pagosingresos','pagosventasmes','pagosingresosmes','usuarios','mesesporcentaje'));
    }

   

    /**
     * Store a newly created resource in storage.
     */
  /** Reporte Gallo PDF **/
  public function reporte()
  {
    $date = Carbon::now()->locale('es');
    $meses = ['marzo', 'abril', 'mayo', 'junio', 'julio', 'agosto', 'setiembre', 'octubre', 'noviembre', 'diciembre'];
    // echo $date->monthName;
    $i = 0;
    $contador = 1;
    $fecha = $date->monthName;

    while ($fecha = !$meses[$i]) {
        $contador++;
        $i++;
    }


    $estudiante = Estudiante::all();// cantidad de estudiante
    $estudianteid = [];//array que contiene los estudiantes que pagaronn
    $estudiantenp=0; // cantidad de estudiante no pagados
    $estudiantep=0;// cantidad de estudiante pagados

    for ($i = 0; $i < count($estudiante); $i++) {

        $pension = Pagos::where('idestudiante', $estudiante[$i]->id)->where('idconcepto', 1)->count();
        if ($contador === $pension) {
            $estudiantep++;// cantidad de estudiante pagados
        } else {
            $data = Estudiante::where('id', $estudiante[$i]->id)->get();
            $estudianteid[] = $data;
     
            $estudiantenp++; // cantidad de estudiante no pagados
      
        }
           
    }

      $lista=$estudianteid;
      $pdf = Pdf::loadView('pages.reporte', compact('lista','fecha'));
      return $pdf->download('lista-deudores.pdf');
  }

   
    

 
    public function destroy($concepto)
    {

        $concepto=Concepto::find($concepto);
        $concepto->delete();
        return back()->with('message', 'Archivo Eliminado ');
    }
    
}
