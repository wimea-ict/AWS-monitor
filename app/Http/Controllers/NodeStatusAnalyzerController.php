<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use station\Http\Controllers\Controller;
use station\Http\Controllers\AnalyzerHandler;
use DateTimeZone;
use DateTime;

class NodeStatusAnalyzerController extends Controller
{
    private $Handler;
    public function __construct()
    {
        $this->Handler = new AnalyzerHandler();
    }

    /**
     * Function that is run
      */
    public function analyze()
    {
        // first clean DB
        //$this->Handler->cleanDBTable($this->Handler->getProbTbName());
        //get time diff to use for querying the db
        // $tasks = DB::table('observationslip')->where('CreationDate','>=',$this->getTimeDiff())
        $date = $this->Handler->getTimeDiff();
        
        // store the first and last id checked  ->where()
        $id_first_checked = 0;
        $id_last_checked = 0;
        $counter = 0;
        $seq = -1;

        $lastId = $this->Handler->getLastId('nodestatus');

        /**
         * PICK ALL THE DATA YOU'LL NEED
         */
        // pick problem station configurations
        $stn_prb_conf = $this->Handler->getStationProbConfigs();
 

        // dd($some);
        dd($some->problem_id);
        // pick problem classification data
        $problemClassfications = $this->Handler->getProblemClassifications();

        // pick only columns that we'll be using. We won't need date_time_recorded because we have
        // ->get(500) at a time //'SEQ' - to track packet drops
        DB::table('nodestatus')->orderBy('id')->select('id','V_MCU','V_IN','date','time','TXT','StationNumber')->where('id','>',$lastId)->chunk(100, function($nodes) use(&$date, &$problemClassfications, &$id_first_checked, &$id_last_checked, &$counter,&$stn_prb_conf,&$seq){
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
                
                $nodeInfo = $this->Handler->getConfigInfo('nodestatus',$node->TXT);
                // dd($nodeInfo);
                $nd_id = $nodeInfo['nd_id'];
                $nd_name = $nodeInfo['nd_name'];
                $stn_id = $nodeInfo['stn_id'];
                $stn_name = $this->Handler->getStationName($stn_id);
                $vinMaxVal = $nodeInfo['vinMaxVal'];
                $vinMinVal = $nodeInfo['vinMinVal'];
                $vmcuMaxVal = $nodeInfo['vmcuMaxVal'];
                $vmcuMinVal = $nodeInfo['vmcuMinVal'];
                
                // pick problem station configurations
                $stn_prb_conf = $this->Handler->getProbConfigs($stn_prb_conf,$stn_id);
                
                // initialize variables with default values
                $criticality = 'non-critical';// default criticality
                $max_track_counter = 12;// default criticality
                
                // ------------------------------------------------------------------------------
                //check for nulls                
                if (empty($node->V_MCU)) {
                    // get problem
                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Node","missing",$stn_prb_conf,$criticality,$max_track_counter);
                   
                }
                /* if (empty($node->V_IN)) {

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_IN","empty",$stn_prb_conf,$criticality,$max_track_counter);
                    
                } */
                /* if (empty($node->date)) { // this problem has been ignored for now

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Date","missing",$stn_prb_conf,$criticality,$max_track_counter);
                    
                }   */  
                // check for mins        
                if ($node->V_MCU < $vmcuMinVal) {

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Node power","below range",$stn_prb_conf,$criticality,$max_track_counter);
                    
                }
                /* if ($node->V_IN < $vinMinVal) {
                    
                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_IN","minimum",$stn_prb_conf,$criticality,$max_track_counter);
                    
                } */
                if ($yearRec < $yearNow) {

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Date","incorrect",$stn_prb_conf,$criticality,$max_track_counter);

                }            
                // check for maxs        
                /* if ($node->V_MCU > $vmcuMaxVal) { // ignored for now

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Node power","above range",$stn_prb_conf,$criticality,$max_track_counter);
                    
                } */
                /* if ($node->V_IN > $vinMaxVal) {

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_IN","maximum",$stn_prb_conf,$criticality,$max_track_counter);
                    
                } */
                if ($yearRec > $yearNow) {

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Date","incorrect",$stn_prb_conf,$criticality,$max_track_counter);
                   
                } 

                /* check for packet drops */
                /* if ($seq !== -1 && ( $seq !== ($node->SEQ + 1))) {
                    // check if there was a reset
                    if ($seq === 255 && $node->SEQ === 0) {
                        # do nothing..
                    }
                    else { // note down problem
                        $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"packets","dropped",$stn_prb_conf,$criticality,$max_track_counter);
                    }
                } */
                
                $counter++;
            }

            //dd($counter);
            if ($counter == 50) { // check if max has been reached.
                return false; // stop chucking...
            }
        });

        // update last check table
        $this->Handler->updateChecksTable('nodestatus',$id_first_checked,$id_last_checked);

        //get data in problems table   problems
        //source, source_id, criticality, classification_id, track_counter, status
        $data = DB::table('problems')->get();
        // $problem = DB::table('problem_classification')->get();

        // return $data;
        return view('layouts.analyzer', compact('data','problems'));
    }
}
