<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $useradmin = User::create([
            "name" => "admin",
            "email" => "admin@gmail.com",
            "password"=> bcrypt('admin'),
            "role" => "admin"
        ]);

        $useremployee = User::create([
            "name" => "employee",
            "email" => "kasir@gmail.com",
            "password"=> bcrypt('kasir'),
            "role" => "employee"
        ]);
    }
}