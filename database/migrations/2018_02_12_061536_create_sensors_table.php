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
            $table->integer('node_id');
            $table->string('parameter_read');
            $table->string('identifier_used');
            $table->string('min_value');
            $table->string('max_value');
            $table->enum('node_type',["2m_node","10m_node","grnd_node","sink_node"]);
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
