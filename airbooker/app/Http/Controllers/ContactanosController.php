<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactanosController extends Controller
{
    // Método para mostrar el contactanos
    public function showContactanos()
    {
        return view('contactanos'); // Retorna la vista
    }

    public function enviarFormulario(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellidos' => 'required|string|max:255',
            'email' => 'required|email',
            'telefono' => 'nullable|string|max:20',
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string',
        ]);

        // Aquí puedes procesar los datos, como enviarlos por email o guardarlos en BD

        return redirect()->back()->with('success', 'Mensaje enviado correctamente.');
    }

}