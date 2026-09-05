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
                'remember_token' => Str::random(10),
            ],
            [
                'name'           => 'User Test',
                'email'          => 'user@gmail.com',
                'password'       => Hash::make('password123'),
                'remember_token' => Str::random(10),
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                array_merge($user, ['updated_at' => now()])
            );
        }
    }
}