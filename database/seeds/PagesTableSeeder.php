<?php

use Illuminate\Database\Seeder;
use App\Models\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::firstOrCreate(['slug' => 'home',],
        [
            'title' => 'Главная',
            'content' => 'Content',
            'announcement' => 'Анонс',
            'video' => 'Видео',
        ]);
        Page::firstOrCreate(['slug' => 'first_day',],
        [
            'title' => '1-й день в компании',
            'content' => 'Content',
            'block' => 'Текст блока',
            'steps' => [
                'Прийти в офис',
                'Пройти на стойку регистрации',
            ],
        ]);
    }
}
