<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin',
            'phone' => '987654321',
            'email' => 'admin@admin.com',
            'role' => 1,
            'status' => 'Active',
            'theme_mode' => 'light',
            'language' => 'ar',
            'password' => bcrypt('123456789'),
            'email_verified_at' => now(),
        ]);
    }
}
