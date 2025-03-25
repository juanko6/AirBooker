<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        /*
        User::query()->delete();
        User::query()->create([
            "name"=> "Test User",
            "email"=> ""    ,   
            "password"=> bcrypt("password"),
            "email_verified_at"=> now(),
            "remember_token"=> Str::random(10),
        ]);     
        User::query()->create([ 
            "name"=> "Test User",
            "email"=> "
            password"=> bcrypt("password"),
            "email_verified_at"=> now(),
            "remember_token"=> Str::random(10),
        ]); 
        
        User::query()->create([ 
            "name"=> "Test User",
            "email"=> "
            password"=> bcrypt("password"),
            "email_verified_at"=> now(),
            "remember_token"=> Str::random(10),
        ]);
        */
    }
}
