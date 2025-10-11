<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Estudiante;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   
    public function login(Request $request){

        $dni=$request->get('dni');
        $password=$request->get('password');
  
     

        $user = Estudiante::where('dni', $dni)->first();
        // $user = User::where('email', $request->email)->first();
 
        if (! $user || ! Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'message' => 'No Autorizado',
            ],403);
        }
     
        return $user->createToken($request->device_name)->plainTextToken;
     
        
        
    }

    public function validateLogin(Request $request){
        
        return $request->validate([
            'dni' => 'required|string',
            'password' => 'required|string',
            'device_name' => 'required'
        ]);
    }
    public function userInfo()
    {
        return response()->json([
            'status' => 'success',
            'type_token'=>'Bearer',
            'user'=>auth()->user(),
        ]);
    }
    public function logout(Request $request)
    {
     
         $request->user()->tokens()->delete();
         return response()->json([
                'message' => 'se4sion cerrado corectamente'
            ], 200);
     
       
    }
}

