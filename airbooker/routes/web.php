<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    LoginController,
    SignUpController,
    UserController,
    AdminController,
    ReservaController,
    VueloController, 
    VuelosDisponiblesController,
};

/*
Que hace ->name('') ?  Si en el futuro cambias la URL de /buscar-vuelos a /vuelos-disponibles, 
solo necesitas actualizar la definición de la ruta en web.php. Todas las 
referencias usando route('buscador.vuelos') seguirán funcionando correctamente.
*/

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');


 

// Nueva ruta para resultados de búsqueda
Route::get('/vuelos-disponibles', [VuelosDisponiblesController::class, 'VuelosDisponibles'])
    ->name('vuelos.disponibles');


// Rutas de autenticación
Route::prefix('auth')->group(function () {
    Route::get('signup', [SignUpController::class, 'showSignUp'])->name('signup');
    Route::post('signup', [SignUpController::class, 'signup']);
    Route::get('login', [LoginController::class, 'showLogin'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

// Rutas del panel de administración
Route::prefix('admin')->group(function () {
    // Dashboard
    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'dashboard')->name('admin.dashboard');
        Route::get('/dashboard', 'dashboard')->withoutMiddleware('admin'); // Permitir acceso a usuarios no admin
    });

    // Gestión de recursos
    Route::resource('users', UserController::class)->except(['create', 'show']);
    Route::resource('reservas', ReservaController::class)->only(['index']);
    Route::resource('vuelos', VueloController::class)->only(['index']);
});