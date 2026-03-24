<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\AsistenciaController;
use App\Http\Controllers\api\v1\ApoderadoApiController;
use App\Http\Controllers\api\v1\AsistenciahoyApiController;
use App\Http\Controllers\api\Auth\AuthController;



     
   
Route::post('login', [AuthController::class, 'login']);
Route::apiResource('asistencia', AsistenciaController::class);

Route::post('login', [AuthController::class, 'login']);
Route::post('enviarcodigo', [AsistenciaController::class,'enviaarcodigo']);


Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', [AuthController::class, 'userInfo']);

  Route::apiResource('apoderado', ApoderadoApiController::class);
  Route::apiResource('asistenciahoy', AsistenciahoyApiController::class);
   Route::get('calendario/{id}', [AsistenciahoyApiController::class,'calendarioasistencia']);
Route::post('estudiante/foto/{id}', [AsistenciahoyApiController::class,'subirFoto']);


    Route::post('logout', [AuthController::class, 'logout']);
});

