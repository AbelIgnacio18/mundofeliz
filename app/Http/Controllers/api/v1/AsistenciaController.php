<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\Administrativo;
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
use PhpParser\Node\Stmt\TryCatch;

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

            $codigo = $request->get('codigo');
            $anolectivo = Anolectivo::where('estado', 1)->first();

            if (!$anolectivo) {
                return response()->json([
                    'ok' => false,
                    'error' => 'No hay año lectivo activo'
                ], 400);
            }

            // Buscar si es estudiante
            $matricula = Matricula::where('codigo', $codigo)
                ->where('idanolectivo', $anolectivo->id)
                ->first();



            if ($matricula) {
                return $this->procesarEstudiante($matricula, $anolectivo);
            }

            // Buscar si es docente
            $docente = Docente::where('codigo', $codigo)->with('user')->first();
            if ($docente) {
                return $this->procesarUsuario($docente, $anolectivo);
            }

            $administrastivo = Administrativo::where('codigo', $codigo)->with('user')->first();
            if ($administrastivo) {

                return $this->procesarUsuario($administrastivo, $anolectivo);
            }


            return response()->json([
                'ok' => false,
                'error' => 'Código no registrado'
            ], 404);
        } catch (\Throwable $e) {
            Log::error('ERROR ASISTENCIA', [
                'mensaje' => $e->getMessage(),

            ]);

            return response()->json([
                'ok' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function procesarEstudiante($matricula, $anolectivo)
    {
        //asistencia de turno estudiante
        $ahora = Carbon::now();
        $estudiante = Estudiante::find($matricula->idestudiante);

        if (!$estudiante) {
            return response()->json(['error' => 'Estudiante no encontrado'], 404);
        }

        $apoderado = Apoderado::find($estudiante->idapoderado);

        $aula = Aula::find($matricula->idaula);
        //asistencia de turno estudiante mañana
        if (Carbon::now()->lt(Carbon::parse($aula->horasalida))) {

            if (empty(Asistenciaest::where('idmatricula', $matricula->id)->where('fechaentrada', date("Y-m-d"))->first()) == true) {
                $asistencia = new Asistenciaest;
                $asistencia->idanolectivo = $anolectivo->id;
                $asistencia->idmatricula = $matricula->id;
                // 2. Usamos la misma instancia para fecha y hora
                $asistencia->fechaentrada = $ahora->format('Y-m-d');
                $asistencia->horaentrada  = $ahora->format('H:i:s');

                // 3. Comparación semántica: ¿Es la hora actual menor que la hora límite?
                // Asumiendo que $aula->horatarde es un string como "08:10:00"

                $asistencia->estado = ($ahora->toTimeString() < Carbon::parse($aula->horatarde)->format('H:i:s')) ? 1 : 0;
                $asistencia->save();


                $this->enviarNotificacionPush($apoderado, $estudiante, "entrada");

                return response()->json($estudiante->nombre, 200);
            } else {
                $asistencia = Asistenciaest::where('idmatricula', $matricula->id)->where('fechaentrada', date("Y-m-d"))->first();
                if ($asistencia->estado == 4) {

                    $asistencia->horaentrada  = $ahora->format('H:i:s');
                    $asistencia->estado = ($ahora->toTimeString() < Carbon::parse($aula->horatarde)->format('H:i:s')) ? 1 : 0;
                    $asistencia->update();
                    return response()->json('Actualizo Asistencia', 200);
                }
                return response()->json('Ya marco asistencia Hoy', 200);
            }
        }


        if (Carbon::now()->gt(Carbon::parse($aula->horasalida))) {
            $asistencia = Asistenciaest::where('idmatricula', $matricula->id)->where('fechaentrada', date("Y-m-d"))->first();
            if (!$asistencia->horasalida && $asistencia->estado!=4) {

                $asistencia->horasalida  = $ahora->format('H:i:s');
                $asistencia->update();
                $this->enviarNotificacionPush($apoderado, $estudiante, "salida");
                return response()->json($estudiante->nombre, 200);
            }

            return response()->json('Ya marco Salida', 200);
        }
        return response()->json('Salida,Entrada Marcada', 200);
    }





    private function procesarUsuario($user, $anolectivo)
    {

        $dia = strtolower(\Carbon\Carbon::now()->locale('es')->dayName);
        $horario = Horario::where('iduser', $user->user_id)
            ->where('dia_semana', $dia)
            ->first();
        if (!$horario) {
            return response()->json("No tiene horario hoy", 200);
        }

        $existe = Asistencia::where('iduser', $user->user_id)
            ->whereDate('fechaentrada', today())
            ->first();


        if (!$existe) {

            $entrada = Carbon::parse($horario->hora_ingreso);
            $tolerancia = $horario->tolerancia;

            $horaActual = now()->format('H:i:s');

            $minutos = $entrada->diffInMinutes($horaActual, false);

            if ($minutos <= 0) {
                $estado = 1; // puntual
                $minutos_tarde = 0;
            } elseif ($minutos <= $tolerancia) {
                $estado = 1; // tolerancia
                $minutos_tarde = 0;
            } else {
                $estado = 0; // tarde
                $minutos_tarde = $minutos;
            }
            $asistencia = new Asistencia;
            $asistencia->idanolectivo = $anolectivo->id;
            $asistencia->iduser = $user->user_id;
            $asistencia->fechaentrada = now()->format('Y-m-d');;
            $asistencia->horaentrada =  $horaActual;
            $asistencia->minutos_tarde = $minutos_tarde;
            $asistencia->estado = $estado;
            $asistencia->save();

            return response()->json($user->user->name, 200);
        }
    }




    public function sync(Request $request)
    {
        try {
            $request->validate([
                'registros' => 'required|array',
                'registros.*.codigo' => 'required',
                'registros.*.fecha' => 'required|date',
                'registros.*.hora' => 'required|date_format:H:i:s',

            ]);
            Log::info('=== SYNC RECIBIDO ===', [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'total_registros' => count($request->registros ?? [])
            ]);

            $anolectivo = Anolectivo::where('estado', 1)->first();

            if (!$anolectivo) {
                return response()->json([
                    'ok' => false,
                    'error' => 'No hay año lectivo activo'
                ], 400);
            }

            $resultados = [];
            $procesados = 0;
            $errores = 0;

            // Iniciar transacción para asegurar integridad
            DB::beginTransaction();

            try {
                foreach ($request->registros as $registro) {
                    try {
                        $codigo = $registro['codigo'];
                        $fecha = $registro['fecha'];
                        $hora = $registro['hora'];


                        // Log para depuración
                        Log::info('Procesando registro sync', [
                            'codigo' => $codigo,
                            'fecha' => $fecha,
                            'hora' => $hora,

                        ]);

                        // Buscar si es estudiante
                        $matricula = Matricula::where('codigo', $codigo)
                            ->where('idanolectivo', $anolectivo->id)
                            ->first();



                        if ($matricula) {
                            $guardado = $this->procesarAsistenciaEstudianteSync($matricula, $fecha, $hora, $anolectivo);

                            if ($guardado) {
                                $procesados++;
                                $resultados[] = [
                                    'codigo' => $codigo,
                                    'status' => 'ok',
                                    'tipo' => 'estudiante',
                                    'mensaje' => 'Registrado correctamente'
                                ];

                                // Opcional: Enviar notificación

                            } else {
                                $errores++;
                                $resultados[] = [
                                    'codigo' => $codigo,
                                    'status' => 'error',
                                    'tipo' => 'estudiante',
                                    'mensaje' => 'No se pudo guardar la asistencia'
                                ];
                            }
                            continue;
                        }

                        // Buscar si es docente
                        $docente = Docente::where('codigo', $codigo)->with('user')->first();

                        if ($docente) {
                            $guardado = $this->procesarAsistenciaUsuarioSync($docente, $fecha, $hora, $anolectivo);

                            if ($guardado) {
                                $procesados++;
                                $resultados[] = [
                                    'codigo' => $codigo,
                                    'status' => 'ok',
                                    'tipo' => 'docente',
                                    'mensaje' => 'Registrado correctamente'
                                ];
                            } else {
                                $errores++;
                                $resultados[] = [
                                    'codigo' => $codigo,
                                    'status' => 'error',
                                    'tipo' => 'docente',
                                    'mensaje' => 'No se pudo guardar la asistencia'
                                ];
                            }
                            continue;
                        }

                          $administrativo = Administrativo::where('codigo', $codigo)->with('user')->first();

                        if ($administrativo) {
                            $guardado = $this->procesarAsistenciaUsuarioSync($administrativo, $fecha, $hora, $anolectivo);

                            if ($guardado) {
                                $procesados++;
                                $resultados[] = [
                                    'codigo' => $codigo,
                                    'status' => 'ok',
                                    'tipo' => 'docente',
                                    'mensaje' => 'Registrado correctamente'
                                ];
                            } else {
                                $errores++;
                                $resultados[] = [
                                    'codigo' => $codigo,
                                    'status' => 'error',
                                    'tipo' => 'docente',
                                    'mensaje' => 'No se pudo guardar la asistencia'
                                ];
                            }
                            continue;
                        }

                        // No encontrado
                        $errores++;
                        $resultados[] = [
                            'codigo' => $codigo,
                            'status' => 'error',
                            'tipo' => 'desconocido',
                            'mensaje' => 'Código no registrado en el sistema'
                        ];
                    } catch (\Exception $e) {

                        $errores++;
                        $resultados[] = [
                            'codigo' => $registro['codigo'],
                            'status' => 'error',
                            'tipo' => 'error',
                            'mensaje' => $e->getMessage()
                        ];

                        Log::error('Error en sync individual', [
                            'codigo' => $registro['codigo'],
                            'error' => $e->getMessage(),
                            'trace' => $e->getTraceAsString()
                        ]);
                    }
                }

                // Si todo OK, confirmar transacción
                DB::commit();

                Log::info('Sync completado', [
                    'procesados' => $procesados,
                    'errores' => $errores,
                    'total' => count($request->registros)
                ]);
            } catch (\Exception $e) {
                DB::rollBack();
                throw $e;
            }

            return response()->json([
                'ok' => true,
                'procesados' => $procesados,
                'errores' => $errores,
                'total' => count($request->registros),
                'resultados' => $resultados
            ], 200);
        } catch (\Throwable $e) {
            Log::error('ERROR SYNC ASISTENCIA', [
                'mensaje' => $e->getMessage(),
                'linea' => $e->getLine(),
                'archivo' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'ok' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function procesarAsistenciaEstudianteSync($matricula, $fecha, $hora, $anolectivo)
    {
        try {
            // Buscar si ya existe registro para ese día
            $estudiante = Estudiante::where('id', $matricula->idestudiante)->first();
            $apoderado = Apoderado::where('id', $estudiante->idapoderado)->first();
            $aula = Aula::where('id', $matricula->idaula)->first();


            if (!$aula) {
                Log::error('Aula no encontrada para matrícula', ['matricula_id' => $matricula->id]);
                return false;
            }
//if (Carbon::now()->gt(Carbon::parse($aula->horasalida))) {

            if (Carbon::now()->lt(Carbon::parse($aula->horasalida))) {

                if (empty(Asistenciaest::where('idmatricula', $matricula->id)->where('fechaentrada', $fecha)->first()) == true) {
                    $asistencia = new Asistenciaest;
                    $asistencia->idanolectivo = $anolectivo->id;
                    $asistencia->idmatricula = $matricula->id;
                    $asistencia->fechaentrada = $fecha;
                    $asistencia->horaentrada = $hora;
                    $asistencia->estado = ($hora < Carbon::parse($aula->horatarde)->format('H:i:s')) ? 1 : 0;
                    $asistencia->save();


                    $this->enviarNotificacionPush($apoderado, $estudiante, "entrada");

                    return response()->json($estudiante->nombre, 200);
                } else {
                    $asistencia = Asistenciaest::where('idmatricula', $matricula->id)->where('fechaentrada', date("Y-m-d"))->first();
                    if ($asistencia->estado == 4) {
                        $asistencia->horaentrada = $hora;
                        $asistencia->estado = ($hora < Carbon::parse($aula->horatarde)->format('H:i:s')) ? 1 : 0;
                        $asistencia->update();
                        return response()->json('Actualizo Asistencia', 200);
                    }
                    return response()->json('Ya marco asistencia Hoy', 200);
                }
            }


            if (Carbon::now()->gt(Carbon::parse($aula->horasalida))) {
                $asistencia = Asistenciaest::where('idmatricula', $matricula->id)->where('fechaentrada', $fecha)->first();
                if (!$asistencia->horasalida && $asistencia->estado!=4) {
                    $asistencia->horasalida = $hora;
                    $asistencia->update();
                    $this->enviarNotificacionPush($apoderado, $estudiante, "salida");
                    return response()->json($estudiante->nombre, 200);
                }

                return response()->json('Ya marco Salida', 200);
            }
            return response()->json('Salida,Entrada Marcada', 200);
        } catch (\Exception $e) {
            Log::error('Error en procesarAsistenciaEstudianteSync', [
                'error' => $e->getMessage(),
                'matricula_id' => $matricula->id,
                'trace' => $e->getTraceAsString()
            ]);
            return false;
        }
    }

    private function procesarAsistenciaUsuarioSync($user, $fecha, $hora, $anolectivo)
    {
        try {
            // Buscar si ya existe registro para ese día
            $dia = strtolower(\Carbon\Carbon::now()->locale('es')->dayName);
            $horario = Horario::where('iduser', $user->user_id)
                ->where('dia_semana', $dia)
                ->first();
            if (!$horario) {
                return response()->json("No tiene horario hoy", 200);
            }

            $asistencia = Asistencia::where('iduser', $user->user_id)
                ->where('fechaentrada', $fecha)
                ->first();



            Log::info('Procesando asistencia docente', [
                'user_id' => $user->user_id,
                'fecha' => $fecha,
                'hora' => $hora,

            ]);
            if (!$asistencia) {

                $entrada = Carbon::parse($horario->hora_ingreso);
                $tolerancia = $horario->tolerancia;

                $horaActual = $hora;

                $minutos = $entrada->diffInMinutes($horaActual, false);

                if ($minutos <= 0) {
                    $estado = 1; // puntual
                    $minutos_tarde = 0;
                } elseif ($minutos <= $tolerancia) {
                    $estado = 1; // tolerancia
                    $minutos_tarde = 0;
                } else {
                    $estado = 0; // tarde
                    $minutos_tarde = $minutos;
                }
                $asistencia = new Asistencia;
                $asistencia->idanolectivo = $anolectivo->id;
                $asistencia->iduser = $user->user_id;
                $asistencia->fechaentrada = $fecha;
                $asistencia->minutos_tarde = $minutos_tarde;
                $asistencia->estado = $estado;
                $asistencia->save();

                return response()->json($user->user->name, 200);
            }


            return false;
        } catch (\Exception $e) {
            Log::error('Error en procesarAsistenciaDocenteSync', [
                'error' => $e->getMessage(),
                'user_id' => $user->id
            ]);
            return false;
        }
    }

    public function enviarcodigo(Request $request)
    {
      
            $request->validate([
                'codigo' => 'required'
            ]);
             cache(['rfid_codigo' => $request->codigo], 4); // dura 10 seg

            return response()->json(['codigo' => $request->codigo,200  ]);
        
    }
}
