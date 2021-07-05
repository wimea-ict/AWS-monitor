<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStationProblemSettingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('station_problem_settings', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('problem_id')->unsigned()->index('problem_id')->comment('Problem ids must not be repeated for any given station i.e a station must not have a duplicated problem_id');
			$table->integer('station_id')->index('station_id');
			$table->integer('max_track_counter')->unsigned();
			$table->enum('report_method', array('sms','email','Both'));
			$table->integer('reporting_time_interval');
			$table->enum('criticality', array('Critical','Non Critical'));
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
		Schema::drop('station_problem_settings');
	}

}
