<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate([
            "username" => "admin"
        ], [
            "name" => "Admin", 
            "email"=> "admin@test.com",
            "password"=> bcrypt("123456")
        ]);
    }
}
