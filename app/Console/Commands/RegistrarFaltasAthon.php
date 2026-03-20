<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Anolectivo;
use App\Models\CalendarioEscolar;
use App\Models\Matricula;
use App\Models\Asistenciaest;
use Illuminate\Support\Facades\Log;

class RegistrarFaltas extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'app:registrar-faltas';

    /**
     * The console command description.
     */
    protected $description = 'Registrar faltas automáticamente cuando se supera la hora de falta';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::info('CRON FUNCIONANDO ' . now());

        $hoy = now()->toDateString();
        $horaActual = Carbon::now()->format('H:i');

        // Verificar si hoy es día laborable
        $dia = CalendarioEscolar::where('fecha', $hoy)->first();

        if (!$dia || !$dia->es_laborable) {
            $this->info('Hoy no es día laborable.');
            return;
        }

        // Obtener año lectivo activo
        $anolec = Anolectivo::where('estado', 1)->first();

        if (!$anolec) {
            $this->error('No hay año lectivo activo.');
            return;
        }

        // Obtener matrículas con aula
        $matriculas = Matricula::with('aula')
            ->where('idanolectivo', $anolec->id)
            ->get();

        foreach ($matriculas as $matri) {

            // Evitar error si no tiene aula
            if (!$matri->aula) {
                continue;
            }

            $horaFalta = $matri->aula->horafalta;

            // Si todavía no llega la hora de falta
            if ($horaActual < $horaFalta) {
                continue;
            }

            // Verificar si ya tiene asistencia registrada hoy
            $existe = Asistenciaest::where('idmatricula', $matri->id)
                ->whereDate('fechaentrada', $hoy)
                ->exists();

            if (!$existe) {

                Asistenciaest::create([
                    'idanolectivo' => $anolec->id,
                    'idmatricula' => $matri->id,
                    'fechaentrada' => $hoy,
                    'estado' => 4 // Falta
                ]);

                Log::info('Falta registrada para matrícula: ' . $matri->id);
            }
        }

        $this->info('Proceso de faltas ejecutado correctamente.');
    }
}