<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChangeTrackerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ChangeTracker', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('stationID')->comment('id of the station in the stations table');
			$table->string('time_of_last_running_analyzer', 200);
			$table->string('Node', 100)->comment('node on which the change was detected');
			$table->string('change_in_minutes', 200)->comment('e.g from 5 to20');
			$table->string('time_range_when_change_occured', 200);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ChangeTracker');
	}

}
