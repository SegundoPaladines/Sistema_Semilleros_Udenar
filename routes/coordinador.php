<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Coordinador\CoordinadorController;

Route::get('', [CoordinadorController::class, 'index'])->name("coordinador.home");
Route::get('vista/editar_semillero/{id}', [CoordinadorController::class, 'editarSemillero'])->name('vista_editar_semillero');
Route::post('vista/actualizar_semillero/{id}', [CoordinadorController::class, 'actualizarSemillero'])->name('actualizar_semilleroC');
Route::get('/semilleristas', [CoordinadorController::class, 'verSemilleristas'])->name('listado_Semilleristas');
Route::get('/desvincular_sem_sem/{num_identificacion}', [CoordinadorController::class, 'desvincularSemillero'])->name('desvincular_sem_sem');