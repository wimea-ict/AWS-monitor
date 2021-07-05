<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGroundNodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('GroundNode', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('stationID')->default(111)->index('stationID');
			$table->string('RTC_T', 200)->nullable();
			$table->string('NAME', 200)->nullable();
			$table->string('E64', 200)->nullable();
			$table->string('V_A1', 200)->nullable();
			$table->string('V_A2', 200)->nullable();
			$table->string('P0_LST60', 200)->nullable();
			$table->string('T1', 200)->nullable();
			$table->string('RSSI', 200)->nullable();
			$table->string('TTL', 200)->nullable();
			$table->string('LQI', 200)->nullable();
			$table->string('SEQ', 200)->nullable();
			$table->string('UP_TIME', 200)->nullable();
			$table->string('T', 200)->nullable();
			$table->string('V_IN', 200)->nullable();
			$table->string('V_MCU', 200)->nullable();
			$table->string('DATE', 200)->nullable();
			$table->string('TIME', 200)->nullable();
			$table->string('Parameter checked', 200)->default('false');
			$table->string('Trend checked', 10)->nullable()->default('false');
			$table->string('Ignore on calc trend', 10)->default('false');
			$table->float('hoursSinceEpoch', 10, 0)->nullable();
			$table->string('P0_LST', 200)->nullable();
			$table->float('P', 10, 0)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('GroundNode');
	}

}
