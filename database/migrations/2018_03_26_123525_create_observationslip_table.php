<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObservationslipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observationslip', function (Blueprint $table) {
            $table->increments('id');
            $table->date('Date');
            $table->integer('Station')->unsigned();
            $table->string('TIME', 10);
            $table->integer('TotalAmountOfAllClouds');//int(11)
            $table->integer('TotalAmountOfLowClouds');
            $table->integer('TypeOfLowClouds1');//int(2)
            $table->integer('OktasOfLowClouds1');
            $table->integer('HeightOfLowClouds1');
            $table->string('CLCODEOfLowClouds1', 10)->default('00');
            $table->integer('TypeOfLowClouds2');
            $table->integer('OktasOfLowClouds2');
            $table->integer('HeightOfLowClouds2');
            $table->string('CLCODEOfLowClouds2');
            $table->integer('TypeOfLowClouds3');
            $table->integer('OktasOfLowClouds3');
            $table->integer('HeightOfLowClouds3');
            $table->string('CLCODEOfLowClouds3', 255);
            $table->integer('TypeOfMediumClouds1');
            $table->integer('OktasOfMediumClouds1');
            $table->integer('HeightOfMediumClouds1');
            $table->string('CLCODEOfMediumClouds1', 10);
            $table->integer('TypeOfMediumClouds2');
            $table->integer('OktasOfMediumClouds2');
            $table->integer('HeightOfMediumClouds2');
            $table->string('CLCODEOfMediumClouds2', 10);
            $table->integer('TypeOfMediumClouds3');
            $table->integer('OktasOfMediumClouds3');
            $table->integer('HeightOfMediumClouds3');
            $table->string('CLCODEOfMediumClouds3', 11);
            $table->integer('TypeOfHighClouds1');
            $table->integer('OktasOfHighClouds1');
            $table->integer('HeightOfHighClouds1');
            $table->string('CLCODEOfHighClouds1', 10);
            $table->integer('TypeOfHighClouds2');
            $table->integer('OktasOfHighClouds2');
            $table->integer('HeightOfHighClouds2');
            $table->string('CLCODEOfHighClouds2', 10);
            $table->integer('TypeOfHighClouds3');
            $table->integer('OktasOfHighClouds3');
            $table->integer('HeightOfHighClouds3');
            $table->string('CLCODEOfHighClouds3', 10);
            $table->double('CloudSearchLightReading');
            $table->string('Rainfall', 10);
            $table->string('Dry_Bulb', 10);
            $table->string('Wet_Bulb', 10);
            $table->double('Max_Read');
            $table->double('Max_Reset');
            $table->double('Min_Read');
            $table->double('Min_Reset');
            $table->double('Piche_Read');
            $table->double('Piche_Reset');
            $table->double('TimeMarksThermo');
            $table->double('TimeMarksHygro');
            $table->double('TimeMarksRainRec');
            $table->string('Present_Weather', 100);
            $table->string('Present_WeatherCode', 25);
            $table->string('Past_Weather', 25);
            $table->double('Visibility');
            $table->string('Wind_Direction', 10);
            $table->string('Wind_Speed', 10);
            $table->double('Gusting');
            $table->double('AttdThermo');
            $table->double('PrAsRead');
            $table->double('Correction');
            $table->string('CLP', 10);
            $table->double('MSLPr');
            $table->double('TimeMarksBarograph');
            $table->double('TimeMarksAnemograph');
            $table->string('OtherTMarks', 125);
            $table->string('Remarks', 100);
            $table->string('SubmittedBy', 10);
            $table->tinyInteger('Approved')->default('0');//tinyint(1)
            $table->dateTime('creation_date')->useCurrent();//use CURRENT_TIMESTAMP as default value
            $table->string('SoilMoisture', 10);
            $table->string('SoilTemperature', 10);
            $table->string('sunduration', 25);
            $table->string('trend', 50);
            $table->string('windrun', 25);
            $table->enum('speciormetar', ['metar', 'speci']);
            $table->string('UnitOfWindSpeed', 30);
            $table->string('IndOrOmissionOfPrecipitation', 30);
            $table->string('TypeOfStation_Present_Past_Weather', 30);
            $table->string('HeightOfLowestCloud', 30);
            $table->string('StandardIsobaricSurface', 30);
            $table->string('GPM', 30);
            $table->string('DurationOfPeriodOfPrecipitation', 30);
            $table->string('GrassMinTemp', 30);
            $table->string('CI_OfPrecipitation', 30);
            $table->string('BE_OfPrecipitation', 30);
            $table->string('IndicatorOfTypeOfIntrumentation', 30);
            $table->string('SignOfPressureChange', 30);
            $table->string('Supp_Info', 30);
            $table->string('VapourPressure', 30);
            $table->string('T_H_Graph', 30);
            $table->enum('DeviceType', ['AWS','web','mobile','desktop'])->default('AWS');
        });

        Schema::table('observationslip', function($table) {            
            $table->foreign('Station')->references('station_id')->on('stations');//->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observationslip');
    }
}
