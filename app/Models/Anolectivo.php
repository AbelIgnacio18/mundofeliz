<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anolectivo extends Model
{
    use HasFactory;

    protected $fillable=['años','inicio','fin','estado'];
     protected $casts = [
        'inicio' => 'date',
        'fin' => 'date',
        'estado' => 'boolean',
    ];
}

