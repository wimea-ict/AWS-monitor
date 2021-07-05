<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserlogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('userlogs', function(Blueprint $table)
		{
			$table->timestamp('Date')->default(DB::raw('CURRENT_TIMESTAMP'));
			$table->integer('id', true);
			$table->integer('station');
			$table->string('User', 30);
			$table->string('UserRole', 25);
			$table->string('Action', 50);
			$table->text('Details', 65535);
			$table->string('IP', 25)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('userlogs');
	}

}
