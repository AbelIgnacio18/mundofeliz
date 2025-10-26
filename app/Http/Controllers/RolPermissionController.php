<?php

namespace App\Http\Controllers;

use App\Models\RolPermission;
use App\Http\Requests\StoreRolPermissionRequest;
use App\Http\Requests\UpdateRolPermissionRequest;

class RolPermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreRolPermissionRequest $request)
    {

          $rolpermission=RolPermission::all();

        for ($i = 0; $i < count($rolpermission); $i++) {
            $rolpermission[$i]->delete();
        }
 
            $permissionandrole = $request->get('permissionandrole');
            if(empty($permissionandrole)==false){
            $cont = 0;
            while ($cont < count($permissionandrole)) {

                $matricula = new RolPermission;
                $split_url = explode('-',  $permissionandrole[$cont]);
                // dd($split_url);
                $matricula->idpermission = $split_url[0];
                $matricula->idrol = $split_url[1];

                $matricula->save();
                $cont = $cont + 1;
            }
            }
       
       

        return back()->with('message', 'Registro Exítosa');
    }

    /**
     * Display the specified resource.
     */
    public function show(RolPermission $rolPermission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RolPermission $rolPermission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRolPermissionRequest $request, RolPermission $rolPermission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RolPermission $rolPermission)
    {
        //
    }
}
