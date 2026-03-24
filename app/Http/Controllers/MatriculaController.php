<?php

namespace App\Http\Controllers;

use App\Models\Anolectivo;
use App\Models\Estudiante;
use App\Models\Mese;
use App\Models\Aula;
use App\Models\Sede;
use App\Models\Matricula;
use App\Models\Concepto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel; //importaciones a excel....EstudianteExport

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request) {


$user = auth()->user();

$sedes = $user->esSuperAdmin()
    ? Sede::all()
    : $user->sedes;

            $anolect = Anolectivo::where('estado', 1)->first();
            // Obtener solo los estudiantes sin matrícula
            //$estudiantes = Estudiante::whereDoesntHave('matricula')->get();
            // $estudiante=Estudiante::all();
          
$user = auth()->user();

$estudiantesMatriculados = Matricula::where('idanolectivo', $anolect->id)
    ->where('estado', 1) // 🔥 SOLO los activos (no trasladados)
    ->pluck('idestudiante')
    ->unique();

$estudiante = Estudiante::whereNotIn('id', $estudiantesMatriculados)->get();
            // dd($estudiante);
            $anolect = Anolectivo::where('estado', 1)->first();
            $concepto = Concepto::where('codigo', 'P001')->orderBy('concepto', 'desc')->get();

            $searchText = trim($request->get('searchText'));
            $searchTextFecha = trim($request->get('searchTextFecha'));
           $matricula = Matricula::porUsuario()->where('idanolectivo', $anolect->id)
                ->when($searchTextFecha, function ($q) use ($searchTextFecha) {
                    // Usamos whereDate para ignorar la hora del timestamp 'created_at'
                    return $q->whereDate('created_at', $searchTextFecha);
                })
                ->whereHas('estudiante', function ($q) use ($searchText) {
                    $q->where('nombre', 'LIKE', '%' . $searchText . '%')
                        ->orWhere('apellidos', 'LIKE', '%' . $searchText . '%');
                })->with([
                    'estudiante',
                    'aula',
                    'meses',
                    'concepto',

                    // 🔥 TRAER PAGOS POR CONCEPTO A LA VEZ
                    // 🔥 nuevas relaciones
                    'estudiante.pagos.pensiones.concepto'
                ])
                ->paginate(50);

            $aula = Aula::porUsuario()->get();
            return view('pages.matricula.index', compact('estudiante', 
            'aula', 'matricula', 'concepto', 'searchText', 'searchTextFecha','sedes'));
        }
    }
 
    /**
     * Show the form for creating a new resource.
     */
   
    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{
    $estudianteid = $request->get('estudiante_id');
    $aula = $request->get('aula_id');
    $codigo = $request->get('codigo'); // ⚠️ opcional
    $fecha_matricula = $request->get('fecha_matricula');
    $colegio_procedencia = $request->get('colegio_procedencia');

    $anolectivo = Anolectivo::where('estado', 1)->first();
    $user = auth()->user();

    // 🔥 definir sede automáticamente
    $idsede = $user->esSuperAdmin()
        ? $request->idsede
        : $user->sedes->first()->id;

    foreach ($estudianteid as $idEst) {

        // ❌ evitar duplicados por año
        $existe = Matricula::where('idestudiante', $idEst)
            ->where('idanolectivo', $anolectivo->id)
            ->exists();

        if ($existe) {
            return back()->with('danger', 'El alumno ya está matriculado en este año');
        }

        $matricula = new Matricula();
        $matricula->idestudiante = $idEst;
        $matricula->idanolectivo = $anolectivo->id;
        $matricula->idaula = $aula;
        $matricula->idsede = $idsede; // 🔥 CLAVE
        $matricula->fecha_matricula = $fecha_matricula;
        $matricula->colegio_procedencia = $colegio_procedencia;
        $matricula->idconcepto = 1;

        // 🔥 SOLO asignar código si viene (no obligatorio)
        if (!empty($codigo)) {

            $existeCodigo = Matricula::where('codigo', $codigo)->exists();

            if ($existeCodigo) {
                return back()->with('danger', 'El código RFID ya está en uso');
            }

            $matricula->codigo = $codigo;
        }

        $matricula->save();
    }

    return back()->with('message', 'Registro Exitoso');
}

    public function show($id) 
    {
        $matricula = Matricula::where('id', $id)->with('estudiante.apoderado')->with('aula')->first();
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

    $aula = Aula::porUsuario()->findOrFail($id); // 🔥 seguridad

    $matricula = Matricula::porUsuario()
        ->where('idanolectivo', $anolect->id)
        ->where('idaula', $id)
        ->join('estudiantes', 'matriculas.idestudiante', '=', 'estudiantes.id')
        ->orderBy('estudiantes.apellidos', 'asc')
        ->select('matriculas.*')
        ->with([
            'estudiante',
            'aula',
            'meses',
            'concepto',
            'estudiante.pagos.pensiones.concepto'
        ])
        ->get();

    return view("pages.matricula.showaula", compact('matricula', 'aula'));
}
    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, $id)
{
    $matricula = Matricula::findOrFail($id);

    // 🔥 validar RFID único
    if ($request->codigo) {
        $existe = Matricula::where('codigo', $request->codigo)
            ->where('id', '!=', $id)
            ->exists();

        if ($existe) {
            return back()->with('danger', 'Este código RFID ya está asignado');
        }
    }

    $matricula->idaula = $request->aula_id;
    $matricula->idconcepto = 1;
    $matricula->estado = $request->estado;
    $matricula->codigo = $request->codigo;

    $matricula->update();

    return back()->with('message', 'Actualización Exitosa');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($matricula)
    {
        $matricula = Matricula::find($matricula);
        $matricula->delete();
        return back()->with('message', 'Registro Eliminado ');
    }


    public function reportematricula(Request $request)
    {
        $request->validate([
            'aula' => 'required'
        ]);
        $idaula = $request->get('aula');
        $aula = Aula::orderBy('nivel', 'asc')
            ->orderByRaw("CAST(grado AS UNSIGNED) asc")
            ->orderBy('seccion', 'asc')
            ->get();


        $anolect = Anolectivo::where('estado', 1)->first();

        if ($idaula == "todos") {
            $mostraraula = (object)[
                "nivel" => "",
                "grado" => "",
                "seccion" => ""
            ];

            //dd($idaula);

            $matricula = Matricula::where('idanolectivo', $anolect->id)->with('estudiante')->with('aula')->with('meses')->orderBy('idaula', 'asc')->get();

            $pdf = Pdf::loadView('pages.matricula.invocepdf', compact('matricula', 'anolect', 'aula', 'mostraraula'));
            $pdf->setPaper('A4', 'landscape');
            return $pdf->stream('lista_matriculado_' . ' $anolect' . '.pdf',);
        }

        $matricula = Matricula::where('idanolectivo', $anolect->id)->where('idaula', $idaula)->with('estudiante')->with('aula')->with('meses')->get();
        $mostraraula = Aula::where('id', $idaula)->first();

        $pdf = Pdf::loadView('pages.matricula.invocepdf', compact('matricula', 'anolect', 'mostraraula'));
        $pdf->setPaper('A4', 'landscape'); //Formato de hoha A4 en horizontal
        return $pdf->stream('lista_matriculado_' . ' $anolect' . '.pdf');
    }
    public function admisiontraslado(Request $request) {}
}
