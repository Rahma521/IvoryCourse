<?php

namespace Database\Seeders;

use App\Models\Courses\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::create([

            'name_ar' => 'قسم الإسعافات الأولية',
            'name_en' => 'First Aid Section',
            'description_ar' => 'قسم متخصص في الإسعافات الأولية.',
            'description_en' => 'A section specialized in first aid.',
        ]);

        // Insert the second row
        Section::create([
            //  'parent_id' => 1, // Assuming this section is a child of the first one
            'name_ar' => 'قسم ثانوي',
            'name_en' => 'Secondary Section',
            'description_ar' => 'قسم ثانوي تابع لقسم الإسعافات الأولية.',
            'description_en' => 'A secondary section under the First Aid Section.',
        ]);
    }
}
