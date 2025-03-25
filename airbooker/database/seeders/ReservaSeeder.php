<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReservaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener IDs de usuarios y vuelos existentes
        $userIds = DB::table('users')->pluck('id');
        $vueloIds = DB::table('vuelos')->pluck('id');

        // Generar 80 reservas
        for ($i = 0; $i < 80; $i++) {
            // Elegir un usuario y un vuelo aleatorio
            $userId = $userIds->random();
            $vueloId = $vueloIds->random();

            // Definir estados aleatorios
            $estados = ['pendiente', 'confirmada', 'cancelada'];
            $estado = $estados[array_rand($estados)];

            // Definir una fecha aleatoria entre hoy y los próximos 6 meses
            $fecha = Carbon::now()->addDays(rand(0, 180))->setTime(rand(0, 23), rand(0, 59), rand(0, 59));

            // Definir un precio aleatorio entre 50 y 1000
            $precio = rand(5000, 100000) / 100;

            // Insertar la reserva en la base de datos
            DB::table('reservas')->insert([
                'user_id' => $userId,
                'vuelo_id' => $vueloId,
                'estado' => $estado,
                'fecha' => $fecha,
                'precio' => $precio,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
