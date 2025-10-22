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
            'name' => 'IEP',
            'apellidos' => 'MundoFeliz',
            'email' => 'dr_mercy@mundofeliz.edu.pe',
            'password' => \Illuminate\Support\Facades\Hash::make('mercymundofeliz'),
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
            'nivel' => 'Primaria',
            'grado' => '1er',
            'seccion' => 'A',
            'vacantes' => 20,
            'tarde' => '08:00:00',          
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Secundaria',
            'grado' => '5to',
            'seccion' => 'A',
            'vacantes' => 20,
            'tarde' => '7:30:00',          
        ]);

        \App\Models\Control::create([
            'estado' => true,
        ]);
    }
}
