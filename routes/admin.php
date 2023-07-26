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
Route::get('/agregar_semilleros', [AdminController::class, 'agregarSemilleros'])->name('agregar_semilleros');

//eventos
Route::get('/eventos', [AdminController::class, 'listarEventos'])->name('listar_eventos');

Route::get('vista/registrar_eventos', [AdminController::class, 'vistaRegEventos'])->name('vista_reg_eventos');
Route::post('vista/registrar_eventos', [AdminController::class, 'registrarEventos'])->name('registrar_evento');

Route::get('vista/editar_eventos/{id}', [AdminController::class, 'vistaEditEventos'])->name('edit_eventos');
Route::post('vista/editar_eventos/{id}', [AdminController::class, 'editarEventos'])->name('editar_evento');

Route::get('/eliminar_eventos/{id}', [AdminController::class, 'eliminarEvento'])->name('eliminar_evento');
Route::get('/eliminar_evento/{id}', [AdminController::class, 'confirmacionEliminacionEvento']);