<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Option;

class CreateOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('options', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key')->unique();
            $table->string('name');
            $table->json('values');
            $table->timestamps();
        });

        Option::create([
            'key' => 'footer.links',
            'name' => 'Ссылки футера',
            'values' => [
                [
                    'title' => 'Внутренний портал',
                    'link' => '#',
                ],
            ],
        ]);
        Option::create([
            'key' => 'footer.phones',
            'name' => 'Телефоны футера',
            'values' => [
                [
                    'title' => 'Единый номер колл-центра',
                    'phone' => '9933'
                ]
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('options');
    }
}
