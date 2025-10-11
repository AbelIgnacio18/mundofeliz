<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concepto extends Model
{
    use HasFactory;
    protected $fillable=['codigo','concepto','monto'];
    public function pago(){
        return $this->belongsTo(Pagos::class,'id','idconcepto');
    
     }
}
