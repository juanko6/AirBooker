<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    /** @use HasFactory<\Database\Factories\OfertaFactory> */

    // Defino la relación uno a muchos con los vuelos
    public function vuelos()
    {
        return $this->hasMany(Vuelo::class);
    }
 
    // Determino automáticamente si una oferta está vencida
    // comparando su fecha fin con la actual
    public function getEstadoAttribute($value) 
    {
        return $this->FechaFin < now() ? 'Vencida' : $value;
    }
    
}
