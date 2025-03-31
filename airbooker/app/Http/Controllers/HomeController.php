<?php

namespace App\Http\Controllers;

use App\Models\Vuelo;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Mostrar la página de inicio con el buscador de vuelos.
     */
    
    // Definir una constante para el número máximo de ofertas a mostrar
    const MAX_OFERTAS_BANNER = 3;
    const MAX_DESTINOS_POPULARES_BANNER = 3;
    const MAX_VUELOS_CON_OFFERTAS = 3;

    public function index()
    {
        // Obtener ofertas activas para mostrar en el banner
        $ofertas = Oferta::where('estado', 'activa')
            ->where('FechaFin', '>=', now())
            ->take(self::MAX_OFERTAS_BANNER) // Usar la constante aquí
            ->get();

        // Obtener los destinos populares (los más frecuentes en los vuelos)
        $destinosPopulares = Vuelo::select('destino', DB::raw('count(*) as total'))
            ->groupBy('destino')
            ->orderByDesc('total')
            ->take(SELF::MAX_DESTINOS_POPULARES_BANNER) // Usar la constante aquí
            ->get();

        // Obtener vuelos con ofertas
        $vuelosConOfertas = Vuelo::whereNotNull('oferta_id')
            ->whereHas('oferta', function ($query) {
                $query->where('estado', 'activa');
            })
            ->with(['aerolinea', 'oferta'])
            ->whereDate('fecha', '>=', now())
            ->take(SELF::MAX_VUELOS_CON_OFFERTAS) // Usar la constante aquí
            ->get();

        return view('home', compact('ofertas', 'destinosPopulares', 'vuelosConOfertas'));
    }

    /**
     * Buscar vuelos según los criterios del formulario.
     */
    public function buscar(Request $request)
    {
        $request->validate([
            'origen' => 'required|string|max:255',
            'destino' => 'required|string|max:255',
            'fecha' => 'required|date|after_or_equal:today',
            'pasajeros' => 'required|integer|min:1',
        ]);

        $vuelos = Vuelo::with(['aerolinea', 'oferta'])
            ->where('origen', 'like', '%' . $request->origen . '%')
            ->where('destino', 'like', '%' . $request->destino . '%')
            ->whereDate('fecha', $request->fecha)
            ->paginate(10);

        return view('vuelos.resultados', compact('vuelos', 'request'));
    }
}
