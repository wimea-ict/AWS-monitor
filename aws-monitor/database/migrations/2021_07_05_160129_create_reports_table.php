<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReportsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reports', function(Blueprint $table)
		{
			$table->increments('report_id');
			$table->integer('problem_id');
			$table->string('message', 2000);
			$table->timestamp('datetime')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('report_counter');
			$table->integer('station_id')->nullable();
			$table->string('node', 20)->nullable();
			$table->string('sensor', 30)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reports');
	}

}
