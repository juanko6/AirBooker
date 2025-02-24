<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable = [
        'nombre',
        'apellido',
        'dni',
        'pasaporte',
        'email'
    ];

    public function reservas(){
        return $this->hasMany(Reserva::class);
    }
}
