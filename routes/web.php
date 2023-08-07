<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//rutas sin autenticacion

Route::get('/', [HomeController::class,'welcome'])
    ->name('welcome');

Route::get('/login', [HomeController::class,'login'])
    ->middleware(['guest'])
    ->name('login');

// rutas con autenticacion

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/register', [HomeController::class, 'registarUsuarios'])->name('register');
    Route::post('/register', [HomeController::class, 'postUsuarios'])->name('register');
    Route::get('/home', [HomeController::class,'index'])->name('home');
    Route::get('/perfil', [HomeController::class, 'perfil'])->name('perfil');
    Route::post('/perfil', [HomeController::class, 'actualizarPerfil'])->name('actualizar_perfil');
    Route::get('/cambiar_contrasena', [HomeController::class, 'actualizarContrasena'])->name('cambiar-contrasena');
    Route::post('/cambiar_contrasena', [HomeController::class, 'cambiarContrasena'])->name('cambio-contrasena');
    Route::get('/eventos', [HomeController::class, 'listarEventos'])->name('listar_eventos');

    //Route::get('/cambiar_contrasena', [HomeController::class, 'contrasena'])-name('contrasena');
});