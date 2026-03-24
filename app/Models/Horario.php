<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    use HasFactory;

    protected $fillable=[
        'iduser',
        'dia_semana',
        'hora_ingreso',
        'tolerancia',
        'estado'
    ];

   
     public function user()
    {
        return $this->belongsTo(User::class, 'iduser');
    }
}