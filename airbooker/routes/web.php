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
    
};

// Defino la ruta principal que muestra la página de inicio
Route::get('/', [HomeController::class, 'index'])->name('home');


 // Ruta para mostrar el formulario de registro
Route::get('signup', [SignUpController::class, 'showSignUp'])->name('signup');

// Ruta para procesar el registro
Route::post('signup', [SignUpController::class, 'signup']);

// Ruta para mostrar el formulario de inicio de sesión
Route::get('login', [LoginController::class, 'showLogin'])->name('login');

// Ruta para procesar el inicio de sesión
Route::post('login', [LoginController::class, 'login']);


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

// Ruta para crear el usuario (método POST)
Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');

// Ruta para mostrar el formulario de edición
Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');

// Ruta para actualizar el usuario
Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('users.update');

Route::get('users/{id}/edit', [UserController::class, 'edit']);

Route::delete('admin/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');



