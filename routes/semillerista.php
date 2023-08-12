<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Semillerista\SemilleristaController;

//rutas de usuarios
Route::get('/proyectos', [SemilleristaController::class,'listarProyectos'])->name('proyectos');