<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodeStatusConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('node_status_configurations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('node_id')->unsigned();
            $table->enum('node_type',["twoMeterNode","tenMeterNode","groundNode","sinkNode"])->comment('this should be the table of the node e.g twoMeterNode');
            $table->double('v_in_min_value');
            $table->double('v_in_max_value');
            $table->double('v_mcu_min_value');
            $table->double('v_mcu_max_value');
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
        Schema::dropIfExists('node_status_configurations');
    }
}
