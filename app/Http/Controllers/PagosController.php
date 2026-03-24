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
use App\Models\Movimiento;
use App\Models\Pago;
use App\Models\Caja;
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

            $searchText = trim($request->get('searchText'));


            $pago = DB::table('pagos as p')
                ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
                ->select('p.id', 'p.idestudiante', 'p.descripcion', 'p.fecha', 'p.created_at', 'p.numcomprobante', 'p.montototal', 'p.montodigital', 'p.montoefectivo', 'p.cobrado_por', 'p.archivo', 'e.nombre', 'e.apellidos', 'e.dni')->where('e.nombre', 'LIKE', '%' . $searchText . '%')->orwhere('e.apellidos', 'LIKE', '%' . $searchText . '%')
                ->orderBy('id', 'desc')->paginate(30);


            $articulo = Articulo::with('categoria')->get();
            // dd($articulo);

            $estudiante = Matricula::with('estudiante')->with('concepto', 'meses', 'estudiante.pagos.pensiones.concepto')->get();
            $concepto = Concepto::orderBy('codigo', 'asc')->orderBy('concepto', 'desc')->get();


            $monto = DB::table('pagos')
                ->whereDate('created_at', date('Y-m-d'))
                ->sum('montoefectivo');


            return view('pages.pago.index', compact('pago', 'concepto', 'estudiante', 'articulo', 'monto', 'searchText'));
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
        //  try {
        //   DB::beginTransaction();

        $mytime = Carbon::now('America/Lima');
        $anolect = Anolectivo::where('estado', 1)->first();



        $separarid = $request->get('idestudiante');
        //caja apertura
        $caja = Caja::where('iduser', auth()->id())
            ->where('estado', 1)
            ->first();

        if (!$caja) {
            return back()->with('message', 'Debe abrir caja primero');
        }
        //dd($separarid);
        $contadorestu = 0;
        while ($contadorestu < count($separarid)) {
            $idestudiante = explode('|', $separarid[$contadorestu]);

            $pago = new Pagos;
            $ultimoRegistro = Pagos::orderBy('id', 'desc')->first();
            $pago->idestudiante = $idestudiante[0];

            $pago->montototal = $request->get('montototal');
            $pago->cobrado_por = $request->cobrado_por;
            if ($request->get('efetivo') == 1) {
                $pago->montodigital = $request->get('montodigital');
                $pago->montoefectivo = $request->get('montototal') - $request->get('montodigital');
                $pago->descripcion = $request->get('descripcion');
            } else {
                $pago->montodigital = 0;
                $pago->montoefectivo = $request->get('montototal');
            }

            if ($request->file('imagen')) {
                $file = $request->file('imagen');
                $name = time() . '.jpg'; // fuerza extensión jpg
                $extension = $file->getClientOriginalExtension();
                $path = Storage::putFileAs('pagos', $request->file('imagen'), $name);
                $pago->archivo = $name;
            }
            $pago->fecha = $mytime->toDateTimeString();
            if (empty($ultimoRegistro) == true) {
                $pago->numcomprobante = 1;
            } else {
                $pago->numcomprobante = $ultimoRegistro->numcomprobante + 1;
            }
            $pago->idanolectivo = $anolect->id;
            $pago->save();
            //registro de movimiento
            // 🔥 EFECTIVO
            if ($pago->montoefectivo > 0) {
                Movimiento::create([
                    'idcaja' => $caja->id,
                    'tipo' => 'ingreso',
                    'monto' => $pago->montoefectivo,
                    'metodo' => 'efectivo',
                    'descripcion' => 'Pago estudiante ID ' . $pago->idestudiante,
                    'idpago' => $pago->id
                ]);
            }

            // 📱 DIGITAL (YAPE)
            if ($pago->montodigital > 0) {
                Movimiento::create([
                    'idcaja' => $caja->id,
                    'tipo' => 'ingreso',
                    'monto' => $pago->montodigital,
                    'metodo' => 'yape',
                    'descripcion' => 'Pago estudiante ID ' . $pago->idestudiante,
                    'idpago' => $pago->id
                ]);
            }
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
            $idmatricula = Matricula::where('idestudiante', $idestudiante[0])->first();
            /* dd(($idmatricula)); */
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

                        if ($concep->codigo == 'P001') {

                            $id = $idmatricula->id;
                            $numeropension = $cantidad[$cont];

                            $mesInicioNumero = Carbon::parse($idmatricula->fecha_matricula)->month;

                            $mesesMap = [
                                1 => 'ENE',
                                2 => 'FEB',
                                3 => 'MAR',
                                4 => 'ABR',
                                5 => 'MAY',
                                6 => 'JUN',
                                7 => 'JUL',
                                8 => 'AGO',
                                9 => 'SET',
                                10 => 'OCT',
                                11 => 'NOV',
                                12 => 'DIC'
                            ];

                            // 🔥 último mes pagado
                            $ultimoMes = Mese::where('idmatricula', $id)->max('mes_numero');

                            $mesActual = $ultimoMes ? $ultimoMes + 1 : $mesInicioNumero;

                            for ($i = 0; $i < $numeropension; $i++) {

                                if ($mesActual > 12) break;

                                // 🔒 validar duplicado real
                                $existe = Mese::where('idmatricula', $id)
                                    ->where('mes_numero', $mesActual)
                                    ->exists();

                                if ($existe) {
                                    $mesActual++;
                                    continue;
                                }

                                $mess = new Mese();
                                $mess->idmatricula = $id;
                                $mess->mes_numero = $mesActual;
                                $mess->mes = $mesesMap[$mesActual];
                                $mess->estado = 1;
                                $mess->save();

                                $mesActual++;
                            }
                        }

                        $detalle->monto = $monto[$cont] * $cantidad[$cont];
                        $detalle->fecha = $mytime->toDateTimeString();
                        $detalle->save();
                        $cont++;
                    }
                }
            }

            $contadorestu++;
        }



        //         DB::commit();
        //     } catch (\Exception $e) {
        //       DB::rollback();
        // }
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
            ->select('p.id', 'e.nombre', 'e.apellidos', 'e.dni', 'p.created_at as fecha', 'p.montototal', 'p.numcomprobante', 'p.archivo')->where('p.id', $id)->get();
        // dd($estudiante);
        $pension = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->join('pensions as pen', 'p.id', '=', 'pen.idpago')
            ->join('conceptos as c', 'pen.idconcepto', '=', 'c.id')
            ->select('p.id', 'e.nombre', 'e.apellidos', 'e.dni', 'c.concepto', 'p.created_at as fecha', 'p.montototal', 'p.archivo', 'pen.cantidad', 'pen.monto', 'p.numcomprobante')->where('p.id', $id)->get();
        // dd($pension);

        $articulo = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->join('detallepagos as det', 'p.id', '=', 'det.idpago')
            ->join('articulos as a', 'det.idarticulo', '=', 'a.id')
            ->join('categorias as c', 'a.idcategoria', '=', 'c.id')
            ->select('p.id', 'p.idestudiante', 'a.nombre as articulo', 'c.nombre as categoria', 'p.created_at as fecha', 'p.archivo', 'det.cantidadar as cantidad', 'det.montoar', 'p.numcomprobante')->where('p.id', $id)->get();


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
                    $concepto = Concepto::where('id', $pensiones->idconcepto)->first();
                    if ($concepto->codigo == "P001") {
                        $cantidadpenciones = $pensiones->cantidad; //cantidad de penciones pagadas
                        $idestudiante = $pago->idestudiante; //estudiantee  
                        $idmatricula = Matricula::where('idestudiante', $idestudiante)->first();
                        for ($i = 0; $i <  $cantidadpenciones; $i++) {
                            $meses = Mese::where('idmatricula', $idmatricula->id)->get();

                            $idmeses = $meses[count($meses) - 1]->id;
                            $mess = Mese::find($idmeses);
                            $mess->delete();
                        }
                    } else {
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
            ->select('p.id', 'e.nombre', 'e.apellidos', 'e.dni', 'e.nombreapoderado', 'p.created_at as fecha', 'p.montototal', 'p.numcomprobante')->where('p.id', $id)->get();
        //  dd($estudiante);
        $pension = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->join('pensions as pen', 'p.id', '=', 'pen.idpago')
            ->join('conceptos as c', 'pen.idconcepto', '=', 'c.id')
            ->select('p.id', 'c.codigo', 'c.concepto', 'c.monto', 'p.created_at as fecha', 'p.montototal', 'pen.cantidad', 'pen.monto', 'p.numcomprobante')->where('p.id', $id)->get();
        // dd($pension);

        $articulo = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->join('detallepagos as det', 'p.id', '=', 'det.idpago')
            ->join('articulos as a', 'det.idarticulo', '=', 'a.id')
            ->join('categorias as c', 'a.idcategoria', '=', 'c.id')
            ->select('p.id', 'p.idestudiante', 'a.nombre as articulo', 'c.nombre as categoria', 'p.created_at as fecha', 'det.cantidadar as cantidad', 'det.montoar', 'p.numcomprobante')->where('p.id', $id)->get();

        $pdf = Pdf::loadView('pages.pago.reportecomprobanteA4', compact('pension', 'articulo', 'estudiante'));

        return $pdf->stream('' . $estudiante[0]->nombre . '-' . $estudiante[0]->apellidos . '.pdf');
    }


    //peporte pdf---------------------------------------
    /** Reporte No Emparejados PDF **/
    public function reportepago($id)
    {
        $estudiante = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->join('apoderados as a', 'a.id', '=', 'e.idapoderado')
            ->select('p.id', 'e.nombre', 'e.apellidos', 'e.dni', 'a.nombre as nombreapoderado', 'a.nombre as apellidos','p.created_at as fecha', 'p.montototal', 'p.numcomprobante')->where('p.id', $id)->get();
        //    dd($estudiante[0]->nombre);
        $pension = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->join('pensions as pen', 'p.id', '=', 'pen.idpago')
            ->join('conceptos as c', 'pen.idconcepto', '=', 'c.id')
            ->select('p.id', 'c.codigo', 'c.concepto', 'c.monto', 'p.created_at as fecha', 'p.montototal', 'pen.cantidad', 'pen.monto', 'p.numcomprobante')->where('p.id', $id)->get();
        // dd($pension);

        $articulo = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->join('detallepagos as det', 'p.id', '=', 'det.idpago')
            ->join('articulos as a', 'det.idarticulo', '=', 'a.id')
            ->join('categorias as c', 'a.idcategoria', '=', 'c.id')
            ->select('p.id', 'p.idestudiante', 'a.nombre as articulo', 'c.nombre as categoria', 'p.created_at as fecha', 'det.cantidadar as cantidad', 'det.montoar', 'p.numcomprobante')->where('p.id', $id)->get();
        // dd($articulo);

        $pdf = Pdf::loadView('pages.pago.reporteComprobante', compact('pension', 'articulo', 'estudiante'));
        $pdf->set_paper(array(0, 0, 135, 380), 'portrait');

        return $pdf->stream('' . $estudiante[0]->nombre . '-' . $estudiante[0]->apellidos . '.pdf');
    }

    // funcion para tikect------------------------------------------------------------

    public function reportefectivohoy()
    {

        $pago = DB::table('pagos as p')
            ->join('estudiantes as e', 'p.idestudiante', '=', 'e.id')
            ->leftJoin(DB::raw("(

        SELECT pen.idpago, c.concepto as detalle
        FROM pensions pen
        JOIN conceptos c ON pen.idconcepto = c.id

        UNION ALL

        SELECT det.idpago, cat.nombre as detalle
        FROM detallepagos det
        JOIN articulos a ON det.idarticulo = a.id
        JOIN categorias cat ON a.idcategoria = cat.id

    ) as detalles"), 'detalles.idpago', '=', 'p.id')
            ->select(
                'p.id',
                'p.idestudiante',
                'p.descripcion',
                'p.fecha',
                'p.created_at',
                'p.numcomprobante',
                'p.montototal',
                'p.montodigital',
                'p.montoefectivo',
                'p.cobrado_por',
                'p.archivo',
                'e.nombre',
                'e.apellidos',
                'e.dni',
                DB::raw("GROUP_CONCAT(DISTINCT detalles.detalle SEPARATOR ', ') as detalle")
            )
            ->whereDate('p.created_at', date('Y-m-d'))
            ->groupBy(
                'p.id',
                'p.idestudiante',
                'p.descripcion',
                'p.fecha',
                'p.created_at',
                'p.numcomprobante',
                'p.montototal',
                'p.montodigital',
                'p.montoefectivo',
                'p.cobrado_por',
                'p.archivo',
                'e.nombre',
                'e.apellidos',
                'e.dni'
            )
            ->orderBy('p.id', 'asc')
            ->get();

        $totales = DB::table('pagos')
            ->selectRaw('
            SUM(montototal) as total_monto,
            SUM(montoefectivo) as total_efectivo,
            SUM(montodigital) as total_digital
        ')
            ->whereDate('created_at', date('Y-m-d'))
            ->first();

        $pdf = Pdf::loadView('pages.pago.reportecaja', compact('pago', 'totales'));
        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream('reporte_caja_' . date('Y-m-d') . '.pdf');
    }



    //ajax para los pagos
    public function getPagos($id)
    {
        $matricula = Matricula::with([
            'meses',
            'estudiante.pagos.pensiones.concepto'
        ])->where('idestudiante', $id)->first();

        if (!$matricula) {
            return response()->json([
                'pagados' => [],
                'pendientes' => [],
                'conceptos' => []
            ]);
        }

        // 🔵 MESES PAGADOS
        $mesesPagados = $matricula->meses->pluck('mes')->toArray();

        // 🟢 TODOS LOS MESES
        $todosMeses = ['MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SET', 'OCT', 'NOV', 'DIC'];

        // 🔴 PENDIENTES
        $mesesPendientes = array_values(array_diff($todosMeses, $mesesPagados));

        // 🟣 CONCEPTOS PAGADOS (AQUÍ ESTÁ LO NUEVO 🔥)
        $pensiones = $matricula->estudiante->pagos->flatMap->pensiones;

        $conceptosMostrar = [
            'MATR2026' => 'MTR',
            'C2025' => 'COP',
            'PSC2025' => 'PS',
            'UE2025' => 'UTE',
        ];

        $conceptosPagadosArray = [];

        foreach ($conceptosMostrar as $codigo => $label) {
            if ($pensiones->firstWhere('concepto.codigo', $codigo)) {
                $conceptosPagadosArray[] = $label;
            }
        }

        return response()->json([
            'pagados' => $mesesPagados,
            'pendientes' => $mesesPendientes,
            'conceptos' => $conceptosPagadosArray // 👈 importante
        ]);
    }
}
