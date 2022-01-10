<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
			$table->string('job_title');
			$table->string('required_skills');
			$table->string('hourly_rate_min')->nullable();
			$table->string('hourly_rate_max')->nullable();
			$table->string('project_budget')->nullable();
			$table->longText('project_description')->nullable();
			$table->string('invoice_attachment')->nullable();
			$table->string('other_attachment')->nullable();
			$table->string('posted_by_username');
			$table->integer('posted_by_id');
			$table->string('assigned_to_username')->nullable();
			$table->string('assigned_to_id')->nullable();
			$table->date('deadline')->nullable();
			$table->boolean('is_project_approved')->default('0');
			
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
        Schema::dropIfExists('job_posts');
    }
}
