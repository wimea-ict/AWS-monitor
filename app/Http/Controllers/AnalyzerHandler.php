<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use station\Http\Controllers\Controller;
use DateTimeZone;
use DateTime;

class AnalyzerHandler extends Controller
{
    /* use constants instead */
    const PROBLEM_CLASSIFN_TB =  "problem_classification";
    const STNS_TB = "stations";
    const STATN_PROB_STTNGS_TB = "station_problem_settings";
    const PROB_TB = "problems";
    const SENSORS_TB = "sensors";
    const GND_ND_TB = "groundNode";
    const TWOM_ND_TB = "twoMeterNode";
    const TENM_ND_TB = "tenMeterNode";
    const SINK_ND_TB = "sinkNode";
    const TIMEZONE = "Africa/Kampala";
    const GND_NAME = "ground_node";
    const TWOMN_NAME = "2m_node";
    const TENN_NAME = "10m_node";
    const SINK_NAME = "sink_node";
    //
    private $problem_classifn_tb;
    private $stns_tb;
    private $statn_prob_sttngs_tb;
    private $prob_tb;
    private $sensors_tb;
    private $gnd_nd_tb;
    private $twoM_nd_tb;
    private $tenM_nd_tb;
    private $sink_nd_tb;
    private $timezone;
    /* names used to identify the table name of the nodes */
    private $gnd_name;
    private $sink_name;
    private $towN_name;
    private $tenN_name;

    public function __construct() {
        $this->problem_classifn_tb = 'problem_classification';
        $this->stns_tb = 'stations';
        $this->statn_prob_sttngs_tb = 'station_problem_settings';
        $this->prob_tb = 'problems';
        $this->sensors_tb = 'sensors';
        $this->gnd_nd_tb = 'groundNode';
        $this->twoM_nd_tb = 'twoMeterNode';
        $this->tenM_nd_tb = 'tenMeterNode';
        $this->sink_nd_tb = 'sinkNode';
        $this->timezone = 'Africa/Kampala';
        $this->gnd_name = 'ground_node';
        $this->towN_name = '2m_node';
        $this->tenN_name = '10m_node';
        $this->sink_name = 'sink_node';
    }

    public function getProbTbName()
    {
        return $this->prob_tb;
    }

    /**
     * getProblemClassifications()
     * gets all the problem classifications in the table
     * @returns $problemClassfications
     */
    public function getProblemClassifications(){
        $problemClassfications = DB::table($this->problem_classifn_tb)->select('id','problem_description','source')->get();
        return $problemClassfications;
    }

    /**
     * getStations();
     * @returns $stations
     */
    public function getStations(){
        $stations = DB::table($this->stns_tb)->select('station_id', 'StationName', 'StationNumber')->get();
        return $stations;
    }
    
    /**
     *  getStationName($stn_id)
     *  @param stn_id
     * @returns $station_name;
     */
    public function getStationName($stn_id){
        $station_name = '';
        $stations = $this->getStations(); 

        foreach ($stations as $station) {
            if ($station->station_id === $stn_id) {
                $station_name = $station->StationName;
                break;
            }
        }
        return $station_name;
    }

    /**
     * pick problem station configurations
     * getNodeConfigurations():
     * @returns $stn_prb_conf;
     */
    public function getStationProbConfigs(){
        
        // problem_id, station_id, max_track_counter, criticality where('station_id',$stn_id)->
        $stn_prb_conf = DB::table($this->statn_prob_sttngs_tb)->select('station_id','problem_id','max_track_counter','criticality')->get();

        return $stn_prb_conf;
    }

    /**
     * get all the data in node table
     */
    public function getNodeData($nd_tb_name, $txt_col_name)
    {
        $node_tb = DB::table($nd_tb_name)->select('node_id','station_id',$txt_col_name,'v_in_max_value','v_in_min_value','v_mcu_max_value','v_mcu_min_value')->get();
        
        return $node_tb;
    }

