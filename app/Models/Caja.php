<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    use HasFactory;

    protected $fillable=['iduser',
'fecha',
'monto_inicial',
'monto_final','diferencia',
'estado'];
public function movimientos()
{
    return $this->hasMany(Movimiento::class,'idcaja','id');
}

}
