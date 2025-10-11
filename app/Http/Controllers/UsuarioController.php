<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;// importacion 


use App\Models\User;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;


class UsuarioController extends Controller
{ /**
    * Display a listing of the resource.
    */
   public function index(Request $request)
   {
       
       if ($request) {
        
           $usuario=User::all();

           return view('pages.usuario.index',compact('usuario'));
       
       }
   
   }

  

   /**
    * Store a newly created resource in storage.
    */
   public function store(StoreUsuarioRequest $request)
   {
       $usuario=new User;

       $usuario = new User;
        $usuario->name= $request->get('name');
        $usuario->apellidos = $request->get('apellidos');
        $usuario->email = $request->get('email');
        if ($request->get('password') != '') $usuario->password = bcrypt($request->get('password'));
        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $file->move(public_path() . '/imagenes/avatar/', $file->getClientOriginalName());
            $usuario->foto = $file->getClientOriginalName();
        }
     
       $usuario->save();
       return back()->with('message', 'Actualización Exítosa');
   }
 

  

   public function update(Request $request,  $usuario)
   {
        $usuario = User::find($usuario);
        $this->validate($request, [
            'name' => 'required|max:250',
            'apellidos' => 'required|max:100',
            'email' => 'required|email|max:255',
            'foto' => 'mimes:jpeg,bmp,png',
            'password' => ($request->get('password') != "") ? 'required|min:5|confirmed' : "",
        ]);
        $usuario->name = $request->get('name');
        $usuario->apellidos = $request->get('apellidos');
        $usuario->email = $request->get('email');
        if ($request->get('password') != '') $usuario->password = bcrypt($request->get('password'));     

        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $file->move(public_path() . '/imagenes/avatar/', $file->getClientOriginalName());
            $usuario->foto = $file->getClientOriginalName();
        }

        $usuario->update();
      
       return back()->with('message', 'Actualización Exítosa');
   }
   


   public function destroy($usuario)
   {

       $usuario=User::find($usuario);
       $usuario->delete();
       return back()->with('message', 'Archivo Eliminado ');
   }
}
