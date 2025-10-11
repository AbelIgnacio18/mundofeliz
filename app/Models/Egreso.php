<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    use HasFactory;
    protected $fillable=['iddocente','montototal','descripcion','fecha'];

    public function docentes(){
        return $this->belongsTo(Egreso::class,'iddocente','id');
    
     }
     public function conceptos(){
        return $this->belongsTo(Concepto::class,'idconcepto','id');
    
     }

     public function pensiones(){
      return $this->hasMany(Pension::class,'idpago','id');
  
   }
}
