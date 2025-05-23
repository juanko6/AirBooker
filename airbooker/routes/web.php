<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ContactanosController, 
    SignUpController,
    UserController,
    AdminController,
    ReservaController,
    VueloController, 
    ReservaClienteController,
    CarteraController, 
    AerolineaController,
    OfertaController,
    CarritoController,
    FooterController,
}; 
use App\Http\Controllers\Auth\LoginController;

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home'); 
Auth::routes();
 


// Ruta para resultados de búsqueda
Route::get('/buscar-vuelos', [VueloController::class, 'vuelosDisponibles'])->name('buscar.vuelos');

// Rutas para carrito y reservas
Route::prefix('carrito')->controller(CarritoController::class)->group(function () {
    Route::get('/', 'index')->name('carrito.index');
    Route::delete('/eliminar/{id}', 'eliminar')->name('carrito.eliminar');
});



Route::post('/reservar/{vuelo}', [CarritoController::class, 'reservar'])->name('reservar.vuelo');


Route::get('/checkout', function () {return view('checkout');})->name('checkout');

Route::post('/procesar-compra', [CarritoController::class, 'procesarCompra'])->name('procesar.compra');



// Rutas de contactanos
Route::get('/contactanos', [ContactanosController::class, 'showContactanos'])->name('contactanos');
Route::post('/contactanos', [ContactanosController::class, 'enviarFormulario'])->name('contactanos.enviar');

// Rutas de autenticación
Route::prefix('auth')->group(function () {
    Route::get('signup', [SignUpController::class, 'showSignUp'])->name('signup');
    Route::post('signup', [SignUpController::class, 'signup']);
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login.get');
    Route::post('login', [LoginController::class, 'login'])->name('login.post');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout.post');
});

// Rutas del panel de administración
Route::prefix('admin')->group(function () {
    // Dashboard
    Route::controller(AdminController::class)->group(function () {
        Route::get('/', 'dashboard')->name('admin.dashboard');
        Route::get('/dashboard', 'dashboard')->withoutMiddleware('admin'); // Permitir acceso a usuarios no admin
    });

    // Gestión de recursos
    Route::resource('users', UserController::class);
    Route::resource('reservas', ReservaController::class);
    Route::resource('vuelos', VueloController::class);
    Route::resource('aerolineas', AerolineaController::class);
    Route::resource('ofertas', OfertaController::class); 

});

Route::get('/api/usuarios', [UserController::class, 'buscar']);
Route::get('/api/vuelos', [VueloController::class, 'filtrar']);


// Ruta para mostrar el perfil
//Route::get('user/perfil/{id}', [UserController::class, 'show']);

// Ruta para mostrar reservas de un usuario
//Route::get('reservas', [ReservaClienteController::class, 'index']);

// Ruta para mostrar la cartera
//Route::get('user/cartera', [UserController::class, 'infoCartera']); 


Route::prefix('user')->group(function() {
    Route::get('perfil', [UserController::class, 'show']);
    Route::get('reservas', [ReservaClienteController::class, 'index']);
    Route::get('cartera', [UserController::class, 'infoCartera']);
});

// Para manejar la suscripción:
Route::post('/subscribe', [FooterController::class, 'subscribe'])->name('subscribe');