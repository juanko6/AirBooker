<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Oferta extends Model
{
    use HasFactory;

    protected $fillable = [
        'FechaInicio',
        'FechaFin',
        'ProcentajeDescuento',
        'estado', 
    ];

    /**
     * Obtener los vuelos asociados a la oferta.
     */
    public function vuelos(): HasMany
    {
        return $this->hasMany(Vuelo::class);
    }

    /**
     * Verificar si la oferta está activa.
     */
    public function isActiva(): bool
    {
        return $this->estado === 'activa';
    }
 
    // Determino automáticamente si una oferta está vencida
    // comparando su fecha fin con la actual
    public function getEstadoAttribute($value) 
    {
        return $this->FechaFin < now() ? 'Vencida' : $value;
    }
    
}
