<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Inicializar Faker
         $faker = Faker::create('es_ES'); // Configuración para datos en español

         // Crear 50 usuarios
            for ($i = 0; $i < 50; $i++) {
                DB::table('users')->insert([
                    'name' => $faker->firstName,
                    'apellidos' => $faker->lastName,
                    'dni' => $this->generateUniqueDNI($faker),
                    'pasaporte' => $this->generateUniquePassport($faker),
                    'email' => $faker->unique()->safeEmail,
                    'email_verified_at' => now(),
                    'password' => Hash::make('password'), // Contraseña común para todos ('password')
                    'telefono' => $faker->phoneNumber,
                    'rol' => $faker->randomElement(['Administrador', 'Cliente']), // Rol aleatorio
                    'remember_token' => Str::random(10),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    
        /**
         * Genera un DNI único (9 caracteres).
        */
        private function generateUniqueDNI($faker)
        {
            do {
                $dni = $faker->numerify('########') . $faker->randomLetter; // Ej: "12345678A"
            } while (DB::table('users')->where('dni', $dni)->exists());
    
            return $dni;
        }
    
        /**
         * Genera un pasaporte único (9 caracteres).
        */
        private function generateUniquePassport($faker)
        {
            do {
                $pasaporte = $faker->bothify('??######'); // Ej: "AB123456"
            } while (DB::table('users')->where('pasaporte', $pasaporte)->exists());
    
            return $pasaporte;
        }
    }