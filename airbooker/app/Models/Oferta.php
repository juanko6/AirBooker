<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;

    // Define los campos que pueden ser asignados masivamente
    protected $fillable = [
        'FechaInicio',
        'FechaFin',
        'ProcentajeDescuento',
        'estado',
    ];

    // Si es necesario, define la tabla asociada (opcional si sigue la convención de nombres)
    protected $table = 'ofertas';

    // Define los tipos de datos para campos específicos (opcional)
    protected $casts = [
        'FechaInicio' => 'date',
        'FechaFin' => 'date',
        'ProcentajeDescuento' => 'decimal:2',
        'estado' => 'string',
    ];
    
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
