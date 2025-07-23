<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Frontend Development',
            'Backend Development',
            'Mobile Development',
            'Graphic Design',
            'Digital Marketing',
            'Cyber Security',
            'DevOps',
            'Data Science',
            'UI/UX Design'
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
