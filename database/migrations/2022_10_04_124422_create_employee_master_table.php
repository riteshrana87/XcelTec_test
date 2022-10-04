<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeMasterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_master', function (Blueprint $table) {
            $table->bigIncrements('id')->comment("Primary Key");
            $table->bigInteger('department_id')->unsigned()->comment("Foreign Key - department");
            $table->foreign('department_id')->references('id')->on('department');
            $table->string('employee_name', 50)->nullable();
            $table->string('employee_work_email')->unique();
            $table->enum('status', array('inactive', 'active'))->default('active')->comment("inactive, active");
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_master');
    }
}
