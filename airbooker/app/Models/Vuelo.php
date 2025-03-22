<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha',
        'hora',
        'id',
        'origen',
        'destino'
    ];

    public function reservas(){
        return $this->hasMany(Reserva::class);
    }
    public $timestamps = false; // ✅ Esto evita el error de `updated_at`
    
}
