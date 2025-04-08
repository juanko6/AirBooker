<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Carrito;
use Illuminate\Support\Facades\Auth;

class CarritoController extends Controller
{
    /**
     * Muestra el contenido del carrito del usuario autenticado.
     */
    public function index()
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

         // Verificar si el usuario está autenticado
        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'Debes iniciar sesión para ver el carrito.']);
        }
        

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
    public function agregarVuelo(Request $request, $vueloId)
    {
        // Validar la cantidad
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        // Obtener el usuario autenticado
        $user = Auth::user();

        // Obtener o crear el carrito del usuario
        $carrito = $user->carrito()->firstOrCreate([]);

        // Agregar el vuelo al carrito
        $carrito->items()->create([
            'vuelo_id' => $vueloId,
            'cantidad' => $request->input('cantidad'),
            'precio_unitario' => 100, // Aquí deberías obtener el precio real del vuelo
        ]);

        return redirect()->route('carrito.index')->with('success', 'Vuelo agregado al carrito.');
    }
}