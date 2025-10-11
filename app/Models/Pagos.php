<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    use HasFactory;
    protected $fillable=['idestudiante','idconcepto','descripcion','fecha','foto'];

    public function estudiantes(){
        return $this->belongsTo(Pagos::class,'idestudiante','id');
    
     }
     public function conceptos(){
        return $this->belongsTo(Concepto::class,'idconcepto','id');
    
     }

     public function pensiones(){
      return $this->hasMany(Pension::class,'idpago','id');
  
   }
}
