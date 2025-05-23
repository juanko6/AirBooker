<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Clase User que representa a los usuarios en el sistema.
 * Extiendo Authenticatable para manejar la autenticación.
 */
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'apellidos',
        'telefono',
        'address',
        'dni',        
        'pasaporte',
        'rol',
        'email',        
        'password',
        'urlImg',
        'creditos',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    
    /**
     * Obtener las reservas del usuario.
     */
    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }

    /**
     * Relación: Un usuario tiene un carrito.
     */
    public function carrito()
    {
        return $this->hasOne(Carrito::class);
    }

    /**
     * Hook: Crear un carrito automáticamente al crear un usuario.
     */
    protected static function booted()
    {
        static::created(function ($user) {
            // Crear un carrito vacío asociado al usuario
            $user->carrito()->create();
        });
    }
    
    /**
     * Obtener las reservas estado "pendientes" del usuario.
     */
    public function reservasPendientes(): HasMany
    {
        return $this->hasMany(Reserva::class)->where('estado', 'pendiente');
    }

    /**
     * Obtener las reservas estado "confirmadas" del usuario.
     */
    public function reservasConfirmadas(): HasMany
    {
        return $this->hasMany(Reserva::class)->where('estado', 'confirmada');
    }
    /**
     * Obtener las reservas estado "canceladas" del usuario.
     */
    public function reservasCanceladas(): HasMany
    {
        return $this->hasMany(Reserva::class)->where('estado', 'cancelada');
    }
 
  
 
    /**
     * Verificar si el usuario es administrador.
     */
    public function isAdmin(): bool
    {
        return $this->rol === 'administrador';
    }

    /**
     * Verificar si el usuario es operario.
     */
    public function isOperario(): bool
    {
        return $this->rol === 'operario';
    }

    /**
     * Verificar si el usuario es cliente.
     */
    public function isCliente(): bool
    {
        return $this->rol === 'cliente';
    }

    /**
     * Defino el casteo de atributos para un correcto manejo de tipos.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* 
    * obtener credito total de usuario
    */
    public function getCreditos(): float
    {
        return $this->creditos;
    }

    /**
     * Actualizar el saldo del usuario.
     */
    public function actualizarSaldo(float $total): bool
    {
        if ($this->creditos - $total < 0) {
            return false;
        }

        $this->creditos -= $total;
        $this->save();

        return true;
    }
 
}
