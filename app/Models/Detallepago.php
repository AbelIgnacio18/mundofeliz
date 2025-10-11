<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detallepago extends Model
{
    use HasFactory;
    protected $fillable=['idpago','idarticulo','cantidadar','montoar','fecha'];

    public function articulos(){
        return $this->hasMany(Articulo::class,'idartuculo','id');
    
     }
}
