<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSystemusersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('systemusers', function(Blueprint $table)
		{
			$table->bigInteger('Userid', true);
			$table->integer('station')->default(1);
			$table->string('region_zone', 30)->nullable()->comment('region or zone of the the user in charge of');
			$table->string('FirstName', 100);
			$table->string('SurName', 100);
			$table->string('UserName', 50);
			$table->string('UserPassword');
			$table->string('UserRole', 50);
			$table->string('UserEmail', 50);
			$table->string('UserPhone', 50);
			$table->boolean('Active', 1);
			$table->boolean('LoggedOn', 1)->nullable();
			$table->boolean('Reset', 1);
			$table->dateTime('LastPasswdChange');
			$table->dateTime('LastLoggedIn');
			$table->string('CreatedBy', 100);
			$table->timestamp('CreationDate')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('systemusers');
	}

}
