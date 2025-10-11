<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistenciaest extends Model
{
    use HasFactory;
    protected $fillable=['idanolectivo','idestudiante','fechaentrada','mes','dia','estado'];

    public function estudiante(){
        return $this->belongsTo(Estudiante::class,'idestudiante','id');
    
     }

       public function matriculaestudiante(){
        return $this->hasOne(Estudiante::class,'id','idestudiante');
    
     }
      
    
     }
    


