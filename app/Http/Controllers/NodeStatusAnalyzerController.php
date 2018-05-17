<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use station\Http\Controllers\Controller;
use DateTimeZone;
use DateTime;
use AnalyzerDBHandler;

class NodeStatusAnalyzerController extends Controller
{
    
    public function __construct(Type $var = null)
    {
        $DBHandler = new AnalyzerDBHandler();
    }

    /**
     * @param $nd_id
     * @param $nd_name
     * @param $problemClassfications
     * @param $param - "V_IN,V_MCU,..." paramaters being checked
     * @param $prob - "empty, null,..." any anormally being checked
     * @param $stn_prb_conf - the station configurations 
     * @param $problemId
     * @param $criticality
     * @param $max_track_counter
     */
    private function checkoutProblem($nd_id,$nd_name,$problemClassfications,$param,$prob,$stn_prb_conf,$problemId,$criticality,$max_track_counter)
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
                            if ($prb_conf->problem_id === $problemId) {
                                $criticality = $prb_conf->criticality;
                                $max_track_counter = $prb_conf->max_track_counter;
                            }
                        }
                    }
                    $DBHandler->registerProblem($nd_id, $nd_name, $problemId, $criticality, $max_track_counter);
                    break;
                }
            }
        }
    }

    /**
     * Function that is run
      */
    public function analyze()
    {
        // first clean DB
        $DBHandler->cleanDBTable($this->prob_tb);
        //get time diff to use for querying the db
        // $tasks = DB::table('observationslip')->where('CreationDate','>=',$this->getTimeDiff())
        $date = $DBHandler->getTimeDiff();
        
        // store the first and last id checked  ->where()
        $id_first_checked = 0;
        $id_last_checked = 0;
        $counter = 1;

        // pick problem classification data
        $problemClassfications = $DBHandler->getProblemClassifications();

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
                
                $nodeInfo = $this->getNodeAndStationInfo($node->TXT);
                // dd($nodeInfo);
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
                    // get problem
                    $this->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_MCU","empty",$stn_prb_conf,$problem->id,$criticality,$max_track_counter);
                    /* foreach ($problemClassfications as $problem) {
                        // do a case insensitive check
                        if (stripos($problem->problem_description, "V_MCU") !== false) {
                            if (stripos($problem->problem_description, "empty") !== false) {
                                
                                if ($stn_prb_conf->isNotEmpty()) {
                                    foreach ($stn_prb_conf as $prb_conf) {
                                        if ($prb_conf->problem_id === $problem->id) {
                                            $criticality = $prb_conf->criticality;
                                            $max_track_counter = $prb_conf->max_track_counter;
                                        }
                                    }
                                }
                                $this->registerProblem($nd_id, $nd_name, $problem->id, $criticality, $max_track_counter);
                                break;
                            }
                        }
                    } */
                }
                if (empty($node->V_IN)) {
                    $this->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_IN","empty",$stn_prb_conf,$problem->id,$criticality,$max_track_counter);
                    // get problem
                    /* foreach ($problemClassfications as $problem) {
                        // do a case insensitive check
                        if (stripos($problem->problem_description, "V_IN") !== false) {
                            if (stripos($problem->problem_description, "empty") !== false) {
                                
                                if ($stn_prb_conf->isNotEmpty()) {
                                    foreach ($stn_prb_conf as $prb_conf) {
                                        if ($prb_conf->problem_id === $problem->id) {
                                            $criticality = $prb_conf->criticality;
                                            $max_track_counter = $prb_conf->max_track_counter;
                                        }
                                    }
                                }
                                $this->registerProblem($nd_id, $nd_name, $problem->id, $criticality, $max_track_counter);
                                break;
                            }
                        }
                    } */
                }
                if (empty($node->date)) {
                    $this->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Date","empty",$stn_prb_conf,$problem->id,$criticality,$max_track_counter);
                    // get problem
                    /* foreach ($problemClassfications as $problem) {
                        // do a case insensitive check
                        if (stripos($problem->problem_description, "Date") !== false) {
                            if (stripos($problem->problem_description, "empty") !== false) {
                                
                                if ($stn_prb_conf->isNotEmpty()) {
                                    foreach ($stn_prb_conf as $prb_conf) {
                                        if ($prb_conf->problem_id === $problem->id) {
                                            $criticality = $prb_conf->criticality;
                                            $max_track_counter = $prb_conf->max_track_counter;
                                        }
                                    }
                                }
                                $this->registerProblem($nd_id, $nd_name, $problem->id, $criticality, $max_track_counter);
                                break;
                            }
                        }
                    } */
                }    
                // check for mins        
                if ($node->V_MCU < $vmcuMinVal) {
                    $this->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_MCU","minimum",$stn_prb_conf,$problem->id,$criticality,$max_track_counter);
                    // get problem
                    /* foreach ($problemClassfications as $problem) {
                        // do a case insensitive check
                        if (stripos($problem->problem_description, "V_MCU") !== false) {
                            if (stripos($problem->problem_description, "minimum") !== false) {
                                
                                if ($stn_prb_conf->isNotEmpty()) {
                                    foreach ($stn_prb_conf as $prb_conf) {
                                        if ($prb_conf->problem_id === $problem->id) {
                                            $criticality = $prb_conf->criticality;
                                            $max_track_counter = $prb_conf->max_track_counter;
                                        }
                                    }
                                }
                                $this->registerProblem($nd_id, $nd_name, $problem->id, $criticality, $max_track_counter);
                                break;
                            }
                        }
                    } */
                }
                if ($node->V_IN < $vinMinVal) {
                    $this->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_IN","minimum",$stn_prb_conf,$problem->id,$criticality,$max_track_counter);
                    // get problem
                    /* foreach ($problemClassfications as $problem) {
                        // do a case insensitive check
                        if (stripos($problem->problem_description, "V_IN") !== false) {
                            if (stripos($problem->problem_description, "minimum") !== false) {
                                
                                if ($stn_prb_conf->isNotEmpty()) {
                                    foreach ($stn_prb_conf as $prb_conf) {
                                        if ($prb_conf->problem_id === $problem->id) {
                                            $criticality = $prb_conf->criticality;
                                            $max_track_counter = $prb_conf->max_track_counter;
                                        }
                                    }
                                }
                                $this->registerProblem($nd_id, $nd_name, $problem->id, $criticality, $max_track_counter);
                                break;
                            }
                        }
                    } */
                }
                if ($yearRec < $yearNow) {
                    if ($yearRec === '1970') {
                        $this->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Date","1970",$stn_prb_conf,$problem->id,$criticality,$max_track_counter);
                        // get problem
                        /* foreach ($problemClassfications as $problem) {
                            // do a case insensitive check
                            if (stripos($problem->problem_description, "Date") !== false) {
                                if (stripos($problem->problem_description, "1970") !== false) {
                                    
                                    if ($stn_prb_conf->isNotEmpty()) {
                                        foreach ($stn_prb_conf as $prb_conf) {
                                            if ($prb_conf->problem_id === $problem->id) {
                                                $criticality = $prb_conf->criticality;
                                                $max_track_counter = $prb_conf->max_track_counter;
                                            }
                                        }
                                    }
                                    $this->registerProblem($nd_id, $nd_name, $problem->id, $criticality, $max_track_counter);
                                    break;
                                }
                            }
                        } */
                    }
                    else{
                        $this->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Date","below",$stn_prb_conf,$problem->id,$criticality,$max_track_counter);
                        // get problem
                        /* foreach ($problemClassfications as $problem) {
                            // do a case insensitive check
                            if (stripos($problem->problem_description, "Date") !== false) {
                                if (stripos($problem->problem_description, "below") !== false) {
                                   
                                    if ($stn_prb_conf->isNotEmpty()) {
                                        foreach ($stn_prb_conf as $prb_conf) {
                                            if ($prb_conf->problem_id === $problem->id) {
                                                $criticality = $prb_conf->criticality;
                                                $max_track_counter = $prb_conf->max_track_counter;
                                            }
                                        }
                                    }
                                    $this->registerProblem($nd_id, $nd_name, $problem->id, $criticality, $max_track_counter);
                                    break;
                                }
                            }
                        } */
                    }
                }            
                // check for maxs        
                if ($node->V_MCU > $vmcuMaxVal) {
                    $this->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_MCU","maximum",$stn_prb_conf,$problem->id,$criticality,$max_track_counter);
                    // get problem
                    /* foreach ($problemClassfications as $problem) {
                        // do a case insensitive check
                        if (stripos($problem->problem_description, "V_MCU") !== false) {
                            if (stripos($problem->problem_description, "maximum") !== false) {
                                
                                if ($stn_prb_conf->isNotEmpty()) {
                                    foreach ($stn_prb_conf as $prb_conf) {
                                        if ($prb_conf->problem_id === $problem->id) {
                                            $criticality = $prb_conf->criticality;
                                            $max_track_counter = $prb_conf->max_track_counter;
                                        }
                                    }
                                }
                                $this->registerProblem($nd_id, $nd_name, $problem->id, $criticality, $max_track_counter);
                                break;
                            }
                        }
                    } */
                }
                if ($node->V_IN > $vinMaxVal) {
                    $this->checkoutProblem($nd_id,$nd_name,$problemClassfications,"V_IN","maximum",$stn_prb_conf,$problem->id,$criticality,$max_track_counter);
                    // get problem
                    /* foreach ($problemClassfications as $problem) {
                        // do a case insensitive check
                        if (stripos($problem->problem_description, "V_IN") !== false) {
                            if (stripos($problem->problem_description, "maximum") !== false) {
                               
                                if ($stn_prb_conf->isNotEmpty()) {
                                    foreach ($stn_prb_conf as $prb_conf) {
                                        if ($prb_conf->problem_id === $problem->id) {
                                            $criticality = $prb_conf->criticality;
                                            $max_track_counter = $prb_conf->max_track_counter;
                                        }
                                    }
                                }
                                $this->registerProblem($nd_id, $nd_name, $problem->id, $criticality, $max_track_counter);
                                break;
                            }
                        }
                    } */
                }
                if ($yearRec > $yearNow) {
                    $this->checkoutProblem($nd_id,$nd_name,$problemClassfications,"Date","above",$stn_prb_conf,$problem->id,$criticality,$max_track_counter);
                    // get problem
                    /* foreach ($problemClassfications as $problem) {
                        // do a case insensitive check
                        if (stripos($problem->problem_description, "Date") !== false) {
                            if (stripos($problem->problem_description, "above") !== false) {
                                
                                if ($stn_prb_conf->isNotEmpty()) {
                                    foreach ($stn_prb_conf as $prb_conf) {
                                        if ($prb_conf->problem_id === $problem->id) {
                                            $criticality = $prb_conf->criticality;
                                            $max_track_counter = $prb_conf->max_track_counter;
                                        }
                                    }
                                }
                                $this->registerProblem($nd_id, $nd_name, $problem->id, $criticality, $max_track_counter);
                                break;
                            }
                        }
                    } */
                } 
                
                $counter++;
                if ($counter == 500) { // check if max has been reached.
                    break; // stop loop...
                }
            }

            dd($counter);
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
