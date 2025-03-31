<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;


class ReservaClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            try {
                $reservas = Reserva::paginate(8);
        
                return view('reservasCliente', compact('reservas'));
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
}