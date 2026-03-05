<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // importacion
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
    public function fechameses() {}
    public function index(Request $request)
    {

        if ($request) {


            $date = Carbon::now()->locale('es');
            // dd(date('m'));
            $usuarios = User::all();


            $anolect = Anolectivo::where('estado', 1)->first();
            $estudiante = Matricula::where('idanolectivo', $anolect->id)->get();

            // dd($estudiante); cantidad de estudiante
            $mesesporcentaje = DB::table('meses as me')
                ->join('matriculas as m', 'me.idmatricula', '=', 'm.id')
                ->join('estudiantes as est', 'm.idestudiante', '=', 'est.id')
                ->select('m.idanolectivo', 'me.mes', DB::raw('count(*) as cantidad'), DB::raw('count(est.id) as estudiante'))
                ->where('m.idanolectivo', $anolect->id)
                ->groupBy('me.mes', 'm.idanolectivo')
                ->orderBy('cantidad', 'desc')
                ->get();
            //  dd($mesesporcentaje);


            $pagosarticulos = DB::table('pagos as p')
                ->join('detallepagos as dt', 'p.id', '=', 'dt.idpago')
                ->join('articulos as art', 'dt.idarticulo', '=', 'art.id')
                ->join('categorias as c', 'art.idcategoria', '=', 'c.id')
                ->select('p.idanolectivo', 'art.nombre', 'c.nombre as categoria', DB::raw('sum(dt.cantidadar) as cantidad'), DB::raw('sum(dt.montoar) as monto'))
                ->where('p.idanolectivo', $anolect->id)
                ->groupBy('art.nombre', 'c.nombre', 'p.idanolectivo')->get(); //ventas de productos de todos los products General
            //asistencias de hoy
            $puntualHoy = DB::table('asistenciaests')
                ->whereDate('fechaentrada', Carbon::today())
                ->where('estado', 1)
                ->count();
            //tardes de hoy
            $tardeHoy = DB::table('asistenciaests')
                ->whereDate('fechaentrada', Carbon::today())
                ->where('estado', 0)
                ->count();

            //faltas de hoy
            $faltaHoy = DB::table('asistenciaests')
                ->whereDate('fechaentrada', Carbon::today())
                ->where('estado', 4)
                ->count();

            $pagosadministrativos = DB::table('pagos as p')
                ->join('pensions as pen', 'p.id', '=', 'pen.idpago')
                ->join('conceptos as con', 'pen.idconcepto', '=', 'con.id')
                ->select('p.idanolectivo', 'con.concepto', DB::raw('sum(pen.cantidad) as cantidad'), DB::raw('sum(pen.monto) as monto'))
                ->where('p.idanolectivo', $anolect->id)
                ->groupBy('con.concepto', 'p.idanolectivo')->get(); //pagos de todos los concepts administrativ incluyendo pensiones general


            $pagospensiones = DB::table('pagos as p')
                ->join('pensions as pen', 'p.id', '=', 'pen.idpago')
                ->join('conceptos as con', 'pen.idconcepto', '=', 'con.id')
                ->select('p.idanolectivo', 'con.id', 'con.concepto', DB::raw('sum(pen.cantidad) as cantidad'), DB::raw('sum(pen.monto) as monto'))
                ->where('con.id', 1)
                ->where('p.idanolectivo', $anolect->id)
                ->groupBy('con.concepto', 'con.id', 'p.idanolectivo')->get(); //pagos de pensiones-------


            $pagosventas = DB::table('pagos as p')->select(DB::raw('sum(p.montototal) as montototal'))->where('p.idanolectivo', $anolect->id)->get();

            $pagosventasmes = DB::table('pagos as p')->select(DB::raw('sum(p.montototal) as montototal'))->where('p.idanolectivo', $anolect->id)->whereMonth('created_at', date('m'))->get();
            //  dd($pagosventas);

            $pagosingresos = DB::table('ingresos as i')->select(DB::raw('sum(i.montototal) as montototal'))->get();
            $pagosingresosmes = DB::table('ingresos as i')->select(DB::raw('sum(i.montototal) as montototal'))->whereMonth('created_at', date('m'))->get();
            //escribimosss......
            $fechaInicio = $request->filled('fechainicio')
                ? Carbon::parse($request->fechainicio)
                : Carbon::parse($anolect->inicio);

            $fechaFin = $request->filled('fechafin')
                ? Carbon::parse($request->fechafin)
                : Carbon::today();

            //porcentajes de falta.....
            $reporte = DB::table('asistenciaests as a')
                ->join('matriculas as m', 'a.idmatricula', '=', 'm.id')
                ->join('estudiantes as e', 'm.idestudiante', '=', 'e.id')
                ->join('aulas as au', 'm.idaula', '=', 'au.id')
                ->whereBetween('a.fechaentrada', [$fechaInicio, $fechaFin])
                ->where('a.idanolectivo', $anolect->id)
                ->select(
                    'e.id',
                    'e.nombre',
                    'e.apellidos',
                    'e.celular',
                    'au.nivel',
                    'au.grado',
                    'au.seccion',
                    DB::raw('COUNT(*) as total_dias'),
                    DB::raw('SUM(CASE WHEN a.estado=4 THEN 1 ELSE 0 END) as total_faltas'),
                    DB::raw('(SUM(CASE WHEN a.estado=4 THEN 1 ELSE 0 END) * 100.0 / COUNT(*)) as porcentaje_faltas')
                )
                ->groupBy('e.id', 'e.nombre', 'e.apellidos', 'e.celular', 'au.nivel', 'au.grado', 'au.seccion')
                ->havingRaw('(SUM(CASE WHEN a.estado=4 THEN 1 ELSE 0 END) * 100.0 / COUNT(*)) >= 20')
                ->orderByDesc('porcentaje_faltas')
                ->limit(15)->get();

            $reportetarde = DB::table('asistenciaests as a')
                ->join('matriculas as m', 'a.idmatricula', '=', 'm.id')
                ->join('estudiantes as e', 'm.idestudiante', '=', 'e.id')
                ->join('aulas as au', 'm.idaula', '=', 'au.id')
                ->whereBetween('a.fechaentrada', [$fechaInicio, $fechaFin])
                ->where('a.idanolectivo', $anolect->id)
                ->select(
                    'e.id',
                    'e.nombre',
                    'e.apellidos',
                    'e.celular',
                    'au.nivel',
                    'au.grado',
                    'au.seccion',
                    DB::raw('COUNT(*) as total_dias'),
                    DB::raw('SUM(CASE WHEN a.estado = 0 THEN 1 ELSE 0 END) as total_tardanzas'),
                    DB::raw('
            (SUM(CASE WHEN a.estado = 0 THEN 1 ELSE 0 END) * 100.0 / COUNT(*))
            as porcentaje_tardanza
        ')
                )
                ->groupBy(
                    'e.id',
                    'e.nombre',
                    'e.apellidos',
                    'e.celular',
                    'au.nivel',
                    'au.grado',
                    'au.seccion'
                )
                ->havingRaw('
        (SUM(CASE WHEN a.estado = 0 THEN 1 ELSE 0 END) * 100.0 / COUNT(*)) >= 30
    ')
                ->orderByDesc('porcentaje_tardanza')
                ->limit(15)
                ->get();

            $asistenciaPorcentaje = DB::table('asistenciaests as a')
                ->join('matriculas as m', 'a.idmatricula', '=', 'm.id')
                ->join('estudiantes as e', 'm.idestudiante', '=', 'e.id')
                ->join('aulas as au', 'm.idaula', '=', 'au.id')
                ->whereBetween('a.fechaentrada', [$fechaInicio, $fechaFin])
                ->where('a.idanolectivo', $anolect->id)

                ->select(
                    'e.id',
                    'e.nombre',
                    'e.apellidos',
                    'e.celular',
                    'au.nivel',
                    'au.grado',
                    'au.seccion',

                    DB::raw('COUNT(*) as total_dias'),

                    DB::raw('SUM(CASE WHEN a.estado = 1 THEN 1 ELSE 0 END) as total_asistencias'),

                    DB::raw('
            ROUND(
                (SUM(CASE WHEN a.estado = 1 THEN 1 ELSE 0 END) * 100.0 / COUNT(*)),
                2
            ) as porcentaje_asistencia
        ')
                )

                ->groupBy(
                    'e.id',
                    'e.nombre',
                    'e.apellidos',
                    'e.celular',
                    'au.nivel',
                    'au.grado',
                    'au.seccion'
                )

                ->orderByDesc('porcentaje_asistencia')
                ->limit(15)
                ->get();



            // generar la torta
            $nivel = $request->filled('nivel')
                ? Carbon::parse($request->nivel)
                : 'Inicial'; // inicial, primaria, secundaria

            $inicio = $request->filled('fechainicio')
            ? Carbon::parse($request->fechainicio)
            : Carbon::parse($anolect->inicio);

        $fin = $request->filled('fechafin')
            ? Carbon::parse($request->fechafin)
            : Carbon::today();

        $datos = DB::table('asistenciaests as a')
            ->join('matriculas as m', 'a.idmatricula', '=', 'm.id')
            ->join('aulas as au', 'm.idaula', '=', 'au.id')
            ->where('au.nivel', $nivel)
           ->where('a.fechaentrada', date('Y-m-d'))
                //  ->where('a.fechaentrada', '2026-02-17')
            ->select(
                DB::raw("SUM(CASE WHEN a.estado = 1 THEN 1 ELSE 0 END) as puntual"),
                DB::raw("SUM(CASE WHEN a.estado = 0 THEN 1 ELSE 0 END) as tarde"),
                DB::raw("SUM(CASE WHEN a.estado = 4 THEN 1 ELSE 0 END) as falta")
            )
            ->first();
            $datos = (object) [
                'puntual' => $datos->puntual ?? 0,
                'tarde'   => $datos->tarde ?? 0,
                'falta'   => $datos->falta ?? 0,
            ];

            //diagrama de barras
             $nivelbarra = $request->nivel;

        $datosbarras = DB::table('asistenciaests as a')
        ->join('matriculas as m', 'a.idmatricula', '=', 'm.id')
        ->join('aulas as au', 'm.idaula', '=', 'au.id')
        ->where('au.nivel', $nivel)
        ->whereDate('a.fechaentrada', '2026-02-17')
        ->select(
            'au.grado',
             'au.seccion',
            DB::raw("SUM(CASE WHEN a.estado = 1 THEN 1 ELSE 0 END) as puntual"),
            DB::raw("SUM(CASE WHEN a.estado = 0 THEN 1 ELSE 0 END) as tarde"),
            DB::raw("SUM(CASE WHEN a.estado = 4 THEN 1 ELSE 0 END) as falta")
        )
        ->groupBy('au.grado',
             'au.seccion')
        ->orderByRaw("
            CASE 
                WHEN au.grado LIKE '%años%' THEN 0
                ELSE 1
            END,
            CAST(au.grado AS UNSIGNED)
        ")
        ->get();
        }


       

        // dd($inicio,$fin);
        //  dd($datos);

        return view('pages.dashboard', compact(
            'date',
            'puntualHoy',
            'tardeHoy',
            'faltaHoy',
            'estudiante',
            'pagosarticulos',
            'pagospensiones',
            'pagosventas',
            'pagosingresos',
            'pagosventasmes',
            'pagosingresosmes',
            'usuarios',
            'mesesporcentaje',
            'reporte',
            'reportetarde',
            'fechaInicio',
            'fechaFin',
            'datos',
            'asistenciaPorcentaje','datosbarras'
        ));
    }

    public function asistenciaPorNivel(Request $request)
    {
        $nivel = $request->nivel;

        $datos = DB::table('asistenciaests as a')
            ->join('matriculas as m', 'a.idmatricula', '=', 'm.id')
            ->join('aulas as au', 'm.idaula', '=', 'au.id')
             ->where('au.nivel', $nivel)
           ->where('a.fechaentrada', date('Y-m-d'))
           
            ->select(
                DB::raw("SUM(CASE WHEN a.estado = 1 THEN 1 ELSE 0 END) as puntual"),
                DB::raw("SUM(CASE WHEN a.estado = 0 THEN 1 ELSE 0 END) as tarde"),
                DB::raw("SUM(CASE WHEN a.estado = 4 THEN 1 ELSE 0 END) as falta")
            )
            ->first();

        return response()->json([
            'puntual' => (int) $datos->puntual,
            'tarde' => (int) $datos->tarde,
            'falta' => (int) $datos->falta,
        ]);
    }

    /**
     * metodo de barras
     */
  public function asistenciaPorAula(Request $request)
{
    $nivel = $request->nivel;

        $datos = DB::table('asistenciaests as a')
        ->join('matriculas as m', 'a.idmatricula', '=', 'm.id')
        ->join('aulas as au', 'm.idaula', '=', 'au.id')
        ->where('au.nivel', $nivel)
        ->whereDate('a.fechaentrada', date('Y-m-d'))
        ->select(
            'au.grado',
             'au.seccion',
            DB::raw("SUM(CASE WHEN a.estado = 1 THEN 1 ELSE 0 END) as puntual"),
            DB::raw("SUM(CASE WHEN a.estado = 0 THEN 1 ELSE 0 END) as tarde"),
            DB::raw("SUM(CASE WHEN a.estado = 4 THEN 1 ELSE 0 END) as falta")
        )
        ->groupBy('au.grado')
        ->orderByRaw("
            CASE 
                WHEN au.grado LIKE '%años%' THEN 0
                ELSE 1
            END,
            CAST(au.grado AS UNSIGNED)
        ")
        ->get();

    return response()->json($datos);
}
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


        $estudiante = Estudiante::all(); // cantidad de estudiante
        $estudianteid = []; //array que contiene los estudiantes que pagaronn
        $estudiantenp = 0; // cantidad de estudiante no pagados
        $estudiantep = 0; // cantidad de estudiante pagados

        for ($i = 0; $i < count($estudiante); $i++) {

            $pension = Pagos::where('idestudiante', $estudiante[$i]->id)->where('idconcepto', 1)->count();
            if ($contador === $pension) {
                $estudiantep++; // cantidad de estudiante pagados
            } else {
                $data = Estudiante::where('id', $estudiante[$i]->id)->get();
                $estudianteid[] = $data;

                $estudiantenp++; // cantidad de estudiante no pagados

            }
        }

        $lista = $estudianteid;
        $pdf = Pdf::loadView('pages.reporte', compact('lista', 'fecha'));
        return $pdf->download('lista-deudores.pdf');
    }





    public function destroy($concepto)
    {

        $concepto = Concepto::find($concepto);
        $concepto->delete();
        return back()->with('message', 'Archivo Eliminado ');
    }
}
