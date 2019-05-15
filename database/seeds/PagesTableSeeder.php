<?php

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\User;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author = User::where('name', 'Admin')->first();
        Page::firstOrCreate(['slug' => 'home',],
        [
            'author_id' => $author->id,
            'title' => 'Главная',
            'content' => 'Content',
            'announcement' => 'Анонс',
            'video' => 'Видео',
        ]);
        Page::firstOrCreate(['slug' => 'first_day',],
        [
            'author_id' => $author->id,
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
