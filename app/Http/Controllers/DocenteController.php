<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; // importacion 
use App\Models\Docente;
use App\Models\User;
use App\Models\UserRol;
use App\Models\Contrato;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreDocenteRequest;
use App\Http\Requests\UpdateDocenteRequest;

class DocenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request) {

            $items = Docente::get();
            //  dd($items);

            return view(
                'pages.docente.index',
                compact('items')
            );
        }
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
    public function store(StoreDocenteRequest $request)
    {
        DB::beginTransaction();

        try {
            $apellidop = $request->get('apellidop');
            $apellidom = $request->get('apellidom');

            // 🔥 1. CREAR USUARIO (LOGIN)
            if (User::where('email', $request->dni . '@bertoltbrecht.com')->exists()) {
                return back()->with('danger', 'El docente ya tiene usuario');
            }

            $user = User::create([
                'name' => strtoupper($request->get('nombre')),
                'apellidos' => strtoupper($apellidop . ' ' . $apellidom),
                'email' => $request->get('dni') . 'bertoltbrecht.com', // temporal
                'password' => bcrypt($request->get('dni')),
            ]);

            // 🔥 2. CREAR DOCENTE
            $docente = new Docente;



            $docente->user_id = $user->id; // 🔥 clave
            $docente->nombre = strtoupper($request->get('nombre'));
            $docente->apellidos = strtoupper($apellidop . ' ' . $apellidom);
            $docente->dni = strtoupper($request->get('dni'));
            $docente->codigo = strtoupper($request->get('codigo'));
            $docente->celular = $request->get('celular');

            $docente->save();

            // 🔥 3. ASIGNAR ROL (docente)
            UserRol::create([
                'iduser' => $user->id,
                'idrol' => 3 // 👈 ID del rol docente
            ]);

            DB::commit();

            return back()->with('message', 'Docente creado con acceso al sistema');
        } catch (\Exception $e) {

            DB::rollback();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Docente $docente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Docente $docente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreDocenteRequest $request, $id)
    {
        DB::beginTransaction();

        try {

            $docente = Docente::findOrFail($id);
            $email = $request->dni . '@bertoltbrecht.com';

            if (User::where('email', $email)
                ->where('id', '!=', $docente->user_id)
                ->exists()
            ) {

                return back()->with('danger', 'Email ya existe');
            }

            // 🔥 actualizar docente

            $docente->nombre = strtoupper($request->get('nombre'));
            $docente->apellidos = strtoupper($request->get('apellidos'));
            $docente->dni = strtoupper($request->get('dni'));
            $docente->codigo = strtoupper($request->get('codigo'));
            $docente->celular = $request->get('celular');

            $docente->save();

            // 🔥 actualizar usuario vinculado


            if ($docente->user) {

                $docente->user->update([
                    'name' => $docente->nombre,
                    'apellidos' => $docente->apellidos,
                    'email' => $docente->dni . '@bertoltbrecht.com', // opcional
                ]);
            }

            DB::commit();

            return back()->with('message', 'Docente actualizado correctamente');
        } catch (\Exception $e) {

            DB::rollback();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($docente)
    {
        DB::beginTransaction();

        try {

            $item = Docente::findOrFail($docente);

            // 🔥 desactivar docente
            $item->estado = 0;
            $item->save();

            // 🔥 desactivar usuario vinculado
            if ($item->user) {
                $item->user->estado = 0;
                $item->user->save();
            }

            DB::commit();

            return back()->with('message', 'Docente desactivado correctamente');
        } catch (\Exception $e) {

            DB::rollback();
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
