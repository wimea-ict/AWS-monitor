<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProblemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('problems', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('stationID', 191);
			$table->enum('criticality', array('Critical','Non Critical'))->nullable();
			$table->integer('classification_id')->unsigned()->index('classification_id');
			$table->string('status', 200)->default('reported');
			$table->string('NodeType', 191)->nullable();
			$table->string('Value', 191)->nullable();
			$table->dateTime('when_reported')->nullable();
			$table->dateTime('when_fixed')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('problems');
	}

}
