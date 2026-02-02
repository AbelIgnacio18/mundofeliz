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
        'fcm_token' => 'required' 
    ]);

    $user = Apoderado::where('dni', $request->dni)->first();

    // 1. Verificamos si el usuario existe y la contraseña es correcta
    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json([
            'message' => 'Credenciales incorrectas'
        ], 401); // Error de autenticación
    }

    // 2. Actualizamos el Token de Firebase (FCM)
    $user->update([
        'fcm_token' => $request->fcm_token,
    ]);

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
    $user = $request->user();

    if ($user) {
        // 1. Limpiamos el token de Firebase para que no lleguen alertas a este equipo
        $user->fcm_token = null;
        $user->save();

        // 2. Eliminamos TODOS los tokens de Sanctum (Cierra sesión en todos los dispositivos)
        // Si solo quieres cerrar en el actual: $user->currentAccessToken()->delete();
        $user->tokens()->delete();

        return response()->json([
            'message' => 'Sesión cerrada correctamente y notificaciones desactivadas'
        ], 200);
    }

    return response()->json(['message' => 'No hay una sesión activa'], 401);
}
 
}

