<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;
use Carbon\Carbon;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $ofertas = Oferta::paginate(10); // ✅ Usar paginate() en lugar de all()
    
            return view('admin.ofertas', compact('ofertas'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mostrar el formulario para crear una nueva oferta
        return view('ofertas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los datos
        $validated = $request->validate([
            'fechaInicio' => 'required|date',
            'fechaFin' => 'required|date',
            'porcentajeDescuento' => 'required|numeric|min:0|max:100',
            'estado' => 'required|in:Activa,Vencida'
        ]);

        // Convertir las fechas al formato adecuado (si es necesario)
        $fechaInicio = Carbon::parse($request->fechaInicio);
        $fechaFin = Carbon::parse($request->fechaFin);

        // Crear la nueva oferta
        try {
            Oferta::create([
                'FechaInicio' => $fechaInicio,
                'FechaFin' => $fechaFin,
                'ProcentajeDescuento' => $request->porcentajeDescuento,
                'estado' => $request->estado
            ]);
            return redirect()->route('ofertas.index')->with('success', 'Oferta creada exitosamente');
        } catch (\Exception $e) {
            // Capturar y mostrar el error
            return back()->withErrors(['error' => 'Hubo un problema al guardar la oferta: ' . $e->getMessage()]);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Oferta $oferta)
    {
        // Mostrar los detalles de una oferta específica
        return view('ofertas.show', compact('oferta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Oferta $oferta)
    {
        // Verificar si la oferta existe
        if (!$oferta) {
            return response()->json(['error' => 'Oferta no encontrada'], 404);
        }
    
        // Devolver los datos de la oferta
        return response()->json(['oferta' => $oferta]);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Oferta $oferta)
    {
        // Validar los datos entrantes
        $validatedData = $request->validate([
            'FechaInicio' => 'required|date',
            'FechaFin' => 'required|date',
            'ProcentajeDescuento' => 'required|numeric',
            'estado' => 'required|in:Activa,Vencida',
        ]);
    
        // Actualizar la oferta
        $oferta->update([
            'FechaInicio' => $request->FechaInicio,
            'FechaFin' => $request->FechaFin,
            'ProcentajeDescuento' => $request->ProcentajeDescuento,
            'estado' => $request->estado,
        ]);
    
        // Retornar una respuesta exitosa
        return back()->with('success', 'Oferta actualizada exitosamente');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Oferta $oferta)
    {
        // Eliminar la oferta
        $oferta->delete();

        // Redirigir con mensaje de éxito
        return redirect()->route('ofertas.index')->with('success', 'Oferta eliminada exitosamente.');
    }
}