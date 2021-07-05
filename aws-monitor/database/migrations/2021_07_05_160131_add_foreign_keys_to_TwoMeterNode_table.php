<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTwoMeterNodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('TwoMeterNode', function(Blueprint $table)
		{
			$table->foreign('stationID', 'Twometer_stations_link')->references('station_id')->on('stations')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('TwoMeterNode', function(Blueprint $table)
		{
			$table->dropForeign('Twometer_stations_link');
		});
	}

}
