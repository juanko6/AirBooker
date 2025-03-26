<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;

class OfertaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener todas las ofertas ordenadas por fecha de creación descendente
        $ofertas = Oferta::orderBy('created_at', 'desc')->get();
        return view('ofertas.index', compact('ofertas'));
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
        // Validar los datos del formulario
        $request->validate([
            'FechaInicio' => 'required|date',
            'FechaFin' => 'required|date|after:FechaInicio',
            'ProcentajeDescuento' => 'required|numeric|min:0|max:100',
            'estado' => 'required|in:ACTIVA,INACTIVA',
        ]);

        // Crear una nueva oferta
        Oferta::create([
            'FechaInicio' => $request->input('FechaInicio'),
            'FechaFin' => $request->input('FechaFin'),
            'ProcentajeDescuento' => $request->input('ProcentajeDescuento'),
            'estado' => $request->input('estado'),
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('ofertas.index')->with('success', 'Oferta creada exitosamente.');
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
        // Mostrar el formulario para editar una oferta existente
        return view('ofertas.edit', compact('oferta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Oferta $oferta)
    {
        // Validar los datos del formulario
        $request->validate([
            'FechaInicio' => 'required|date',
            'FechaFin' => 'required|date|after:FechaInicio',
            'ProcentajeDescuento' => 'required|numeric|min:0|max:100',
            'estado' => 'required|in:ACTIVA,INACTIVA',
        ]);

        // Actualizar la oferta
        $oferta->update([
            'FechaInicio' => $request->input('FechaInicio'),
            'FechaFin' => $request->input('FechaFin'),
            'ProcentajeDescuento' => $request->input('ProcentajeDescuento'),
            'estado' => $request->input('estado'),
        ]);

        // Redirigir con mensaje de éxito
        return redirect()->route('ofertas.index')->with('success', 'Oferta actualizada exitosamente.');
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