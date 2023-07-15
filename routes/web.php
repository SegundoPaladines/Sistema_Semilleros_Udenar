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
    Route::get('/register', [HomeController::class, 'registarUsuarios']);
    Route::get('/home', [HomeController::class,'index'])->name('home');
});