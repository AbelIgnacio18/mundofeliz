<?php

namespace App\Imports;

use App\Models\Estudiante;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Apoderado;

use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class EstudianteImport implements ToModel, WithHeadingRow
{
public function model(array $row)
    {
      // 1. Limpieza y validación de datos del Apoderado
        $dniApoderado = isset($row['dni_apoderado']) ? trim($row['dni_apoderado']) : null;
        
        // Si no hay DNI real del apoderado, no podemos crear la cuenta de acceso
        if (empty($dniApoderado)) {
            return null; 
        }

       // 2. Gestión del Apoderado (Unificación por DNI real)
        // Buscamos por DNI para que si tiene varios hijos, se vinculen a la misma cuenta
        $apoderado = Apoderado::updateOrCreate(
            ['dni' => $dniApoderado],
            [
                'nombre'    => trim($row['nombre_apoderado']),
                'celular'   => isset($row['celular_apoderados']) ? trim($row['celular_apoderados']) : trim($row['celular']),
                'direccion' => isset($row['direccion']) ? trim($row['direccion']) : 'No especificada',
                'password'  => Hash::make($dniApoderado), // Password inicial = su DNI real
                'estado'    => 1, // Activo por defecto
            ]
        );

        // 3. Registro del Estudiante
        return Estudiante::updateOrCreate(
            ['dni' => trim($row['dni_estudiante'])], // Buscamos por el DNI del alumno
            [
                'nombre'        => trim($row['nombres']),
                'apellidos'     => trim($row['apellidos']),
                'celular'       => isset($row['celular_apoderados']) ? trim($row['celular_apoderados']) : null, // Solo para emergencias
                'observaciones' => isset($row['observaciones']) ? trim($row['observaciones']) : null,
                'idapoderado'   => $apoderado->id, // Vinculación obligatoria
                'estado'        => 1,
            ]
        );
    }
    

}
