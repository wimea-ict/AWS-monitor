<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateElementsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('elements', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('ElementName', 30);
			$table->string('InstrumentName', 30);
			$table->integer('station')->comment('foreign key');
			$table->string('Abbrev', 10)->nullable();
			$table->string('Type', 30)->nullable();
			$table->string('Units', 30)->nullable();
			$table->string('Scale', 30)->nullable();
			$table->string('Limits', 30)->nullable();
			$table->string('Description', 30)->nullable();
			$table->string('SubmittedBy', 30);
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
		Schema::drop('elements');
	}

}
