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
        $users = [
            [
                'name'           => 'Administrator',
                'email'          => 'admin@gmail.com',
                'password'       => Hash::make('password123'),
                'google_id'      => null,
                'role'           => 'admin',
                'remember_token' => Str::random(10),
            ],
            [
                'name'           => 'User Test',
                'email'          => 'user@gmail.com',
                'password'       => Hash::make('password123'),
                'google_id'      => null,
                'role'           => 'user', // Ubah ke 'user' jika perannya sebagai user biasa
                'remember_token' => Str::random(10),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                array_merge($user, [
                    'created_at' => now(),
                    'updated_at' => now(),
                ])
            );
        }
    }
}
