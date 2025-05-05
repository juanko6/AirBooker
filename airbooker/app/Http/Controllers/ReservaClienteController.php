<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ReservaClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            try {
                $user = $this->verificarAutenticacion(); 
                $reservas = $user->reservas()->paginate(8);
        
                return view('user.reservasCliente', compact('reservas'));
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }

    private function verificarAutenticacion()
    {
        $user = Auth::user();

        if (!$user) {
            redirect()->route('login')->withErrors(['message' => 'Debes iniciar sesión para realizar esta acción.'])->send();
            exit;
        }

        return $user;
    }
}