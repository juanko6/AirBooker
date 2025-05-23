<?php

namespace App\Http\Controllers;

use App\Models\Aerolinea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


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
            'urlLogo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // validación de imagen
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
    // Ruta base donde se guardan los logos
        $rutaLogo = null;

        if ($request->hasFile('urlLogo')) {
            // Subida personalizada
            $file = $request->file('urlLogo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/aerolinias'), $filename);
            $rutaLogo = '/images/aerolinias/' . $filename;
        } else {
            // Crear copia del logo por defecto
            $origen = public_path('images/aerolineas/logo-defaul.png');
            $nuevoNombre = time() . '_logo-defaul.png';
            $destino = public_path('images/aerolinias/' . $nuevoNombre);

            if (file_exists($origen)) {
                copy($origen, $destino);
                $rutaLogo = '/images/aerolinias/' . $nuevoNombre;
            } else {
                // Seguridad: si no existe el archivo base
                $rutaLogo = null;
            }
        }
    
        // Crear una nueva aerolínea
        $aerolinea = Aerolinea::create([
            'nombre' => $request->nombre,
            'contacto' => $request->contacto,
            'paisOrigen' => $request->paisOrigen,
            'sitio_web' => $request->sitio_web,
            'urlLogo' => $rutaLogo,
        ]);
    
        return back()->with('success', 'Aerolínea creada exitosamente');
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
        $aerolinea->urlLogo = asset($aerolinea->urlLogo);
        return response()->json($aerolinea); // Devolver los datos como JSON    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Aerolinea $aerolinea)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'nullable|string|max:255',
            'contacto' => 'nullable|string|max:255',
            'paisOrigen' => 'nullable|string|max:255',
            'sitio_web' => 'nullable|string|max:255',
            'urlLogo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Si hay un nuevo logo, eliminar el anterior
        if ($request->hasFile('urlLogo')) {
            if ($aerolinea->urlLogo && file_exists(public_path($aerolinea->urlLogo))) {
                unlink(public_path($aerolinea->urlLogo));
            }

            $file = $request->file('urlLogo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/aerolinias'), $filename);
            $aerolinea->urlLogo = '/images/aerolinias/' . $filename;
        }

        $aerolinea->update([
            'nombre' => $request->nombre ?? $aerolinea->nombre,
            'contacto' => $request->contacto ?? $aerolinea->contacto,
            'paisOrigen' => $request->paisOrigen ?? $aerolinea->paisOrigen,
            'sitio_web' => $request->sitio_web ?? $aerolinea->sitio_web,
            'urlLogo' => $aerolinea->urlLogo,
        ]);

        return back()->with('success', 'Aerolínea actualizada exitosamente');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Aerolinea $aerolinea)
    {
        // Si hay un logo guardado y existe físicamente en el disco
        if ($aerolinea->urlLogo && Storage::disk('public')->exists(str_replace('/storage/', '', $aerolinea->urlLogo))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $aerolinea->urlLogo));
        }
    
        // Eliminar la aerolínea de la base de datos
        $aerolinea->delete();
    
        return back()->with('success', 'Aerolínea eliminada exitosamente');
    }
    
}