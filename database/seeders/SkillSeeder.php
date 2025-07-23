<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Skill::insert([
            [
                'name' => 'Laravel',
                'image_url' => 'https://cdn-icons-png.flaticon.com/512/919/919830.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vue.js',
                'image_url' => 'https://cdn-icons-png.flaticon.com/512/6132/6132221.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Git',
                'image_url' => 'https://cdn-icons-png.flaticon.com/512/733/733553.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'JavaScript',
                'image_url' => 'https://cdn-icons-png.flaticon.com/512/5968/5968292.png',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tailwind CSS',
                'image_url' => 'https://upload.wikimedia.org/wikipedia/commons/d/d5/Tailwind_CSS_Logo.svg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
