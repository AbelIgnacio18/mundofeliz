<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    use HasFactory;

    protected $fillable=[
        'idcaja',
'tipo',// (ingreso/egreso)
'idpago',
'iddocente',
'monto',
'metodo',
'descripcion',];
public function caja()
{
    return $this->belongsTo(Caja::class, 'idcaja', 'id');
}
}
