<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDetectedAnalyzerProblemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('DetectedAnalyzerProblems', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('Problem', 200)->nullable();
			$table->string('Value', 20)->nullable();
			$table->string('NodeType')->nullable();
			$table->integer('stationID')->nullable();
			$table->timestamp('when_reported')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->dateTime('when_fixed')->nullable();
			$table->string('status', 200)->default('reported');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('DetectedAnalyzerProblems');
	}

}
