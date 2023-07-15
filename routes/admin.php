<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

Route::get('/register', [AdminController::class,'registrarUsuarios'])->name('register');