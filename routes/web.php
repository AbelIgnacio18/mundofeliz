<?php

use App\Http\Controllers\AnolectivoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ConceptoController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\IngresoController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\AulaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\AsistenciaestController;
use App\Http\Controllers\EgresoController;
use App\Http\Controllers\CajaController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/home', function () {
    return redirect()->route('app.home');
})->name('home');


Route::group(['prefix' => 'dashboard', 'as' => 'app.', 'middleware' => ['web','auth']], function () {

Route::get('home', [App\Http\Controllers\PanelController::class, 'index'])->name('home');

    Route::get('user', function () {return view('pages.user'); })->name('user');


    Route::get('lista-estudiantes',[App\Http\Controllers\PanelController::class, 'reporte'])->name('reporte');
    Route::get('/reportepdf/{id}',[App\Http\Controllers\PagosController::class, 'reportepdf'])->name('reportepdf');
    Route::get('pdffiltrado',[App\Http\Controllers\EstudianteController::class, 'pdffiltrado'])->name('pdffiltrado');


    Route::resource('/concepto-pago',ConceptoController::class);
    Route::resource('/administracion-aulas',AulaController::class)->names('config-aulas');
    Route::resource('/administracion-contrato',ContratoController::class);
   
    Route::resource('/administracion-anolectivo',AnolectivoController::class)->names('config-lectivo');
    Route::resource('/administracion-caja',CajaController::class)->names('config-caja');
    Route::resource('/estudiantes',EstudianteController::class);
    Route::resource('/docentes',DocenteController::class);
    Route::resource('/personal',PersonalController::class);
    Route::resource('/matriculas',MatriculaController::class);
    Route::resource('/admin-egresos',EgresoController::class);
    Route::resource('/pagos-realizados',PagosController::class);
    Route::resource('/administradores',UsuarioController::class);
    Route::resource('/articulos',ArticuloController::class);
    Route::resource('/ingresos',IngresoController::class);
    Route::resource('/asistencia-docentes',AsistenciaController::class)->names('asistencia');
    
    Route::resource('/asistencia-estudiantes',AsistenciaestController::class)->names('asist-estudiante');
     Route::post('/asistencia-actualizar',[App\Http\Controllers\AsistenciaestController::class, 'control'])->name('cambiarasistencia');
     Route::get('/reporte-asistencia',[App\Http\Controllers\AsistenciaestController::class, 'reporteasistencia'])->name('reporteasistencia');
     Route::get('/reporte-asistencia-docente',[App\Http\Controllers\AsistenciaController::class, 'reporteasistencia'])->name('reporteasistenciadocente');
       Route::get('/reporte-matricula',[App\Http\Controllers\MatriculaController::class, 'reportematricula'])->name('reportematricula');


      Route::get('/asistencia-aula',[App\Http\Controllers\AsistenciaestController::class, 'filtrarasistencia'])->name('asistenciaaula');
       Route::get('/registrar-falta',[App\Http\Controllers\AsistenciaestController::class, 'registrarfalta'])->name('registrarfalta');
       Route::get('/listar-falta',[App\Http\Controllers\AsistenciaestController::class, 'listarfalta'])->name('listarfalta');
    

    Route::get('estudents-list',[App\Http\Controllers\EstudianteController::class, 'exportsexcel'])->name('estudents-list');
    Route::post('estudents-import',[App\Http\Controllers\EstudianteController::class, 'importexcel'])->name('estudents-import');

    Route::get('/reportepago/{id}', [App\Http\Controllers\PagosController::class, 'reportepago'])->name('reportepago');
    Route::group( ['prefix' => 'settings', 'as' => 'setting.'], function () {

    Route::get('my-profile',function () {return view('pages.profile');})->name('my-profile');

    Route::get('change-password',function () {return view('pages.change-password');})->name('change-password');

        }
    );

});


Route::group(['prefix' => 'authentication', 'as' => 'auth.', 'middleware' => 'web'], function () {

    Route::post('logout', function () {
        Illuminate\Support\Facades\Auth::logout();
        return redirect()->route('login');
    })->name('logout');
});

Route::group(['prefix' => 'authentication','middleware' => 'guest'], function () {

Route::get('login', App\Http\Livewire\Authentication\Login\SimpleLoginComponent::class)->name('login');

});
