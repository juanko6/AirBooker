<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    // Defino los campos que pueden ser rellenados masivamente
    protected $fillable = [
        'fecha',
        'hora',
        'id',
        'origen',
        'destino'
    ];
 
    // Defino la relación con Aerolinea - Un vuelo pertenece a una aerolínea
    public function aerolinea()
    {
        return $this->belongsTo(Aerolinea::class);
    }

    // Defino la relación con Reserva - Un vuelo puede tener múltiples reservas
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
      
    // Defino la relación con Oferta - Un vuelo puede estar asociado a una oferta
    public function oferta()
    {
        return $this->belongsTo(Oferta::class);
    }

    
}