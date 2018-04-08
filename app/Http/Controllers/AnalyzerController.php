<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;

class AnalyzerController extends Controller
{
    
    private $node_status_configurations_tb;

    public function __construct() {
        $this->node_status_configurations_tb = 'node_status_configurations';
    }

    private function getNodeConf(){
        $nodeConf = DB::table($node_status_configurations_tb)->select('txt_value','v_in_min_value','v_in_max_value','v_mcu_min_value','v_mcu_max_value')->get();
        return $nodeConf;
    }

    private function getProblemClassifications(){
        $problemClassfications = DB::table('problem_classification')->select('id','problem_description','source')->get();
        return $problemClassfications;
    }

    private function getStations(){
        $stations = DB::table('stations')->select('station_id', 'StationName', 'StationNumber')->get();
        return $stations;
    }
    
    private function getStationName($stn_id){
        $station_name = '';
        $stations = getStations(); 

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
     * getNodeConfigurations(): returns assocative array of values
     * Get the config data for each node
     * This is the point where we get the the vinMaxVal, vinMinVal, vmcuMaxVal, vmcuMinVal
     * Since only configured nodes are saved to the database, there shouldn't be an unassigned variable.
     */
    private function getStationProbConfigs($stn_id){
        
        // problem_id, station_id, max_track_counter, criticality
        $stn_prb_conf = DB::table('station_problem_settings')->where('station_id',$stn_id)->select('problem_id','max_track_counter','criticality')->get();

        return $stn_prb_conf;
    }

    /**
     * getNodeAndStationIds(): returns assocative array of values
     * Get the respective node ids
     * '2m_node','10m_node','sink_node','ground_node'
     * this should be separated into its own function
     * the txt identifiers should be stated as variables to manage them as they change
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
            $node_tb = DB::table('groundNode')->select('node_id','station_id','txt_gnd_value')->get();
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
            $node_tb = DB::table('twoMeterNode')->select('node_id','station_id','txt_2m_value')->get();
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
            $node_tb = DB::table('tenMeterNode')->select('node_id','station_id','txt_10m_value')->get();
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
            $node_tb = DB::table('sinkNode')->select('node_id','station_id','txt_sink_value')->get();
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

    public function analyze()
    {
        // "date_time_recorded": "2018-02-28 15:40:19"
        // $tasks = DB::table('observationslip')->where('CreationDate','>=','2018-01-01 00:00:00')
        $zone = new DateTimeZone('Africa/Kampala');// set timezone
        $date = new DateTime("now", $zone);// get current time
        // $date->sub(new DateInterval('PT1H'));// subtract one hour from current time
        $date = $date->format('Y-m-d H:m:s');// change date time object to string format used in the database.
        // test variables
        $vinNull = 0; $vmcuNull = 0; $dateNull = 0; $vinMin = 0; $vinMax = 0; $vmcuMin = 0; $vmcuMax = 0; $dateMin = 0; $dateMax = 0; $date1970 = 0; $invalidDates = array(); $nullV_IN = array(); $nullVMCU = array();

        // pick configuration info
        $nodeConf = getNodeConf();

        // pick problem classification data
        $problemClassfications = getProblemClassifications();
        $str = array();

        // pick the availble stations // station_id, StationName, StationNumber
        $stations = getStations();

        // pick only columns that we'll be using. We won't need date_time_recorded because we have
        DB::table('nodestatus')->select('V_MCU','V_IN','date','time','TXT','StationNumber')->orderBy('id')->chunk(200, function($nodes) use(&$vinNull, &$vmcuNull, &$dateNull, &$vinMin, &$vinMax, &$vmcuMin, &$vmcuMax, &$dateMin, &$dateMax, &$date, &$date1970, &$invalidDates, &$nodeConf, &$nullV_IN, &$nullVMCU, &$problemClassfications, &$str){
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
                
                $nodeInfo = getNodeAndStationInfo($node->TXT);

                $nd_id = $nodeInfo['nd_id'];
                $nd_name = $nodeInfo['nd_name'];
                $stn_id = $nodeInfo['stn_id'];
                $stn_name = getStationName($stn_id);
                $vinMaxVal = $nodeInfo['vinMaxVal'];
                $vinMinVal = $nodeInfo['vinMinVal'];
                $vmcuMaxVal = $nodeInfo['vmcuMaxVal'];
                $vmcuMinVal = $nodeInfo['vmcuMinVal'];
                
                // pick problem station configurations
                $stn_prb_conf = getStationProbConfigs($stn_id);
                
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
                                // check data in the problems table to see if problem has been reported yet. // id, source_id, track_counter
                                $prob = DB::table('problems')->select('id','source_id','track_counter')->where([
                                    ['source_id','=',$nd_id],
                                    ['status','<>','solved'],
                                ])->get();
                                if (empty($prob)) {
                                    /**
                                     * hence record doesn't exit in the database and so..
                                     * insert into the the problem into the database
                                     * at this point, we get the criticality of this problem
                                     */
                                    // id, source[enum('sensor','station','2m_node','10m_node','sink_node','ground_node')], source_id, criticality[enum('critical', 'non-critical')], classification_id, track_counter, status[enum('reported', 'investigation', 'solved')], created_at, updated_at
                                    
                                    DB::table('problems')->insert(
                                        ['source'=>$nd_name,'source_id'=>$nd_id,'criticality'=>$criticality,'classification_id'=>$problem->id,'track_counter'=>1,''=>'investigation']
                                    );
                                }
                                else {
                                    /**
                                     * problem exists
                                     * if problem is not yet reported, then increment the counter
                                     * after increment, check if the counter has reached max, if so, call the reporter and then set the status to reported.
                                     * if status is reported, then just update the 'updated_at' column to show that the problem was realised
                                     */
                                    DB::table('problems')->where('source_id','=',$nd_id)->increment('track_counter');
                                }
                                break;
                            }
                        }
                    }
                }
                if ($node->V_IN == '' || $node->V_IN == null) {
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
                if ($node->date == '' || $node->date == null) {
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
