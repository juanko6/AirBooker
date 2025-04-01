<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Ejecuto las migraciones para crear las tablas necesarias.
     */
    public function up(): void
    {
        // Creo la tabla de usuarios con sus campos
        Schema::create('users', function (Blueprint $table) {
            $table->id();  // Elimino primary() ya que id() ya es primary key por defecto
            $table->string('name');
            $table->string('apellidos'); 
            $table->string('dni', 9)->unique();
            $table->string('pasaporte', 9)->unique();            
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('telefono', 25);
            $table->enum('rol', ['Administrador', 'Cliente']);
            $table->string('urlImg')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        // Creo la tabla para restablecer contraseñas
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // Creo la tabla para gestionar las sesiones
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Revierto las migraciones eliminando las tablas.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

