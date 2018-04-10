<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use station\Http\Controllers\Controller;
use DateTimeZone;
use DateTime;

class NodeStatusAnalyzerController extends Controller
{
    
    private $problem_classifn_tb;
    private $stns_tb;
    private $statn_prob_sttngs_tb;
    private $prob_tb;
    private $gnd_nd_tb;
    private $twoM_nd_tb;
    private $tenM_nd_tb;
    private $sink_nd_tb;
    private $timezone;

    public function __construct() {
        $this->problem_classifn_tb = 'problem_classification';
        $this->stns_tb = 'stations';
        $this->statn_prob_sttngs_tb = 'station_problem_settings';
        $this->prob_tb = 'problems';
        $this->gnd_nd_tb = 'groundNode';
        $this->twoM_nd_tb = 'twoMeterNode';
        $this->tenM_nd_tb = 'tenMeterNode';
        $this->sink_nd_tb = 'sinkNode';
        $this->timezone = 'Africa/Kampala';
    }

    /**
     * getProblemClassifications()
     * gets all the problem classifications in the table
     * @returns $problemClassfications
     */
    private function getProblemClassifications(){
        $problemClassfications = DB::table($this->problem_classifn_tb)->select('id','problem_description','source')->get();
        return $problemClassfications;
    }

    /**
     * getStations();
     * @returns $stations
     */
    private function getStations(){
        $stations = DB::table($this->stns_tb)->select('station_id', 'StationName', 'StationNumber')->get();
        return $stations;
    }
    
