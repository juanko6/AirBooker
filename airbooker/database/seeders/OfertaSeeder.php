<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;


class OfertaSeeder extends Seeder
{
    public function run()
    {
        // Inicializar Faker para generar datos aleatorios
        $faker = Faker::create();

        // Generar 10 ofertas
        for ($i = 1; $i <= 10; $i++) {
            // Descuento aleatorio entre 15% y 25%
            $descuento = $faker->randomFloat(2, 15, 25);

            // Fechas aleatorias (FechaInicio debe ser menor que FechaFin)
            $fechaInicio = $faker->dateTimeBetween('-30 days', '+10 days')->format('Y-m-d');
            $fechaFin = $faker->dateTimeBetween($fechaInicio, '+60 days')->format('Y-m-d');

            // Estado automático basado en FechaFin
            $estado = now()->toDateString() > $fechaFin ? 'Vencida' : 'Activa';

            // Insertar la oferta en la base de datos
            DB::table('ofertas')->insert([
                'FechaInicio' => $fechaInicio,
                'FechaFin' => $fechaFin,
                'ProcentajeDescuento' => $descuento,
                'estado' => $estado,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Asignar cada oferta a un vuelo (IDs del 1 al 10)
        for ($i = 1; $i <= 10; $i++) {
            DB::table('vuelos')
                ->where('id', $i)
                ->update(['oferta_id' => $i]);
        }
    }
}