<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsletterSubscriber;

class FooterController extends Controller
{
    /**
     * Maneja la suscripción al newsletter.
     */
    public function subscribe(Request $request)
    {
        // Validar el email
        $request->validate([
            'email' => 'required|email|unique:newsletter_subscribers,email',
        ]);

        // Crear el suscriptor
        NewsletterSubscriber::create([
            'email' => $request->input('email'),
        ]);

        // Devolver una respuesta JSON con un mensaje de éxito
        return response()->json([
            'success' => true,
            'message' => '¡Gracias por suscribirte! Pronto recibirás nuestras ofertas.',
        ]);
    }
}