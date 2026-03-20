<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Importante para Auth
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens; // Importante para Sanctum
use Illuminate\Notifications\Notifiable;




class Apoderado extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'apoderados';

    protected $fillable = [
        'nombre',
        'dni',
        'celularp',
        'celularm',        
        'celular',
        'direccion',
        'password',
        'fcm_token',
        'estado'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function estudiantes()
{
    return $this->hasMany(Estudiante::class ,'idapoderado');
}

}