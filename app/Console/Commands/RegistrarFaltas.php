<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Anolectivo;
use App\Models\Estudiante;
use App\Models\Apoderado;
use App\Models\CalendarioEscolar;
use App\Services\FcmService;
class RegistrarFaltas extends Command
{
    /**  
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:registrar-faltas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $hoy = now()->toDateString();
 $horaActual = Carbon::now()->format('H:i');
    $dia = CalendarioEscolar::where('fecha', $hoy)->first();

    if (!$dia || !$dia->es_laborable) {
        $this->info('Hoy no es día laborable.');
        return;
    }

    $anolec = Anolectivo::where('estado', 1)->first();

    if (!$anolec) {
        $this->error('No hay año lectivo activo.');
        return;
    }

    $matriculas = \App\Models\Matricula::where('idanolectivo', $anolec->id)->get();

    foreach ($matriculas as $matri) {
         // Evitar error si no tiene aula
            if (!$matri->aula) {
                continue;
            }

            $horaFalta = $matri->aula->horafalta;

            // Si todavía no llega la hora de falta
            if ($horaActual < Carbon::parse($horaFalta)->format('H:i:s')) {
                continue;
            }


        $existe = \App\Models\Asistenciaest::where('idmatricula', $matri->id)
            ->whereDate('fechaentrada', $hoy)
            ->exists();

        if (!$existe) {
             $estudiante = Estudiante::where('id', $matri->id)->first();
            $apoderado = Apoderado::where('id', $estudiante->idapoderado)->first();
            \App\Models\Asistenciaest::create([
                'idanolectivo' => $anolec->id,
                'idmatricula' => $matri->id,
                'fechaentrada' => $hoy,
                 'horaentrada' => date('H:i:s'),
                'estado' => 4 // Falta
            ]);

             $this->enviarNotificacionPush($apoderado, $estudiante, "Falta");
        }
    }

    $this->info('Faltas registradas correctamente.');  

       
   
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
            'Estudiante ' . $estudiante->nombre . ' ' . $estudiante->apellidos . ' Registro su' . $tipo,
            [
                'tipo' => 'asistencia',
                'alumno_id' => $estudiante->id,
                'hora' => now()->format('H:i:s'),
            ]

        );
    }

}

