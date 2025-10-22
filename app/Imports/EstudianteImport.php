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
            
            'apellidos'=>$row[0],
            'nombre'=>$row[1],
             'dni'=>$row[2],
            'celular'=>$row[3],
            'direccion'=>$row[4],
        'nombreapderado'=>$row[5],
        'observaciones'=>$row[6],
         
            
        ]);
    }
}
