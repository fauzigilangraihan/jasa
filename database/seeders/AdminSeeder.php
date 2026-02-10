<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin fauziDev',
            'email' => 'admin@fauzidev.com',
            'password' => Hash::make('admin123456'),
            'role' => 'admin',
            'phone' => '+62812345678',
            'is_active' => true,
        ]);

        User::create([
            'name' => 'Test Customer',
            'email' => 'customer@test.com',
            'password' => Hash::make('customer123'),
            'role' => 'client',
            'company_name' => 'Test Company',
            'phone' => '+62812987654',
            'is_active' => true,
        ]);
    }
}
