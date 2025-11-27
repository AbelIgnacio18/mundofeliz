<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;// importacion 


use App\Models\User;
use App\Models\Rol;
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
       
       if ($request) {
          $rol=Rol::all();

         
          
if(Auth::user()->roles[0]->nombre=="Admin"){
 $usuario=User::with('roles')->get();
}else{
$id=Auth::user()->id;
 $usuario=User::where('id',$id)->with('roles')->get();
};

           return view('pages.usuario.index',compact('usuario','rol'));
       
       }
   
   }

  

   /**
    * Store a newly created resource in storage.
    */
   public function store(StoreUsuarioRequest $request)
   {
       $usuario=new User;

        $userrol = $request->get('userrol_id');
       

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
            if(empty($userrol)==false){
            $cont = 0;
            while ($cont < count($userrol)) {

                $matricula = new UserRol;
             
                // dd($split_url);
                $matricula->iduser = $usuario->id;
                $matricula->idrol = $userrol[$cont];

                $matricula->save();
                $cont = $cont + 1;
            }
            }
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
$usuario->estado = $request->get('estado');
        $usuario->update();

  $userrol = $request->get('userrol_id');
        if (empty($userrol) == false) {
            $cont = 0;
            while ($cont < count($userrol)) {

                $usuario = UserRol::where('iduser', $usuario->id)->first();
                $usuario->idrol = $userrol[$cont];

                $usuario->update();
                $cont = $cont + 1;
            }
        }
      
       return back()->with('message', 'Actualización Exítosa');
   }
   


   public function destroy($usuario)
   {

       $usuario=User::find($usuario);
       $usuario->estado=0;
       $usuario->update();
       return back()->with('message', 'Usuario Desactivado ');
   }
}
