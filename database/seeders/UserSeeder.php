<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'identification_number' => '123456789',
            'full_name' => 'admin admin',
            'phone_number' => '123456789',
            'address' => 'cra 123 falsa 123',
            'email' => 'admin@gmail.com',
            'password' => '123456789',
            'status' => 1,
        ]);
    }
}
