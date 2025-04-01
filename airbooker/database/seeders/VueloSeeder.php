<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
class VueloSeeder extends Seeder
{
    public function run(): void
    {
        // Inicializar Faker para generar datos ficticios
        $faker = Faker::create();

        // Obtener IDs de aerolíneas y ofertas existentes
        $aerolineaIds = \App\Models\Aerolinea::pluck('id')->toArray();
        $ofertaIds = \App\Models\Oferta::pluck('id')->toArray();
        // Obtener la lista de imágenes en la carpeta public/images/Destinos
        $imagenes = glob(public_path('images/Destinos/*.{jpg}'), GLOB_BRACE);

        // Generar 100 vuelos
        for ($i = 0; $i < 100; $i++) {

            $hora = $faker->time('H:i:s'); // Generar hora inicial aleatoria
            $horasDeVuelo = $faker->numberBetween(1, 4); // Duración del vuelo en horas
            $horaFinVuelo = date('H:i:s', strtotime($hora . ' + ' . $horasDeVuelo . ' hours')); // Calcular hora final

            // Calcular la duración del viaje en formato H:i:s
            $duracionDelViaje = gmdate('H:i', strtotime($horaFinVuelo) - strtotime($hora));
            
            DB::table('vuelos')->insert([
                'fecha' => $faker->dateTimeBetween('-1 month', '+6 months')->format('Y-m-d'), // Fechas entre hace 1 mes y dentro de 6 meses                
                'hora' => $hora, // Horas aleatorias
                'horaFinVuelo' => $horaFinVuelo, // Hora final del vuelo
                'duracionDelViaje' => $duracionDelViaje, // Duración del viaje en formato H:i:s
                'origen' => $faker->randomElement(['Madrid', 'Barcelona', 'Londres', 'París', 'Berlín']), // Orígenes fijos
                'destino' => $faker->randomElement(['Nueva York', 'Tokio', 'Roma', 'Moscú', 'Dubai']), // Destinos fijos
                'precio' => $faker->randomFloat(2, 100, 1000), // Precios entre 100 y 1000 con 2 decimales
                'clase' => $faker->randomElement(['Primera Clase', 'Ejecutiva', 'Económica']),
                'aerolinea_id' => $faker->randomElement($aerolineaIds), // ID de aerolínea aleatorio
                'oferta_id' => $faker->optional(0.3)->randomElement($ofertaIds), // 30% de los vuelos tendrán oferta
                'urlImgDestino' => asset('images/Destinos/' . basename($faker->randomElement($imagenes))), // URL completa con asset()
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}