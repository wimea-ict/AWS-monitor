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
    /* txt col names for the different node tables */
    private $txt_2m_col_name;
    private $txt_10m_col_name;
    private $txt_gnd_col_name;
    private $txt_sink_col_name;
    /* variable to store the problem configurations for the different stations from the station_problem_settings table */
    private $stn_prb_conf;
    private $problemClassfications;
    /* variables to store table data for the different nodes */
    private $twoM_nd_data;
    private $tenM_nd_data;
    private $gnd_nd_data;
    private $sink_nd_data;
    public function __construct()
    {
        $this->Handler = new AnalyzerHandler();
        $this->txt_2m_col_name  = 'txt_2m_value';
        $this->txt_10m_col_name  = 'txt_10m_value';
        $this->txt_gnd_col_name  = 'txt_gnd_value';
        $this->txt_sink_col_name  = 'txt_sink_value';
        /**
         * PICK ALL THE DATA YOU'LL NEED
         */
        // pick problem station configurations
        $this->problemClassfications = $this->Handler->getProblemClassifications();
        $this->stn_prb_conf = $this->Handler->getStationProbConfigs();
        $this->twoM_nd_data = $this->Handler->getNodeTableData($this->txt_2m_col_name);
        $this->tenM_nd_data = $this->Handler->getNodeTableData($this->txt_10m_col_name);
        $this->gnd_nd_data = $this->Handler->getNodeTableData($this->txt_gnd_col_name);
        $this->sink_nd_data = $this->Handler->getNodeTableData($this->txt_sink_col_name);
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
 
        // pick problem classification data
        $problemClassfications = $this->problemClassfications;

        // pick only columns that we'll be using. We won't need date_time_recorded because we have
        // ->get(500) at a time //'SEQ' - to track packet drops
        DB::table('nodestatus')->orderBy('id')->select('id','V_MCU','V_IN','date','time','TXT','StationNumber')->where('id','>',$lastId)->chunk(100, function($nodes) use(&$date, &$problemClassfications, &$id_first_checked, &$id_last_checked, &$counter,&$seq){
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
                // $stn_name = '';// not used
                // $vinMaxVal = ''; 
                // $vinMinVal = '';
                $vmcuMaxVal = '';
                $vmcuMinVal = '';
                $config_data = '';
                $yearNow = substr($date,0,4);
                $yearRec = substr($node->date,0,4);

                /* get correct config data */
                if (stripos($node->TXT, 'gnd') !== false) {
                    $config_data = $this->gnd_nd_data;
                }
                elseif (stripos($node->TXT, '2m') !== false) {
                    $config_data = $this->twoM_nd_data;
                }
                elseif (stripos($node->TXT, '10m') !== false) {
                    $config_data = $this->tenM_nd_data;
                }
                elseif (stripos($node->TXT, 'sink') !== false) {
                    $config_data = $this->sink_nd_data;
                }
                
                /* if no configuration data was found then skip that record */
                if ($config_data === '') {
                    continue;
                }
                $nodeInfo = $this->Handler->getNodeConfigurations($config_data,$node->TXT);
                $nd_id = $nodeInfo['nd_id'];
                $nd_name = $nodeInfo['nd_name'];
                $stn_id = $nodeInfo['stn_id'];
                // $stn_name = $this->Handler->getStationName($stn_id); // not needed for now...
                // $vinMaxVal = $nodeInfo['vinMaxVal'];
                // $vinMinVal = $nodeInfo['vinMinVal'];
                $vmcuMaxVal = $nodeInfo['vmcuMaxVal'];
                $vmcuMinVal = $nodeInfo['vmcuMinVal'];
                
                // pick problem station configurations
                $stn_prb_conf = $this->stn_prb_conf;
                
                // initialize variables with default values
                $criticality = 'non-critical';// default criticality
                $max_track_counter = 12;// default criticality
                
                // ------------------------------------------------------------------------------
                //check for nulls                
                if (empty($node->V_MCU)) {
                    // get problem
                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Node","missing",$stn_prb_conf,$criticality,$max_track_counter,$stn_id);
                   
                }
                /* if (empty($node->V_IN)) {

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_IN","empty",$stn_prb_conf,$criticality,$max_track_counter,$stn_id);
                    
                } */
                /* if (empty($node->date)) { // this problem has been ignored for now

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Date","missing",$stn_prb_conf,$criticality,$max_track_counter,$stn_id);
                    
                }   */  
                // check for mins        
                if ($node->V_MCU < $vmcuMinVal) {

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Node power","below range",$stn_prb_conf,$criticality,$max_track_counter,$stn_id);
                    
                }
                /* if ($node->V_IN < $vinMinVal) {
                    
                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_IN","minimum",$stn_prb_conf,$criticality,$max_track_counter,$stn_id);
                    
                } */
                if (strcasecmp($yearRec, $yearNow) == 0) {// then dates are equal
                    /* consider time diff */
                    /* if () {
                        $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Date","incorrect",$stn_prb_conf,$criticality,$max_track_counter,$stn_id);
                    } */

                }
                else {
                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Date","incorrect",$stn_prb_conf,$criticality,$max_track_counter,$stn_id);
                }        
                // check for maxs        
                /* if ($node->V_MCU > $vmcuMaxVal) { // ignored for now

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Node power","above range",$stn_prb_conf,$criticality,$max_track_counter,$stn_id);
                    
                } */
                /* if ($node->V_IN > $vinMaxVal) {

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_IN","maximum",$stn_prb_conf,$criticality,$max_track_counter,$stn_id);
                    
                } */

                /* check for packet drops */
                /* if ($seq !== -1 && ( $seq !== ($node->SEQ + 1))) {
                    // check if there was a reset
                    if ($seq === 255 && $node->SEQ === 0) {
                        # do nothing..
                    }
                    else { // note down problem
                        $this->Handler->checkoutProblem($nd_id,$nd_name,$problemClassfications,"packets","dropped",$stn_prb_conf,$criticality,$max_track_counter,$stn_id);
                    }
                } */
                
                $counter++;
            }

            //dd($counter);
            if ($counter == 500) { // check if max has been reached.
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
