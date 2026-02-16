<?php

namespace App\Http\Controllers\api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Apoderado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
   
 public function login(Request $request) {
    $request->validate([
        'dni' => 'required',
        'password' => 'required',
        'device_name' => 'required',
         'fcm_token' => 'nullable|string'
       // 'fcm_token' => 'required' 
        
    ]);

    $user = Apoderado::where('dni', $request->dni)->first();

    // 1. Verificamos si el usuario existe y la contraseña es correcta
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Credenciales incorrectas'
        ], 401); // Error de autenticación
    }

    // 2. Actualizamos el Token de Firebase (FCM)
    // $user->update([
    //     'fcm_token' => $request->fcm_token,
    // ]);
    if ($request->filled('fcm_token')) {
    $user->update([
        'fcm_token' => $request->fcm_token,
    ]);
}

    // 3. Generamos el Token de Sanctum (Acceso API)
    // Opcional: Eliminar tokens antiguos para que solo haya una sesión activa
    $user->tokens()->delete(); 
    
    $token = $user->createToken($request->device_name)->plainTextToken;

    // 4. Retornamos la respuesta exitosa
    return response()->json([
        'token' => $token,
        'user'  => $user
    ], 200);
}

public function userInfo(Request $request)
{
     $user = \App\Models\Apoderado::with('estudiantes')
        ->find($request->user()->id);

    return response()->json([
        'status' => 'success',
        'type_token' => 'Bearer',
        'user' => $user,
    ]);
}

public function logout(Request $request)
{
    $user = $request->user();

    if (!$user) {
        return response()->json(['message' => 'No autenticado'], 401);
    }

    $user->update(['fcm_token' => null]);

    // Elimina SOLO el token actual
    $request->user()->currentAccessToken()->delete();

    return response()->json([
        'message' => 'Sesión cerrada correctamente'
    ]);
}

 
}

