<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(SectionSeeder::class);

       // $this->call(CoursesSeeder::class);
        //$this->call(ChaptersSeeder::class);

    }
}
