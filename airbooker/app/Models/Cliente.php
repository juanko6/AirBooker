<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    public function reservas(){
        return $this->hasMany(Reserva::class);
    }
}
