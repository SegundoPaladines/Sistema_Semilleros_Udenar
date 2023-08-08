<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Coordinador\CoordinadorController;

Route::get('', [CoordinadorController::class, 'index'])->name("coordinador.home");
Route::get('vista/editar_semillero/{id}', [CoordinadorController::class, 'editarSemillero'])->name('editar_semillero');
Route::post('vista/actualizar_semillero/{id}', [CoordinadorController::class, 'actualizarSemillero'])->name('actualizar_semilleroC');