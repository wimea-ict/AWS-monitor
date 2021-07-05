<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUploadsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('uploads', function(Blueprint $table)
		{
			$table->increments('id');
			$table->dateTime('datetime')->nullable();
			$table->float('rh_wimea')->nullable();
			$table->float('rh_unma')->nullable();
			$table->float('sol_wimea')->nullable();
			$table->float('sol_unma')->nullable();
			$table->float('temp_wimea')->nullable();
			$table->float('temp_unma')->nullable();
			$table->float('press_wimea')->nullable();
			$table->float('press_unma')->nullable();
			$table->string('station', 191)->nullable();
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('uploads');
	}

}
