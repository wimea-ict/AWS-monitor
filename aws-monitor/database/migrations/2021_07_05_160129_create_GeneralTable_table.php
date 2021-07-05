<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGeneralTableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('GeneralTable', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('stationID')->default(111)->index('stationID');
			$table->string('RTC_T', 200)->nullable();
			$table->string('V_BAT', 200)->nullable();
			$table->string('SOC', 200)->nullable();
			$table->string('V_MCRTC_T', 200)->nullable();
			$table->string('REPS', 200)->nullable();
			$table->string('DATE_OF_DB_INSERTION', 200)->nullable();
			$table->string('TIME_OF_DB_INSERTION', 200)->nullable();
			$table->string('stationname', 200)->nullable();
			$table->float('hoursSinceEpoch_of_db_insertion', 10, 0)->nullable();
			$table->string('DATE', 200)->nullable();
			$table->string('TIME', 200)->nullable();
			$table->string('hoursSinceEpoch', 200)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('GeneralTable');
	}

}
