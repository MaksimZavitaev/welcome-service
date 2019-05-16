<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Category;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable();
            $table->string('slug')->unique();
            $table->string('title');
            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('categories');
        });

        $categories = collect();

        foreach([
            'general' => 'Общая информация',
            'corporate_live' => 'Корпоративная жизнь',
        ] as $slug => $title) {
            $categories->push(Category::create([
                'slug' => $slug,
                'title' => $title,
            ]));
        }

        $parent = $categories->firstWhere('slug', 'corporate_live');
        foreach([
            'articles' => 'Статьи',
            'news' => 'Новости',
            'videos' => 'Видео',
        ] as $slug => $title) {
            $categories->push(Category::create([
                'parent_id' => $parent->id,
                'slug' => $slug,
                'title' => $title,
            ]));
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
