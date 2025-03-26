<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Creo la tabla ofertas con sus respectivos campos
     */
    public function up(): void
    {
        Schema::create('ofertas', function (Blueprint $table) {
            // Defino el id como clave primaria
            $table->id();
            // Añado campos de fechas para controlar la vigencia
            $table->date('FechaInicio');
            $table->date('FechaFin');
            // Almaceno el descuento con 2 decimales
            $table->decimal('ProcentajeDescuento', 5, 2);
            // Estado de la oferta con valores predefinidos
            $table->enum('estado', ['Activa', 'Inactiva', 'Vencida']);
            // Campos de auditoría created_at y updated_at
            $table->timestamps();
        });
    }

    /**
     * Elimino la tabla ofertas si necesito revertir
     */
    public function down(): void
    {
        Schema::dropIfExists('ofertas');
    }
};
