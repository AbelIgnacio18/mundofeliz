<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // importacion
use App\Models\Pagos;
use App\Models\Mese;
use App\Http\Requests\StorePagosRequest;
use App\Http\Requests\UpdatePagosRequest;
use App\Models\Concepto;
use App\Models\Articulo;
use App\Models\Matricula;
use App\Models\Anolectivo;
use App\Models\Pension;
use App\Models\Pago;
use App\Models\Detallepago;
use App\Models\Estudiante;
use Illuminate\Support\Facades\DB;
use carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;


class PagosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request) {


            $pago = DB::table('pagos as p')
                ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
                ->select('p.id', 'p.idestudiante', 'p.descripcion', 'p.fecha','p.created_at','p.numcomprobante', 'p.montototal','p.archivo', 'e.nombre', 'e.apellidos','e.dni')
                ->orderBy('id', 'asc')->get();


            $articulo = Articulo::with('categoria')->get();
           // dd($articulo);

            $estudiante = Matricula::with('estudiantes')->with('concepto')->get();
            $concepto = Concepto::all();


            return view('pages.pago.index', compact('pago', 'concepto', 'estudiante', 'articulo'));
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validated = $request->validate([
        'idestudiante' => 'required',  
        
        'montototal' => 'required|numeric|min:0',
      //  'imagen' => 'nullable|image|mimes:jpg,png,jpeg|max:5120', // <= 5MB
        'imagen' => 'nullable|image|max:5120',


    ]);
        try {
            DB::beginTransaction();
            $pago = new Pagos;
            $mytime = Carbon::now('America/Lima');
            $anolect = Anolectivo::where('estado', 1)->first();
            $ultimoRegistro = Pagos::orderBy('id','desc')->first();
            
           
            $separarid=$request->get('idestudiante');
            $idestudiante = explode('/', $separarid);
            $pago->idestudiante =$idestudiante[0];
            
            $pago->montototal = $request->get('montototal');
            $pago->descripcion = $request->get('montototal');


             if ($request->file('imagen')) {
            $file = $request->file('imagen');
          $name = time() . '.jpg'; // fuerza extensión jpg
            $extension = $file->getClientOriginalExtension();

            $path = Storage::putFileAs('pagos', $request->file('imagen'), $name);
            
            $pago->archivo = $name;
        }


            $pago->fecha = $mytime->toDateTimeString();
            if(empty($ultimoRegistro)==true){

            $pago->numcomprobante = 8100;
            }else{
                $pago->numcomprobante = $ultimoRegistro->numcomprobante +1;
            }
            
             $pago->idanolectivo = $anolect->id;
            $pago->save();




            //articulos
            $idarticulo = $request->get('idarticulo');
            $cantidadar = $request->get('cantidadar');
            $montoar = $request->get('montoar');

            if (is_string($idarticulo) == false) {
                if ($idarticulo != null) {
                    $contador = 0;
                    while ($contador < count($idarticulo)) {
                        $detallep = new Detallepago();

                        $detallep->idpago = $pago->id;
                        $detallep->idarticulo = $idarticulo[$contador];
                        $detallep->cantidadar = $cantidadar[$contador];


                        $articulo = Articulo::find($idarticulo[$contador]);
                        $stock1 = $articulo->stock; // unma
                        $articulo->stock = $stock1 - $cantidadar[$contador];
                        $articulo->update();

                        $detallep->montoar = $montoar[$contador] * $cantidadar[$contador];

                        $detallep->fecha = $mytime->toDateTimeString();

                        $detallep->save();
                        $contador++;
                    }
                }
            }


            //pensiones-----------------
            $idconcepto = $request->get('idconcepto');
            $cantidad = $request->get('cantidad');
            $monto = $request->get('monto');
            $descripcion = $request->get('idconcepto');
            $idmatriula=Matricula::where('idestudiante',$idestudiante[0])->first();
            // dd(is_string($idconcepto));
            if (is_string($idconcepto) == false) {
                if ($idconcepto != null) {
                    $cont = 0;
                    while ($cont < count($idconcepto)) {
                        $detalle = new Pension();
                        // dd($ingreso->id);
                        $detalle->idpago = $pago->id;
                        $detalle->idconcepto = $idconcepto[$cont];
                        $detalle->cantidad = $cantidad[$cont];

                        $concep = Concepto::where('id', $idconcepto[$cont])->first();
                        if ($concep->codigo=='P001') {
                            $id = $idmatriula->id;
                            $numeropension = $cantidad[$cont];

                            $numeromesespagados = Mese::where('idmatricula', $id)->count();
                            //  dd($numeropension,$numeromesespagados);

                            $meses = ['MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SET', 'OCT', 'NOV', 'DIC'];
                            for ($i = 0; $i <  $numeropension; $i++) {
                                $mess = new Mese();
                                $mess->idmatricula = $id;

                                $mess->mes = $meses[$numeromesespagados];

                                $mess->save();
                                $numeromesespagados++;
                            }
                        }

                        $detalle->monto = $monto[$cont] * $cantidad[$cont];
                        $detalle->fecha = $mytime->toDateTimeString();
                        $detalle->save();
                        $cont++;
                    }
                }
            }


            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
        }
        //estudiante------------------------





