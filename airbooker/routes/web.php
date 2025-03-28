<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    HomeController,
    ContactanosController,
    LoginController,
    SignUpController,
    UserController,
    AdminController,
    ReservaController,
    VueloController, 
    ReservaClienteController,
    CarteraController,
    VuelosDisponiblesController,
    AerolineaController,
    OfertaController,
};

/*
Que hace ->name('') ?  Si en el futuro cambias la URL de /buscar-vuelos a /vuelos-disponibles, 
solo necesitas actualizar la definición de la ruta en web.php. Todas las 
referencias usando route('buscador.vuelos') seguirán funcionando correctamente.
*/

// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');


// Nueva ruta para resultados de búsqueda
Route::get('/vuelos-disponibles', [VueloController::class, 'vuelosDisponibles']) ->name('vuelos.disponibles');


// Rutas del buscador de vuelos
Route::get('/buscar-vuelos', [BuscadorVueloController::class, 'BuscarVuelos'])->name('buscador.vuelos');
Route::post('/buscar-vuelos', [BuscadorVueloController::class, 'BuscarVuelos']);

// Rutas de contactanos
Route::get('/contactanos', [ContactanosController::class, 'showContactanos'])->name('contactanos');

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
    Route::resource('users', UserController::class);
    Route::resource('reservas', ReservaController::class);
    Route::resource('vuelos', VueloController::class);
    Route::resource('aerolineas', AerolineaController::class);
    Route::resource('ofertas', OfertaController::class);

    Route::get('/reservas/{id}/edit', [ReservaController::class, 'edit'])->name('reservas.edit');
    Route::put('/reservas/{id}', [ReservaController::class, 'update'])->name('reservas.update');

    Route::get('/aerolineas/{aerolinea}/edit', [AerolineaController::class, 'edit']);

    Route::get('/ofertas/{oferta}/edit', [OfertaController::class, 'edit'])->name('ofertas.edit');



});

Route::get('/api/usuarios', [UserController::class, 'buscar']);
Route::get('/api/vuelos', [VueloController::class, 'filtrar']);

// Ruta para mostrar el perfil
Route::get('perfil/{id}', [UserController::class, 'show']);

// Ruta para mostrar reservas de un usuario
Route::get('reservas', [ReservaClienteController::class, 'index']);

// Ruta para mostrar la cartera
Route::get('cartera', [CarteraController::class, 'index']);