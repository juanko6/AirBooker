<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    // Defino los campos que se pueden asignar masivamente
    protected $fillable = [
        'id',
        'estado',
        'fecha',
        'precio'
    ];

    // Establezco la relación con el modelo User
    // Una reserva pertenece a un usuario (N:1)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Establezco la relación con el modelo Vuelo
    // Una reserva pertenece a un vuelo (N:1)
    public function vuelo() 
    {
        return $this->belongsTo(Vuelo::class);
    }
}