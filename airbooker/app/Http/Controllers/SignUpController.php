<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SignUpController extends Controller
{
    // Método para mostrar el formulario de registro
    public function showSignUp()
    {
        return view('signup'); // Retorna la vista de registro
    }
}
