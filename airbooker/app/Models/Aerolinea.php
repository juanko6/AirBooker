<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modelo para la tabla aerolineas.
 * Represento la entidad Aerolinea en mi sistema.
 */
class Aerolinea extends Model
{
    // Defino la tabla asociada
    protected $table = "aerolineas";
    
    // Especifico los campos que pueden ser llenados masivamente
    protected $fillable = [
        "nombre",
        "paisOrigen",
        "contacto", 
        "sitio_web",
        "created_at",
        "updated_at",
    ];

    /**
     * Obtengo los vuelos asociados a esta aerolínea.
     * Relación 1:N - Una aerolínea tiene muchos vuelos
     */
    public function vuelos()
    {
        return $this->hasMany(Vuelo::class);
    }
}
