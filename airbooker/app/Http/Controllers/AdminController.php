<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Reserva;
use App\Models\Vuelo;
use App\Models\Aerolinea;
use App\Models\Oferta;

class AdminController extends Controller
{
    public function dashboard()
    {

            // Consulta para obtener el total de dinero por mes
    $reservasPorMes = Reserva::selectRaw('YEAR(fecha) as ano, MONTH(fecha) as mes, SUM(precio) as total')
    ->groupBy(DB::raw('YEAR(fecha), MONTH(fecha)'))
    ->orderBy(DB::raw('YEAR(fecha), MONTH(fecha)'))
    ->get();

        return view('admin.dashboard', [
            'totalUsers' => User::count(),
            'totalReservas' => Reserva::count(),
            'totalVuelos' => Vuelo::count(),
            'totalAerolineas' => Aerolinea::count(),
            'totalOfertas' => Oferta::count(),
            'reservasPorMes' => $reservasPorMes
        ]);
    }

    

    
}