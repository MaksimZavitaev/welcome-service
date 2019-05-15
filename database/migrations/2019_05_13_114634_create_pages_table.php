<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Page;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('author_id');
            $table->unsignedInteger('category_id')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('title');
            $table->text('content');
            $table->text('announcement')->nullable();
            $table->text('video')->nullable();
            $table->text('block')->nullable();
            $table->json('steps')->nullable();
            $table->timestamps();

            $table->foreign('author_id')
                ->references('id')
                ->on('users');
        });

        Schema::create('employee_page', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('page_id');
            $table->text('content');
            $table->text('block');
            $table->json('steps');

            $table->foreign('employee_id')
                ->references('id')
                ->on('employees');
            $table->foreign('page_id')
                ->references('id')
                ->on('pages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_page');
        Schema::dropIfExists('pages');
    }
}
