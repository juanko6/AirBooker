<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('carrito_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carrito_id')->constrained()->onDelete('cascade'); // Relación con carritos
            $table->foreignId('vuelo_id')->constrained()->onDelete('cascade'); // Relación con vuelos
            $table->integer('cantidad')->default(1); // Cantidad de asientos reservados
            $table->decimal('precio_unitario', 8, 2); // Precio unitario del vuelo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito_items');
    }
};
