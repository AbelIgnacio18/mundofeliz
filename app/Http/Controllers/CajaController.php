<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // importacion
use App\Models\Caja;
use App\Models\Movimiento;
use App\Http\Requests\StoreCajaRequest;
use App\Http\Requests\UpdateCajaRequest;

class CajaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request) {
             $existe = Caja::where('iduser', auth()->id())
            ->where('estado',1)
            ->first();

      $caja = Caja::with('movimientos')
    ->withCount('movimientos')
    ->get()
    ->map(function ($c) {

        $ingresos = $c->movimientos->where('tipo','ingreso')->sum('monto');
        $egresos = $c->movimientos->where('tipo','egreso')->sum('monto');

        $c->ingresos = $ingresos;
        $c->egresos = $egresos;
        $c->saldo = $c->monto_inicial + $ingresos - $egresos;

        return $c;
    });
            return view('pages.caja.index', compact('caja','existe'));
    }
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCajaRequest $request)
    {
        $existe = Caja::where('iduser', auth()->id())
            ->where('estado',1)
            ->first();

        if ($existe) {
            return back()->with('danger', 'Ya tienes una caja abierta');
        }

        Caja::create([
            'iduser' => auth()->id(),
            'fecha' => now(),
            'monto_inicial' => $request->get('monto_inicial'),
            'estado' => 1
        ]);

        return back()->with('success', 'Caja abierta');
    }


    public function update(Request $request, $id)
    {
       $request->validate([
        'monto_fisico' => 'required|numeric|min:0'
    ]);

    $caja = Caja::findOrFail($id);

    // 🔥 calcular ingresos
    $ingresos = Movimiento::where('idcaja', $id)
        ->where('tipo', 'ingreso')
        ->sum('monto');

    // 🔥 calcular egresos
    $egresos = Movimiento::where('idcaja', $id)
        ->where('tipo', 'egreso')
        ->sum('monto');

    // 🔥 saldo sistema
    $saldo = $caja->monto_inicial + $ingresos - $egresos;

    // 🔥 diferencia
    $diferencia = $request->monto_fisico - $saldo;

    // guardar
    $caja->monto_final = $request->monto_fisico;
    $caja->estado = 0;
    $caja->diferencia = $diferencia;
    $caja->save();

    return back()->with('success', 'Caja cerrada correctamente');
    }





    public function destroy($id)
    {

       $caja = Caja::findOrFail($id);

    if ($caja->movimientos()->count() > 0) {
        return back()->with('error', 'No se puede eliminar, tiene movimientos');
    }

    $caja->delete();

    return back()->with('success', 'Caja eliminada');
    }
}
