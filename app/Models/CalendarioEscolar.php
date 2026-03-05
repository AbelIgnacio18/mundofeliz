<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalendarioEscolar extends Model
{
    use HasFactory;

    protected $table = 'calendario_escolar';

    protected $fillable = [
        'fecha',
        'descripcion',
        'es_laborable'
    ];
}
