<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $user_admin = User::create([
            'name' => fake()->name(),
            'email' => "admin@example.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => Role::whereStr('role_administrator')->first()->id, 

        ]);

        $user_normal = User::create([
            'name' => fake()->name(),
            'email' => "viewer@example.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
            'role_id' => Role::whereStr('role_viewer')->first()->id, 

        ]);
    }
}
