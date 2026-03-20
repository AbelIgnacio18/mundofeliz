<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pension extends Model
{
    use HasFactory;
    protected $fillable=['idpago','idconcepto','cantidad','montototal'];
    public function pago(){
       return $this->belongsTo(Pagos::class, 'idpago', 'id');
    
     }
     public function concepto(){
        return $this->belongsTo(Concepto::class,'idconcepto','id');
    
     }

     
}