    /**
     * 
     */
    public function getNodeTableData($txt_col_name)
    {

        $tb_data = '';
        /* 'sensor','station','2m_node','10m_node','sink_node','ground_node' */
        if (stripos($txt_col_name, 'gnd') !== false) {
            // node_id, station_id, txt_gnd_value
            $tb_data = $this->getNodeData($this->gnd_nd_tb,'txt_gnd_value');
            
        }
        else if (stripos($txt_col_name, '2m') !== false) {
            // node_id, station_id, txt_2m_value
            $tb_data = $this->getNodeData($this->twoM_nd_tb,'txt_2m_value');
            
        }
        else if (stripos($txt_col_name, '10m') !== false) {
            // node_id, station_id, txt_10m_value
            $tb_data = $this->getNodeData($this->tenM_nd_tb,'txt_10m_value');
            
        }
        else if (stripos($txt_col_name, 'sink') !== false) {
            // node_id, station_id, txt_sink_value
            $tb_data = $this->getNodeData($this->sink_nd_tb,'txt_sink_value');
            
        }

        return $tb_data;
    }

    /**
     * getNodeConfigurations()
     * it also gets the node configurations
     * @returns array of values
     * Get the respective node ids
     * node name:- '2m_node','10m_node','sink_node','ground_node'
     * this should be separated into its own function
     * the txt identifiers should be stated as variables to manage them as they change
     * Since only configured nodes are saved to the database, there shouldn't be an unassigned variable.
     */
    public function getNodeConfigurations($config_data, $txt){

        
        $nd_id = '';
        $nd_name = '';
        $stn_id = '';
        $vinMaxVal = '';
        $vinMinVal = '';
        $vmcuMaxVal = '';
        $vmcuMinVal = '';
        $node_tb = $config_data;
        /* 'sensor','station','2m_node','10m_node','sink_node','ground_node' */
        if (stripos($txt, 'gnd') !== false) {
            // look up node config in the table data
            foreach ($node_tb as $nd_tb) {
                if ($nd_tb->txt_gnd_value === $txt) {
                    $stn_id = $nd_tb->station_id;
                    $nd_id = $nd_tb->node_id;
                    $nd_name = $this->gnd_name;
                    $vinMaxVal = $nd_tb->v_in_max_value;
                    $vinMinVal = $nd_tb->v_in_min_value;
                    $vmcuMaxVal = $nd_tb->v_mcu_max_value;
                    $vmcuMinVal = $nd_tb->v_mcu_min_value;
                    break;
                }
            }
        }
        else if (stripos($txt, '2m') !== false) {
            // look up node config in the table data
            foreach ($node_tb as $nd_tb) {
                if ($nd_tb->txt_2m_value === $txt) {
                    $stn_id = $nd_tb->station_id;
                    $nd_id = $nd_tb->node_id;
                    $nd_name = $this->towN_name;
                    $vinMaxVal = $nd_tb->v_in_max_value;
                    $vinMinVal = $nd_tb->v_in_min_value;
                    $vmcuMaxVal = $nd_tb->v_mcu_max_value;
                    $vmcuMinVal = $nd_tb->v_mcu_min_value;
                    break;
                }
            }
        }
        else if (stripos($txt, '10m') !== false) {
            // look up node config in the table data
            foreach ($node_tb as $nd_tb) {
                if ($nd_tb->txt_10m_value === $txt) {
                    $stn_id = $nd_tb->station_id;
                    $nd_id = $nd_tb->node_id;
                    $nd_name = $this->tenN_name;
                    $vinMaxVal = $nd_tb->v_in_max_value;
                    $vinMinVal = $nd_tb->v_in_min_value;
                    $vmcuMaxVal = $nd_tb->v_mcu_max_value;
                    $vmcuMinVal = $nd_tb->v_mcu_min_value;
                    break;
                }
            }
        }
        else if (stripos($txt, 'sink') !== false) {
            // look up node config in the table data
            foreach ($node_tb as $nd_tb) {
                if ($nd_tb->txt_sink_value === $txt) {
                    $stn_id = $nd_tb->station_id;
                    $nd_id = $nd_tb->node_id;
                    $nd_name = $this->sink_name;
                    $vinMaxVal = $nd_tb->v_in_max_value;
                    $vinMinVal = $nd_tb->v_in_min_value;
                    $vmcuMaxVal = $nd_tb->v_mcu_max_value;
                    $vmcuMinVal = $nd_tb->v_mcu_min_value;
                    break;
                }
            }
        }
        
        return array(
            'stn_id' => $stn_id, 
            'nd_id' => $nd_id, 
            'nd_name' => $nd_name, 
            'vinMaxVal' => $vinMaxVal, 
            'vinMinVal' => $vinMinVal, 
            'vmcuMaxVal' => $vmcuMaxVal, 
            'vmcuMinVal' => $vmcuMinVal, 
        );
    }

