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
use App\Http\Controllers\PensionController;

use App\Http\Controllers\AulaController;
use App\Http\Controllers\DocenteController;
use App\Http\Controllers\PersonalController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\AsistenciaestController;
use App\Http\Controllers\EgresoController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolPermissionController;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'redirectLogin']);
Route::get('/home', [PageController::class, 'redirectHome'])->name('home');



Route::group(['prefix' => 'dashboard', 'as' => 'app.', 'middleware' => ['web','auth']], function () {

Route::get('home', [App\Http\Controllers\PanelController::class, 'index'])->name('home');
//graficos de barras
    Route::get('/asistencia-nivel', [App\Http\Controllers\PanelController::class, 'asistenciaPorNivel'])
    ->name('asistencia.nivel');
    Route::get('/asistencia-aula-barra', [App\Http\Controllers\PanelController::class, 'asistenciaPorAula']
)->name('asistencia.aula');

    Route::get('user', [PageController::class, 'user'])->name('user');
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
    Route::resource('/pension',PensionController::class);
    Route::resource('/admin-egresos',EgresoController::class);
    Route::resource('/pagos-realizados',PagosController::class);
    Route::get('/pagos-realizados-data', [PagosController::class, 'datatable'])
    ->name('pagos.data');
    Route::resource('/administradores',UsuarioController::class);
     Route::resource('/categoria',CategoriaController::class);
    Route::resource('/articulos',ArticuloController::class);
    Route::resource('/ingresos',IngresoController::class);
    Route::resource('/roles-permission',RolController::class);
    Route::resource('/permission',PermissionController::class);
    
     Route::resource('/roles-permission-union',RolPermissionController::class)->names('unionrolespermission');;
    Route::resource('/asistencia-docentes',AsistenciaController::class)->names('asistencia');
     Route::resource('/calendario-escolar',CalendarioController::class)->names('calendario');
    Route::resource('/docentes-horarios',HorarioController::class)->names('docenteshorarios');

    Route::get('/registrar-falta-docente',[App\Http\Controllers\AsistenciaController::class, 'registrarfalta'])->name('registrarfaltadocente');
    
    Route::resource('/asistencia-estudiantes',AsistenciaestController::class)->names('asist-estudiante');
     Route::post('/asistencia-actualizar',[App\Http\Controllers\AsistenciaestController::class, 'control'])->name('cambiarasistencia');
     Route::get('/reporte-asistencia',[App\Http\Controllers\AsistenciaestController::class, 'reporteasistencia'])->name('reporteasistencia');
     Route::get('/reporte-asistencia-docente',[App\Http\Controllers\AsistenciaController::class, 'reporteasistencia'])->name('reporteasistenciadocente');
     Route::get('/reporte-asistenciadocente-pdf/{id}}',[App\Http\Controllers\AsistenciaController::class, 'asistenciaindividual'])->name('asistenciaindividualdocente');
    Route::get('/reporte-matricula',[App\Http\Controllers\MatriculaController::class, 'reportematricula'])->name('reportematricula');
    Route::put('/asistencia-observacion/{id}',[AsistenciaestController::class, 'ActualizarObservacion'])->name('asist-observacion');
    Route::get('/reporte-asistencia-pdf/{id}}',[App\Http\Controllers\AsistenciaestController::class, 'asistenciaindividual'])->name('asistenciaindividual');
    Route::get('/matricula-aula/{id}',[App\Http\Controllers\MatriculaController::class, 'showaula'])->name('showaula');
      Route::get('/pension-aula/{id}',[App\Http\Controllers\PensionController::class, 'showaula'])->name('pensionaula');
      Route::get('/reporte-pago',[App\Http\Controllers\PagosController::class, 'reportefectivohoy'])->name('reportefectivohoy');
          Route::get('/mostar-concepto-pago/{id}',[App\Http\Controllers\PagosController::class, 'getPagos'])->name('mostrarcomceptospagados');


      Route::get('/asistencia-aula',[App\Http\Controllers\AsistenciaestController::class, 'filtrarasistencia'])->name('asistenciaaula');//esta por eliminR
       Route::get('/registrar-falta',[App\Http\Controllers\AsistenciaestController::class, 'registrarfalta'])->name('registrarfalta');
       Route::get('/listar-falta',[App\Http\Controllers\AsistenciaestController::class, 'listarfalta'])->name('listarfalta');
        Route::get('/vista-asistencia',[App\Http\Controllers\AsistenciaestController::class, 'vistaasistencia'])->name('vistaasistencia');
     Route::get('/ultima-asistencia',[App\Http\Controllers\AsistenciaestController::class, 'ultimaAsistencia'])->name('ultimaasistencia');
    

    Route::get('estudents-list',[App\Http\Controllers\EstudianteController::class, 'exportsexcel'])->name('estudents-list');
    Route::post('estudents-import',[App\Http\Controllers\EstudianteController::class, 'importexcel'])->name('estudents-import');
Route::get('/descargar-plantilla', [EstudianteController::class, 'descargarPlantilla'])
    ->name('estudiantes.plantilla');
    Route::get('/reportepago/{id}', [App\Http\Controllers\PagosController::class, 'reportepago'])->name('reportepago');

    Route::group( ['prefix' => 'settings', 'as' => 'setting.'], function () {

    Route::get('my-profile', [PageController::class, 'profile'])->name('my-profile');
    Route::get('change-password', [PageController::class, 'changePassword'])->name('change-password');



        }
    );

});


Route::group(['prefix' => 'authentication', 'as' => 'auth.', 'middleware' => 'web'], function () {

Route::post('logout', [PageController::class, 'logout'])->name('logout');
});

Route::group(['prefix' => 'authentication','middleware' => 'guest'], function () {

Route::get('login', App\Http\Livewire\Authentication\Login\SimpleLoginComponent::class)->name('login');

});
