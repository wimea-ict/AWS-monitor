<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaillistTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('maillist', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->unsignedInteger('userID')->nullable();
			$table->integer('stationID')->nullable();
			$table->boolean('status')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('maillist');
	}

}
