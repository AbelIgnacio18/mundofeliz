<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;
    protected $fillable=['idestudiante','idconcepto','descripcion','fecha','foto'];

    public function estudiante(){
        return $this->belongsTo(Estudiante::class,'idestudiante','id');
    
     }
     public function conceptos(){
        return $this->belongsTo(Concepto::class,'idconcepto','id');
    
     }

     public function pensiones(){
      return $this->hasMany(Pension::class,'idpago','id');
  
   }
   // loss 

//    public function pensions()
// {
//     return $this->hasMany(Pension::class, 'idpago');
// }

// public function concepto()
// {
//     return $this->belongsTo(Concepto::class, 'idconcepto');
// }
}
