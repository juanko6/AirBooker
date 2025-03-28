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
}
