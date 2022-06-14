<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ip_configs', function (Blueprint $table) {
            $table->id();
			$table->string('ip')->unique();
			$table->string('countryName')->nullable();
			$table->string('countryCode')->nullable();
			$table->string('regionCode')->nullable();
			$table->string('regionName')->nullable();
			$table->string('cityName')->nullable();
			$table->string('zipCode')->nullable();
			$table->string('isoCode')->nullable();
			$table->string('postalCode')->nullable();
			$table->string('latitude')->nullable();
			$table->string('longitude')->nullable();
			$table->string('metroCode')->nullable();
			$table->string('areaCode')->nullable();
			$table->string('timezone')->nullable();
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
        Schema::dropIfExists('ip_configs');
    }
}
