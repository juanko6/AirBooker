<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Vuelo;
use App\Models\Aerolinea;

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
        // Obtener aerolíneas para el formulario de creación
        $aerolineas = Aerolinea::all();
        return view('admin.vuelos.create', compact('aerolineas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validator = Validator::make($request->all(), [
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'precio' => 'required|numeric|min:0',
            'aerolinea_id' => 'required|exists:aerolineas,id',
            'oferta_id' => 'nullable|exists:ofertas,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Crear el nuevo vuelo
        Vuelo::create([
            'origen' => $request->origen,
            'destino' => $request->destino,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'precio' => $request->precio,
            'aerolinea_id' => $request->aerolinea_id,
            'oferta_id' => $request->oferta_id,
        ]);

        return redirect()->route('admin.vuelos.index')
            ->with('success', 'Vuelo creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Obtener el vuelo con sus relaciones
        $vuelo = Vuelo::with(['aerolinea', 'oferta'])->findOrFail($id);
        return view('admin.vuelos.show', compact('vuelo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Obtener el vuelo y las aerolíneas para el formulario de edición
        $vuelo = Vuelo::findOrFail($id);
        $aerolineas = Aerolinea::all();
        return view('admin.vuelos.edit', compact('vuelo', 'aerolineas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validación de los datos del formulario
        $validator = Validator::make($request->all(), [
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'precio' => 'required|numeric|min:0',
            'aerolinea_id' => 'required|exists:aerolineas,id',
            'oferta_id' => 'nullable|exists:ofertas,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Actualizar el vuelo
        $vuelo = Vuelo::findOrFail($id);
        $vuelo->update([
            'origen' => $request->origen,
            'destino' => $request->destino,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'precio' => $request->precio,
            'aerolinea_id' => $request->aerolinea_id,
            'oferta_id' => $request->oferta_id,
        ]);

        return redirect()->route('admin.vuelos.index')
            ->with('success', 'Vuelo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Eliminar el vuelo
        $vuelo = Vuelo::findOrFail($id);
        $vuelo->delete();

        return redirect()->route('admin.vuelos.index')
            ->with('success', 'Vuelo eliminado exitosamente.');
    }

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
     * Buscar vuelos por origen, destino y fecha
     */
    public function buscarVuelos(Request $request)
    {
        // Validación de parámetros
        $request->validate([
            'ciudad_origen' => 'required|string|max:255',
            'ciudad_destino' => 'required|string|max:255',
            'fecha_salida' => 'required|date|after_or_equal:today',
        ]);

        // Consulta de vuelos
        $vuelos = Vuelo::with(['aerolinea', 'oferta'])
            ->where('origen', 'LIKE', '%' . $request->ciudad_origen . '%')
            ->where('destino', 'LIKE', '%' . $request->ciudad_destino . '%')
            ->where('fecha', '>=', $request->fecha_salida)
            ->whereDoesntHave('reservas', function ($q) {
                $q->where('estado', '!=', 'CANCELADA');
            })
            ->paginate(3);

        // Calcular precios con descuento
        foreach ($vuelos as $vuelo) {
            $vuelo->precio_con_descuento = $vuelo->getPrecioConDescuento();
        }

        // Mantener parámetros de búsqueda
        $busqueda = [
            'ciudad_origen' => $request->ciudad_origen,
            'ciudad_destino' => $request->ciudad_destino,
            'fecha_salida' => $request->fecha_salida,
        ];

        return view('vuelosDisponibles', compact('vuelos', 'busqueda'));
    }

    /**
     * Mostrar vuelos disponibles con filtros
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
        $vuelos = $query->paginate(4)->appends([
            'origen' => $origen,
            'destino' => $destino,
            'fecha' => $fecha,
            'aerolinea' => $aerolinea,
            'precio_min' => $precioMin,
            'precio_max' => $precioMax,
        ]);
        
        
        // Calcular precios con descuento
        foreach ($vuelos as $vuelo) {
            $vuelo->precio_con_descuento = $vuelo->getPrecioConDescuento();
        }

        // Mantener parámetros de búsqueda
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