<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;
    protected $fillable=['idestudiante','idsede','colegio_procedencia'	,'fecha_matricula','idanolectivo','idaula','codigo'];

     public function estudiante()
{
    return $this->belongsTo(Estudiante::class, 'idestudiante', 'id');
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
    
      public function asistenciahoy(){
        return $this->hasmany(Asistenciaest::class,'idmatricula','id');
    
     }
     public function asistencias() {
    return $this->hasMany(Asistenciaest::class, 'idmatricula', 'id');
}
     public function scopePorUsuario($query)
{
    $user = auth()->user();

    if (!$user) return $query;

    if ($user->esSuperAdmin()) return $query;

    return $query->whereIn('idsede', $user->getSedesIds());
}
    
}
