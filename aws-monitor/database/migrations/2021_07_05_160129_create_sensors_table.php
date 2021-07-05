<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSensorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sensors', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('node_id')->unsigned();
			$table->enum('node_type', array('twoMeterNode','tenMeterNode','groundNode','sinkNode'))->comment('this should be the table of the node e.g twoMeterNode');
			$table->enum('sensor_status', array('on','off'));
			$table->string('parameter_read', 191);
			$table->string('identifier_used', 191);
			$table->string('min_value', 191);
			$table->string('max_value', 191);
			$table->string('report_time_interval', 191)->nullable()->default('12');
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
		Schema::drop('sensors');
	}

}
