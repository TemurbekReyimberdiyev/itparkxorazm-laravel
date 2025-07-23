<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::insert([
            [
                'heading' => 'IT Park Xorazm rasmiy ish boshladi',
                'description' => 'Xorazmda yangi zamonaviy IT markazi ishga tushdi. Bu markaz yoshlarga texnologiyalarni o‘rgatishga qaratilgan.',
                'image_url' => 'https://via.placeholder.com/600x400',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'heading' => 'Frontend Bootcamp boshlandi',
                'description' => 'Frontend kursida HTML, CSS, JavaScript va Vue 3 texnologiyalari o‘rgatiladi.',
                'image_url' => 'https://via.placeholder.com/600x400',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'heading' => 'Yangi kurslar ro‘yxati e’lon qilindi',
                'description' => '2025-yil 1-avgustdan boshlab yangi kurslar ochiladi. Ro‘yxatdan o‘ting!',
                'image_url' => 'https://via.placeholder.com/600x400',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
