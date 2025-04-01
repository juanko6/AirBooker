<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Creo la tabla vuelos en la base de datos
     */
    public function up(): void
    {
        Schema::create('vuelos', function (Blueprint $table) {
            // Defino los campos básicos
            $table->id();  // Ya incluye primary key por defecto
            $table->date('fecha');            
            $table->time('hora');
            $table->date('horaFinVuelo')->nullable();
            $table->string('origen');
            $table->string('destino');
            $table->decimal('precio', 8, 2);
            $table->enum('clase', ['business', 'primera', 'turista']);


            // Establezco la relación con aerolíneas
            $table->foreignId('aerolinea_id')
                ->constrained('aerolineas')
                ->cascadeOnDelete();
            
            // Establezco la relación con ofertas
            $table->foreignId('oferta_id')
                ->nullable()
                ->constrained('ofertas')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Elimino la tabla vuelos si necesito revertir
     */
    public function down(): void
    {
        Schema::dropIfExists('vuelos');
    }
};
