<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    use HasFactory;
    protected $fillable=['nombre','stock','preciocosto','precioventa'];

       public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'idcategoria');
    }
}
