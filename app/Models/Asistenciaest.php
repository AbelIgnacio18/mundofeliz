<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistenciaest extends Model
{
    use HasFactory;
    protected $fillable=['idanolectivo','idmatricula','fechaentrada','horaentrada','horasalida','observacion','estado'];

  
     public function matricula()
{
    return $this->belongsTo(Matricula::class, 'idmatricula', 'id');
}
      
    
     }
    


