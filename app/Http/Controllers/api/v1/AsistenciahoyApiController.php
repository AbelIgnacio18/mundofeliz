<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Anolectivo;
use App\Models\Apoderado;
use App\Models\Matricula;
use App\Models\Asistenciaest;
use App\Models\Asistencia;
use App\Models\Estudiante;
use App\Models\Horario;
use App\Models\Contrato;
use App\Models\Personal_access_token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Aula;
use App\Models\Docente;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Google\Client;
use App\Services\FcmService;



class AsistenciahoyApiController extends Controller
{
    public function index($id)
    {

        $estudiante = Asistenciaest::where('idestudiante', $id)->get();

        return response()->json($estudiante, 200);
    }

   
    public function store(Request $request)
    {

    }


    public function show($id)
    {
        $estudiante = DB::table('estudiantes as e')
            ->join('matriculas as m', 'e.id', '=', 'm.idestudiante')
            ->join('asistenciaests as a', 'm.id', '=', 'a.idmatricula')
            ->join('aulas as au', 'au.id', '=', 'm.idaula')
            ->select('e.id as iduser', 'e.nombre', 'e.apellidos','m.id as idmatricula' ,
            'a.fechaentrada as fecha','a.created_at as entrada', 'a.horasalida as salida','au.nivel','au.grado','au.seccion','au.horaentrada','au.horasalida','a.estado')->where('e.id', $id)->orderBy('a.fechaentrada', 'desc')->first();

        $countasistencia = Asistenciaest::where('idmatricula',$estudiante->idmatricula)->count();
        //faltass

        $countfaltas = Asistenciaest::where('idmatricula',$estudiante->idmatricula)->where('estado', 4)->count();
        //tardansasss
        $counttardanza = Asistenciaest::where('idmatricula',$estudiante->idmatricula)->where('estado', 0)->count();
       $porcentualfaltas = $countasistencia > 0 ? ($countfaltas / $countasistencia) * 100 : 0;

    //     $estado = match ($estudiante->estado) {
    //     0 ,
    //     1 ,
    //     4 
        
    // };

        //porcentajes de falta
     $estuds = [
            'user' => $estudiante->nombre . ' ' . $estudiante->apellidos,
             'id' => $estudiante->idmatricula,
            'aula'=>$estudiante->nivel. ' '.$estudiante->grado.' '.$estudiante->seccion,
           
            'horaentrada' => Carbon::parse($estudiante->horaentrada)->format('h:i A'),
            'horasalida' => Carbon::parse($estudiante->horasalida)->format('h:i A'),               //   'mes' => Carbon::parse($estudiante->fecha)->format('F'),
            'fecha' => Carbon::parse($estudiante->fecha)->format('l,d F'),
            'entrada' => Carbon::parse($estudiante->entrada)->format('h:i A'),
            'salida' => $estudiante->salida != null ? Carbon::parse($estudiante->salida)->format('h:i A') : '—',

            'porcentaje' => round($porcentualfaltas, 0),
            'falta' => $countfaltas,
            'tardanza' => $counttardanza,
            'estado' => $estudiante->estado,
    ];




        //  $estudiante= Arr::add($estudiante, 'numeroasist', $countasistencia);


        return response()->json($estuds, 200);
    }
    public function calendarioasistencia($id){
    return Asistenciaest::where('idmatricula',$id)
            ->select('fechaentrada as fecha','estado')
             ->orderBy('fechaentrada')
            ->get();
    }

    public function subirFoto(Request $request, $id)
{
    $est = Estudiante::findOrFail($id);

    if ($request->hasFile('foto')) {

        // 🗑️ eliminar imagen anterior (opcional pero PRO)
        if ($est->imagen && Storage::disk('public')->exists($est->imagen)) {
            Storage::disk('public')->delete($est->imagen);
        }

        // 📸 guardar nueva imagen
        $ruta = $request->file('foto')->store('estudiantes', 'public');

        // 🌐 guardar URL completa
        $est->imagen = asset('storage/' . $ruta);

        $est->save();
    }

    return response()->json([
        'ok' => true,
        'imagen' => $est->imagen // 🔥 devuelves la URL lista
    ]);
}
    
}
