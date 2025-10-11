<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'InnovaStaff',
            'apellidos' => 'InnovaStaff',
            'email' => 'test_alumko@innovastaff.org',
            'password' => \Illuminate\Support\Facades\Hash::make('alumko'),
            'foto' => '01.png',
        ]);

        \App\Models\User::create([
            'name' => 'Academia Pre Policial',
            'apellidos' => 'Latino',
            'email' => 'latino@innovastaff.org',
            'password' => \Illuminate\Support\Facades\Hash::make('latino'),
            'foto' => '01.png',
        ]);
        
        \App\Models\Concepto::create([
            'codigo' => 'P001',
            'concepto' => 'Pensión',
            'monto' => '230',
        
        ]);

                \App\Models\Anolectivo::create([
            'años' => '2025',
            'inicio' => '03-03-2025',
            'fin' => '19-12-2025',           
        ]);

    
  // Datos semilla de Nivel de Educación
        \App\Models\Aula::create([
            'nivel' => 'Turno Mañana',
            'grado' => '3años',
            'seccion' => 'Verde',
            'vacantes' => 20,
            'tarde' => '08:00:00',          
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Turno Tarde',
            'grado' => '5to',
            'seccion' => 'A',
            'vacantes' => 20,
            'tarde' => '15:00:00',          
        ]);

        \App\Models\Control::create([
            'estado' => true,
        ]);
         \App\Models\Anolectivo::create([
            'años' => 'verano 2025II',
            'inicio' => '2025-09-25',
            'fin' => '2025-12-25',
         
            'estado' => 1,
        ]);
    }
}
