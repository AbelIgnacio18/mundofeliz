<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;
    protected $fillable=['idestudiante','idanolectivo','idaula'];
    public function estudiante(){
        return $this->hasOne(Estudiante::class,'id','idestudiante');
    
     }

      public function meses(){
        return $this->hasMany(Mese::class,'idmatricula','id');
    ///esta funcionandooo
     }

     public function aula(){
        return $this->hasOne(Aula::class,'id','idaula');
    
     }
      public function concepto(){
        return $this->hasOne(Concepto::class,'id','idconcepto');
    
     }
      public function estudiantes(){
        return $this->hasOne(Estudiante::class,'id','idestudiante');
    
     }
      public function asistenciahoy(){
        return $this->hasmany(Asistenciaest::class,'idmatricula','id');
    
     }
    
}
