<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElectronTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Electron', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('RTC_T', 200)->nullable();
			$table->integer('V_BAT')->nullable();
			$table->integer('SOC')->nullable();
			$table->string('stationname', 20)->nullable();
			$table->integer('stationID')->default(111)->index('stationID');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('Electron');
	}

}
