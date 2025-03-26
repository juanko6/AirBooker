<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vuelo;
use App\Models\Reserva;
use Illuminate\Http\Request;


class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservas = Reserva::with('user', 'vuelo')->paginate(10);
        return view('admin.reservas', compact('reservas'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $reserva = new Reserva();
        $reserva->user_id = $request->user_id;
        $reserva->vuelo_id = $request->vuelo_id;
        $reserva->fecha = $request->fecha;
        $reserva->precio = $request->precio;
        $reserva->estado = $request->estado;
        $reserva->save();

        return redirect()->route('reservas.index')->with('success', 'Reserva creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $reserva = Reserva::with('user', 'vuelo')->findOrFail($id);
        $usuarios = User::all();
        $vuelos = Vuelo::all();
        return response()->json(['reserva' => $reserva, 'usuarios' => $usuarios, 'vuelos' => $vuelos]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->user_id = $request->user_id;
        $reserva->vuelo_id = $request->vuelo_id;
        $reserva->fecha = $request->fecha;
        $reserva->precio = $request->precio;
        $reserva->estado = $request->estado;
        $reserva->save();

        return back()->with('success', 'Reserva actualizada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $reserva = Reserva::findOrFail($id);
            $reserva->delete();
    
            return response()->json(['success' => true, 'message' => 'Reserva eliminada con éxito']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al eliminar la reserva']);
        }
    }
}
