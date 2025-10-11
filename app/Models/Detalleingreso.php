<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalleingreso extends Model
{
    use HasFactory;
    protected $fillable=['idingreso','idarticulo','cantidad','montototal','fecha'];
    public function articulos(){
        return $this->hasMany(Articulo::class,'idartuculo','id');
    
     }
}
