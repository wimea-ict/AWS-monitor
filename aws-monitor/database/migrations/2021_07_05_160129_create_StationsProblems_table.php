<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStationsProblemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('StationsProblems', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('missingstation', 200);
			$table->string('timeofmissing', 200);
			$table->string('dateofmissing', 200);
			$table->string('status', 200);
			$table->string('frequency', 200);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('StationsProblems');
	}

}
