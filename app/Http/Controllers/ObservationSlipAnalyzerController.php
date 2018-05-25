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
    public function __construct()
    {
        $this->Handler = new AnalyzerHandler();
        /**
         * get available sensors 
         * nodetype - twoMeterNode, tenMeterNode, groundNode, sinkNode
        */
        $this->twoM_nd_sensors = $this->Handler->getSensorConfigInfo('twoMeterNode');
        $this->tenM_nd_sensors = $this->Handler->getSensorConfigInfo('tenMeterNode');
        $this->gnd_nd_sensors = $this->Handler->getSensorConfigInfo('groundNode');
        $this->sink_nd_sensors = $this->Handler->getSensorConfigInfo('sinkNode');

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


        // pick problem classification data
        $problemClassfications = $this->Handler->getProblemClassifications();

        // sunduration
        DB::table('nodestatus')->orderBy('id')->select('id','Station','Rainfall','Dry_Bulb','Wet_Bulb','Wind_Direction','Wind_Speed','SoilMoisture','SoilTemperature')->where('id','>',$lastId)->chunk(100, function($sensors) use(&$date, &$problemClassfications, &$id_first_checked, &$id_last_checked, &$counter){
            foreach ($sensors as $sensor) {

                //store first id
                if ($id_first_checked == 0) {// ensure it's not yet set
                    $id_first_checked = $sensor->id;
                }
                //store last id checked
                $id_last_checked = $sensor->id;// keep overwritting to keep the last checked

                /**
                 * get the data about the station to which this data belongs 
                 * station numbers have conflicts and so we shall use the txt value to determine the station from which the data is.
                 */ 
                $sensor_id = '';
                $nd_id = '';
                $maxVal = '';
                $minVal = '';
                $param_read = '';
                dd('hold it right here!');
                // $sensorInfo = $this->Handler->getSensorConfigInfo($sensor->TXT);
                // dd($sensorInfo);
                $sensor_id = $sensorInfo['sensor_id'];
                $nd_id = $sensorInfo['nd_id'];
                // $stn_name = $this->Handler->getStationName($stn_id); // reduce number of times 
                $maxVal = $sensorInfo['maxVal'];
                $minVal = $sensorInfo['minVal'];
                $param_read = $sensorInfo['param_read'];
                
                // pick problem station configurations
                $stn_prb_conf = $this->Handler->getStationProbConfigs($stn_id);
                
                // initialize variables with default values
                $criticality = 'non-critical';// default criticality
                $max_track_counter = 12;// default criticality
                
                // ------------------------------------------------------------------------------
                /* 'id','Station','Rainfall','Dry_Bulb','Wet_Bulb','Wind_Direction','Wind_Speed','SoilMoisture','SoilTemperature' */
                
                $counter++;
            }

            //dd($counter);
            if ($counter == 500) { // check if max has been reached.
                return false; // stop chucking...
            }
        });

        // update last check table
        $this->Handler->updateChecksTable('observationslip',$id_first_checked,$id_last_checked);

        //get data in problems table   problems
        //source, source_id, criticality, classification_id, track_counter, status
        $data = DB::table('problems')->get();
        // $problem = DB::table('problem_classification')->get();

        // return $data;
        return view('layouts.analyzer', compact('data','problems'));
    }
}