    /* 
    elseif (strcasecmp($type,'observationslip') == 0) {
            $sensor_id = '';
            $sensor_name = '';
            $nd_id = '';
            $maxVal = '';
            $minVal = '';
            $param_read = '';
           
            $sensor_data = DB::table($this->sensors_tb)->select('id','node_id','node_type','parameter_read','min_value','max_value')->where('id','=',$txt)->get();
            
            return array(
                'nd_id' => $sensor_data->node_id, 
                'sensor_id' => $sensor_data->id, 
                'maxVal' => $sensor_data->max_value, 
                'minVal' => $sensor_data->min_value,
                'param_read' => $sensor_data->parameter_read, 
            );
        }
    */

    /**
     * Resetting a table
     * @param $tb_name
     */
    public function cleanDBTable($tb_name)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($tb_name)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * Insert data into problem table     
     * @param $nd_id, 
     * @param $nd_name, 
     * @param $prob_id, 
     * @param $criticality
     * @return null
     */
    public function insertIntoProbTb($nd_id, $nd_name, $prob_id, $criticality)
    {
        /*
         * Field        possible values
         * id
         * source       ('sensor','station','2m_node','10m_node','sink_node','ground_node')
         * source_id
         * criticality  ('critical', 'non-critical')
         * classification_id
         * track_counter
         * status       ('reported', 'investigation', 'solved')
         * created_at
         * updated_at
         */
        DB::table($this->prob_tb)->insert(
            ['source'=>$nd_name,'source_id'=>$nd_id,'criticality'=>$criticality,'classification_id'=>$prob_id,'track_counter'=>1,'status'=>'investigation', 'created_at'=>$this->getCurrentDateTime()]
        );
    }

    /**
     * check data in the problems table to see if problem has been reported yet.
     * @return problem
     * it excludes the solved problems and so should return only one record
     * this is because we don't record a problem again before it has been solved.
     */
    public function getProblem($nd_id,$source,$classification_id)
    {
        // id, source_id, track_counter
        $prob = DB::table($this->prob_tb)->select('id','source_id','track_counter','status')->where([
            ['source_id','=',$nd_id],
            ['source','=',$source],
            ['status','<>','solved'],
            ['classification_id','=',$classification_id],
        ])->get();
        
        return $prob;
    }

    /**
     * call reporter to report problem
     */
    public function getReporter($prob_id)
    {
        //............ call reporter here.............................

        // update status if reporting was done successfully
        DB::table($this->prob_tb)->where('id',$prob_id)->update(['status'=>'reported']);
    }

    /**
     * update problem 
     */
    public function updateProblem($prob_track_counter,$nd_id,$max_track_counter,$prob_status,$prob_id)
    {
        if ($prob_status == 'reported') {
            // update the updated_at column to affirm that the problem was encountered again
            DB::table($this->prob_tb)->where('id',$prob_id)->update(['updated_at'=>$this->getCurrentDateTime()]);
        }
        else {
            // check if max_counter had already been reached to avoid incrementing it again.
            if (($prob_track_counter)>= $max_track_counter) {
                $this->getReporter($prob_id);
                return;// exit method
            }
            DB::table($this->prob_tb)->where('id',$prob_id)->increment('track_counter');
            // check if max_counter has been reached and if so change status and call the reporter.
            if (($prob_track_counter + 1)>= $max_track_counter) {
                $this->getReporter($prob_id);
            }
        }        
    }

    /**
     * get current date
     */
    public function getCurrentDateTime()
    {
        $zone = new DateTimeZone($this->timezone);// set timezone
        $date = new DateTime("now", $zone);// get current time
        
        return $date;
    }

    /**
     * Get time difference to use when quering the node_status table
     */
    public function getTimeDiff()
    {
        // "date_time_recorded": "2018-02-28 15:40:19"
        $date = $this->getCurrentDateTime();// get current time
        // $date->sub(new DateInterval('PT1H'));// subtract one hour from current time
        $date = $date->format('Y-m-d H:m:s');// change date time object to string format used in the database.
        return $date;
    }

