<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**  
     * Define the application's command schedule.
     */

protected function schedule(Schedule $schedule): void
{
    /*       $schedule->command('app:registrar-faltas')
        ->dailyAt('09:50')
        ->weekdays(); // 👈 SOLO lunes a viernes */
    $schedule->command('app:registrar-faltas')
        ->everyFiveMinutes()      // solo cada 5m, si desea cada 10m, cambiar Five por Ten
        ->between('08:50', '11:30') // rango donde podría existir la falta
        ->weekdays()              // solo lunes a viernes
        ->withoutOverlapping();   // evita duplicados
}

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}