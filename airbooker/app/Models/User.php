<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Clase User que representa a los usuarios en el sistema.
 * Extiendo Authenticatable para manejar la autenticación.
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Defino los campos que pueden ser asignados masivamente.
     * Esto protege contra la asignación masiva no deseada.
     */
    protected $fillable = [
        'name',
        'apellidos', 
        'dni',
        'pasaporte',
        'email',
        'telefono',
        'rol',
        'password',
    ];

    /**
     * Especifico los atributos que deben ocultarse al serializar.
     * Por seguridad, oculto password y token.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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

    /**
     * Establezco la relación uno a muchos con las reservas.
     * Un usuario puede tener múltiples reservas.
     */
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }
}
