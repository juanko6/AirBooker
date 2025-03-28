<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vuelo extends Model
{
    // Defino los campos que pueden ser rellenados masivamente
    protected $fillable = [
        'fecha',
        'hora',
        'origen',
        'destino', 
        'precio',
        'aerolinea_id',
        'oferta_id',
        'created_at',
        'updated_at',
    ];
 
    // Defino la relación con Aerolinea - Un vuelo pertenece a una aerolínea
    public function aerolinea()
    {
        return $this->belongsTo(Aerolinea::class);
    }

    // Defino la relación con Reserva - Un vuelo puede tener múltiples reservas
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
      
    // Defino la relación con Oferta - Un vuelo puede estar asociado a una oferta
    public function oferta()
    {
        return $this->belongsTo(Oferta::class);
    }
    
    
    
        
    // Defino un atributo calculado para obtener el precio con descuento
    public function getPrecioConDescuento()
    {
        if ($this->oferta && $this->oferta->estado === 'Activa') {
            return $this->precio * (1 - $this->oferta->ProcentajeDescuento / 100);
        }
        return $this->precio;
    }
    
}