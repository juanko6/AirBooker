<?php

namespace App\Http\Controllers;

use App\Models\Aerolinea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AerolineaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $aerolineas = Aerolinea::paginate(10); // ✅ Usar paginate() en lugar de all()
    
            return view('admin.aerolineas', compact('aerolineas'));
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Este método generalmente se usa para mostrar un formulario en aplicaciones web.
        // En APIs RESTful, este método no suele ser necesario.
        return response()->json(['message' => 'Use POST /aerolineas para crear una nueva aerolínea'], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'contacto' => 'required|string|max:255',
            'paisOrigen' => 'required|string|max:255',
            'sitio_web' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Crear una nueva aerolínea
        $aerolinea = Aerolinea::create([
            'nombre' => $request->nombre,
            'contacto' => $request->contacto,
            'paisOrigen' => $request->paisOrigen,
            'sitio_web' => $request->sitio_web,
        ]);

        return back()->with('success', 'Aerolinea creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Aerolinea $aerolinea)
    {
        // Mostrar los detalles de una aerolínea específica
        return response()->json($aerolinea, 100);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Aerolinea $aerolinea)
    {
        // Este método generalmente se usa para mostrar un formulario en aplicaciones web.
        // En APIs RESTful, este método no suele ser necesario.
        return response()->json($aerolinea); // Devolver los datos como JSON    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aerolinea $aerolinea)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'nombre' => 'nullable|string|max:255',
            'contacto' => 'nullable|string|max:255',
            'paisOrigen' => 'nullable|string|max:255',
            'sitio_web' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Actualizar los campos de la aerolínea
        $aerolinea->update([
            'nombre' => $request->nombre ?? $aerolinea->nombre,
            'contacto' => $request->contacto ?? $aerolinea->contacto,
            'paisOrigen' => $request->paisOrigen ?? $aerolinea->paisOrigen,
            'sitio_web' => $request->sitio_web ?? $aerolinea->sitio_web,
        ]);

        return back()->with('success', 'Aerolínea actualizada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aerolinea $aerolinea)
    {
        // Eliminar la aerolínea
        $aerolinea->delete();
        return back()->with('success', 'Aerolinea Eliminada exitosamente');

    }
}