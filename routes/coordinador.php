<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Coordinador\CoordinadorController;

Route::get('', [CoordinadorController::class, 'index'])->name("coordinador.home");