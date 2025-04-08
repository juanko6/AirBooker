<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Carrito;
use App\Models\Vuelo;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    /**
     * Muestra el contenido del carrito del usuario autenticado.
     */
    /**
     * Verifica si el usuario está autenticado y redirige si no lo está.
     */
    private function verificarAutenticacion()
    {
        $user = Auth::user();

        if (!$user) {
            redirect()->route('login')->withErrors(['message' => 'Debes iniciar sesión para realizar esta acción.'])->send();
            exit;
        }

        return $user;
    }

    /**
     * Muestra el contenido del carrito del usuario autenticado.
     */
    public function index()
    {
        // Verificar autenticación
        $user = $this->verificarAutenticacion();

        // Obtener el carrito del usuario con sus items y vuelos asociados
        $carrito = $user->carrito()->with('items.vuelo.aerolinea')->first();

        // Si no hay carrito o está vacío, redirigir o mostrar mensaje
        if (!$carrito || $carrito->items->isEmpty()) {
            return view('carrito', ['carrito' => null]);
        }

        // Pasar el carrito a la vista
        return view('carrito', ['carrito' => $carrito]);
    }

    /**
     * Agrega un vuelo al carrito del usuario autenticado.
     */
    public function reservar(Vuelo $vuelo)
    {
        // Verificar autenticación
        $user = $this->verificarAutenticacion();

        // Obtener o crear el carrito del usuario
        $carrito = $user->carrito ?? $user->carrito()->create();

        // Verificar si el vuelo ya está en el carrito
        if ($carrito->items()->where('vuelo_id', $vuelo->id)->exists()) {
            return back()->withErrors(['message' => 'Este vuelo ya está en tu carrito.']);
        }

        // Crear un nuevo CarritoItem
        $carrito->items()->create([
            'vuelo_id' => $vuelo->id,
            'cantidad' => 1,
            'precio_unitario' => $vuelo->precio_final,
        ]);

        // Redirigir con mensaje de éxito
        return back()->with('success', 'Vuelo agregado al carrito.');
    }




}