<?php

namespace App\Http\Controllers;

use App\Exports\EstudianteExport;
use Illuminate\Http\Request;// importacion 
use App\Http\Requests\StoreAdministrativoRequest;
use App\Http\Requests\UpdateAdministrativoRequest;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\administrativoExport;
use App\Imports\administrativoImport;
use App\Models\Administrativo;
use App\Models\User;
use App\Models\UserRol;
use App\Models\Rol;
use App\Models\Sede;


use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;//importaciones a excel....administrativoExport

class administrativoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
  

    public function __construct()
    {
       
    } 

   public function index(Request $request)
{
    $user = auth()->user();

   $roles = Rol::where('nombre', '!=', 'SuperAdmin')->get();
    $sedes = Sede::all();

    $items = Administrativo::with('user.roles', 'user.sedes')
        ->whereHas('user', function ($q) use ($user) {
            $q->porSede($user);
        })
        ->get();

    return view('pages.administrativo.index', compact('items', 'roles', 'sedes'));
}



    protected function pdffiltrado(Request $request)
    {

        if ($request) {
          

        $administrativo = Administrativo::get();
        
        

        $pdf = Pdf::loadView('pages.administrativo.mostrarfiltro',compact('administrativo','seccion'));
        

     
        return $pdf->stream('lista-administrativos.pdf');
       
       

      
    }
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $email = $request->dni . '@bertoltbrecht.com';

        if (User::where('email', $email)->exists()) {
            return back()->with('danger', 'El usuario ya existe');
        }

        // 🔥 crear usuario
        $user = User::create([
            'name' => strtoupper($request->nombre),
            'apellidos' => strtoupper($request->apellidos),
            'email' => $email,
            'password' => bcrypt($request->dni),
        ]);

        // 🔥 crear administrativo
        Administrativo::create([
            'user_id' => $user->id,
            'dni' => $request->dni,
            'codigo' => $request->codigo,
            'celular' => $request->celular,
        ]);


        // Roles


        // 🔥 Asignar sedes
        $sedes = $request->get('sedes', []); // array de sedes seleccionadas
        $userrol = $request->get('userrol_id', []);
        // 🔹 asignar roles
        $user->roles()->sync($userrol);
        // Validar que no sea SuperAdmin
        $esSuperAdmin = Rol::whereIn('id', [$request->userrol_id])
            ->where('nombre', 'SuperAdmin')
            ->exists();

        if (!$esSuperAdmin) {
            $user->sedes()->sync($sedes);
        }
        DB::commit();

        return back()->with('message', 'Personal creado correctamente');
    }

    public function show($id)
    {
        $administrativo = Administrativo::where('id', $id)->first();
        
     
    }
   

public function update(Request $request, $id)
{
    DB::beginTransaction();

    try {

        $admin = Administrativo::findOrFail($id);
        $usuario = $admin->user;

        $email = $request->dni . '@bertoltbrecht.com';

        // validar email único
        if (User::where('email', $email)
            ->where('id', '!=', $admin->user_id)
            ->exists()) {

            return back()->with('danger', 'Email ya existe');
        }

        // actualizar administrativo
        $admin->update([
            'dni' => $request->dni,
            'codigo' => $request->codigo,
            'celular' => $request->celular,
        ]);

        // actualizar usuario
        if ($usuario) {
            $usuario->update([
                'name' => strtoupper($request->nombre),
                'apellidos' => strtoupper($request->apellidos),
                'email' => $email,
            ]);

            // 🔹 ROLES
            $roles = $request->get('userrol_id', []);
            $usuario->roles()->sync($roles);

            // 🔹 recargar roles
            $usuario->load('roles');

            // 🔥 SEDES
            $sedes = $request->get('sedes', []);

            if ($usuario->esSuperAdmin()) {
                $usuario->sedes()->detach();
            } else {
                $usuario->sedes()->sync($sedes);
            }
        }

        DB::commit();

        return back()->with('message', 'Actualizado correctamente');

    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', $e->getMessage());
    }
}
    

 
    public function destroy($administrativo)
    {

        $administrativo=Administrativo::find($administrativo);
        $administrativo->delete();
        return back()->with('message', 'Archivo Eliminado ');
    }

  
  
}
