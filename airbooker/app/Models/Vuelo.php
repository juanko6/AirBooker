<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vuelo extends Model
{
    use HasFactory;

    protected $fillable = [
        'aerolinea_id',
        'origen',
        'destino',
        'fecha',
        'hora',
        'horaFinVuelo',         
        'precio',
        'oferta_id',
        'clase',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime:H:i',
        'horaFinVuelo' => 'datetime:H:i',
        'precio' => 'decimal:2',
    ];

    /**
     * Obtener la aerolínea asociada al vuelo.
     */
    public function aerolinea(): BelongsTo
    {
        return $this->belongsTo(Aerolinea::class);
    }

    /**
     * Obtener la oferta asociada al vuelo.
     */
    public function oferta(): BelongsTo
    {
        return $this->belongsTo(Oferta::class);
    }

    /**
     * Obtener las reservas del vuelo.
     */
    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }

    /**
     * Calcular el precio con descuento si hay oferta activa.
     */
    public function getPrecioConDescuento()
    {
        if ($this->oferta && $this->oferta->isActiva()) {
            $descuento = $this->precio * ($this->oferta->ProcentajeDescuento / 100);
            return $this->precio - $descuento;
        }

        return $this->precio;
    }

    /**
     * Filtrar vuelos por origen.
     */
    public function scopeOrigen($query, $origen)
    {
        if ($origen) {
            return $query->where('origen', 'like', "%$origen%");
        }
        return $query;
    }

    /**
     * Filtrar vuelos por destino.
     */
    public function scopeDestino($query, $destino)
    {
        if ($destino) {
            return $query->where('destino', 'like', "%$destino%");
        }
        return $query;
    }

    /**
     * Filtrar vuelos por fecha.
     */
    public function scopeFecha($query, $fecha)
    {
        if ($fecha) {
            return $query->whereDate('fecha', $fecha);
        }
        return $query;
    }
}