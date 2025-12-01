<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Anolectivo;
use App\Models\Matricula;
use App\Models\Asistenciaest;
use App\Models\Asistencia;
use App\Models\Estudiante;
use App\Models\Control;
use App\Models\Contrato;
use App\Models\Personal_access_token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Aula;
use App\Models\Docente;
use Carbon\Carbon;

use Google\Client;



class AsistenciaController extends Controller
{
    public function index($id)
    {

        $estudiante = Asistenciaest::where('idestudiante', $id)->get();

        return response()->json($estudiante, 200);
    }



    public function store(Request $request)
    {




        $request->validate([
            'codigo' => 'required'
        ]);
        $control = Control::first();
        $codigo = $request->get('codigo');
        $estudiante = Estudiante::where('codigo', $codigo)->first();
        $anolectivo = Anolectivo::where('estado', 1)->first();

        ///poner la hor de entrada dinamic
        if (empty($estudiante) == true) {
            $docente = Docente::where('codigo', $codigo)->first();

            $cargo = Contrato::where('id', $docente->idcontrato)->first();
//asistencia de turno docente Mañana
            if (Carbon::now()->lt(Carbon::parse("14:30:00"))) {

                if (empty(Asistencia::where('iddocente', $docente->id)->where('fechaentrada', date("Y-m-d"))->first()) == true) {
                    $asistencia = new Asistencia;
                    $asistencia->idanolectivo = $anolectivo->id;
                    $asistencia->iddocente = $docente->id;
                    $asistencia->fechaentrada = date("Y-m-d");
                    $asistencia->estado = (date("H:i:s") < $cargo->horaentrada) ? 1 : 0;
                    $asistencia->save();
                    return response()->json($docente->nombre . ' ' . $codigo, 200);
                } else {
                    if (Carbon::now()->lt(Carbon::parse("14:30:00")) and Carbon::now()->gt(Carbon::parse("13:50:00"))) {
                        $asistencia = Asistencia::where('iddocente', $docente->id)->where('fechaentrada', date("Y-m-d"))->first();

                        $asistencia->updated_at = now();
                        $asistencia->update();
                        return response()->json("salida" . $docente->nombre, 200);
                    } else {
                        return response()->json('Ya marco asistencia' . ' ' . $codigo, 200);
                    }
                }
            }
//asistencia de turno docente tarde
            if (Carbon::now()->gt(Carbon::parse("14:31:00"))) {
                $conteoasist = Asistencia::where('iddocente', $docente->id)->where('fechaentrada', date("Y-m-d"))
                    ->whereTime('created_at', '>=', '14:31:00')
                    ->first();

                if (!$conteoasist) {

                    $asistencia = new Asistencia;
                    $asistencia->idanolectivo = $anolectivo->id;
                    $asistencia->iddocente = $docente->id;
                    $asistencia->fechaentrada = date("Y-m-d");
                    $asistencia->estado = (date("H:i:s") < "15:00:59") ? 1 : 0;
                    $asistencia->save();
                    return response()->json($docente->nombre . ' ' . $codigo, 200);
                } else {

                    if (Carbon::now()->gt(Carbon::parse("17:15:00"))) {
                        $asistencia = Asistencia::where('iddocente', $docente->id)->where('fechaentrada', date("Y-m-d"))->orderBy('id', 'desc')->first();

                        $asistencia->updated_at = now();
                        $asistencia->update();
                        return response()->json("salida" . $docente->nombre, 200);
                    } else {
                        return response()->json('Ya marco asistencia' . ' ' . $codigo, 200);
                    }
                };
            }
        }




        $matricula = Matricula::where('idestudiante', $estudiante->id)->where('idanolectivo', $anolectivo->id)->first();
        $aula = Aula::where('id', $matricula->idaula)->first();
//asistencia de turno estudiante mañana
        if (Carbon::now()->lt(Carbon::parse("14:30:00"))) {

            if (empty(Asistenciaest::where('idmatricula', $matricula->id)->where('fechaentrada', date("Y-m-d"))->first()) == true) {
                $asistencia = new Asistenciaest;
                $asistencia->idanolectivo = $anolectivo->id;
                $asistencia->idmatricula = $matricula->id;
                $asistencia->fechaentrada = date("Y-m-d");
                $asistencia->estado = (date("H:i:s") < $aula->tarde) ? 1 : 0;
                $asistencia->save();


                return response()->json($estudiante->nombre . ' ' . $codigo, 200);
            } else {

                if (Carbon::now()->lt(Carbon::parse("14:30:00")) and Carbon::now()->gt(Carbon::parse("13:50:00"))) {
                    $asistencia = Asistenciaest::where('idmatricula', $matricula->id)->where('fechaentrada', date("Y-m-d"))->first();

                    $asistencia->updated_at = now();
                    $asistencia->update();
                    return response()->json($estudiante->nombre . ' ' . $codigo, 200);
                } else {
                    return response()->json('Ya marco asistencia' . ' ' . $codigo, 200);
                }
            }
        }
//asistencia de turno estudiante tarde
        if (Carbon::now()->gt(Carbon::parse("14:31:00"))) {

            $conteoasist = Asistenciaest::where('idmatricula', $matricula->id)
                ->where('fechaentrada', date("Y-m-d"))
                ->whereTime('created_at', '>=', '14:31:00')
                ->first();


            if (!$conteoasist) {
                $asistencia = new Asistenciaest;
                $asistencia->idanolectivo = $anolectivo->id;
                $asistencia->idmatricula = $matricula->id;
                $asistencia->fechaentrada = date("Y-m-d");
                $asistencia->estado = (date("H:i:s") < $aula->tarde) ? 1 : 0;
                $asistencia->save();

                return response()->json($estudiante->nombre . 'marco entrada' . ' ' . $codigo, 200);
            } else {

                if (Carbon::now()->gt(Carbon::parse("17:15:00"))) {
                    $asistencia = Asistenciaest::where('idmatricula', $matricula->id)->where('fechaentrada', date("Y-m-d"))->orderBy('id', 'desc')->first();

                    $asistencia->updated_at = now();
                    $asistencia->update();
                    return response()->json($estudiante->nombre . ' marco salida' . $codigo, 200);
                } else {
                    return response()->json('Ya marco asistencia tarde' . ' ' . $codigo, 200);
                }
            };
        }


        return response()->json($codigo . ' ' . 'no matriculado', 200);
    }


