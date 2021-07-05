<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToTenMeterNodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('TenMeterNode', function(Blueprint $table)
		{
			$table->foreign('stationID', 'Tenmeter_stations_link')->references('station_id')->on('stations')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('TenMeterNode', function(Blueprint $table)
		{
			$table->dropForeign('Tenmeter_stations_link');
		});
	}

}
