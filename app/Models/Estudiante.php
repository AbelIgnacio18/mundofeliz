<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estudiante extends Model
{
    use HasFactory;
  
    protected $fillable=['nombre','apellidos','dni','idaula','codigo','estado'];

    public function pagos(){
        return $this->hasMany(Pagos::class,'id','idestudiante');
    
     }

     public function meses(){
        return $this->hasMany(Mese::class,'idestudiante','id');
    ///esta funcionandooo
     }

     public function aula(){
        return $this->belongsTo(Aula::class,'idaula','id');
    ///esta funcionandooo
     }
}
