<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $fillable=['idañolectivo','iddocente','fechaentreda','mes','dia'];


    
    public function docentes(){
        return $this->belongsTo(Docente::class,'iddocente','id');
    
     }
}
