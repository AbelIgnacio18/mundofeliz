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

         \App\Models\Modulo::create([
            'nombre' => 'estudiantes',
        ]);
         \App\Models\Modulo::create([
              'nombre' =>'matricula',
        ]); \App\Models\Modulo::create([
              'nombre' =>'concepto',
        ]); \App\Models\Modulo::create([
               'nombre' => 'docentes',
        ]); \App\Models\Modulo::create([
              'nombre' => 'articulos',
        ]); \App\Models\Modulo::create([
            'nombre' => 'ingresos',
        ]); \App\Models\Modulo::create([
               'nombre' => 'comprobante',
        ]);
         \App\Models\Modulo::create([
               'nombre' => 'asistencia',
        ]);

        \App\Models\Modulo::create([
                'nombre' =>'usuario',
        ]); \App\Models\Modulo::create([
               'nombre' =>'role y permisos',
        ]);   


        \App\Models\Rol::create([
               'nombre' =>'Admin',
        ]);  
         \App\Models\UserRol::create([
               'iduser' =>1,
               'idrol' =>1,
        ]); 


         \App\Models\Permission::create([
             'idmodulo'=>1,
               'nombre'=>'VER ESTUDIANTES',
                 'status'=>1,  
        ]);
        
          \App\Models\Permission::create([
               'idmodulo'=>2,
                'nombre'=>'VER MATRICUCLA',

                 'status'=>1,
                 
        ]);  
        \App\Models\Permission::create([
              'idmodulo'=>3,
                'nombre'=>'VER CONCEPTO',
                 'status'=>1, 
        ]); 
         \App\Models\Permission::create([
               'idmodulo'=>4,
                'nombre'=>'VER DOCENTE',
                 'status'=>1,
        ]); 
         \App\Models\Permission::create([
               'idmodulo'=>5,
                'nombre'=>'VER INVENTARIO ARTICULOS',
                 'status'=>1,
        ]); 
         \App\Models\Permission::create([
               'idmodulo'=>6,
                'nombre'=>'VER INVENTARIO INGRESOS',
                 'status'=>1,
        ]); 
         \App\Models\Permission::create([
              'idmodulo'=>7,
                'nombre'=>'VER COMPROBANTES',
                 'status'=>1, 
        ]); 
         \App\Models\Permission::create([
               'idmodulo'=>8,
                'nombre'=>'VER ASISTENCIA',
                 'status'=>1,
        ]); 
         \App\Models\Permission::create([
              'idmodulo'=>9,
                'nombre'=>'VER USUSARIOS',
                 'status'=>1, 
        ]); 
         \App\Models\Permission::create([
               'idmodulo'=>10,
                'nombre'=>'VER ROL & PERMISOS',
                 'status'=>1,
        ]);
     
\App\Models\RolPermission::create([
               'idrol'=>1, 
               'idpermission'=>9
        ]);
        \App\Models\RolPermission::create([
               'idrol'=>1, 
               'idpermission'=>10
        ]);
      
  
    
    
       
       
     
      
    }
}
