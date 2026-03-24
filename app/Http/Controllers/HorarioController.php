<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreHorarioRequest;
use App\Http\Requests\UpdateHorarioRequest;
use App\Models\Horario;
use App\Models\Docente;
use App\Models\User;

class HorarioController extends Controller
{
    public function __construct() {}

    public function index(Request $request)
{
    // 🔹 traer usuarios (docentes + administrativos si quieres)
    $usuarios = User::with(['docente', 'administrativo'])->get();

    // 🔹 horarios agrupados por usuario
    $horarios = Horario::with('user')->get()->groupBy('iduser');

    return view('pages.horario.index', compact('horarios', 'usuarios'));
}

    public function store(Request $request)
    {
        $items = new Horario();

        $dias = $request->dias;
        $horas = $request->horas;
        $tolerancias = $request->tolerancias;

        foreach ($dias as $index => $dia) {

            if (!empty($horas[$index])) {

                Horario::create([
                    'iduser' => $request->iduser,
                    'dia_semana' => $dia,
                    'hora_ingreso' => $horas[$index],
                    'tolerancia' => $tolerancias[$index],
                    'estado' => 1
                ]);
            }
        }
        return back()->with('message', 'Actualización Exítosa');
    }
   




    public function update(Request $request,  $docenteId)
    {

  
$diasSeleccionados = $request->dias ?? [];

Horario::where('iduser',$docenteId)
       ->whereNotIn('dia_semana',$diasSeleccionados)
       ->delete();


  foreach($request->horas as $dia => $hora){

    if(in_array($dia,$diasSeleccionados) && !empty($hora)){

        Horario::updateOrCreate(

        [
            'iduser'=>$docenteId,
            'dia_semana'=>$dia
        ],

        [
            'hora_ingreso'=>$hora
        ]

        );

    }

}
        return back()->with('message', 'Actualización Exítosa');
    }




    public function destroy($docenteId)
    {

        Horario::where('iduser', $docenteId)->delete();
        return back()->with('message', 'Archivo Eliminado ');
    }
}
