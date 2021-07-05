<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToGroundNodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('GroundNode', function(Blueprint $table)
		{
			$table->foreign('stationID', 'Groundnode_stations_link')->references('station_id')->on('stations')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('GroundNode', function(Blueprint $table)
		{
			$table->dropForeign('Groundnode_stations_link');
		});
	}

}
