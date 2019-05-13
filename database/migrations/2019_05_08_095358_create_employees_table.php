<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('department_id');
            $table->string('position');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('patronymic')->nullable();
            $table->string('email');
            $table->string('mobile_number');
            $table->string('work_number');
            $table->string('extension_number');
            $table->timestamps();
            $table->softDeletes();

            $table->unique('email');
            $table->foreign('department_id')
                  ->references('id')
                  ->on('departments')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
