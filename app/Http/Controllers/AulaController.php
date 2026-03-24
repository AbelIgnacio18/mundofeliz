<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAulaRequest;
use App\Http\Requests\UpdateAulaRequest;
use App\Models\Aula;

use App\Models\Sede;


class AulaController extends Controller
{
    public function __construct() {}

public function index()
{
    $user = auth()->user();

    $items = Aula::with('sede')->porUsuario()->get();

    // 🔥 AQUÍ ESTÁ LA CLAVE
    $sedes = $user->esSuperAdmin()
        ? Sede::all()
        : $user->sedes;

    return view('pages.aula.index', compact('items', 'sedes'));
}

public function store(StoreAulaRequest $request)
{
    $user = auth()->user();

    // 🔒 VALIDAR SEDE (SEGURIDAD)
    if (!$user->esSuperAdmin()) {
        if (!$user->tieneSede($request->idsede)) {
            abort(403, 'No tienes acceso a esta sede');
        }
    }

    Aula::create([
        'nivel'       => $request->nivel,
        'grado'       => $request->grado,
        'seccion'     => $request->seccion,
        'vacantes'    => $request->vacantes,
        'horaentrada' => $request->horaentrada,
        'horatarde'   => $request->horatarde,
        'horafalta'   => $request->horafalta,
        'horasalida'  => $request->horasalida,
        'idsede'      => $request->idsede, // 🔥 CLAVE
    ]);

    return back()->with('message', 'Aula creada correctamente');
}



    public function update(UpdateAulaRequest $request, $id)
{
    $aula = Aula::findOrFail($id);
    $user = auth()->user();

    // 🔒 SEGURIDAD POR SEDE
    if (!$user->esSuperAdmin()) {
        if (!$user->tieneSede($aula->idsede)) {
            abort(403, 'No tienes acceso a esta aula');
        }
    }

    $aula->update([
        'nivel'       => $request->nivel,
        'vacantes'    => $request->vacantes,
        'horaentrada' => $request->horaentrada,
        'horatarde'   => $request->horatarde,
        'horafalta'   => $request->horafalta,
        'horasalida'  => $request->horasalida,
    ]);

    return back()->with('message', 'Actualización exitosa');
}



    public function destroy($items)
    {

        $items = Aula::find($items);
        $items->delete();
        return back()->with('message', 'Archivo Eliminado ');
    }
}
