<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\VueloController;

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

// Agrupar las rutas bajo /admin
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/reservas', [ReservaController::class, 'index']);
    Route::get('/vuelos', [VueloController::class, 'index']);
    
});

// Ruta para crear el usuario (método POST)
Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
