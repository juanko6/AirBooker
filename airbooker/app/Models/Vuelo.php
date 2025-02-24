<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    protected $fillable = [
        'fecha',
        'hora',
        'id',
        'origen',
        'destino'
    ];

    public function reservas(){
        return $this->belongsTo(Reserva::class);
    }
}
