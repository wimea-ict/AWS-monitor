<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToMailLists extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('maillist', function (Blueprint $table) {
            $table->foreign('userID')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('stationID')->references('station_id')->on('stations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('maillist', function (Blueprint $table) {
            $table->dropForeign('userID');
            $table->dropForeign('stationID');
        });
    }
}
