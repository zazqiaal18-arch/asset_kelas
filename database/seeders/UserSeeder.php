<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'           => 'Administrator',
                'email'          => 'admin@gmail.com',
                'password'       => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'name'           => 'User Test',
                'email'          => 'user@gmail.com',
                'password'       => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}