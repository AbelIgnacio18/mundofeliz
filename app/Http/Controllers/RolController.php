<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\Permission;
use App\Models\RolPermission;
use App\Models\Modulo;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\StoreRolRequest;
use App\Http\Requests\UpdateEstudianteRequest;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
{
    $this->middleware(function ($request, $next) {
        if (!auth()->user()->hasPermission('VER ROL & PERMISOS')) {
            abort(403, 'No tienes permiso para acceder a este módulo.');
        }
        return $next($request);
    })->only(['index']); // puedes aplicar a métodos específicos
}

     public function index(Request $request)
    {
        
        if ($request) {
         
            $rol=Rol::all();
            $permission=Permission::with('modulo')->get();
            $rolpermission=RolPermission::all();
             $modulo=Modulo::all();


            return view('pages.rol.index',compact('rol','permission','rolpermission','modulo'));
        
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
    public function store(StoreRolRequest $request)
    {

          $rol=new Rol;
           
        $rol->nombre=$request->get('nombre');
        
        $rol->save();
        return back()->with('message', 'Registro Exítoso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rol $rol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rol $rol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rol $rol)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rol $rol)
    {
        //
    }
}
