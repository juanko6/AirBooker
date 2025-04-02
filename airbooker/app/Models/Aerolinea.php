<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo para la tabla aerolineas.
 * Represento la entidad Aerolinea en mi sistema.
 */
class Aerolinea extends Model
{
    
    use HasFactory;

    protected $fillable = [
        'nombre',
        'paisOrigen',
        'sitio_web',
        'contacto',
        'urlLogo',
    ];

    /**
     * Obtener los vuelos asociados a la aerolínea.
     */
    public function vuelos(): HasMany
    {
        return $this->hasMany(Vuelo::class);
    }
}