    /**
     *  getStationName($stn_id)
     *  @param stn_id
     * @returns $station_name;
     */
    private function getStationName($stn_id){
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
    private function getStationProbConfigs($stn_id){
        
        // problem_id, station_id, max_track_counter, criticality
        $stn_prb_conf = DB::table($this->statn_prob_sttngs_tb)->where('station_id',$stn_id)->select('problem_id','max_track_counter','criticality')->get();

        return $stn_prb_conf;
    }

    /**
     * get all the node status data
     */
    private function getNodeData($nd_tb, $txt)
    {
        $node_tb = DB::table($nd_tb)->select('node_id','station_id',$txt,'v_in_max_value','v_in_min_value','v_mcu_max_value','v_mcu_min_value')->get();
        
        return $node_tb;
    }

    /**
     * getNodeAndStationIds()
     * it also gets the node configurations
     * @returns array('stn_id' => $stn_id, 'nd_id' => $nd_id, 'nd_name' => $nd_name, 'vinMaxVal' => $vinMaxVal, 'vinMinVal' => $vinMinVal, 'vmcuMaxVal' => $vmcuMaxVal, 'vmcuMinVal' => $vmcuMinVal,);
     * Get the respective node ids
     * node name:- '2m_node','10m_node','sink_node','ground_node'
     * this should be separated into its own function
     * the txt identifiers should be stated as variables to manage them as they change
     * Since only configured nodes are saved to the database, there shouldn't be an unassigned variable.
     */
    private function getNodeAndStationInfo($txt){

        $nd_id = '';
        $nd_name = '';
        $stn_id = '';
        $vinMaxVal = '';
        $vinMinVal = '';
        $vmcuMaxVal = '';
        $vmcuMinVal = '';

        if (stripos($txt, 'gnd') !== false) {
            // node_id, station_id, txt_gnd_value
            $node_tb = $this->getNodeData($this->gnd_nd_tb,'txt_gnd_value');
            foreach ($node_tb as $nd_tb) {
                if ($nd_tb->txt_gnd_value === $txt) {
                    $stn_id = $nd_tb->station_id;
                    $nd_id = $nd_tb->node_id;
                    $nd_name = 'ground_node';
                    $vinMaxVal = $nd_tb->v_in_max_value;
                    $vinMinVal = $nd_tb->v_in_min_value;
                    $vmcuMaxVal = $nd_tb->v_mcu_max_value;
                    $vmcuMinVal = $nd_tb->v_mcu_min_value;
                    break;
                }
            }
        }
        else if (stripos($txt, '2m') !== false) {
            // node_id, station_id, txt_gnd_value
            $node_tb = $this->getNodeData($this->twoM_nd_tb,'txt_2m_value');
            foreach ($node_tb as $nd_tb) {
                if ($nd_tb->txt_2m_value === $txt) {
                    $stn_id = $nd_tb->station_id;
                    $nd_id = $nd_tb->node_id;
                    $nd_name = '2m_node';
                    $vinMaxVal = $nd_tb->v_in_max_value;
                    $vinMinVal = $nd_tb->v_in_min_value;
                    $vmcuMaxVal = $nd_tb->v_mcu_max_value;
                    $vmcuMinVal = $nd_tb->v_mcu_min_value;
                    break;
                }
            }
        }
        else if (stripos($txt, '10m') !== false) {
            // node_id, station_id, txt_gnd_value
            $node_tb = $this->getNodeData($this->tenM_nd_tb,'txt_10m_value');
            foreach ($node_tb as $nd_tb) {
                if ($nd_tb->txt_10m_value === $txt) {
                    $stn_id = $nd_tb->station_id;
                    $nd_id = $nd_tb->node_id;
                    $nd_name = '10m_node';
                    $vinMaxVal = $nd_tb->v_in_max_value;
                    $vinMinVal = $nd_tb->v_in_min_value;
                    $vmcuMaxVal = $nd_tb->v_mcu_max_value;
                    $vmcuMinVal = $nd_tb->v_mcu_min_value;
                    break;
                }
            }
        }
        else if (stripos($txt, 'sink') !== false) {
            // node_id, station_id, txt_gnd_value
            $node_tb = $this->getNodeData($this->sink_nd_tb,'txt_sink_value');
            foreach ($node_tb as $nd_tb) {
                if ($nd_tb->txt_sink_value === $txt) {
                    $stn_id = $nd_tb->station_id;
                    $nd_id = $nd_tb->node_id;
                    $nd_name = 'sink_node';
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

    /**
     * Resetting a table
     */
    private function cleanDBTable($tb_name)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table($tb_name)->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    /**
     * insertIntoProbTb() ... Insert data into problem table
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
    private function insertIntoProbTb($nd_name,$nd_id,$criticality,$prob_id)
    {
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
    private function getProblem($nd_id,$source,$classification_id)
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
    private function getReporter($prob_id)
    {
        //............ call reporter here.............................

        // update status if reporting was done successfully
        DB::table($this->prob_tb)->where('id',$prob_id)->update(['status'=>'reported']);
    }

    /**
     * update problem 
     */
    private function updateProblem($prob_track_counter,$nd_id,$max_track_counter,$prob_status,$prob_id)
    {
        if ($prob_status == 'reported') {
            // update the updated_at column to affirm that the problem was encountered again
            DB::table($this->prob_tb)->where('id',$prob_id)->update(['updated_at'=>$this->getCurrentDateTime()]);
        }
        else {
            // check if max_counter had already been reached to avoid incrementing it again.
            if (($prob_track_counter + 1)>= $max_track_counter) {
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
    private function getCurrentDateTime()
    {
        $zone = new DateTimeZone($this->timezone);// set timezone
        $date = new DateTime("now", $zone);// get current time
        
        return $date;
    }

    /**
     * Get time difference to use when quering the node_status table
     */
    private function getTimeDiff()
    {
        // "date_time_recorded": "2018-02-28 15:40:19"
        $date = $this->getCurrentDateTime();// get current time
        // $date->sub(new DateInterval('PT1H'));// subtract one hour from current time
        $date = $date->format('Y-m-d H:m:s');// change date time object to string format used in the database.
        return $date;
    }

    /**
     * Function that is run
      */
    public function analyze()
    {
        // first clean DB
        $this->cleanDBTable($this->prob_tb);
        //get time diff to use for querying the db
        // $tasks = DB::table('observationslip')->where('CreationDate','>=',$this->getTimeDiff())
        $date = $this->getTimeDiff();
        // test variables
        $vinNull = 0; $vmcuNull = 0; $dateNull = 0; $vinMin = 0; $vinMax = 0; $vmcuMin = 0; $vmcuMax = 0; $dateMin = 0; $dateMax = 0; $date1970 = 0; $invalidDates = array(); $nullV_IN = array(); $nullVMCU = array();

        // pick problem classification data
        $problemClassfications = $this->getProblemClassifications();
        $str = array();

        // pick only columns that we'll be using. We won't need date_time_recorded because we have
        DB::table('nodestatus')->select('V_MCU','V_IN','date','time','TXT','StationNumber')->orderBy('id')->chunk(200, function($nodes) use(&$vinNull, &$vmcuNull, &$dateNull, &$vinMin, &$vinMax, &$vmcuMin, &$vmcuMax, &$dateMin, &$dateMax, &$date, &$date1970, &$invalidDates, &$nullV_IN, &$nullVMCU, &$problemClassfications, &$str){
            foreach ($nodes as $node) {

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
                
                $nodeInfo = $this->getNodeAndStationInfo($node->TXT);

                $nd_id = $nodeInfo['nd_id'];
                $nd_name = $nodeInfo['nd_name'];
                $stn_id = $nodeInfo['stn_id'];
                $stn_name = $this->getStationName($stn_id);
                $vinMaxVal = $nodeInfo['vinMaxVal'];
                $vinMinVal = $nodeInfo['vinMinVal'];
                $vmcuMaxVal = $nodeInfo['vmcuMaxVal'];
                $vmcuMinVal = $nodeInfo['vmcuMinVal'];
                
                // pick problem station configurations
                $stn_prb_conf = $this->getStationProbConfigs($stn_id);
                
                // initialize variables with default values
                $criticality = 'non-critical';// default criticality
                $max_track_counter = 12;// default criticality
                
                // ------------------------------------------------------------------------------
                //check for nulls
                if (empty($node->V_MCU)) {
                    $vmcuNull++;
                    $nullV_IN[] = $node->TXT . $stn_name;
                    // get problem
                    foreach ($problemClassfications as $problem) {
                        // do a case insensitive check
                        if (stripos($problem->problem_description, "V_MCU") !== false) {
                            if (stripos($problem->problem_description, "empty") !== false) {
                                /**
                                 * getting the station problem configurations
                                 * problem criticality and max_counter
                                 */
                                    if ($stn_prb_conf !== null || $stn_prb_conf !== '') {
                                        foreach ($stn_prb_conf as $prb_conf) {
                                            if ($prb_conf->problem_id === $problem->id) {
                                                $criticality = $prb_conf->criticality;
                                                $max_track_counter = $prb_conf->max_track_counter;
                                            }
                                        }
                                    }
                                // check data in the problems table to see if problem has been reported yet.
                                $prob = $this->getProblem($nd_id,$nd_name,$problem->id); 
                                // dd($prob->isEmpty());
                                // dd($prob);

                                // $casted = get_object_vars($prob);
                                // dd($casted);
                                // dd(empty($casted));
                                
                                // $bool = get_object_vars($prob) ? TRUE : FALSE;
                                // dd(get_object_vars($prob));
                                // dd($bool);
                                if ($prob->isEmpty()) {
                                    /**
                                     * record doesn't exit in the database and so..
                                     * insert into the the problem into the database
                                     * at this point, we get the criticality of this problem
                                     */
                                    $this->insertIntoProbTb($nd_name, $nd_id, $criticality, $problem->id);
                                }
                                else {
                                    /**
                                     * problem exists
                                     * if problem is not yet reported, then increment the counter
                                     * after increment, check if the counter has reached max, if so, call the reporter and then set the status to reported.
                                     * if status is reported, then just update the 'updated_at' column to show that the problem was realised
                                     */

                                    // dd($prob);
                                    // dd($prob->isEmpty());
                                    // dd($prob->toArray());
                                    $prob = $prob->toArray();
                                    // dd($prob[0]['track_counter']);
                                    // dd($prob->get('track_counter'));
                                    // dd($prob->flatten(2));
                                    // dd($prob[0]->id);  
                                    // dd(count($prob));  
                                    $this->updateProblem($prob[0]->track_counter,$nd_id,$max_track_counter,$prob[0]->status,$prob[0]->id);
                                }
                                break;
                            }
                        }
                    }
                }
                if (empty($node->V_IN)) {
                    $vinNull++;
                    $nullVMCU[] = $node->TXT . $stn_name;
                    // get problem
                    foreach ($problemClassfications as $problem) {
                        // do a case insensitive check
                        if (stripos($problem->problem_description, "V_IN") !== false) {
                            if (stripos($problem->problem_description, "empty") !== false) {
                                // $str[] = $problem->problem_description . $stn_name;
                                break;
                            }
                        }
                    }
                }
                if (empty($node->date)) {
                    $dateNull++;
                }    
                // check for mins        
                if ($node->V_MCU < $vmcuMinVal) {
                    $vmcuMin++;
                    // get problem
                    foreach ($problemClassfications as $problem) {
                        // do a case insensitive check
                        if (stripos($problem->problem_description, "V_MCU") !== false) {
                            if (stripos($problem->problem_description, "minimum") !== false) {
                                // $str[] = $problem->problem_description . $stn_name;
                                break;
                            }
                        }
                    }
                }
                if ($node->V_IN < $vinMinVal) {
                    $vinMin++;
                    // get problem
                    foreach ($problemClassfications as $problem) {
                        // do a case insensitive check
                        if (stripos($problem->problem_description, "V_IN") !== false) {
                            if (stripos($problem->problem_description, "minimum") !== false) {
                                // $str[] = $problem->problem_description . $stn_name;
                                break;
                            }
                        }
                    }
                }
                $yearNow = substr($date,0,4);
                $yearRec = substr($node->date,0,4);
                if ($yearRec < $yearNow) {
                    $dateMin++;
                    $invalidDates[] = $yearRec;
                }            
                // check for maxs        
                if ($node->V_MCU > $vmcuMaxVal) {
                    $vmcuMax++;
                    // get problem
                    foreach ($problemClassfications as $problem) {
                        // do a case insensitive check
                        if (stripos($problem->problem_description, "V_MCU") !== false) {
                            if (stripos($problem->problem_description, "maximum") !== false) {
                                // $str[] = $problem->problem_description . $stn_name;
                                break;
                            }
                        }
                    }
                }
                if ($node->V_IN > $vinMaxVal) {
                    $vinMax++;
                    // get problem
                    foreach ($problemClassfications as $problem) {
                        // do a case insensitive check
                        if (stripos($problem->problem_description, "V_IN") !== false) {
                            if (stripos($problem->problem_description, "maximum") !== false) {
                                // $str[] = $problem->problem_description . $stn_name;
                                break;
                            }
                        }
                    }
                }
                if ($yearRec > $yearNow) {
                    $dateMax++;
                    $invalidDates[] = $yearRec;
                }        
            }
        });

        $wrongDateString = "\n";
        $wrongDates = array_count_values($invalidDates);
        foreach ($wrongDates as $key => $value) {
            $wrongDateString .= $key." appears ". $value." time(s). \n";
        };

        $probs = "\n";
        $probData = array_count_values($str);
        foreach ($probData as $key => $value) {
            $probs .= $key." ---> ". $value." time(s). \n";
        };

        $vinNulls = "\n";
        $nullsvin = array_count_values($nullV_IN);
        foreach ($nullsvin as $key => $value) {
            $vinNulls .= $key." appears ". $value." time(s). \n";
        };

        $vmcuNulls = "\n";
        $nullsvmcu = array_count_values($nullV_IN);
        foreach ($nullsvmcu as $key => $value) {
            $vmcuNulls .= $key." appears ". $value." time(s). \n";
        };

        $string = "V_IN nulls: ".$vinNull."\n"."V_IN mins: ".$vinMin."\n"."V_IN max: ".$vinMax."\n"."V_MCU nulls: ".$vmcuNull."\n"."V_MCU mins: ".$vmcuMin."\n"."V_MCU max: ".$vmcuMax."\n"."Date nulls: ".$dateNull."\n"."Date mins: ".$dateMin."\n"."Date Max: ".$dateMax."\n"."Problems : ".$probs."\n"."Wrong Dates: ".$wrongDateString."\n"."V_IN nulls: ".$vinNulls."\n"."V_IN nulls: ".$vmcuNulls;

        $funcs = 'non-critical'.PHP_EOL;
        dd($string);

        // return $datas;
        return view('layouts/tester', compact('datas'));
    }
}
