<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pension extends Model
{
    use HasFactory;
    protected $fillable=['idpago','idconcepto','cantidad','montototal'];
    public function pago(){
        return $this->belongsTo(Pagos::class,'id','idconcepto');
    
     }
     public function concepto(){
        return $this->hasOne(Concepto::class,'idconcepto','id');
    
     }
}
