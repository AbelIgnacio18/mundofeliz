<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\anolectivo;
use App\Models\Asistencia;
use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteApiController extends Controller
{
    public function index(Request $request)
    {

        $estudiante = Estudiante::all();

        return response()->json($estudiante, 200);
    }

  
}