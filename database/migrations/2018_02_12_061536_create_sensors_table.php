<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensors', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('node_id')->unsigned();
            $table->enum('node_type',["twoMeterNode","tenMeterNode","groundNode","sinkNode"])->comment('this should be the table of the node e.g twoMeterNode');
            $table->string('parameter_read');
            $table->string('identifier_used');
            $table->string('min_value');
            $table->string('max_value');
            $table->string('report_time_interval');
            $table->enum('sensor_status',["off","on"]);
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
        Schema::dropIfExists('sensors');
    }
}
