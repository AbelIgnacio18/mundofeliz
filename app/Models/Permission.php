<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = ['nombre', 'status', 'idmodulo'];

     public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'idmodulo');
    }
   
}
