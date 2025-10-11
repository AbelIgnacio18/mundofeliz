<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;
    protected $fillable=['iduser','montototal','descripcion','fecha'];

    public function detalleingresos(){
        return $this->hasMany(Detalleingreso::class,'idingreso','id');
    
     }
     public function articulos(){
        return $this->hasMany(Articulo::class,'idartuculo','id');
    
     }
}
