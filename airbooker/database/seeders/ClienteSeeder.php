<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('cliente')->delete();

        DB::table('cliente')->insert([
            'nombre' => 'Paco',
            'apellidos' => 'Garcia Martinez',
            'telefono' => '8362746762',
            'dni' => '7268472387S',
            'pasaporte' => '732g32gy3yg3',
            'email' => 'paco@gmail.com'
        ]);
    }
}
