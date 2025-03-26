<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vuelo;

class buscadorVueloController extends Controller
{
    /**
     * Muestra el formulario de búsqueda y maneja la lógica de búsqueda.
     */
    public function index(Request $request)
    {
        // Validación de parámetros
        $request->validate([
            'ciudad_origen' => 'required|string|max:255',
            'ciudad_destino' => 'required|string|max:255',
            'fecha_salida' => 'required|date|after_or_equal:today',
        ]);

        // Consulta principal
        $vuelos = Vuelo::with(['aerolinea', 'oferta'])
            ->where('origen', 'LIKE', '%' . $request->ciudad_origen . '%')
            ->where('destino', 'LIKE', '%' . $request->ciudad_destino . '%')
            ->where('fecha', '>=', $request->fecha_salida)
            ->whereDoesntHave('reservas', function($query) {
                $query->where('estado', '!=', 'CANCELADA');
            })
            ->get();

        // Calcular precios con descuento
        foreach ($vuelos as $vuelo) {
            if ($vuelo->oferta && $vuelo->oferta->estado === 'ACTIVA') {
                $descuento = $vuelo->oferta->ProcentajeDescuento;
                $vuelo->precio_con_descuento = $vuelo->precio * (1 - $descuento / 100);
            } else {
                $vuelo->precio_con_descuento = null;
            }
        }

        return view('buscadorVuelo', compact('vuelos'));
    }
}