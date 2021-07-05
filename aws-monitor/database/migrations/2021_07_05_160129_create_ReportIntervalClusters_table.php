<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReportIntervalClustersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ReportIntervalClusters', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('stationID')->comment('station id from stations table');
			$table->string('Node', 200)->comment('the node that generated the clusters');
			$table->string('time_of_last_running_analyzer', 200);
			$table->string('cluster', 10000)->comment('actuall cluster generated for the table');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ReportIntervalClusters');
	}

}
