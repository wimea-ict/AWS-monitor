<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use station\Http\Controllers\Controller;
use station\Http\Controllers\AnalyzerDBHandler;
use DateTimeZone;
use DateTime;

class NodeStatusAnalyzerController extends Controller
{
    private $DBHandler;
    public function __construct()
    {
        $this->DBHandler = new AnalyzerDBHandler();
    }

    /**
     * Function that is run
      */
    public function analyze()
    {
        // first clean DB
        $this->DBHandler->cleanDBTable($this->DBHandler->getProbTbName());
        //get time diff to use for querying the db
        // $tasks = DB::table('observationslip')->where('CreationDate','>=',$this->getTimeDiff())
        $date = $this->DBHandler->getTimeDiff();
        
        // store the first and last id checked  ->where()
        $id_first_checked = 0;
        $id_last_checked = 0;
        $counter = 0;

        // pick problem classification data
        $problemClassfications = $this->DBHandler->getProblemClassifications();

        // pick only columns that we'll be using. We won't need date_time_recorded because we have
        // ->get(500) at a time
        DB::table('nodestatus')->orderBy('id')->select('id','V_MCU','V_IN','date','time','TXT','StationNumber')->chunk(100, function($nodes) use(&$date, &$problemClassfications, &$id_first_checked, &$id_last_checked, &$counter){
            foreach ($nodes as $node) {

                //store first id
                if ($id_first_checked == 0) {// ensure it's not yet set
                    $id_first_checked = $node->id;
                }
                //store last id checked
                $id_last_checked = $node->id;// keep overwritting to keep the last checked

                /**
                 * get the data about the station to which this data belongs 
                 * station numbers have conflicts and so we shall use the txt value to determine the station from which the data is.
                 */ 
                $nd_id = '';
                $nd_name = '';
                $stn_id = '';
                $stn_no = '';
                $stn_name = '';
                $vinMaxVal = '';
                $vinMinVal = '';
                $vmcuMaxVal = '';
                $vmcuMinVal = '';
                $yearNow = substr($date,0,4);
                $yearRec = substr($node->date,0,4);
                
                $nodeInfo = $this->DBHandler->getNodeAndStationInfo($node->TXT);
                // dd($nodeInfo);
                $nd_id = $nodeInfo['nd_id'];
                $nd_name = $nodeInfo['nd_name'];
                $stn_id = $nodeInfo['stn_id'];
                $stn_name = $this->DBHandler->getStationName($stn_id);
                $vinMaxVal = $nodeInfo['vinMaxVal'];
                $vinMinVal = $nodeInfo['vinMinVal'];
                $vmcuMaxVal = $nodeInfo['vmcuMaxVal'];
                $vmcuMinVal = $nodeInfo['vmcuMinVal'];
                
                // pick problem station configurations
                $stn_prb_conf = $this->DBHandler->getStationProbConfigs($stn_id);
                
                // initialize variables with default values
                $criticality = 'non-critical';// default criticality
                $max_track_counter = 12;// default criticality
                
                // ------------------------------------------------------------------------------
                //check for nulls
                
                if (empty($node->V_MCU)) {
                    // get problem
                    $this->DBHandler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_MCU","empty",$stn_prb_conf,$criticality,$max_track_counter);
                   
                }
                if (empty($node->V_IN)) {

                    $this->DBHandler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_IN","empty",$stn_prb_conf,$criticality,$max_track_counter);
                    
                }
                if (empty($node->date)) {

                    $this->DBHandler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Date","empty",$stn_prb_conf,$criticality,$max_track_counter);
                    
                }    
                // check for mins        
                if ($node->V_MCU < $vmcuMinVal) {

                    $this->DBHandler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_MCU","minimum",$stn_prb_conf,$criticality,$max_track_counter);
                    
                }
                if ($node->V_IN < $vinMinVal) {
                    
                    $this->DBHandler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_IN","minimum",$stn_prb_conf,$criticality,$max_track_counter);
                    
                }
                if ($yearRec < $yearNow) {
                    if ($yearRec === '1970') {

                        $this->DBHandler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Date","1970",$stn_prb_conf,$criticality,$max_track_counter);
                        
                    }
                    else{

                        $this->DBHandler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Date","below",$stn_prb_conf,$criticality,$max_track_counter);
                        
                    }
                }            
                // check for maxs        
                if ($node->V_MCU > $vmcuMaxVal) {

                    $this->DBHandler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_MCU","maximum",$stn_prb_conf,$criticality,$max_track_counter);
                    
                }
                if ($node->V_IN > $vinMaxVal) {

                    $this->DBHandler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_IN","maximum",$stn_prb_conf,$criticality,$max_track_counter);
                    
                }
                if ($yearRec > $yearNow) {

                    $this->DBHandler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Date","above",$stn_prb_conf,$criticality,$max_track_counter);
                   
                } 
                
                $counter++;
            }

            //dd($counter);
            if ($counter == 500) { // check if max has been reached.
                return false; // stop chucking...
            }
        });

        /**
         * analyzer_last_check
         * Store the changes to the db
         */
        DB::table('analyzer_last_check')->insert(
            ['id_first_checked'=>$id_first_checked,'id_last_checked'=>$id_last_checked]
        );

        //get data in problems table   problems
        //source, source_id, criticality, classification_id, track_counter, status
        $data = DB::table('problems')->get();

        // return $data;
        return view('layouts.analyzer', compact('data'));
    }
}
