<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use App\Models\CalendarioEscolar;

class CalendarioEscolar extends Model
{
    use HasFactory;
    $inicio = Carbon::create(2026, 3, 1);
$fin = Carbon::create(2026, 12, 31);

while ($inicio <= $fin) {

    CalendarioEscolar::create([
        'fecha' => $inicio->toDateString(),
        'es_laborable' => !$inicio->isWeekend(), // sábados y domingos no laborables
    ]);

    $inicio->addDay();
}
}