        return back()->with('message', 'Registro Exítoso');
    }




    public function update(UpdatePagosRequest $request,  $pago)
    {
        $pago = Pagos::find($pago);
        $pago->idestudiante = $request->get('idestudiante');
        $pago->idconcepto = $request->get('idconcepto');
        $pago->descripcion = $request->get('descripcion');
        $pago->update();

        return back()->with('message', 'Actualización Exítosa');
    }
    public function show($id)
    {
        $estudiante = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->select('p.id', 'e.nombre', 'e.apellidos', 'e.dni', 'p.created_at as fecha', 'p.montototal','p.numcomprobante','p.archivo')->where('p.id', $id)->get();
        // dd($estudiante);
        $pension = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->join('pensions as pen', 'p.id', '=', 'pen.idpago')
            ->join('conceptos as c', 'pen.idconcepto', '=', 'c.id')
            ->select('p.id', 'e.nombre', 'e.apellidos','e.dni', 'c.concepto', 'p.created_at as fecha', 'p.montototal','p.archivo', 'pen.cantidad', 'pen.monto','p.numcomprobante')->where('p.id', $id)->get();
        // dd($pension);

        $articulo = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->join('detallepagos as det', 'p.id', '=', 'det.idpago')
            ->join('articulos as a', 'det.idarticulo', '=', 'a.id')
            ->join('categorias as c', 'a.idcategoria', '=', 'c.id')
            ->select('p.id', 'p.idestudiante', 'a.nombre as articulo', 'c.nombre as categoria', 'p.created_at as fecha','p.archivo', 'det.cantidadar as cantidad', 'det.montoar','p.numcomprobante')->where('p.id', $id)->get();


        //  dd($articulo);
        return view("pages.pago.show", compact('pension', 'articulo', 'estudiante'));
    }



    public function destroy($pagoid)
    {

        $pago = Pagos::find($pagoid);
      
        $detallecont = Detallepago::where('idpago', $pagoid)->get();
        //    dd(count($detallecont));
        if (count($detallecont) != 0) {
            for ($i = 0; $i < count($detallecont); $i++) {
                $detalle = Detallepago::where('idpago', $pagoid)->first();
                // dd($detalle);
                $cantidadarticulo = $detalle->cantidadar;
                // dd($detalle->idarticulo);
                $articulo = Articulo::find($detalle->idarticulo);
                $stock1 = $articulo->stock; // unma
                $articulo->stock = $stock1 + $cantidadarticulo;
                $articulo->update();
                $detalle->delete();
            }
        }

        //numero de penciones pagadas en esta factura
        $pensionescont = Pension::where('idpago', $pagoid)->get();


        if (count($pensionescont) != 0) {

            for ($i = 0; $i < count($pensionescont); $i++) {
                $pensiones = Pension::where('idpago', $pagoid)->count();
                if ($pensiones != 0) {
                    $pensiones = Pension::where('idpago', $pagoid)->first();
                    $concepto=Concepto::where('id',$pensiones->idconcepto)->first();
                    if($concepto->codigo=="P001"){
                    $cantidadpenciones = $pensiones->cantidad; //cantidad de penciones pagadas
                    $idestudiante = $pago->idestudiante; //estudiantee  
                    $idmatriula = Matricula::where('idestudiante', $idestudiante)->first();
                     for ($i = 0; $i <  $cantidadpenciones; $i++) {
                        $meses = Mese::where('idmatricula', $idmatriula->id)->get();

                        $idmeses = $meses[count($meses) - 1]->id;
                        $mess = Mese::find($idmeses);
                        $mess->delete();
                    }
                    }else{
                        $pensiones = Pension::where('idpago', $pagoid)->first();
                        $pensiones->delete();
                    }
                                        
                   
                } 
            }
        }

        $pago->delete();


        return back()->with('message', 'Archivo Eliminado ');
    }

    /** Reporte Comprobant PDF Formato A4 **/
    public function reportepdf($id)
    {

        $estudiante = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->select('p.id', 'e.nombre', 'e.apellidos', 'e.dni','e.nombreapoderado', 'p.created_at as fecha', 'p.montototal','p.numcomprobante')->where('p.id', $id)->get();
        //  dd($estudiante);
        $pension = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->join('pensions as pen', 'p.id', '=', 'pen.idpago')
            ->join('conceptos as c', 'pen.idconcepto', '=', 'c.id')
            ->select('p.id', 'c.codigo', 'c.concepto', 'c.monto', 'p.created_at as fecha', 'p.montototal', 'pen.cantidad', 'pen.monto','p.numcomprobante')->where('p.id', $id)->get();
        // dd($pension);

        $articulo = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->join('detallepagos as det', 'p.id', '=', 'det.idpago')
            ->join('articulos as a', 'det.idarticulo', '=', 'a.id')
            ->join('categorias as c', 'a.idcategoria', '=', 'c.id')
            ->select('p.id', 'p.idestudiante', 'a.nombre as articulo', 'c.nombre as categoria', 'p.created_at as fecha', 'det.cantidadar as cantidad', 'det.montoar','p.numcomprobante')->where('p.id', $id)->get();

        $pdf = Pdf::loadView('pages.pago.reportecomprobanteA4', compact('pension', 'articulo', 'estudiante'));

        return $pdf->stream('' . $estudiante[0]->nombre . '-' . $estudiante[0]->apellidos . '.pdf');
    }


    //peporte pdf---------------------------------------
    /** Reporte No Emparejados PDF **/
    public function reportepago($id)
    {
        $estudiante = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->select('p.id', 'e.nombre', 'e.apellidos', 'e.dni','e.nombreapoderado', 'p.created_at as fecha', 'p.montototal','p.numcomprobante')->where('p.id', $id)->get();
        //    dd($estudiante[0]->nombre);
        $pension = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->join('pensions as pen', 'p.id', '=', 'pen.idpago')
            ->join('conceptos as c', 'pen.idconcepto', '=', 'c.id')
            ->select('p.id', 'c.codigo', 'c.concepto', 'c.monto', 'p.created_at as fecha', 'p.montototal', 'pen.cantidad', 'pen.monto','p.numcomprobante')->where('p.id', $id)->get();
        // dd($pension);

        $articulo = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->join('detallepagos as det', 'p.id', '=', 'det.idpago')
            ->join('articulos as a', 'det.idarticulo', '=', 'a.id')
            ->join('categorias as c', 'a.idcategoria', '=', 'c.id')
            ->select('p.id', 'p.idestudiante', 'a.nombre as articulo', 'c.nombre as categoria', 'p.created_at as fecha', 'det.cantidadar as cantidad', 'det.montoar','p.numcomprobante')->where('p.id', $id)->get();
        // dd($articulo);

        $pdf = Pdf::loadView('pages.pago.reporteComprobante', compact('pension', 'articulo', 'estudiante'));
        $pdf->set_paper(array(0, 0, 135, 380), 'portrait');
        return $pdf->stream('' . $estudiante[0]->nombre . '-' . $estudiante[0]->apellidos .'.pdf');
    }

    // funcion para tikect------------------------------------------------------------
  
}
