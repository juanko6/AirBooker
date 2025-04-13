<?php

namespace App\Http\Controllers;
use App\Models\Faq;


use App\Models\Vuelo;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }


    /**
     * Mostrar la página de inicio con el buscador de vuelos.
     */
    
    // Definir una constante para el número máximo de ofertas a mostrar 
    const MAX_VUELOS_CON_OFFERTAS = 8;

    public function index()
{
    // Obtener vuelos con ofertas
    $vuelosConOfertas = Vuelo::whereNotNull('oferta_id')
        ->whereHas('oferta', function ($query) {
            $query->where('estado', 'activa');
        })
        ->with(['aerolinea', 'oferta'])
        ->whereDate('fecha', '>=', now())
        ->take(self::MAX_VUELOS_CON_OFFERTAS)
        ->get();

    // Obtener FAQs
    $faqs = Faq::all();

    return view('home', compact('vuelosConOfertas', 'faqs'));
}
}
