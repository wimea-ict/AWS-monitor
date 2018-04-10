<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateStationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
<<<<<<< HEAD
        Schema::create('nodes', function (Blueprint $table) {
         
        $table->increments('node_id');
            $table->integer('station_id')->unsigned();
            $table->string('txt_key');
            $table->string('mac_address');
            $table->foreign('station_id')->references('station_id')->on('stations'); 
            $table->timestamps();
        });
=======
        //
>>>>>>> 9ab67d001672b87a9a98cf05e1d85285142d40e7
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
