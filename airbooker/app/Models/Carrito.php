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
}