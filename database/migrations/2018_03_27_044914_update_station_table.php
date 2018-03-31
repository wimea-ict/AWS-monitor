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
<<<<<<< HEAD:database/migrations/2018_02_12_061442_create_nodes_table.php
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
<<<<<<< HEAD
>>>>>>> c74096c27d46aa298943fc215473d7b325a29b78:database/migrations/2018_03_27_044914_update_station_table.php
=======
>>>>>>> 24f6d5374d5eee5f07465fc9e76e26003c2819b6:database/migrations/2018_03_27_044914_update_station_table.php
>>>>>>> bc8fd876f56ad734d92d6bad43dfd59fed7250e7
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
