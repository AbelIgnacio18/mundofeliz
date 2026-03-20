<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\CalendarioEscolar;
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


        $inicio = Carbon::create(2026, 3, 1);
        $fin = Carbon::create(2026, 12, 31);

        while ($inicio <= $fin) {

            CalendarioEscolar::create([
                'fecha' => $inicio->toDateString(),
                'es_laborable' => !$inicio->isWeekend(), // sábados y domingos no laborables
            ]);

            $inicio->addDay();
        }

        \App\Models\User::create([
            'name' => 'InnovaStaff',
            'apellidos' => 'InnovaStaff',
            'email' => 'test_athon@innovastaff.org',
            'password' => \Illuminate\Support\Facades\Hash::make('athon/innovastaff'),
            'foto' => '01.webp',
        ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'M2025',
        //     'concepto' => 'Matrícula s/.250',
        //     'monto' => '250',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'M2025',
        //     'concepto' => 'Matrícula s/.200',
        //     'monto' => '200',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'M2025',
        //     'concepto' => 'Matrícula s/.100',
        //     'monto' => '100',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'M2025',
        //     'concepto' => 'Matrícula Hermanos s/.300',
        //     'monto' => '300',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'M2025',
        //     'concepto' => 'Matrícula Hermanos s/.280',
        //     'monto' => '280',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'M2025',
        //     'concepto' => 'Matrícula Hermanos s/.250',
        //     'monto' => '250',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'M2025',
        //     'concepto' => 'Matrícula Familia s/.350',
        //     'monto' => '350',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'M2025',
        //     'concepto' => 'Matrícula Familia s/.300',
        //     'monto' => '300',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'C2025',
        //     'concepto' => 'Copias s/.170',
        //     'monto' => '170',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'C2025',
        //     'concepto' => 'Copias s/.160',
        //     'monto' => '160',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'C2025',
        //     'concepto' => 'Copias s/.150',
        //     'monto' => '150',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'C2025',
        //     'concepto' => 'Copias s/.140',
        //     'monto' => '140',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'C2025',
        //     'concepto' => 'Copias s/.120',
        //     'monto' => '120',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'C2025',
        //     'concepto' => 'Copias s/.100',
        //     'monto' => '100',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'C2025',
        //     'concepto' => 'Copias s/.85',
        //     'monto' => '85',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'C2025',
        //     'concepto' => 'Copias s/.80',
        //     'monto' => '80',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'C2025',
        //     'concepto' => 'Copias s/.60',
        //     'monto' => '60',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'C2025',
        //     'concepto' => 'Copias s/.50',
        //     'monto' => '50',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'PSC2025',
        //     'concepto' => 'Psicootricidad s/.50',
        //     'monto' => '50',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'PSC2025',
        //     'concepto' => 'Psicootricidad s/.30',
        //     'monto' => '50',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'PSC2025',
        //     'concepto' => 'Psicootricidad s/.25',
        //     'monto' => '25',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'UE2025',
        //     'concepto' => 'Útiles Escolares s/.280',
        //     'monto' => '280',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'UE2025',
        //     'concepto' => 'Útiles Escolares s/.270',
        //     'monto' => '280',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'UE2025',
        //     'concepto' => 'Útiles Escolares s/.260',
        //     'monto' => '280',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'UE2025',
        //     'concepto' => 'Útiles Escolares s/.250',
        //     'monto' => '250',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'UE2025',
        //     'concepto' => 'Útiles Escolares s/.180',
        //     'monto' => '180',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'UE2025',
        //     'concepto' => 'Útiles Escolares s/.150',
        //     'monto' => '150',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'UE2025',
        //     'concepto' => 'Útiles Escolares s/.140',
        //     'monto' => '140',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'UE2025',
        //     'concepto' => 'Útiles Escolares s/.130',
        //     'monto' => '130',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'P001',
        //     'concepto' => 'Pensión Inicial s/.220',
        //     'monto' => '220',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'P001',
        //     'concepto' => 'Pensión Inicial s/.210',
        //     'monto' => '210',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'P001',
        //     'concepto' => 'Pensión Inicial s/.200',
        //     'monto' => '200',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'P001',
        //     'concepto' => 'Pensión Inicial s/.190',
        //     'monto' => '190',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'P001',
        //     'concepto' => 'Pensión Inicial s/.185',
        //     'monto' => '185',
        // ]);

        // \App\Models\Concepto::create([
        //     'codigo' => 'P001',
        //     'concepto' => 'Pensión Inicial s/.180',
        //     'monto' => '180',
        // ]);

        \App\Models\Concepto::create([
            'codigo' => 'P001',
            'concepto' => 'Pensión Inicial s/.100',
            'monto' => '100',
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
            'horaentrada' => '07:20:00',
            'horatarde' => '08:00:59',
            'horafalta' => '10:00:00',
            'horasalida' => '13:30:00',
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Inicial',
            'grado' => '4 años',
            'seccion' => 'Único',
            'vacantes' => 39,
            'horaentrada' => '07:20:00',
            'horatarde' => '08:00:59',
            'horafalta' => '10:00:00',
            'horasalida' => '13:30:00',
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Inicial',
            'grado' => '5 años',
            'seccion' => 'Único',
            'vacantes' => 45,
            'horaentrada' => '07:20:00',
            'horatarde' => '08:00:59',
            'horafalta' => '10:00:00',
            'horasalida' => '13:30:00',
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Primaria',
            'grado' => '1er grado',
            'seccion' => 'Único',
            'vacantes' => 55,
            'horaentrada' => '07:20:00',
            'horatarde' => '08:00:59',
            'horafalta' => '10:00:00',
            'horasalida' => '13:30:00',
        ]);

        \App\Models\Aula::create([
            'nivel' => 'Primaria',
            'grado' => '2do grado',
            'seccion' => 'Único',
            'vacantes' => 63,
            'horaentrada' => '07:20:00',
            'horatarde' => '08:00:59',
            'horafalta' => '10:00:00',
            'horasalida' => '13:30:00',
        ]);

        // \App\Models\Aula::create([
        //     'nivel' => 'Primaria',
        //     'grado' => '3er grado',
        //     'seccion' => 'Único',
        //     'vacantes' => 51,
        //     'tarde' => '8:00:59',          
        // ]);

        // \App\Models\Aula::create([
        //     'nivel' => 'Primaria',
        //     'grado' => '4to grado',
        //     'seccion' => 'Único',
        //     'vacantes' => 42,
        //     'tarde' => '8:00:59',          
        // ]);

        // \App\Models\Aula::create([
        //     'nivel' => 'Primaria',
        //     'grado' => '5to grado',
        //     'seccion' => 'Único',
        //     'vacantes' => 57,
        //     'tarde' => '8:00:59',          
        // ]);

        // \App\Models\Aula::create([
        //     'nivel' => 'Primaria',
        //     'grado' => '6to grado',
        //     'seccion' => 'Único',
        //     'vacantes' => 44,
        //     'tarde' => '8:00:59',          
        // ]);

        // \App\Models\Aula::create([
        //     'nivel' => 'Secundaria',
        //     'grado' => '1er grado',
        //     'seccion' => 'Único',
        //     'vacantes' => 51,
        //     'tarde' => '8:00:59',          
        // ]);

        // \App\Models\Aula::create([
        //     'nivel' => 'Secundaria',
        //     'grado' => '2do grado',
        //     'seccion' => 'Único',
        //     'vacantes' => 67,
        //     'tarde' => '8:00:59',          
        // ]);

        // \App\Models\Aula::create([
        //     'nivel' => 'Secundaria',
        //     'grado' => '3er grado',
        //     'seccion' => 'Único',
        //     'vacantes' => 63,
        //     'tarde' => '8:00:59',          
        // ]);

        // \App\Models\Aula::create([
        //     'nivel' => 'Secundaria',
        //     'grado' => '4to grado',
        //     'seccion' => 'Único',
        //     'vacantes' => 67,
        //     'tarde' => '8:00:59',          
        // ]);

        // \App\Models\Aula::create([
        //     'nivel' => 'Secundaria',
        //     'grado' => '5to grado',
        //     'seccion' => 'Único',
        //     'vacantes' => 50,
        //     'tarde' => '8:00:59',          
        // ]);

        // \App\Models\Horario::create([
        //     'entrada' => 'hrentrada',
        //     'mañana' => '08:00:20',
        //     'tarde' => '14:30:00',
        //     'estado' => true,
        // ]);

        \App\Models\Modulo::create([
            'nombre' => 'estudiantes',
        ]);
        \App\Models\Modulo::create([
            'nombre' => 'matricula',
        ]);
        \App\Models\Modulo::create([
            'nombre' => 'concepto',
        ]);
        \App\Models\Modulo::create([
            'nombre' => 'docentes',
        ]);
        \App\Models\Modulo::create([
            'nombre' => 'articulos',
        ]);
        \App\Models\Modulo::create([
            'nombre' => 'ingresos',
        ]);
        \App\Models\Modulo::create([
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
            'nombre' => 'usuario',
        ]);
        \App\Models\Modulo::create([
            'nombre' => 'role y permisos',
        ]);

        \App\Models\Rol::create([
            'nombre' => 'SuperAdmin',
        ]);
        \App\Models\Rol::create([
            'nombre' => 'Admin',
        ]);
        \App\Models\Rol::create([
            'nombre' => 'Docente',
        ]);

        \App\Models\Rol::create([
            'nombre' => 'Secretaria',
        ]);

        \App\Models\UserRol::create([
            'iduser' => 1,
            'idrol' => 1,
        ]);

        \App\Models\Permission::create([
            'idmodulo' => 1,
            'nombre' => 'VER ESTUDIANTES',
            'status' => 1,
        ]);

        \App\Models\Permission::create([
            'idmodulo' => 2,
            'nombre' => 'VER MATRICULA',

            'status' => 1,

        ]);
        \App\Models\Permission::create([
            'idmodulo' => 3,
            'nombre' => 'VER CONCEPTO',
            'status' => 1,
        ]);
        \App\Models\Permission::create([
            'idmodulo' => 4,
            'nombre' => 'VER DOCENTE',
            'status' => 1,
        ]);
        \App\Models\Permission::create([
            'idmodulo' => 5,
            'nombre' => 'VER INVENTARIO ARTICULOS',
            'status' => 1,
        ]);
        \App\Models\Permission::create([
            'idmodulo' => 6,
            'nombre' => 'VER INVENTARIO INGRESOS',
            'status' => 1,
        ]);
        \App\Models\Permission::create([
            'idmodulo' => 7,
            'nombre' => 'VER COMPROBANTES',
            'status' => 1,
        ]);
        \App\Models\Permission::create([
            'idmodulo' => 8,
            'nombre' => 'VER ASISTENCIA',
            'status' => 1,
        ]);
        \App\Models\Permission::create([
            'idmodulo' => 9,
            'nombre' => 'VER AÑO LECTIVO',
            'status' => 1,
        ]);
        \App\Models\Permission::create([
            'idmodulo' => 10,
            'nombre' => 'VER AULAS',
            'status' => 1,
        ]);
        \App\Models\Permission::create([
            'idmodulo' => 11,
            'nombre' => 'VER CARGO',
            'status' => 1,
        ]);
        \App\Models\Permission::create([
            'idmodulo' => 12,
            'nombre' => 'VER USUARIOS',
            'status' => 1,
        ]);
        \App\Models\Permission::create([
            'idmodulo' => 13,
            'nombre' => 'VER ROL & PERMISOS',
            'status' => 1,
        ]);


        \App\Models\RolPermission::create([
            'idrol' => 1,
            'idpermission' => 12
        ]);
        \App\Models\RolPermission::create([
            'idrol' => 1,
            'idpermission' => 13
        ]);
    }
}
