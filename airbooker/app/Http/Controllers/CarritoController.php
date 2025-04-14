<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Carrito;
use App\Models\Vuelo;
use App\Models\Reserva;

use Illuminate\Support\Facades\Auth;
use App\Models\CarritoItem;

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
        $carrito = $user->carrito ?? $user->carrito()->crear();

        // Verificar si el vuelo ya está en el carrito
        if ($carrito->items()->where('vuelo_id', $vuelo->id)->exists()) {
            return back()->withErrors(['message' => 'Este vuelo ya está en tu carrito.']);
        }

        // Crear un nuevo CarritoItem
        $carrito->items()->create([
            'vuelo_id' => $vuelo->id,
            'cantidad' => 1,
            'precio_unitario' => $vuelo->getPrecio(),

        ]);

        // Redirigir al usuario a la página del carrito con mensaje de éxito
        return redirect()->route('carrito.index')->with('success', 'Vuelo agregado al carrito.');
    } 

    /**
     * Elimina un item del carrito del usuario autenticado.
     */
    public function eliminar($id)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Verificar si el usuario está autenticado
        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'Debes iniciar sesión para realizar esta acción.']);
        }

        // Buscar el CarritoItem por su ID
        $item = CarritoItem::find($id);

        // Verificar si el item existe
        if (!$item) {
            return back()->withErrors(['message' => 'El item no existe.']);
        }

        // Verificar si el item pertenece al carrito del usuario
        if ($item->carrito->user_id !== $user->id) {
            return back()->withErrors(['message' => 'No tienes permiso para eliminar este item.']);
        }

        // Eliminar el item
        $item->eliminar();

        // Redirigir con mensaje de éxito
        return back()->with('success', 'Item eliminado del carrito.');
    }



    /**
     * Procesar el compra del carrito.
     */
    public function procesarCompra(Request $request)
    {
        // Verificar autenticación
        $user = $this->verificarAutenticacion();

        // Verificar si el usuario es un cliente
        if ($user->rol !== 'Cliente') {
            return back()->withErrors(['message' => 'Solo los clientes pueden realizar compras.']);
        }

        // Obtener el carrito del usuario
        $carrito = $user->carrito()->with('items.vuelo.oferta')->first();

        // Verificar si el carrito existe y tiene items
        if (!$carrito || $carrito->items->isEmpty()) {
            return back()->withErrors(['message' => 'Tu carrito está vacío. Agrega vuelos para continuar.']);
        }


        // Calcular el total a pagar (incluyendo descuentos)
                // Calcular el total a pagar
        $total = $carrito->calcularTotal();
         
        // Verificar si el usuario tiene suficiente crédito
        if ($user->actualizarSaldo($total)) {
            // Realizar la compra 
            foreach ($carrito->items as $item) {
                Reserva::crearReserva($user->id, $item->vuelo_id, $item->precio_unitario);
            }            
        }else{
            return back()->withErrors(['message' => 'Saldo insuficiente. Por favor, recarga tu saldo en Perfil -> Cartera.']);
        }
            
        
        // Vaciar el carrito
        $carrito->items()->delete();

        // Redirigir a la vista de checkout
        return redirect()->route('checkout')->with('success', 'Compra realizada con éxito.');

    }
}