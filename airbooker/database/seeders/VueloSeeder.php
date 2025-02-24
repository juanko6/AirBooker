<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VueloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vuelos')->delete();

        DB::table('vuelos')->insert([
            'fecha' => '12-4-2025',
            'hora' => '12:00',
            'id' => '83622',
            'origen' => 'alicante',
            'destino' => 'galicia'
        ]);
    }
}
