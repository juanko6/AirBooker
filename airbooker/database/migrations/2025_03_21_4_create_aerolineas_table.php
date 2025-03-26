 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Creo la tabla aerolineas.
     * Defino la estructura con los campos necesarios.
     */
    public function up(): void
    {
        Schema::create('aerolineas', function (Blueprint $table) {
            // Defino ID como clave primaria autoincremental
            $table->id();
            
            // Agrego campos básicos de la aerolínea
            $table->string('nombre');
            $table->string('paisOrigen');
            $table->string('contacto');
            $table->string('sitio_web');
            
            // Agrego timestamps para auditoría
            $table->timestamps();
        });
    }

    /**
     * Elimino la tabla aerolineas si necesito revertir.
     */
    public function down(): void
    {
        Schema::dropIfExists('aerolineas');
    }
};
