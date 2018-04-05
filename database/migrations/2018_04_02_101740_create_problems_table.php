<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('problems', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('source',["2m_node","10m_node","sink_node","ground_node","sensor","station"]);
            $table->string('source_id');// for node(tableName_txtValue)
            $table->enum('criticality',["critical","non-critical"]);
            $table->integer('classification_id')->unsigned();
            $table->enum('status',["reported","investigation","solved"]);
            $table->timestamps();
        });

        Schema::table('problems', function (Blueprint $table) {
            // $table->foreign('description_id')->references('id')->on('problem_classification');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('problems');
    }
}
