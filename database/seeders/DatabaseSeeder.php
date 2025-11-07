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
            'email' => 'test_athon@innovastaff.org',
            'password' => \Illuminate\Support\Facades\Hash::make('athon/innovastaff'),
            'foto' => '01.webp',
        ]);

        \App\Models\User::create([
            'name' => 'IEP',
            'apellidos' => 'Mundo Feliz',
            'email' => 'dr_mercy@mundofeliz.edu.pe',
            'password' => \Illuminate\Support\Facades\Hash::make('mercy2mundofeliz'),
            'foto' => '01.webp',
        ]);
        
        \App\Models\Concepto::create([
            'codigo' => 'P001',
            'concepto' => 'Pensión',
            'monto' => '240',
        
        ]);

        \App\Models\Anolectivo::create([
            'años' => '2025',
            'inicio' => '2025-10-01',
            'fin' => '2025-12-25',           
        ]);

    
  // Datos semilla de Nivel de Educación
        \App\Models\Aula::create([
            'nivel' => 'Inicial',
            'grado' => '3 años',
            'seccion' => 'Único',
            'vacantes' => 22,
            'tarde' => '08:00:59',      
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Inicial',
            'grado' => '4 años',
            'seccion' => 'Único',
            'vacantes' => 39,
            'tarde' => '8:00:59',          
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Inicial',
            'grado' => '5 años',
            'seccion' => 'Único',
            'vacantes' => 45,
            'tarde' => '8:00:59',          
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Primaria',
            'grado' => '1er grado',
            'seccion' => 'Único',
            'vacantes' => 55,
            'tarde' => '8:00:59',          
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Primaria',
            'grado' => '2do grado',
            'seccion' => 'Único',
            'vacantes' => 63,
            'tarde' => '8:00:59',          
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Primaria',
            'grado' => '3er grado',
            'seccion' => 'Único',
            'vacantes' => 51,
            'tarde' => '8:00:59',          
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Primaria',
            'grado' => '4to grado',
            'seccion' => 'Único',
            'vacantes' => 42,
            'tarde' => '8:00:59',          
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Primaria',
            'grado' => '5to grado',
            'seccion' => 'Único',
            'vacantes' => 57,
            'tarde' => '8:00:59',          
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Primaria',
            'grado' => '6to grado',
            'seccion' => 'Único',
            'vacantes' => 44,
            'tarde' => '8:00:59',          
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Secundaria',
            'grado' => '1er grado',
            'seccion' => 'Único',
            'vacantes' => 51,
            'tarde' => '8:00:59',          
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Secundaria',
            'grado' => '2do grado',
            'seccion' => 'Único',
            'vacantes' => 67,
            'tarde' => '8:00:59',          
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Secundaria',
            'grado' => '3er grado',
            'seccion' => 'Único',
            'vacantes' => 63,
            'tarde' => '8:00:59',          
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Secundaria',
            'grado' => '4to grado',
            'seccion' => 'Único',
            'vacantes' => 67,
            'tarde' => '8:00:59',          
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Secundaria',
            'grado' => '5to grado',
            'seccion' => 'Único',
            'vacantes' => 50,
            'tarde' => '8:00:59',          
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
            'nombre' => 'año lectivo',
        ]);
        \App\Models\Modulo::create([
            'nombre' => 'aula',
        ]);
        \App\Models\Modulo::create([
            'nombre' => 'cargo',
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
        \App\Models\UserRol::create([
            'iduser' =>2,
            'idrol' =>1,
        ]); 


        \App\Models\Permission::create([
            'idmodulo'=>1,
            'nombre'=>'VER ESTUDIANTES',
                'status'=>1,  
        ]);
        
        \App\Models\Permission::create([
            'idmodulo'=>2,
                'nombre'=>'VER MATRICULA',

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
                'nombre'=>'VER AÑO LECTIVO',
                'status'=>1, 
        ]);
        \App\Models\Permission::create([
            'idmodulo'=>10,
                'nombre'=>'VER AULAS',
                'status'=>1, 
        ]);
        \App\Models\Permission::create([
            'idmodulo'=>11,
                'nombre'=>'VER CARGO',
                'status'=>1, 
        ]);
        \App\Models\Permission::create([
            'idmodulo'=>12,
                'nombre'=>'VER USUARIOS',
                'status'=>1, 
        ]); 
        \App\Models\Permission::create([
            'idmodulo'=>13,
                'nombre'=>'VER ROL & PERMISOS',
                'status'=>1,
        ]);


\App\Models\RolPermission::create([
            'idrol'=>1, 
            'idpermission'=>12
        ]);
        \App\Models\RolPermission::create([
            'idrol'=>1, 
            'idpermission'=>13
        ]);


    }
}
