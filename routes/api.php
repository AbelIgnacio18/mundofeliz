<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\AsistenciaController;

use App\Http\Controllers\api\Auth\AuthController;



     
     Route::post('login', [AuthController::class, 'login'] );
     Route::apiResource('asistencia',AsistenciaController::class);
     


     Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    // Route::middleware('auth:sanctum')->get('asistencia/{id}',[AsistenciaController::class, 'show']);


    Route::post('logout', [AuthController::class, 'logout'] )->middleware('auth:sanctum');



