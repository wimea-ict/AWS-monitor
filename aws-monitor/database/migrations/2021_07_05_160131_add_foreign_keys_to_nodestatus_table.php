<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToNodestatusTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('nodestatus', function(Blueprint $table)
		{
			$table->foreign('station_id', 'nodestatus_ibfk_1')->references('station_id')->on('stations')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('nodestatus', function(Blueprint $table)
		{
			$table->dropForeign('nodestatus_ibfk_1');
		});
	}

}
