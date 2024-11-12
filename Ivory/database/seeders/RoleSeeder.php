<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name_ar' => 'admin',
            'name_en' => 'admin',
            'guard' => 'admin',
        ]);
    }
}
