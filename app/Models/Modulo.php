<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    public function permisos()
    {
        return $this->hasMany(Permission::class, 'idmodulo');
    }
}
