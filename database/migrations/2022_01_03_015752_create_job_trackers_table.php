<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTrackersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_trackers', function (Blueprint $table) {
            $table->id();
			$table->integer('jobid');
			$table->integer('user_id');
			$table->string('jobupdate_headline');
			$table->longText('jobupdate_description');
			$table->string('jobupdate_time');
			$table->string('jobupdate_status')->nullable();
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
        Schema::dropIfExists('job_trackers');
    }
}
