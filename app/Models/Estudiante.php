<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
  
    protected $fillable=['nombre','apellidos','dni','celular','direccion','nombreapoderado','observaciones','codigo','estado'];

    public function pagos(){
        return $this->hasMany(Pagos::class,'id','idestudiante');
    
     }
     public function matricula()
    {
        return $this->hasOne(Matricula::class, 'idestudiante');
    }

    
}