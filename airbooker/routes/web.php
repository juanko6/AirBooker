<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUpController;

Route::get('/', function () {
    return view('signup');
});

// Ruta para mostrar el formulario de registro
Route::get('signup', [SignUpController::class, 'showSignUpForm'])->name('signup');

// Ruta para procesar el registro
Route::post('signup', [SignUpController::class, 'signup']);