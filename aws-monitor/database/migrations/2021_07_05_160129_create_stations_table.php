<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('stations', function(Blueprint $table)
		{
			$table->integer('station_id', true);
			$table->string('StationName', 30)->nullable();
			$table->string('StationNumber', 30)->nullable();
			$table->string('StationRegNumber', 30)->nullable();
			$table->string('Location', 50)->nullable();
			$table->string('Indicator', 30)->nullable();
			$table->string('StationRegion', 30)->nullable();
			$table->string('Country', 30)->default('Uganda');
			$table->float('Latitude', 10, 0)->nullable();
			$table->float('Longitude', 10, 0)->nullable();
			$table->float('Altitude', 10, 0)->nullable();
			$table->enum('StationStatus', array('on','off'))->default('on');
			$table->string('StationType', 30)->nullable();
			$table->dateTime('Opened')->nullable();
			$table->date('Closed')->nullable();
			$table->string('SubmittedBy', 30)->nullable();
			$table->timestamp('Creation_Date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('UpdateDate')->nullable();
			$table->enum('stationCategory', array('manual','aws'))->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('stations');
	}

}
