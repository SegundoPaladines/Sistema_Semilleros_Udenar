<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Coordinador\CoordinadorController;

Route::get('', [CoordinadorController::class, 'index'])->name("coordinador.home");
Route::get('vista/editar_semillero/{id}', [CoordinadorController::class, 'editarSemillero'])->name('vista_editar_semillero');
Route::post('vista/actualizar_semillero/{id}', [CoordinadorController::class, 'actualizarSemillero'])->name('actualizar_semilleroC');
Route::get('/semillero/semilleristas', [CoordinadorController::class, 'verSemilleristas'])->name('listado_Semilleristas');
Route::get('/desvincular_sem_sem/{num_identificacion}', [CoordinadorController::class, 'desvincularSemillero'])->name('desvincular_sem_sem');

//rutas de usuarios
Route::get('/proyectos', [CoordinadorController::class,'listarProyectos'])->name('proyectos');

//Agregar
Route::get('/vista/agregar-proyectos', [CoordinadorController::class,'vistaAgrProyectos'])->name('vista_agr_proy');
Route::post('/vista/agregar-proyectos', [CoordinadorController::class,'agregarProyecto'])->name('agregar_proyecto');

//Editar
Route::get('/vista/editar_proyectos/{id}', [CoordinadorController::class, 'vistaEditProyectos'])->name('edit_proyectos');
Route::post('/vista/editar_proyectos/{id}', [CoordinadorController::class, 'editarProyectos'])->name('editar_proyecto');

//Eliminar
Route::get('/eliminar_proyectos/{id}', [CoordinadorController::class, 'eliminarProyecto'])->name('eliminar_proyecto');
Route::get('/eliminar_proyecto/{id}', [CoordinadorController::class, 'confirmacionEliminacionProyecto']);