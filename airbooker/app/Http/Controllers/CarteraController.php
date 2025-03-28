<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use Illuminate\Http\Request;


class CarteraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        {
            try {        
                return view('cartera');
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }
    }
}