<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSinkNodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('SinkNode', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('stationID')->default(111)->index('stationID');
			$table->string('RTC_T', 200);
			$table->string('NAME', 200)->nullable();
			$table->string('E64', 200)->nullable();
			$table->string('P_MS5611', 200)->nullable();
			$table->string('V_IN', 200)->nullable();
			$table->string('V_MCU', 200)->nullable();
			$table->string('UP_TIME', 200)->nullable();
			$table->string('T', 200)->nullable();
			$table->string('SEQ', 200)->nullable();
			$table->string('DATE', 200)->nullable();
			$table->string('TIME', 200)->nullable();
			$table->string('parameterChecked', 200)->default('false');
			$table->string('Ignore on calc trend', 10)->default('false')->comment('ignore row if its time difference is big to avoid wrong values');
			$table->string('Trend checked', 10)->default('false');
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
		Schema::drop('SinkNode');
	}

}
