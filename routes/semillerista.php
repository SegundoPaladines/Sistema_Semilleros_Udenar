<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Semillerista\SemilleristaController;

//actualizar datos
Route::get('/actualizar_datos_semillerista', [SemilleristaController::class, 'vistaActualizarDatos'])->name('vista_actualizar_datos_semillerista');
Route::post('/actualizar_datos_semillerista', [SemilleristaController::class, 'actualizarDatos'])->name('actualizar_datos_semillerista');

//rutas de usuarios
Route::get('/proyectos', [SemilleristaController::class,'listarProyectos'])->name('proyectos_sem');