<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAwsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('aws', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->date('Date')->nullable();
			$table->time('Time')->nullable();
			$table->string('StationName', 25)->nullable();
			$table->bigInteger('StationNumber');
			$table->string('TXT')->nullable();
			$table->string('E64')->nullable();
			$table->integer('IdOfTransmittingNode')->nullable();
			$table->integer('Temperature')->nullable();
			$table->integer('SoilTemperature')->nullable();
			$table->integer('T_mcu')->nullable();
			$table->string('V_MCU')->nullable();
			$table->integer('P0')->nullable();
			$table->integer('P0_lst60_02')->nullable();
			$table->integer('P1')->nullable();
			$table->integer('P1_t')->nullable();
			$table->integer('P1_lst')->nullable();
			$table->integer('Uptime')->nullable();
			$table->string('Error')->nullable();
			$table->integer('V_IN')->nullable();
			$table->integer('A1')->nullable();
			$table->integer('A2')->nullable();
			$table->integer('A3')->nullable();
			$table->integer('GW_LON')->nullable();
			$table->integer('GW_LAT')->nullable();
			$table->integer('P_MS5611')->nullable();
			$table->integer('UT')->nullable();
			$table->integer('RH_SHT2X')->nullable();
			$table->integer('T_SHT2X')->nullable();
			$table->integer('ADC1')->nullable();
			$table->integer('ADC2')->nullable();
			$table->string('DOMAIN', 25)->nullable();
			$table->string('TZ', 25)->nullable();
			$table->string('UP', 25)->nullable();
			$table->integer('T')->nullable();
			$table->string('PS')->nullable();
			$table->string('RH')->nullable();
			$table->integer('V_a1')->nullable();
			$table->integer('P0_T')->nullable();
			$table->integer('V_A1_V_A2_005_400')->nullable();
			$table->integer('V_AD1_100')->nullable();
			$table->integer('V_AD2_100')->nullable();
			$table->integer('V_AD3_100')->nullable();
			$table->integer('V_AD1_1000')->nullable();
			$table->integer('V_AD2_1000')->nullable();
			$table->integer('V_AD3_1000')->nullable();
			$table->string('ADDR')->nullable();
			$table->string('V_AD1')->nullable();
			$table->string('V_AD2')->nullable();
			$table->string('V_AD3')->nullable();
			$table->string('SEQ')->nullable();
			$table->string('TTL')->nullable();
			$table->string('RSSI')->nullable();
			$table->string('LQI')->nullable();
			$table->string('DRP')->nullable();
			$table->string('SRC')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('aws');
	}

}
