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
    BuscadorVueloController,
    ContactanosController
};

// Rutas públicas
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

// Rutas del panel de administración
Route::prefix('admin')->group(function () {
    // Dashboard
    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'dashboard')->name('admin.dashboard');
        Route::get('/dashboard', 'dashboard')->withoutMiddleware('admin'); // Permitir acceso a usuarios no admin
    });

    // Gestión de recursos
    Route::resource('users', UserController::class)->except(['create', 'show']);
    Route::resource('reservas', ReservaController::class)->except(['create', 'show']);
    Route::resource('vuelos', VueloController::class)->only(['index']);

    Route::get('/reservas/{id}/edit', [ReservaController::class, 'edit'])->name('reservas.edit');
    Route::put('/reservas/{id}', [ReservaController::class, 'update'])->name('reservas.update');
});

Route::get('/api/usuarios', [UserController::class, 'buscar']);
Route::get('/api/vuelos', [VueloController::class, 'filtrar']);

