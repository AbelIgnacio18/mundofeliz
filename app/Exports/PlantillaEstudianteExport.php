<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PlantillaEstudianteExport implements FromArray, WithHeadings, ShouldAutoSize
{
    /**
     * Definimos los encabezados de la plantilla
     */
    public function headings(): array
    {
        return [
            'nombres',
            'apellidos',
            'dni_estudiante',
            'celular_emergencia',
            'direccion',
            'nombre_apoderado',
            'dni_apoderado', // Campo CRÍTICO para el acceso a la App
            'observaciones'
        ];
    }

    /**
     * Retornamos un array vacío (solo queremos la estructura)
     * o una fila de ejemplo.
     */
    public function array(): array
    {
        return [
            [
                'Juan Gabriel',
                'Perez Quispe',
                '70654321',
                '987654321',
                'Av. Real 123 - El Tambo',
                'Maria Quispe Lázaro',
                '40506070',
                'Estudiante de traslado'
            ]
        ];
    }
}