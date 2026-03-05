<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Anolectivo;
use App\Models\CalendarioEscolar;
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

    $matriculas = \App\Models\Matricula::all();

    foreach ($matriculas as $matricula) {

        $existe = \App\Models\Asistenciaest::where('idmatricula', $matricula->id)
            ->whereDate('fechaentrada', $hoy)
            ->exists();

        if (!$existe) {
            \App\Models\Asistenciaest::create([
                'idanolectivo' => $anolec->id,
                'idmatricula' => $matricula->id,
                'fechaentrada' => $hoy,
                'estado' => 4 // Falta
            ]);
        }
    }

    $this->info('Faltas registradas correctamente.');  

       
   
    }
}
