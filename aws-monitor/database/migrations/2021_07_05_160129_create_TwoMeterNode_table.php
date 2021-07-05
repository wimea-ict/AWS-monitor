<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTwoMeterNodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('TwoMeterNode', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('stationID')->default(111)->index('stationID');
			$table->string('RTC_T', 200)->nullable();
			$table->string('NAME', 200)->nullable();
			$table->string('E64', 200)->nullable();
			$table->string('T_SHT2X', 200)->nullable();
			$table->string('checked', 20)->default('default-value');
			$table->string('RH_SHT2X', 200)->nullable();
			$table->string('checkr', 200)->default('default-value');
			$table->string('RSSI', 200)->nullable();
			$table->string('TTL', 200)->nullable();
			$table->string('LQI', 200)->nullable();
			$table->string('V_IN', 200)->nullable();
			$table->string('V_MCU', 200)->nullable();
			$table->string('SEQ', 200)->nullable();
			$table->string('UP_TIME', 200)->nullable();
			$table->string('T', 200)->nullable();
			$table->string('DATE', 200)->nullable();
			$table->string('TIME', 200)->nullable();
			$table->string('Parameter checked', 200)->default('false');
			$table->string('Trend checked', 10)->default('false');
			$table->string('Ignore on calc trend', 10)->default('false')->comment('ignore row if its time difference is big to avoid wrong values');
			$table->float('hoursSinceEpoch', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('TwoMeterNode');
	}

}
