<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;// importacion 


use App\Models\User;
use App\Models\Rol;
use App\Models\Sede;
use App\Models\UserRol;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use Illuminate\Support\Facades\Auth;


class UsuarioController extends Controller
{ /** 
    * Display a listing of the resource.
    */
 public function index(Request $request)
{
    $user = Auth::user();

    $rol = Rol::all();
    $sedes = Sede::all();

    if ($user->esSuperAdmin()) {
        $usuario = User::with('roles', 'sedes')->get();
        
    } else {
        $usuario = User::with('roles', 'sedes')
            ->porSede($user)
            ->get();
    }
    

    return view('pages.usuario.index', compact('usuario', 'rol', 'sedes'));
}

  

   /**
    * Store a newly created resource in storage.
    */
 public function store(StoreUsuarioRequest $request)
{
    $usuario = new User;

    $usuario->name = $request->name;
    $usuario->apellidos = $request->apellidos;
    $usuario->email = $request->email;

    if ($request->password != '') {
        $usuario->password = bcrypt($request->password);
    }

    if ($request->hasFile('imagen')) {
        $file = $request->file('imagen');
        $file->move(public_path('imagenes/avatar'), $file->getClientOriginalName());
        $usuario->foto = $file->getClientOriginalName();
    }

    $usuario->save();

    // 🔹 datos seguros
    $userrol = $request->get('userrol_id', []);
    $sedes  = $request->get('sedes', []);

    // 🔹 asignar roles
    $usuario->roles()->sync($userrol);

    // 🔹 recargar roles
    $usuario->load('roles');

    // 🔥 lógica de sedes
    if ($usuario->esSuperAdmin()) {
        $usuario->sedes()->detach();
    } else {
        $usuario->sedes()->sync($sedes);
    }

    return back()->with('message', 'Usuario creado correctamente');
}



    public function update(UpdateUsuarioRequest $request, $id)
{
    $usuario = User::findOrFail($id);

    $usuario->name = $request->name;
    $usuario->apellidos = $request->apellidos;
    $usuario->email = $request->email;

    if ($request->password != '') {
        $usuario->password = bcrypt($request->password);
    }

    if ($request->hasFile('imagen')) {
        $file = $request->file('imagen');
        $file->move(public_path('imagenes/avatar'), $file->getClientOriginalName());
        $usuario->foto = $file->getClientOriginalName();
    }

    $usuario->estado = $request->estado;
    $usuario->save();

    // 🔹 datos seguros
    $userrol = $request->get('userrol_id', []);
    $sedes  = $request->get('sedes', []);

    // 🔹 roles
    $usuario->roles()->sync($userrol);

    // 🔹 recargar roles
    $usuario->load('roles');

    // 🔥 sedes
    if ($usuario->esSuperAdmin()) {
        $usuario->sedes()->detach();
    } else {
        $usuario->sedes()->sync($sedes);
    }

    return back()->with('message', 'Usuario actualizado correctamente');
}



    public function destroy($usuario)
    {

        $usuario = User::find($usuario);
        $usuario->estado = 0;
        $usuario->update();
        return back()->with('message', 'Usuario Desactivado ');
    }
}
