<?php

namespace App\Http\Controllers;

use App\Models\Sede;
use App\Http\Requests\StoreuserRolRequest;
use App\Http\Requests\UpdateuserRolRequest;
use Illuminate\Http\Request;
class SedeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  public function index()
{
    $items = Sede::all();
    return view('pages.sede.index', compact('items'));
}

public function store(Request $request)
{
    Sede::create($request->all());
    return redirect()->back();
}

public function update(Request $request, $id)
{
    $sede = Sede::findOrFail($id);
    $sede->update($request->all());

    return redirect()->back();
}


public function seleccionar(Request $request)
{
    $sede = Sede::findOrFail($request->idsede);

    session([
        'sede_actual' => $sede->id,
        'sede_nombre' => $sede->nombre, // 🔥 esto te faltaba
    ]);

    return redirect()->back()->with('success', 'Sede seleccionada');
}

    

}
