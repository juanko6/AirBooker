<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
    ];

    

    /**
     * Relación: Un carrito pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación: Un carrito tiene muchos items.
     */
    public function items()
    {
        return $this->hasMany(CarritoItem::class);
    }
 

    /**
     * Calcular el total a pagar (incluyendo descuentos).
     */
    public function calcularTotal()
    {
        return $this->items->sum(function ($item) {
            if (!$item->vuelo) {
                return 0;
            }

            $descuento = $item->vuelo->oferta
                ? ($item->precio_unitario * $item->vuelo->oferta->ProcentajeDescuento / 100)
                : 0;

            return $item->precio_unitario - $descuento;
        });
    }
}
