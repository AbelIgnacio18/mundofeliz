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
        
      $schedule->command('app:registrar-faltas')
         ->dailyAt('13:34')
         ->weekdays(); // 👈 SOLO lunes a viernes

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
