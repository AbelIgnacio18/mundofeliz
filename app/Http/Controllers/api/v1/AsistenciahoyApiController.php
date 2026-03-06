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
            ->select('e.id as iduser', 'e.nombre', 'e.apellidos','m.id as idmatricula' ,
            'a.fechaentrada as fecha','a.created_at as entrada', 'a.horasalida as salida','a.estado')->where('e.id', $id)->orderBy('a.fechaentrada', 'desc')->first();

        $countasistencia = Asistenciaest::where('idmatricula',$estudiante->idmatricula)->count();
        //faltass

        $countfaltas = Asistenciaest::where('idmatricula',$estudiante->idmatricula)->where('estado', null)->count();
        //tardansasss
        $counttardanza = Asistenciaest::where('idmatricula',$estudiante->idmatricula)->where('estado', 0)->count();
       $porcentualfaltas = $countasistencia > 0 ? ($countfaltas / $countasistencia) * 100 : 0;

            $estado = match ($estudiante->estado) {
        0 => 'Tarde',
        1 => 'Temprano',
        null => 'Faltó',
    };

        //porcentajes de falta
     $estuds = [
        'user' => $estudiante->nombre . ' ' . $estudiante->apellidos,
      'mes' => Carbon::parse($estudiante->fecha)->format('F'),
        'dia' => Carbon::parse($estudiante->fecha)->translatedFormat('l'),
        'entrada' =>Carbon::parse($estudiante->entrada)->format('h:i A'),
        'salida' => $estudiante->salida != null ? Carbon::parse($estudiante->salida)->format('h:i A') : '—',
        
        'porcentaje' => round($porcentualfaltas, 2),
        'falta' => $countfaltas,
        'tardanza' => $counttardanza,
        'estado' => $estado,
    ];


        //  $estudiante= Arr::add($estudiante, 'numeroasist', $countasistencia);


        return response()->json($estuds, 200);
    }
}
