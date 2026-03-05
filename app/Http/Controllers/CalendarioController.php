<?php

namespace App\Http\Controllers;

use App\Models\CalendarioEscolar;
use App\Http\Requests\StoreCalendarioRequest;
use App\Http\Requests\UpdateCalendarioRequest;
use Illuminate\Http\Request;
class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
    $dias = CalendarioEscolar::orderBy('fecha','desc')->get();
    return view('pages.calendario.index', compact('dias'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCalendarioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Calendario $Calendario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calendario $Calendario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $dia = CalendarioEscolar::findOrFail($id);

    $dia->es_laborable = !$dia->es_laborable;
    $dia->save();

    return response()->json([
        'estado'=>$dia->es_laborable
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calendario $Calendario)
    {
        //
    }
}
