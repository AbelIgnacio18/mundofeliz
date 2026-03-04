<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Anolectivo;
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
 if (Carbon::now()->isSaturday()) {
        $this->info('Hoy es sábado, no se ejecuta.');
        return;
    }

    if (Carbon::now()->isSunday()) {
        $this->info('Hoy es domingo, no se ejecuta.');
        return;
    }
    // Obtener todas las matrículas
           $anolec = Anolectivo::where('estado', 1)->first();
    $matriculas = \App\Models\Matricula::all();

    foreach ($matriculas as $matricula) {

        $existe = \App\Models\Asistenciaest::where('idmatricula', $matricula->id)
            ->whereDate('fechaentrada', $hoy)
            ->exists();

        if (!$existe) {
            \App\Models\Asistenciaest::create([
                'idanolectivo'=>$anolec->id,
                'idmatricula' => $matricula->id,
                'fechaentrada' => $hoy,
                'estado' => 4 // 2 = Falta
            ]);
        }
    }

    $this->info('Faltas registradas correctamente.');
    }
}
