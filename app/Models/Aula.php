<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\FiltraPorSede;
class Aula extends Model
{
    use HasFactory, FiltraPorSede;
   protected $fillable=[
    'nivel',
    'grado',
    'seccion',
    'vacantes',
    'horaentrada',
    'horatarde',
    'horafalta',
    'horasalida',
    'idsede'
];
protected $casts = [
    'horaentrada' => 'datetime:H:i:s',
    'horatarde' => 'datetime:H:i:s',
    'horafalta' => 'datetime:H:i:s',
    'horasalida' => 'datetime:H:i:s',
];
   public function sede()
{
    return $this->belongsTo(Sede::class, 'idsede');
}
public function matriculas()
{
    return $this->hasMany(Matricula::class, 'idaula');
}

}
