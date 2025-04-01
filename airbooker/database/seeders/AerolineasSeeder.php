<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AerolineasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Array con los datos de las aerolíneas        
        $aerolineas = [
            [
            'nombre' => 'American Airlines',
            'paisOrigen' => 'Estados Unidos',
            'contacto' => '+1 800-433-7300',
            'sitio_web' => 'https://www.aa.com',
            'urlLogo' => '/images/aerolinias/AmericanAirlines.svg'
            ],
            [
            'nombre' => 'Delta Air Lines',
            'paisOrigen' => 'Estados Unidos',
            'contacto' => '+1 800-221-1212',
            'sitio_web' => 'https://www.delta.com',
            'urlLogo' => '/images/aerolinias/DeltaAirLines.webp'
            ],
            [
            'nombre' => 'United Airlines',
            'paisOrigen' => 'Estados Unidos',
            'contacto' => '+1 800-864-8331',
            'sitio_web' => 'https://www.united.com',
            'urlLogo' => '/images/aerolinias/UnitedAirlines.png'
            ],
            [
            'nombre' => 'Lufthansa',
            'paisOrigen' => 'Alemania',
            'contacto' => '+49 69 86799799',
            'sitio_web' => 'https://www.lufthansa.com',
            'urlLogo' => '/images/aerolinias/Lufthansa.png'
            ],
            [
            'nombre' => 'Emirates',
            'paisOrigen' => 'Emiratos Árabes Unidos',
            'contacto' => '+971 600 555 555',
            'sitio_web' => 'https://www.emirates.com',
            'urlLogo' => '/images/aerolinias/EmiratesDubai.png'
            ],
            [
            'nombre' => 'Qatar Airways',
            'paisOrigen' => 'Catar',
            'contacto' => '+974 4023 0000',
            'sitio_web' => 'https://www.qatarairways.com',
            'urlLogo' => '/images/aerolinias/QatarAirways.png'
            ],
            [
            'nombre' => 'Air France',
            'paisOrigen' => 'Francia',
            'contacto' => '+33 892 702 702',
            'sitio_web' => 'https://www.airfrance.com',
            'urlLogo' => '/images/aerolinias/AirFrance.png'
            ],
            [
            'nombre' => 'British Airways',
            'paisOrigen' => 'Reino Unido',
            'contacto' => '+44 344 493 0787',
            'sitio_web' => 'https://www.britishairways.com',
            'urlLogo' => '/images/aerolinias/BritishAirways.png'
            ],
            [
            'nombre' => 'LATAM Airlines',
            'paisOrigen' => 'Chile',
            'contacto' => '+56 2 2690 1111',
            'sitio_web' => 'https://www.latamairlines.com',
            'urlLogo' => '/images/aerolinias/LATAMAirlines.png'
            ],
            [
            'nombre' => 'Iberia',
            'paisOrigen' => 'España',
            'contacto' => '+34 901 111 000',
            'sitio_web' => 'https://www.iberia.com',
            'urlLogo' => '/images/aerolinias/Iberia.png'
            ],
        ];

        // Insertar los datos en la tabla aerolineas
        DB::table('aerolineas')->insert($aerolineas);
    }
}
