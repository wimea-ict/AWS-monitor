<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use station\Http\Controllers\Controller;
use station\Http\Controllers\AnalyzerHandler;
use DateTimeZone;
use DateTime;

class ObservationSlipAnalyzerController extends Controller
{
    private $Handler;
    private $twoM_nd_sensors;
    private $tenM_nd_sensors;
    private $gnd_nd_sensors;
    private $sink_nd_sensors;
    /* variable to store the problem configurations for the different stations from the station_problem_settings table */
    private $stn_prb_conf;
    private $problemClassfications;

    public function __construct()
    {
        $this->Handler = new AnalyzerHandler();
        /* pick configurations data */
        $this->problemClassfications = $this->Handler->getProblemClassifications();
        $this->stn_prb_conf = $this->Handler->getStationProbConfig();
        /**
         * get available sensors 
         * nodetype - twoMeterNode, tenMeterNode, groundNode, sinkNode
        */
        $this->twoM_nd_sensors = $this->Handler->getSensorConfigInfo('twoMeterNode');
        $this->tenM_nd_sensors = $this->Handler->getSensorConfigInfo('tenMeterNode');
        $this->gnd_nd_sensors = $this->Handler->getSensorConfigInfo('groundNode');
        $this->sink_nd_sensors = $this->Handler->getSensorConfigInfo('sinkNode');

        // dd($this->twoM_nd_sensors);
        // dd($this->tenM_nd_sensors);
        // dd($this->gnd_nd_sensors);
        // dd($this->sink_nd_sensors);

        // dd($sensorInfo);
    }

