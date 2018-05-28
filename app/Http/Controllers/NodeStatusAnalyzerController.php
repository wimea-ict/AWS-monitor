<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
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
         * nodetype - twoMeterNode, tenMeterNode, groundNode, sinkNode 
         */
        // $this->problemClassfications = $this->Handler->getEnabledSensors('twoMeterNode');

        // pick problem station configurations
        $this->problemClassfications = $this->Handler->getProblemClassifications();
        $this->stn_prb_conf = $this->Handler->getStationProbConfig();
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
        // $date = $this->Handler->getTimeDiff();
        
        // store the first and last id checked  ->where()
        $id_first_checked = 0;
        $id_last_checked = 0;
        $counter = 0;
        $seq = -1;  
        
        $lastId = $this->Handler->getLastId('nodestatus');

        // pick only columns that we'll be using since that will be faster. 
        // We need date_time_recorded to verify the date time sent by the node
        // ->get(500) at a time //'SEQ' - to track packet drops
        DB::table($this->Handler->getNodeStatusTbName())->orderBy('id')->select('id','V_MCU','V_IN','date','time','TXT','date_time_recorded')->where('id','>',$lastId)->chunk(100, function($nodes) use(&$date, &$id_first_checked, &$id_last_checked, &$counter,&$seq){

            /* declare a collection to store the nodes that sent data */
            $available_nodes = array(
                $this->Handler->getGndName() => array(),
                $this->Handler->get2mName() => array(),
                $this->Handler->get10mName() => array(),
                $this->Handler->getSinkName() => array()
            );

            $recorded_ids = array();

            // pick problem station configurations
            $stn_prb_conf = $this->stn_prb_conf;
            
            // initialize variables with default values
            $criticality = 'Non Critical';// default criticality
            $max_track_counter = 12;// default criticality
            
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
                $nd_data = '';// variable to hold the array keys
                $yearNow = substr($date,0,4);
                $yearRec = substr($node->date,0,4);

                /* get correct config data */
                if (stripos($node->TXT, 'gnd') !== false) {
                    $config_data = $this->gnd_nd_data;
                    $nd_data = $this->Handler->getGndName();
                }
                elseif (stripos($node->TXT, '2m') !== false) {
                    $config_data = $this->twoM_nd_data;
                    $nd_data = $this->Handler->get2mName();
                }
                elseif (stripos($node->TXT, '10m') !== false) {
                    $config_data = $this->tenM_nd_data;
                    $nd_data = $this->Handler->get10mName();
                }
                elseif (stripos($node->TXT, 'sink') !== false) {
                    $config_data = $this->sink_nd_data;
                    $nd_data = $this->Handler->getSinkName();
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
                
                array_push($recorded_ids,$nd_id);
                /* store the node id if it isn't there already. search strictly */
                if ((array_search($nd_id, $available_nodes[$nd_data], true)) === false) {
                    array_push($available_nodes[$nd_data], $nd_id);
                }
                
                // ------------------------------------------------------------------------------
                //check for nulls                
                if (empty($node->V_MCU)) {
                    // get problem
                    $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"Node","missing",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
                   
                }                     
                elseif ($node->V_MCU < $vmcuMinVal) {// check for mins   

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"Node power","below range",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
                    
                }
                /* check if there were no problems in which case we decrement the counter for the problem if they had been recorded before */
                if (!empty($node->V_MCU)) {
                    $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"Node","missing",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'removeproblem');
                }
                elseif ($node->V_MCU >= $vmcuMinVal) {
                    
                    $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"Node power","below range",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'removeproblem');
                }
                
                /* if (empty($node->V_IN)) {

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"V_IN","empty",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
                    
                } */
                /* if (empty($node->date)) { // this problem has been ignored for now

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"Date","missing",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
                    
                }   */ 
                /* if ($node->V_IN < $vinMinVal) {
                    
                    $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"V_IN","minimum",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
                    
                } */
                if (strcasecmp($yearRec, $yearNow) == 0) {// then dates are equal
                    /* consider time diff */
                    /* if () {
                        $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"Date","incorrect",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
                    } */

                }
                else {
                    $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"Date","incorrect",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
                }        
                // check for maxs        
                /* if ($node->V_MCU > $vmcuMaxVal) { // ignored for now

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"Node power","above range",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
                    
                } */
                /* if ($node->V_IN > $vinMaxVal) {

                    $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"V_IN","maximum",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
                    
                } */

                /* check for packet drops */
                /* if ($seq !== -1 && ( $seq !== ($node->SEQ + 1))) {
                    // check if there was a reset
                    if ($seq === 255 && $node->SEQ === 0) {
                        # do nothing..
                    }
                    else { // note down problem
                        $this->Handler->checkoutProblem($nd_id,$nd_name,$this->problemClassfications,"packets","dropped",$stn_prb_conf,$criticality,$max_track_counter,$stn_id,'addproblem');
                    }
                } */
                
                $counter++;
            }

            // dd(array_unique($recorded_ids));

            // dd($available_nodes);

            
            $this->Handler->findMissingNodes($available_nodes,$criticality,$max_track_counter);

            //dd($counter);
            if ($counter === 500) { // check if max has been reached.
                return false; // stop chucking...
            }
        });

        // update last check table
        $this->Handler->updateChecksTable('nodestatus',$id_first_checked,$id_last_checked);

        //show data in the problems table
        return redirect('/probTbData');
    }
}
