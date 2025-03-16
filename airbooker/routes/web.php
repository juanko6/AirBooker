<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUpController;

//Para poder ir viendo las vistas
Route::get('/', function () {
    return view('login');
});

// Ruta para mostrar el formulario de registro
Route::get('signup', [SignUpController::class, 'showSignUp'])->name('signup');

// Ruta para procesar el registro
Route::post('signup', [SignUpController::class, 'signup']);

// Ruta para mostrar el formulario de inicio de sesión
Route::get('login', [SignUpController::class, 'showLogin'])->name('login');

// Ruta para procesar el inicio de sesión
Route::post('login', [SignUpController::class, 'login']);