<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;
    protected $fillable=['nombre','apellidos','dni','idcontrato','codigo','estado'];

    public function contrato(){
        return $this->belongsTo(Contrato::class,'idcontrato','id');
    
     }
}
