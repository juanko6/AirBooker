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
        'urlImgDestino',
    ];

    protected $casts = [
        'fecha' => 'date',
        'hora' => 'datetime:H:i',
        'horaFinVuelo' => 'datetime:H:i',
        'precio' => 'decimal:2',
    ];

    /**
     * Relación con Aerolínea
     */
    public function aerolinea(): BelongsTo
    {
        return $this->belongsTo(Aerolinea::class);
    }

    /**
     * Relación con Oferta
     */
    public function oferta(): BelongsTo
    {
        return $this->belongsTo(Oferta::class);
    }

    /**
     * Relación con Reservas
     */
    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }

    /**
     * Calcular precio con descuento si hay oferta activa
     */
    public function getPrecioConDescuento()
    {
        if ($this->oferta && $this->oferta->estado === 'Activa') {
            return $this->precio * (1 - $this->oferta->ProcentajeDescuento / 100);
        }
        return $this->precio;
    }

    /**
     * Filtrar vuelos disponibles
     *      * 
     */
    public static function filtrarDisponibles($filtros)
    {
        // Calcular precio final con descuento
        $query = self::with(['aerolinea'])
            ->leftJoin('ofertas', 'vuelos.oferta_id', '=', 'ofertas.id')
            ->select('vuelos.*')
            ->selectRaw('
                CASE 
                    WHEN ofertas.estado = "Activa" THEN 
                        ROUND(vuelos.precio * (1 - ofertas.ProcentajeDescuento / 100), 2)
                    ELSE 
                        ROUND(vuelos.precio, 2)
                END as precio_final
            ')
            ->where('origen', 'LIKE', '%' . $filtros['origen'] . '%')
            ->where('destino', 'LIKE', '%' . $filtros['destino'] . '%')
            ->where('fecha', '>=', $filtros['fecha'])
            ->whereDoesntHave('reservas', function ($q) {
                $q->where('estado', '!=', 'CANCELADA');
            });

        
        // Filtro por aerolíneas        
        if (!empty($filtros['aerolinea'])) {
            $query->whereHas('aerolinea', function ($q) use ($filtros) {
                $q->whereIn('nombre', $filtros['aerolinea']);
            });
        }

        // Filtro por rango de precios (ahora usando precio_final)
        if ($filtros['precio_min'] && $filtros['precio_max']) {
            $query->havingRaw('precio_final BETWEEN ? AND ?', [$filtros['precio_min'], $filtros['precio_max']]);
        }

        // Ordenación: Primero ofertas, luego por precio_final
        if ($filtros['mostrar_ofertas']) {
            $query->orderByRaw('oferta_id IS NOT NULL DESC'); // Priorizar ofertas
        }

        // Aplicar ordenación por precio_final
        if ($filtros['ordenar_por_precio'] === 'barato') {
            $query->orderBy('precio_final', 'asc');
        } elseif ($filtros['ordenar_por_precio'] === 'caro') {
            $query->orderBy('precio_final', 'desc');
        } else {
            $query->orderBy('fecha')->orderBy('hora'); // Orden predeterminado
        }

        return $query;
    }
}

