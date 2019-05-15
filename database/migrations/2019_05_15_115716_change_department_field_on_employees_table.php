<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDepartmentFieldOnEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function(Blueprint $table) {
            $table->dropForeign('employees_department_id_foreign');
            $table->dropColumn('department_id');
            $table->string('department')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function(Blueprint $table) {
            $table->dropColumn('department');
            $table->unsignedBigInteger('department_id')->after('id')->nullable();
            $table->foreign('department_id')
                ->references('id')
                ->on('departments');
        });
    }
}
