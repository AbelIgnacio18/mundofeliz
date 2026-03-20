<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
  
    protected $fillable=['nombre','apellidos','dni','celular',
    'observaciones','estado','idapoderado','fecha_nacimiento','colegio_procedencia','genero','imagen'];

    // public function pagos(){
    //     return $this->hasMany(Pagos::class,'id','idestudiante');
    
    //  }
     public function matricula()
    {
        return $this->hasOne(Matricula::class, 'idestudiante');
    }
    public function apoderado()
{
    // belongsTo es más semántico aquí que hasOne
    return $this->belongsTo(Apoderado::class, 'idapoderado', 'id');
}
     public function concepto()
    {
        return $this->hasOne(Concepto::class, 'id');
    }

 

public function pagos()
{
    return $this->hasMany(Pagos::class, 'idestudiante', 'id');
}
    
}