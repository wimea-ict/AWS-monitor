<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataBunblesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_bunbles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('station_id');
            $table->string('mobile_number');
            $table->date("end_date");
            $table->timestamps();
            $table->foreign('station_id')->references('station_id')->on('stations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_bunbles');
    }
}
