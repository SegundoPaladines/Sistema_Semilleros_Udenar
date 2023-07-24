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

//perfiles
Route::get('/perfil/{id}', [AdminController::class, 'perfil'])->name('perfiles');
Route::post('/perfil/{id}', [AdminController::class, 'actualizarPerfil'])->name('actualizar_perfiles');

//semilleros
Route::get('/semilleros', [AdminController::class, 'listarSemilleros'])->name('listar_semilleros');

//agregar semilerros
Route::get('/agregar_semilleros', [AdminController::class, 'agregarSemilleros'])->name('agregar_semilleros');
Route::post('/agregar_semillero', [AdminController::class, 'agregarSemillero'])->name('agregar_semillero');

//actualizar semilleros
Route::get('/actualizar_semillero/{id}', [AdminController::class, 'vistaActualizarSemillero'])->name('vista_actualizar_semillero');
Route::post('/actualizar_semillero/{id}', [AdminController::class, 'actualizarSemillero'])->name('actualizar_semillero');

//eliminar semilleros
Route::get('/eliminar-semilleros/{id}', [AdminController::class,'eliminarSemillero'])->name('delete_sem');
Route::get('/eliminar-semillero/{id}', [AdminController::class,'eliminarSemilleroConfirmado'])->name('eliminar_sem_confirmado');

//ver participantes de un semillero
Route::get('/participantes-semillero/{id}', [AdminController::class,'vistaParticipantes'])->name('participantes_semillero');