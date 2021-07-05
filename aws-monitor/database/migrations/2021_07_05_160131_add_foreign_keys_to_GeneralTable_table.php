<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGeneralTableTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('GeneralTable', function(Blueprint $table)
		{
			$table->foreign('stationID', 'Generaltable_stations_link')->references('station_id')->on('stations')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('GeneralTable', function(Blueprint $table)
		{
			$table->dropForeign('Generaltable_stations_link');
		});
	}

}
