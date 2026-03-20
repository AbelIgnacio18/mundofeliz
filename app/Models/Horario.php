<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable=[
        'iddocente',
        'dia_semana',
        'hora_ingreso',
        'tolerancia',
        'estado'
    ];

    public function docente()
    {
        return $this->belongsTo(Docente::class,'iddocente','id');
    }
}