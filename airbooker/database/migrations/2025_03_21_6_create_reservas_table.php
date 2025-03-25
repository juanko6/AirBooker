<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuto las migraciones creando la tabla 'reservas'.
     */
    public function up(): void
    {
        Schema::create('reservas', function (Blueprint $table) {
            // Creo el ID principal autoincremental
            $table->id();
            
            // Añado relación con la tabla user
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            
            // Añado relación con la tabla vuelos
            $table->foreignId('vuelo_id')
                  ->constrained('vuelos')
                  ->cascadeOnDelete();

            // Defino los campos básicos de la reserva
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada']);
            $table->dateTime('fecha');
            $table->decimal('precio', 8, 2);

            // Añado timestamps automáticos
            $table->timestamps();
        });
    }

    /**
     * Revierto la migración eliminando la tabla.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
