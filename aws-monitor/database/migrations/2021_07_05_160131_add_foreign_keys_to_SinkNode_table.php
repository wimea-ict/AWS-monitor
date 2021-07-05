<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToSinkNodeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('SinkNode', function(Blueprint $table)
		{
			$table->foreign('stationID', 'Sinknode_stations_link')->references('station_id')->on('stations')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('SinkNode', function(Blueprint $table)
		{
			$table->dropForeign('Sinknode_stations_link');
		});
	}

}