    /**
     * 
     */
    public function registerProblem($nd_id, $nd_name, $problem_id, $criticality, $max_track_counter)
    {
        // check data in the problems table to see if problem has been reported yet.
        $prob = $this->getProblem($nd_id,$nd_name,$problem_id); 
        
        if ($prob->isEmpty()) {
            /**
             * record doesn't exit in the database and so..registerProblem($nd_id, $nd_name, $problem->id, $criticality, $max_track_counter)
             * insert into the the problem into the database
             * at this point, we get the criticality of this problem
             */
            $this->insertIntoProbTb($nd_id, $nd_name, $problem_id, $criticality);
        }
        else {
            /**
             * $nd_id, $nd_name, $problem->id, $criticality, $max_track_counter
             * problem exists
             * if problem is not yet reported, then increment the counter
             * after increment, check if the counter has reached max, if so, call the reporter and then set the status to reported.
             * if status is reported, then just update the 'updated_at' column to show that the problem was realised
             */

            $prob = $prob->toArray();
            
            $this->updateProblem($prob[0]->track_counter,$nd_id,$max_track_counter,$prob[0]->status,$prob[0]->id);
        }
    }

    /**
     * @param $nd_id
     * @param $nd_name
     * @param $problemClassfications
     * @param $param - "V_IN,V_MCU,..." paramaters being checked
     * @param $prob - "empty, null,..." any anormally being checked
     * @param $stn_prb_conf - the station configurations 
     * @param $criticality
     * @param $max_track_counter
     * @param $stn_id
     */
    public function checkoutProblem($nd_id,$nd_name,$problemClassfications,$param,$prob,$stn_prb_conf,$criticality,$max_track_counter,$stn_id)
    {
        // get problem
        foreach ($problemClassfications as $problem) {
            // do a case insensitive check
            if (stripos($problem->problem_description, $param) !== false) {
                if (stripos($problem->problem_description, $prob) !== false) {
                    /**
                     * getting the problem criticality and prob_max_counter
                     */
                    if ($stn_prb_conf->isNotEmpty()) {
                        foreach ($stn_prb_conf as $prb_conf) {
                            if ($prb_conf->station_id === $stn_id) {
                                if ($prb_conf->problem_id === $problem->id) {
                                    $criticality = $prb_conf->criticality;
                                    $max_track_counter = $prb_conf->max_track_counter;
                                }
                            }                            
                        }
                    }
                    $this->registerProblem($nd_id, $nd_name, $problem->id, $criticality, $max_track_counter);
                    break;
                }
            }
        }
        // if problem is not found, return nothing
        return;
    }

    /**
     * check table to be checked for last check details...
     * @param $data
     */
    public function getLastId($data)
    {
        if (strcasecmp($data,'observationslip') == 0) {
            $checks = DB::table('observtnslp_analyzer_checks')->orderBy('id','desc')->first();
            if (empty($checks->id_last_checked)) {
                return -1;
            }
            else {
                return $checks->id_last_checked;
            }
        }
        elseif (strcasecmp($data,'nodestatus') == 0) {
            $checks = DB::table('nodestatus_analyzer_checks')->orderBy('id','desc')->first();
            if (empty($checks->id_last_checked)) {
                return -1;
            }
            else {
                return $checks->id_last_checked;
            }
        }        
        return -1;
    }

    /**
     * Function to update the check table
     * @param $data - 
     * @param $id_first_checked - 
     * @param $id_last_checked - 
     */
    public function updateChecksTable($data,$id_first_checked,$id_last_checked)
    {
        if (strcasecmp($data,'nodestatus') == 0) {
            
            DB::table('nodestatus_analyzer_checks')->insert(
                ['id_first_checked'=>$id_first_checked,'id_last_checked'=>$id_last_checked]
            );
        }
        elseif (strcasecmp($data,'observationslip') == 0) {
            
            DB::table('observtnslp_analyzer_checks')->insert(
                ['id_first_checked'=>$id_first_checked,'id_last_checked'=>$id_last_checked]
            );
        }
    }

    /**
     * This method returns
     */
    public function getEnabledSations()
    {
        # code...
    }
}
