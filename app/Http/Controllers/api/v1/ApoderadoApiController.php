<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\anolectivo;
use App\Models\Asistencia;
use App\Models\Apoderado;
use Illuminate\Http\Request;

class ApoderadoApiController extends Controller
{
    public function show($id)
    {

      $apoderado = Apoderado::with('estudiantes')->find($id);

        return response()->json($apoderado, 200);
    }

  
}