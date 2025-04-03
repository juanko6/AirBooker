<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Vuelo;
use App\Models\Aerolinea;
use App\Models\Oferta;
use Carbon\Carbon;

class VueloController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $vuelos = Vuelo::with('aerolinea', 'oferta')->paginate(10); // para la tabla
    $aerolineas = Aerolinea::all(); // para el select
    $ofertas = Oferta::all(); // si tienes select de ofertas

    return view('admin.vuelos', compact('vuelos', 'aerolineas', 'ofertas'));
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

        return back()->with('success', 'Vuelo creado exitosamente.');
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
    public function edit(Vuelo $vuelo)
    {
        $vuelo->load(['aerolinea', 'oferta']);
        return response()->json($vuelo);
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

        return back()->with('success', 'Vuelo actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Eliminar el vuelo
        $vuelo = Vuelo::findOrFail($id);
        $vuelo->delete();

        return back()->with('success', 'Vuelo eliminado exitosamente.');
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
    $aerolineas = $request->input('aerolinea', []); // Array de aerolíneas seleccionadas
    $precioMin = $request->input('precio_min');
    $precioMax = $request->input('precio_max');
    $mostrarOfertasPrimero = $request->has('mostrar_ofertas'); // Checkbox "Ofertas"
    
    $ordenarPorPrecio = $request->input('ordenar_por_precio'); // Ordenación por precio

    // Consulta base
    $query = Vuelo::with(['aerolinea', 'oferta'])
        ->where('origen', 'LIKE', '%' . $origen . '%')
        ->where('destino', 'LIKE', '%' . $destino . '%')
        ->where('fecha', '>=', $fecha)
        ->whereDoesntHave('reservas', function ($q) {
            $q->where('estado', '!=', 'CANCELADA');
        });

    // Filtro por múltiples aerolíneas
    if (!empty($aerolineas)) {
        $query->whereHas('aerolinea', function ($q) use ($aerolineas) {
            $q->whereIn('nombre', $aerolineas);
        });
    }

    // Filtro por rango de precios
    if ($precioMin && $precioMax) {
        $query->whereBetween('precio', [$precioMin, $precioMax]);
    }

    // Reordenar si se activa el checkbox "Ofertas"
    if ($mostrarOfertasPrimero) {
        $query->orderByRaw('oferta_id IS NOT NULL DESC'); // Muestra primero los vuelos con oferta
    }
    
    
     // Ordenación por precio
     if ($ordenarPorPrecio === 'barato') {
        $query->orderBy('precio', 'asc'); // Más barato primero
    } elseif ($ordenarPorPrecio === 'caro') {
        $query->orderBy('precio', 'desc'); // Más caro primero
    } else {
        $query->orderBy('fecha')->orderBy('hora'); // Orden predeterminado por fecha y hora
    }



    // Paginación
    $vuelos = $query->paginate(4)->appends([
        'origen' => $origen,
        'destino' => $destino,
        'fecha' => $fecha,
        'aerolinea' => $aerolineas, // Mantener los valores seleccionados
        'precio_min' => $precioMin,
        'precio_max' => $precioMax,
        'mostrar_ofertas' => $mostrarOfertasPrimero ? 'on' : null, // Mantener estado del checkbox
        'ordenar_por_precio' => $ordenarPorPrecio, // Mantener ordenación por precio
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
        'aerolinea' => $aerolineas, // Array de aerolíneas seleccionadas
        'precio_min' => $precioMin,
        'precio_max' => $precioMax,
        'mostrar_ofertas' => $mostrarOfertasPrimero, // Estado del checkbox
        'ordenar_por_precio' => $ordenarPorPrecio, // Ordenación por precio
    ];

    // Obtener aerolíneas para el filtro lateral
    $aerolineas = Aerolinea::all();

    return view('vuelosDisponibles', compact('vuelos', 'filtros', 'aerolineas'));
}
}