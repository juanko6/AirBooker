<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clientes')->delete();

        DB::table('clientes')->insert([
            'nombre' => 'Paco',
            'apellidos' => 'Garcia Martinez',
            'telefono' => '8362746762',
            'dni' => '727S',
            'pasaporte' => '732g32gy3yg3',
            'email' => 'paco@gmail.com'
        ]);
    }
}
