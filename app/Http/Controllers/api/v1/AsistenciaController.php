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



class AsistenciaController extends Controller
{
    public function index($id)
    {

        $estudiante = Asistenciaest::where('idestudiante', $id)->get();

        return response()->json($estudiante, 200);
    }


    private function enviarNotificacionPush($apoderado, $estudiante, $tipo)
    {
        $fcmToken = $apoderado->fcm_token;
        // dd($fcmToken);
        if (empty($fcmToken)) {
            logger()->info("El estudiante {$estudiante->nombre} no tiene un token registrado.");
            return;
        }

        app(FcmService::class)->send(
            $fcmToken,
            'Asistencia registrada',
            'Estudiante ' . $estudiante->nombre . ' ' . $estudiante->apellidos . ' Marco ' . $tipo,
            [
                'tipo' => 'asistencia',
                'alumno_id' => $estudiante->id,
                'hora' => now()->format('H:i:s'),
            ]

        );
    }


    public function store(Request $request)
    {

        try {


            $request->validate([
                'codigo' => 'required'
            ]);
            $horario = Horario::first();
            $codigo = $request->get('codigo');
            $estudiante = Matricula::where('codigo', $codigo)->first();
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


            //asistencia de turno estudiante mañana

            $matricula = Matricula::where('codigo', $codigo)->where('idanolectivo', $anolectivo->id)->first();
            $estudiante = Estudiante::where('id', $matricula->idestudiante)->first();
            $idapoderado = Apoderado::where('id', $estudiante->idapoderado)->first();
            $aula = Aula::where('id', $matricula->idaula)->first();
            //asistencia de turno estudiante mañana
            if (Carbon::now()->lt(Carbon::parse($aula->horafalta))) {

                if (empty(Asistenciaest::where('idmatricula', $matricula->id)->where('fechaentrada', date("Y-m-d"))->first()) == true) {
                    $asistencia = new Asistenciaest;
                    $asistencia->idanolectivo = $anolectivo->id;
                    $asistencia->idmatricula = $matricula->id;
                    $asistencia->fechaentrada = date("Y-m-d");
                    $asistencia->estado = (date("H:i:s") < $aula->horatarde) ? 1 : 0;
                    $asistencia->save();


                    $this->enviarNotificacionPush($idapoderado, $estudiante, "entrada");
                    
                    return response()->json($estudiante->nombre, 200);
                } else {

                    if (Carbon::now()->lt(Carbon::parse("$aula->horasalida")) and Carbon::now()->gt(Carbon::parse("13:50:00"))) {
                        $asistencia = Asistenciaest::where('idmatricula', $matricula->id)->where('fechaentrada', date("Y-m-d"))->first();

                        $asistencia->horasalida = date("H:i:s");
                        $asistencia->update();
                        $this->enviarNotificacionPush($idapoderado, $estudiante, "salida");
                        return response()->json($estudiante->nombre, 200);
                    } else {
                        return response()->json('Ya marco asistencia' , 200);
                    }
                }
            }
            // //asistencia de turno estudiante tarde
            // if (Carbon::now()->gt(Carbon::parse("14:31:00"))) {

            //     $conteoasist = Asistenciaest::where('idmatricula', $matricula->id)
            //         ->where('fechaentrada', date("Y-m-d"))
            //         ->whereTime('created_at', '>=', '14:31:00')
            //         ->first();


            //     if (!$conteoasist) {
            //         $asistencia = new Asistenciaest;
            //         $asistencia->idanolectivo = $anolectivo->id;
            //         $asistencia->idmatricula = $matricula->id;
            //         $asistencia->fechaentrada = date("Y-m-d");
            //         $asistencia->estado = (date("H:i:s") < $aula->tarde) ? 1 : 0;
            //         $asistencia->save();
            //         //dd($idapoderado,$estudiante,);
            //         $this->enviarNotificacionPush($idapoderado, $estudiante, "entrada");
            //         return response()->json($estudiante->id . 'marco entrada' . ' ' . $codigo, 200);
            //     } else {

            //         if (Carbon::now()->gt(Carbon::parse("17:15:00"))) {
            //             $asistencia = Asistenciaest::where('idmatricula', $matricula->id)->where('fechaentrada', date("Y-m-d"))->orderBy('id', 'desc')->first();

            //             $asistencia->updated_at = now();
            //             $asistencia->update();
            //             $this->enviarNotificacionPush($idapoderado, $estudiante, "Salida");
            //             return response()->json($estudiante->nombre . ' marco salida' . $codigo, 200);
            //         } else {
            //             return response()->json('Ya marco asistencia tarde' . ' ' . $codigo, 200);
            //         }
            //     };
            // }


            return response()->json($codigo . ' ' . 'no registrado i/o no matriculado', 200);
        } catch (\Throwable $e) {

            Log::error('ERROR ASISTENCIA', [
                'mensaje' => $e->getMessage(),
                'linea' => $e->getLine(),
                'archivo' => $e->getFile(),
            ]);

            return response()->json([
                'ok' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
