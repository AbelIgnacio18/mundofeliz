<?php

namespace App\Exports;

use App\Models\Matricula;
use App\Models\Anolectivo;
use Maatwebsite\Excel\Concerns\FromCollection;

class EstudianteExport implements FromCollection
{
    public function collection()
    {
        $anolect = Anolectivo::where('estado', 1)->first();
        if (!$anolect) {
            return collect([['No hay año lectivo activo']]);
        }
        return collect([
            ['UID,Nombre'] // 👈 encabezado en una sola celda
        ])->merge(
            Matricula::join('estudiantes', 'matriculas.idestudiante', '=', 'estudiantes.id')
                ->where('matriculas.idanolectivo', $anolect->id) // ✅ FILTRO
                ->selectRaw("CONCAT(matriculas.codigo, ',', estudiantes.nombre) as dato")
                ->get()
                ->filter(function ($item) {
                    return $item->dato != null && $item->dato != '';
                })
                ->map(function ($item) {
                    return [$item->dato]; // 👈 UNA SOLA COLUMNA
                })
        );
    }
}
