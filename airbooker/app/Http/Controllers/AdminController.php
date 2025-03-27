<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Reserva;
use App\Models\Vuelo;
use App\Models\Aerolinea;
use App\Models\Oferta;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalReservas' => Reserva::count(),
            'totalVuelos' => Vuelo::count(),
            'totalAerolineas' => Aerolinea::count(),
            'totalOfertas' => Oferta::count(),
        ]);
    }
}