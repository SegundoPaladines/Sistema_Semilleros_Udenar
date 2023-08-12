<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

//rutas de usuarios
Route::get('/usuarios', [AdminController::class,'listarUsuarios'])->name('usuarios');
//registrar
Route::get('/vista/registrar-usuarios', [AdminController::class,'vistaRegUsuarios'])->name('v_reg_usr');
Route::post('/vista/registrar-usuarios', [AdminController::class,'registrarUsuario'])->name('registar_usuario');
//editar
Route::get('/vista/editar-usuarios/{id}', [AdminController::class,'vistaEditUsuarios'])->name('edit_usr');
Route::post('/vista/editar-usuarios/{id}', [AdminController::class,'editUsuarios'])->name('editar_usr');

//eliminar
Route::get('/eliminar-usuarios/{id}', [AdminController::class,'eliminarUsuario'])->name('delete_usr');
Route::get('/eliminar-usuario/{id}', [AdminController::class,'eliminarUsuarioConfirmado'])->name('eliminar_confirmado');

//rutas de usuarios
Route::get('/proyectos', [AdminController::class,'listarProyectos'])->name('proyectos');

//Agregar
Route::get('/vista/agregar-proyectos', [AdminController::class,'vistaAgrProyectos'])->name('vista_agr_proy');
Route::post('/vista/agregar-proyectos', [AdminController::class,'agregarProyecto'])->name('agregar_proyecto');

//Editar
Route::get('vista/editar_proyectos/{id}', [AdminController::class, 'vistaEditProyectos'])->name('edit_proyectos');
Route::post('vista/editar_proyectos/{id}', [AdminController::class, 'editarProyectos'])->name('editar_proyecto');

//Eliminar
Route::get('/eliminar_proyectos/{id}', [AdminController::class, 'eliminarProyecto'])->name('eliminar_proyecto');
Route::get('/eliminar_proyecto/{id}', [AdminController::class, 'confirmacionEliminacionProyecto']);