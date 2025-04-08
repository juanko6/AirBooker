<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    // Método para mostrar la vista del carrito
    public function index()
    {
        // Aquí puedes cargar los datos necesarios para la vista del carrito
        return view('carrito');
    }
    // Método para agregar un producto al carrito
    public function agregarAlCarrito(Request $request)
    {
        // Lógica para agregar un producto al carrito
        // Puedes usar sesiones o una base de datos para almacenar el carrito
        // Ejemplo: session()->push('carrito', $producto);
        
        return redirect()->route('carrito')->with('success', 'Producto agregado al carrito.');
    }
}
