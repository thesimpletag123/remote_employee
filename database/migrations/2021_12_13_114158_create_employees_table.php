<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('user_id');
            $table->string('full_name');
            $table->string('contact_no')->nullable();
            $table->string('professional_field')->nullable();
            $table->string('skills')->nullable();
            $table->string('extra_skills')->nullable();
			$table->string('experience_in_month')->nullable();
			$table->string('resume')->nullable();
			$table->string('is_verified')->default('0');
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
        Schema::dropIfExists('employees');
    }
}
