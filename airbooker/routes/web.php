<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    SignUpController,
    UserController,
    AdminController,
    ReservaController,
    VueloController,
    
};

// Defino la ruta principal que muestra la página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');


// Agrupo las rutas relacionadas con la autenticación
Route::controller(SignUpController::class)->group(function () {
    // Defino las rutas para el registro de usuarios
    Route::get('signup', 'showSignUp')->name('signup');
    Route::post('signup', 'signup');
    
    // Defino las rutas para el inicio de sesión
    Route::get('login', 'showLogin')->name('login');
    Route::post('login', 'login');
});

// Agrupo todas las rutas del panel de administración
Route::prefix('admin')->group(function () {
    // Defino las rutas del dashboard administrativo
    Route::controller(AdminController::class)->group(function() {
        Route::get('/', 'dashboard')->name('admin.dashboard');
        Route::get('/dashboard', 'dashboard');
    });
    
    // Defino las rutas para gestión de recursos
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/reservas', [ReservaController::class, 'index']);
    Route::get('/vuelos', [VueloController::class, 'index']);
});