    public function storesalida(Request $request) {}

    public function show($id)
    {
        $estudiante = DB::table('estudiantes as e')
            ->join('nivels as n', 'e.idnivel', '=', 'n.id')
            ->join('asistencias as a', 'e.id', '=', 'a.idestudiante')
            ->select('e.id as iduser', 'e.nombre', 'e.apellidoP', 'e.apellidoM', 'n.nombre as nivel', 'a.mes', 'a.dia', 'a.fecha as entrada', 'a.created_at as salida')->where('e.id', $id)->where('a.mes', date('m'))->where('a.dia', date('d'))->first();

        $countasistencia = Asistenciaest::where('idestudiante', $id)->where('mes', date('m'))->count();
        //faltass

        $countfaltas = Asistenciaest::where('idestudiante', $id)->where('mes', date('m'))->where('status', 1)->count();
        //tardansasss
        $counttardanza = Asistenciaest::where('idestudiante', $id)->where('mes', date('m'))->where('status', 2)->count();


        $estuds = ['user' => $estudiante->nombre . ' ' . $estudiante->apellidoP . ' ' . $estudiante->apellidoM, 'nivel' => $estudiante->nivel, 'mes' => $estudiante->mes, 'dia' => $estudiante->dia, 'entrada' => Carbon::parse($estudiante->entrada)->format('h:i'), 'salida' => Carbon::parse($estudiante->salida)->format('h:i'), 'countasist' => $countasistencia, 'falta' => $countfaltas, 'tardanza' => $counttardanza];


        //  $estudiante= Arr::add($estudiante, 'numeroasist', $countasistencia);


        return response()->json($estuds, 200);
    }
}
