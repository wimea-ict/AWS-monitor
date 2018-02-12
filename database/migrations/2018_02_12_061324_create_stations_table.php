<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stations', function (Blueprint $table) {
            $table->increments('station_id');
            $table->string('station_name');
            $table->string('station_location');
            $table->double('longitude');
            $table->double('latitude');
            $table->string('station_number');
            $table->string('location');
            $table->string('city');
            $table->string('region');
            $table->string('code');
            $table->dateTime('date_opened');
            $table->dateTime('date_closed');
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
        Schema::dropIfExists('stations');
    }
}
