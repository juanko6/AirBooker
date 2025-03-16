<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'apellidos', 
        'telefono',  
        'dni',
        'pasaporte',
        'email'
    ];

    public function reservas(){
        return $this->hasMany(Reserva::class);
    }

    public $timestamps = false; // ✅ Esto evita el error de `updated_at`
}
