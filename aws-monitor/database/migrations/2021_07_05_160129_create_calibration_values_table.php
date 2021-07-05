<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCalibrationValuesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('calibration_values', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('confidence_level', 100);
			$table->string('coefficient_m', 100);
			$table->string('coefficient_c', 100);
			$table->string('station_parameter', 100);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('calibration_values');
	}

}
