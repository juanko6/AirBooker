<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    public function reservas(){
        return $this->belongsTo(Reserva::class);
    }
}