    /**
     * Function that is run
      */
    public function analyze()
    {
        // first clean DB
        //$this->Handler->cleanDBTable($this->Handler->getProbTbName());
        
        // store the first and last id checked  ->where()
        $id_first_checked = 0;
        $id_last_checked = 0;
        $counter = 0;

        $lastId = $this->Handler->getLastId('observationslip');

        // sunduration
        DB::table($this->Handler->getObservationSlipTbName())->orderBy('id')->select('id','Station','Rainfall','Dry_Bulb','Wet_Bulb','Wind_Direction','Wind_Speed','SoilMoisture','SoilTemperature','CLP')->where('id','>',$lastId)->chunk(100, function($sensors) use(&$date, &$id_first_checked, &$id_last_checked, &$counter){

            /* array to hold available sensors */
            $available_sensors = array();
            // pick problem station configurations
            $stn_prb_conf = $this->stn_prb_conf;
            
            // initialize variables with default values
            $criticality = 'Non Critical';// default criticality
            $max_track_counter = 12;// default criticality

            foreach ($sensors as $sensor) {

                //store first id
                if ($id_first_checked == 0) {// ensure it's not yet set
                    $id_first_checked = $sensor->id;
                }
                //store last id checked
                $id_last_checked = $sensor->id;// keep overwritting to keep the last checked

                /* store the node id if it isn't there already. search strictly */
                if ((array_search($sensor->id, $available_sensors, true)) === false) {
                    array_push($available_sensors, $sensor->id);
                }
                
                // ------------------------------------------------------------------------------
                /* 'id','Station','Rainfall','Dry_Bulb','Wet_Bulb','Wind_Direction','Wind_Speed','SoilMoisture','SoilTemperature' */
                /* $this->twoM_nd_sensors, $this->tenM_nd_sensors, $this->gnd_nd_sensors, $this->sink_nd_sensors */
                // check for nulls
                if (!empty($sensor->Rainfall)) {
                    // $this->gnd_nd_sensors;
                    // parameter_read - relative humidity(2mnd), Temperature(2mnd), insulation(10mnd), wind speed(10mnd), wind direction(), preciptation(gndnd), soil moisture(gnd), soil temperature(gnd), pressure(sinknd)
                    $this->Handler->analyzeSensorData($this->gnd_nd_sensors, $sensor->Station, 'preciptation', $sensor->Rainfall, 'incorrect', $sensor->id, $this->problemClassfications, $stn_prb_conf, $criticality, $max_track_counter);
                }
                elseif (!empty($sensor->Dry_Bulb) && !empty($sensor->Wet_Bulb)) {
                    // $this->twoM_nd_sensors;
                    // parameter_read - relative humidity(2mnd), Temperature(2mnd), insulation(10mnd), wind speed(10mnd), wind direction(), preciptation(gndnd), soil moisture(gnd), soil temperature(gnd), pressure(sinknd)
                    // $this->Handler->analyzeSensorData($this->twoM_nd_sensors, $sensor->Station, 'Temperature', $sensor->Dry_Bulb, 'incorrect', $sensor->id, $this->problemClassfications, $stn_prb_conf, $criticality, $max_track_counter);

                }
                elseif (!empty($sensor->Wind_Direction)) {
                    // $this->tenM_nd_sensors;
                    // parameter_read - relative humidity(2mnd), Temperature(2mnd), insulation(10mnd), wind speed(10mnd), wind direction(), preciptation(gndnd), soil moisture(gnd), soil temperature(gnd), pressure(sinknd)
                    $this->Handler->analyzeSensorData($this->tenM_nd_sensors, $sensor->Station, 'wind direction', $sensor->Wind_Direction, 'incorrect', $sensor->id, $this->problemClassfications, $stn_prb_conf, $criticality, $max_track_counter);
                }
                elseif (!empty($sensor->Wind_Speed)) {
                    // $this->tenM_nd_sensors;
                    // parameter_read - relative humidity(2mnd), Temperature(2mnd), insulation(10mnd), wind speed(10mnd), wind direction(), preciptation(gndnd), soil moisture(gnd), soil temperature(gnd), pressure(sinknd)
                    $this->Handler->analyzeSensorData($this->tenM_nd_sensors, $sensor->Station, 'wind speed', $sensor->Wind_Speed, 'incorrect', $sensor->id, $this->problemClassfications, $stn_prb_conf, $criticality, $max_track_counter);
                }
                elseif (!empty($sensor->SoilMoisture)) {
                    // $this->gnd_nd_sensors;
                    // parameter_read - relative humidity(2mnd), Temperature(2mnd), insulation(10mnd), wind speed(10mnd), wind direction(10mnd), preciptation(gndnd), soil moisture(gnd), soil temperature(gnd), pressure(sinknd)
                    $this->Handler->analyzeSensorData($this->gnd_nd_sensors, $sensor->Station, 'soil moisture', $sensor->SoilMoisture, 'incorrect', $sensor->id, $this->problemClassfications, $stn_prb_conf, $criticality, $max_track_counter);
                }
                elseif (!empty($sensor->SoilTemperature)) {
                    // $this->gnd_nd_sensors;
                    // parameter_read - relative humidity(2mnd), Temperature(2mnd), insulation(10mnd), wind speed(10mnd), wind direction(), preciptation(gndnd), soil moisture(gnd), soil temperature(gnd), pressure(sinknd)
                    $this->Handler->analyzeSensorData($this->gnd_nd_sensors, $sensor->Station, 'soil temperature', $sensor->SoilTemperature, 'incorrect', $sensor->id, $this->problemClassfications, $stn_prb_conf, $criticality, $max_track_counter);
                }
                elseif (!empty($sensor->CLP)) {
                    // $this->sink_nd_sensors;
                    // parameter_read - relative humidity(2mnd), Temperature(2mnd), insulation(10mnd), wind speed(10mnd), wind direction(), preciptation(gndnd), soil moisture(gnd), soil temperature(gnd), pressure(sinknd)
                    $this->Handler->analyzeSensorData($this->sink_nd_sensors, $sensor->Station, 'pressure', $sensor->CLP, 'incorrect', $sensor->id, $this->problemClassfications, $stn_prb_conf, $criticality, $max_track_counter);
                }
                
                $counter++;
            }

            $this->Handler->findMissingSensors($available_sensors,$criticality,$max_track_counter);            

            //dd($counter);
            if ($counter === 500) { // check if max has been reached.
                // dd($counter);   
                return false; // stop chucking...
            }
        });

        // update last check table
        $this->Handler->updateChecksTable('observationslip',$id_first_checked,$id_last_checked);

        //get data in problems table   problems
        //source, source_id, criticality, classification_id, track_counter, status
        $data = DB::table('problems')->get();
        // $problem = DB::table('problem_classification')->get();

        //show data in the problems table
        return redirect('/probTbData')->with([
            'flash_message' => 'Analyzed '.($id_last_checked - $id_first_checked + 1).' records'
        ]);
    }
}
