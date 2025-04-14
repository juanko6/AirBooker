<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use App\Models\User;  

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        /*
            Resultado Esperado
            Se crearán 45 usuarios con sus respectivos carritos.
            Cada carrito estará asociado a un usuario y permanecerá vacío hasta que se agreguen items.
            La lógica del evento created se ejecutará correctamente, y la verificación adicional garantizará que no haya usuarios sin carrito.
        */
        
         // Inicializar Faker
         $faker = Faker::create('es_ES'); // Configuración para datos en español

        
        // Crear 45 usuarios utilizando el modelo User
        // Crear usuario Administrador por defecto
        $admin = User::create([
            'name' => 'Administrador',
            'apellidos' => 'AirBooker',
            'dni' => $this->generateUniqueDNI($faker),
            'pasaporte' => $this->generateUniquePassport($faker),
            'email' => 'admin@airbooker.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'), // Contraseña para el administrador
            'telefono' => $faker->phoneNumber,
            'rol' => 'Administrador',
            'urlImg' => 'https://www.shutterstock.com/image-vector/user-profile-icon-vector-avatar-600nw-2247726673.jpg',
            'remember_token' => Str::random(10),
            'creditos' => 1500.00,
        ]);

        // Crear usuario Cliente por defecto
        $cliente = User::create([
            'name' => 'Cliente',
            'apellidos' => 'AirBooker',
            'dni' => $this->generateUniqueDNI($faker),
            'pasaporte' => $this->generateUniquePassport($faker),
            'email' => 'cliente@airbooker.com',
            'email_verified_at' => now(),
            'password' => Hash::make('123456'), // Contraseña para el cliente
            'telefono' => $faker->phoneNumber,
            'rol' => 'Cliente',
            'urlImg' => 'https://www.shutterstock.com/image-vector/user-profile-icon-vector-avatar-600nw-2247726673.jpg',
            'remember_token' => Str::random(10),
            'creditos' => 1000.00,
        ]);

        // Crear 45 usuarios aleatorios
        for ($i = 1; $i <= 45; $i++) {
            $user = User::create([
            'name' => $faker->firstName,
            'apellidos' => $faker->lastName,
            'dni' => $this->generateUniqueDNI($faker),
            'pasaporte' => $this->generateUniquePassport($faker),
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('123456'), // Contraseña común para todos ('123456')
            'telefono' => $faker->phoneNumber,
            'rol' => $faker->randomElement(['Administrador', 'Cliente']), // Rol aleatorio
            'urlImg' => 'https://www.shutterstock.com/image-vector/user-profile-icon-vector-avatar-600nw-2247726673.jpg',
            'remember_token' => Str::random(10),
            'creditos' => $faker->randomFloat(2, 1000, 1500),
            ]);

            // Verificar que el carrito se haya creado automáticamente
            if (!$user->carrito) {
                $user->carrito()->create(); // Crear carrito manualmente si no existe
            }       

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