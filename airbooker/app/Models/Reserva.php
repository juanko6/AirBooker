<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model
{
    use HasFactory;

    protected $fillable = [
        'vuelo_id',
        'user_id',
        'fecha',
        'precio',
        'estado',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'precio' => 'decimal:2',
    ];

    //Crear una reserva
    

    /**
     * Obtener el vuelo asociado a la reserva.
     */
    public function vuelo(): BelongsTo
    {
        return $this->belongsTo(Vuelo::class);
    }

    /**
     * Obtener el usuario asociado a la reserva.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener todas las reservas con estado pendiente.
     */
    public static function obtenerReservasPendientes()
    {
        return self::where('estado', 'pendiente')->get();
    }
    
    /**
     * Verificar si la reserva está pendiente.
     */
    public function isPendiente(): bool
    {
        return $this->estado === 'pendiente';
    }

    /**
     * Verificar si la reserva está pagada.
     */
    public function isPagada(): bool
    {
        return $this->estado === 'pagada';
    }

    /**
     * Verificar si la reserva está cancelada.
     */
    public function isCancelada(): bool
    {
        return $this->estado === 'cancelada';
    }

    public static function crearReserva($userId, $vueloId, $precio)
    {
        return self::create([
            'user_id' => $userId,
            'vuelo_id' => $vueloId,
            'precio' => $precio,
            'fecha' => now(),
            'estado' => 'confirmada',
        ]);
    }
    
}