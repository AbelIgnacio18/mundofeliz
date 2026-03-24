<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Docente extends Model
{
    use HasFactory;
    protected $fillable=['user_id','nombre','apellidos','dni','codigo','estado'];

    public function contrato(){
        return $this->belongsTo(Contrato::class,'idcontrato','id');
    
     }
     
     public function horarios()
{
    return $this->hasMany(Horario::class,'iddocente','id');
}
public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}
     
}
