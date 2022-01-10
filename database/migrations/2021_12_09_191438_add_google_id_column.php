<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoogleIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::table('users', function ($table) {
            $table->string('google_id')->nullable();
            $table->string('linkedin_id')->nullable();
            $table->string('user_type')->nullable();
            $table->string('country')->nullable();
            $table->boolean('is_verified')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
