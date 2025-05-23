<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        $aerolineas = Aerolinea::all();
        $ofertas = Oferta::all();
        $vuelos = Vuelo::with('aerolinea', 'oferta')->paginate(10);
        
        
        return view('admin.vuelos', compact('vuelos', 'aerolineas', 'ofertas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $aerolineas = Aerolinea::all();
        return view('admin.vuelos.create', compact('aerolineas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'origen' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/u|max:255',
            'destino' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/u|max:255',

            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'precio' => 'required|numeric|min:0',
            'aerolinea_id' => 'required|exists:aerolineas,id',
            'oferta_id' => 'nullable|exists:ofertas,id',
        ]);

        Vuelo::create($request->only([
            'origen', 'destino', 'fecha', 'hora', 'precio', 'aerolinea_id', 'oferta_id'
        ]));

        return back()->with('success', 'Vuelo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vuelo = Vuelo::with(['aerolinea', 'oferta'])->findOrFail($id);
        return view('admin.vuelos.show', compact('vuelo'));
    }

    public function edit($id)
    {
        $vuelo = Vuelo::findOrFail($id);
        return response()->json($vuelo);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'origen' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/u|max:255',
            'destino' => 'required|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑüÜ\s]+$/u|max:255',

            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'precio' => 'required|numeric|min:0',
            'aerolinea_id' => 'required|exists:aerolineas,id',
            'oferta_id' => 'nullable|exists:ofertas,id',
        ]);

        $vuelo = Vuelo::findOrFail($id);
        $vuelo->update($request->only([
            'origen', 'destino', 'fecha', 'hora', 'precio', 'aerolinea_id', 'oferta_id'
        ]));

        return back()->with('success', 'Vuelo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vuelo = Vuelo::findOrFail($id);
        $vuelo->delete();

        return back()->with('success', 'Vuelo eliminado exitosamente.');
    }

    /**
     * Mostrar vuelos disponibles con filtros
     */

    public function vuelosDisponibles(Request $request)
    {
        // Validación
        $validated = $request->validate([
            'aerolinea' => 'nullable|array',
            'aerolinea.*' => 'string|exists:aerolineas,nombre',
            'origen' => 'nullable|string|max:255',
            'destino' => 'nullable|string|max:255',
            'fecha' => 'nullable|date|after_or_equal:today',
        ]);

        // Inicializar parámetros
        $filtros = [
            'origen' => $request->input('origen', ''),
            'destino' => $request->input('destino', ''),
            'fecha' => $request->input('fecha', now()->format('Y-m-d')),
            'aerolinea' => $request->input('aerolinea', []),
            'precio_min' => $request->input('precio_min'),
            'precio_max' => $request->input('precio_max'),
            'mostrar_ofertas' => $request->has('mostrar_ofertas'),
            'ordenar_por_precio' => $request->input('ordenar_por_precio'),
        ];

        
        // Consulta con paginación
        $vuelos = Vuelo::filtrarDisponibles($filtros)
            ->paginate(10)
            ->appends($filtros);

        // Obtener aerolíneas para el filtro lateral
        $aerolineas = Aerolinea::all();

         return view('vuelosDisponibles', compact('vuelos', 'filtros', 'aerolineas'));
    }

    public function filtrar(Request $request)
        {
            $validated = $request->validate([
                'fecha' => 'required|date',
                // Otros filtros si los necesitas
            ]);

            $vuelos = Vuelo::whereDate('fecha', $request->fecha)->get(); // Consulta de vuelos por fecha

            $noVuelos = $vuelos->isEmpty();
            
            return response()->json([
                'vuelos' => $vuelos,
                'no_vuelos' => $noVuelos // Agregar el estado de si no hay vuelos
            ]); 
        }

}