<?php

namespace App\Imports;

use App\Models\Estudiante;
use Maatwebsite\Excel\Concerns\ToModel;

class EstudianteImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Estudiante([
            
            'apellidos'=>$row[0].' '.$row[1],
            'nombre'=>$row[2],
            // 'dni'=>$row[3],
            // 'celular'=>$row[5],
         
            
        ]);
    }
}
