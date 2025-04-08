<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarritoItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'carrito_id',
        'vuelo_id',
        'cantidad',
        'precio_unitario',
    ];

    /**
     * Relación: Un item pertenece a un carrito.
     */
    public function carrito()
    {
        return $this->belongsTo(Carrito::class);
    }

    /**
     * Relación: Un item está asociado a un vuelo.
     */
    public function vuelo()
    {
        return $this->belongsTo(Vuelo::class);
    }
}