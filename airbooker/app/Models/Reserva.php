<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }

    public function vuelo(){
        return $this->hasMany(Vuelo::class);
    }
}
