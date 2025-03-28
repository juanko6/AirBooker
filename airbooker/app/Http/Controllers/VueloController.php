<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Vuelo;
use App\Models\Aerolinea;
use App\Models\Oferta;

class VueloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vuelos = Vuelo::with('oferta')->paginate(10);
        return view('admin.vuelos', compact('vuelos'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Filtrar vuelos por fecha
     */
    /**
     * Filtrar vuelos por fecha
     */
    public function filtrar(Request $request)
    {
        $fecha = $request->query('fecha');
        $vuelos = Vuelo::whereDate('fecha', $fecha)->get();
        return response()->json($vuelos);
    }

    /**
     * Buscar vuelos por origen y destino y fecha
     */
    public function buscarVuelos(Request $request)
    {
        // Validación de parámetros
        $request->validate([
            'ciudad_origen' => 'required|string|max:255',
            'ciudad_destino' => 'required|string|max:255',
            'fecha_salida' => 'required|date|after_or_equal:today',
        ]);

        // Consulta de vuelos (similar a la anterior pero optimizada)
        $vuelos = Vuelo::with(['aerolinea', 'oferta'])
            ->where('origen', 'LIKE', '%' . $request->ciudad_origen . '%')
            ->where('destino', 'LIKE', '%' . $request->ciudad_destino . '%')
            ->where('fecha', '>=', $request->fecha_salida)
            ->whereDoesntHave('reservas', function($q) {
                $q->where('estado', '!=', 'CANCELADA');
            })
            ->paginate(10); // Paginación

        // Calcular precios con descuento
        foreach ($vuelos as $vuelo) {
            
            $vuelo->precio_con_descuento = $vuelo->getPrecioConDescuento();
        }
   

        // Mantener parámetros de búsqueda en la vista
        $busqueda = [
            'ciudad_origen' => $request->ciudad_origen,
            'ciudad_destino' => $request->ciudad_destino,
            'fecha_salida' => $request->fecha_salida,
        ];

        return view('vuelosDisponibles', compact('vuelos', 'busqueda'));         
    }    

    /**
     * Método para mostrar los vuelos disponibles
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function vuelosDisponibles(Request $request)
    {
        // Validación de parámetros
        $request->validate([
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'fecha' => 'required|date|after_or_equal:today',
        ]);

        // Parámetros de búsqueda
        $origen = $request->input('origen');
        $destino = $request->input('destino');
        $fecha = $request->input('fecha');
        $aerolinea = $request->input('aerolinea');
        $precioMin = $request->input('precio_min');
        $precioMax = $request->input('precio_max');

        // Consulta base
        $query = Vuelo::with(['aerolinea', 'oferta'])
            ->where('origen', 'LIKE', '%' . $origen . '%')
            ->where('destino', 'LIKE', '%' . $destino . '%')
            ->where('fecha', '>=', $fecha)
            ->whereDoesntHave('reservas', function ($q) {
                $q->where('estado', '!=', 'CANCELADA');
            });

        // Filtros avanzados
        if ($aerolinea) {
            $query->whereHas('aerolinea', function ($q) use ($aerolinea) {
                $q->where('nombre', 'LIKE', '%' . $aerolinea . '%');
            });
        }

        if ($precioMin && $precioMax) {
            $query->whereBetween('precio', [$precioMin, $precioMax]);
        }

        // Paginación
        $vuelos = $query->paginate(10);

        // Calcular precios con descuento
        foreach ($vuelos as $vuelo) {
            $vuelo->precio_con_descuento = $vuelo->getPrecioConDescuento();
        }

        // Mantener parámetros de búsqueda en la vista
        $filtros = [
            'origen' => $origen,
            'destino' => $destino,
            'fecha' => $fecha,
            'aerolinea' => $aerolinea,
            'precio_min' => $precioMin,
            'precio_max' => $precioMax,
        ];

        // Obtener aerolíneas para el filtro lateral
        $aerolineas = Aerolinea::all();

        return view('vuelosDisponibles', compact('vuelos', 'filtros', 'aerolineas'));
    }
}