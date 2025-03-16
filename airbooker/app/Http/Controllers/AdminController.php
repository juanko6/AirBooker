<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Reserva;
use App\Models\Vuelo;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalClientes' => Cliente::count(),
            'totalReservas' => Reserva::count(),
            'totalVuelos' => Vuelo::count()
        ]);
    }
}