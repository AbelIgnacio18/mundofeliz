<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;//importa para que f uncione

class Usuario extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'apellidos',
        'celular',      
        'email',      
        'password',
    ];
       public function roles()
    {
        // Nombre de la tabla pivot = userroles
        return $this->belongsToMany(Rol::class, 'user_rols', 'iduser', 'idrol');
    }
}
