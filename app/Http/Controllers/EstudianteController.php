<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // importacion 
use App\Models\Estudiante;
use App\Http\Requests\StoreEstudianteRequest;
use App\Http\Requests\UpdateEstudianteRequest;

use App\Models\Mese;


use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\EstudianteExport;
use App\Imports\EstudianteImport;
use App\Exports\PlantillaEstudianteExport;
use App\Models\Aula;
use App\Models\Apoderado;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel; //importaciones a excel....EstudianteExport

class EstudianteController extends Controller
{
    /**
     * Display a listing of the resource.
     */


    public function __construct() {}

    public function index(Request $request)
    {

        if ($request) {
            $searchText = trim($request->get('searchText'));

            $items = Estudiante::where('nombre', 'LIKE', '%' . $searchText . '%')
                ->orWhere('apellidos', 'LIKE', '%' . $searchText . '%')->with('apoderado')->orderBy('id', 'desc')->paginate(50);
            //  dd($items);
            $aula = Aula::all();
            return view('pages.estudiante.index', compact('items', 'aula', 'searchText'));
        }
    }







    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEstudianteRequest $request)
    {
        try {
            // 1. Lógica del Apoderado: Buscar por DNI o crear si no existe
          
            $apoderado = Apoderado::firstOrCreate(
                ['dni' => $request->get('dniapoderado')],
                [
                    'nombre' => strtoupper($request->get('nombreapoderado')),
                    'celularp' => $request->get('celularp'),
                    'celularm' => $request->get('celularm'),
                    'celular' => $request->get('celularm') . ' / ' . $request->get('celularp'),
                    'password' => bcrypt($request->get('dniapoderado')),
                    'direccion' => strtoupper($request->get('direccion')),
                ]
            );

            // 2. Registro del Estudiante
            $estudiante = new Estudiante;
            $apellidop = $request->get('apellidop');
            $apellidom = $request->get('apellidom');

            $estudiante->nombre = strtoupper($request->get('nombre'));
            $estudiante->apellidos = strtoupper($apellidop . ' ' . $apellidom);
            $estudiante->dni = $request->get('dni');
            $estudiante->celular = strtoupper($request->get('celularm') . ' / ' . $request->get('celularp'));
            $estudiante->fecha_nacimiento = $request->get('fecha_nacimiento');
            $estudiante->colegio_procedencia = strtoupper($request->get('colegio_procedencia'));
            $estudiante->genero = strtoupper($request->get('genero'));
            // $estudiante->imagen = $request->get('imagen');
            $estudiante->idapoderado = $apoderado->id; // Vinculación
            $estudiante->observaciones = strtoupper($request->get('observaciones'));

            $estudiante->save();

            // 3. ENVIAR NOTIFICACIÓN PUSH (Llamada al método de Firebase)
            // Solo si el apoderado ya tiene el token de la App registrado fecha_nacimiento	date	

            if ($apoderado->fcm_token) {
                $this->enviarNotificacionFirebase($apoderado->fcm_token, $estudiante->nombre, "Registro");
            }

            session()->flash('swal', [
                'icon' => 'success',
                'title' => '!Bien hecho!',
                'text' => '!Estudiante y Apoderado procesados correctamente!',
            ]);

            return back()->with('message', 'Registro Exitoso');
        } catch (\Exception $e) {
            logger()->error("Error en store estudiante: " . $e->getMessage());
            return back()->withErrors(['error' => 'Ocurrió un error al registrar.']);
        }
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
        $estudiante = Estudiante::find($item);
        $apoderado = Apoderado::find($estudiante->idapoderado);
        $apoderado->nombre = strtoupper($request->get('nombreapoderado'));
        $apoderado->dni = strtoupper($request->get('dniapoderado'));
        $estudiante->celularp = strtoupper($request->get('celularp'));
        $estudiante->celularm = strtoupper($request->get('celularm'));
        $apoderado->direccion = strtoupper($request->get('direccion'));
        $apoderado->password = bcrypt($request->get('dniapoderado'));
        $apoderado->update();

        $estudiante->nombre = strtoupper($request->get('nombre'));
        $estudiante->apellidos = strtoupper($request->get('apellidos'));
        $estudiante->dni = strtoupper($request->get('dni'));
        $estudiante->celular = strtoupper($request->get('celularm') . ' / ' . $request->get('celularp'));
        $estudiante->observaciones = strtoupper($request->get('observaciones'));
        $estudiante->update();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => 'bien hecho',
            'text' => '!Estudiante Actualización correctamente!',
            'timer' => '500',
            ' showConfirmButton' => 'false'
        ]);
        return back()->with('message', 'Actualización Exítosa');
    }



    public function destroy($estudiante)
    {

        $estudiante = Estudiante::find($estudiante);
        $estudiante->delete();
        return back()->with('message', 'Archivo Eliminado ');
    }

    // public function exportsexcel()
    // {
    //     return Excel::download(new EstudianteExport, 'lista-estudiantes.xlsx');
    // }


    public function descargarPlantilla()
    {
        return Excel::download(new PlantillaEstudianteExport, 'plantilla_importar_estudiantes.xlsx');
    }

    public function importexcel(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            Excel::import(new EstudianteImport, $file);
            return back()->with('message', 'Archivo Importado ');
        } else {
            return back()->with('message', 'Proceso no Ejecutado ');
        }
    }
}
