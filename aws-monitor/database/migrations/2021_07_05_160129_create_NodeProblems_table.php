<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNodeProblemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('NodeProblems', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('missingnode', 200);
			$table->string('timeofmissing', 200);
			$table->string('dateofmissing', 200);
			$table->string('status', 200);
			$table->string('frequency', 200);
			$table->string('sourcenode', 200);
			$table->string('sourcestation', 200);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('NodeProblems');
	}

}
