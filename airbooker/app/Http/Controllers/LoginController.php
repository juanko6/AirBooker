<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    // Método para mostrar el formulario de inicio de sesión
    public function showLogin()
    {
        return view('login'); // Retorna la vista de registro
    }
}
