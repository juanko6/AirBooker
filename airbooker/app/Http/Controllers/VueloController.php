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

    public function vuelosDisponibles(Request $request)
    {
        // Parámetros de búsqueda
        $origen = $request->input('origen');
        $destino = $request->input('destino');
        $fecha = $request->input('fecha');
        $aerolinea = $request->input('aerolinea');
        $precioMin = $request->input('precio_min');
        $precioMax = $request->input('precio_max');

        // Consulta base
        $query = Vuelo::query()
            ->select('vuelos.*', 'aerolineas.nombre as aerolinea_nombre')
            ->selectRaw('
                CASE 
                    WHEN ofertas.id IS NOT NULL THEN 
                        FORMAT(vuelos.precio * (1 - ofertas.ProcentajeDescuento/100), 2)
                    ELSE 
                        FORMAT(vuelos.precio, 2)
                END as precio_final
            ')
            ->join('aerolineas', 'vuelos.aerolinea_id', '=', 'aerolineas.id')
            ->leftJoin('ofertas', 'vuelos.oferta_id', '=', 'ofertas.id');

        // Filtros básicos
        if ($origen) $query->where('vuelos.origen', $origen);
        if ($destino) $query->where('vuelos.destino', $destino);
        if ($fecha) $query->where('vuelos.fecha', $fecha);

        // Filtros avanzados
        if ($aerolinea) $query->where('aerolineas.nombre', $aerolinea);
        if ($precioMin && $precioMax) {
            $query->whereBetween('vuelos.precio', [$precioMin, $precioMax]);
        }

        // Obtener resultados
        $vuelos = $query->get();
        $aerolineas = Aerolinea::all();

        return view('vuelosDisponibles', [
            'vuelos' => $vuelos,
            'aerolineas' => $aerolineas,
            'filtros' => [
                'origen' => $origen,
                'destino' => $destino,
                'fecha' => $fecha,
                'aerolinea' => $aerolinea,
                'precioMin' => $precioMin,
                'precioMax' => $precioMax
            ]
        ]);
    }
}