<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::resource('addstation', 'StationsController');
Route::resource('configurestation', 'ConfigureStaion');
Route::post('updateStation','ConfigureStaion@update');

Route::resource('configure10mnode', 'TenMNodeController');
Route::resource('configure2mnode', 'TwoMNodeController');
Route::resource('configuresinknode', 'SinkNodeController');
Route::resource('configuregroundnode', 'GroundNodeController');
Route::get('/', function () {
    return view('main');
});

Route::get('/ajax-model', function () {

    return view('layouts/ajax-model.php');
});



Route::get('/addnode', function () {
    return view('layouts/addnode');
});

Route::get('/configurenode', function () {
    return view('layouts/configurenode');
});

Route::get('/addsensor', function () {
    return view('layouts/addsensor');
});

Route::get('/configuresensor', function () {
    return view('layouts/configuresensor');
});

Route::get('/tester',function(){

    // "date_time_recorded": "2018-02-28 15:40:19"
    // $tasks = DB::table('observationslip')->where('CreationDate','>=','2018-01-01 00:00:00')
    /* 
    DateTime @1522491220 {#261 ▼
        date: 2018-03-31 10:13:40.0 UTC (+00:00)
    }
    */

    $zone = new DateTimeZone('Africa/Kampala');// set timezone
    $date = new DateTime("now", $zone);// get current time
    // $date->sub(new DateInterval('PT1H'));// subtract one hour from current time
    $date = $date->format('Y-m-d H:m:s');// change date time object to string format used in the database.

    // test variables
    $vinNull = 0; $vmcuNull = 0; $dateNull = 0; $vinMin = 0; $vinMax = 0; $vmcuMin = 0; $vmcuMax = 0; $dateMin = 0; $dateMax = 0; $date1970 = 0; $invalidDates = array(); $nullV_IN = array(); $nullVMCU = array();

    // pick configuration info
    $nodeConf = DB::table('node_status_configurations')->select('txt_value','v_in_min_value','v_in_max_value','v_mcu_min_value','v_mcu_max_value')->get();

    // pick problem classification data
    $problemClassfications = DB::table('problem_classification')->select('id','problem_description','source')->get();
    $str = array();

    // pick the availble stations // station_id, StationName, StationNumber
    $stations = DB::table('stations')->select('station_id', 'StationName', 'StationNumber')->get();

    // pick only columns that we'll be using. We won't need date_time_recorded because we have
    $counts = DB::table('nodestatus')->select('V_MCU','V_IN','date','time','TXT','StationNumber')->orderBy('id')->chunk(400, function($nodes) use(&$vinNull, &$vmcuNull, &$dateNull, &$vinMin, &$vinMax, &$vmcuMin, &$vmcuMax, &$dateMin, &$dateMax, &$date, &$date1970, &$invalidDates, &$nodeConf, &$nullV_IN, &$nullVMCU, &$problemClassfications, &$str, &$stations){
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
            
            /**
             * getNodeAndStationIds(): returns assocative array of values
             * Get the respective node ids
             * '2m_node','10m_node','sink_node','ground_node'
             * this should be separated into its own function
             * the txt identifiers should be stated as variables to manage them as they change
             */
            if (stripos($node->TXT, 'gnd') !== false) {
                // node_id, station_id, txt_gnd_value
                $node_tb = DB::table('groundNode')->select('node_id','station_id','txt_gnd_value')->get();
                foreach ($node_tb as $nd_tb) {
                    if ($nd_tb->txt_gnd_value === $node->TXT) {
                        $stn_id = $nd_tb->station_id;
                        $nd_id = $nd_tb->node_id;
                        $nd_name = 'ground_node';
                        $str[] = $node->TXT .' -> '. $nd_tb->node_id .' -> '. $nd_tb->station_id;
                        break;
                    }
                }
            }
            else if (stripos($node->TXT, '2m') !== false) {
                // node_id, station_id, txt_gnd_value
                $node_tb = DB::table('twoMeterNode')->select('node_id','station_id','txt_2m_value')->get();
                foreach ($node_tb as $nd_tb) {
                    if ($nd_tb->txt_2m_value === $node->TXT) {
                        $stn_id = $nd_tb->station_id;
                        $nd_id = $nd_tb->node_id;
                        $nd_name = '2m_node';
                        $str[] = $node->TXT .' -> '. $nd_tb->node_id .' -> '. $nd_tb->station_id;
                        break;
                    }
                }
            }
            else if (stripos($node->TXT, '10m') !== false) {
                // node_id, station_id, txt_gnd_value
                $node_tb = DB::table('tenMeterNode')->select('node_id','station_id','txt_10m_value')->get();
                foreach ($node_tb as $nd_tb) {
                    if ($nd_tb->txt_10m_value === $node->TXT) {
                        $stn_id = $nd_tb->station_id;
                        $nd_id = $nd_tb->node_id;
                        $nd_name = '10m_node';
                        $str[] = $node->TXT .' -> '. $nd_tb->node_id .' -> '. $nd_tb->station_id;
                        break;
                    }
                }
            }
            else if (stripos($node->TXT, 'sink') !== false) {
                // node_id, station_id, txt_gnd_value
                $node_tb = DB::table('sinkNode')->select('node_id','station_id','txt_sink_value')->get();
                foreach ($node_tb as $nd_tb) {
                    if ($nd_tb->txt_sink_value === $node->TXT) {
                        $stn_id = $nd_tb->station_id;
                        $nd_id = $nd_tb->node_id;
                        $nd_name = 'sink_node';
                        $str[] = $node->TXT .' -> '. $nd_tb->node_id .' -> '. $nd_tb->station_id;
                        break;
                    }
                }
            }
            /**
             * getStationName()
             */
            foreach ($stations as $station) {
                if ($station->station_id === $stn_id) {
                    $station_name = $station->StationName;
                    $str[] = $station->StationName;
                    break;
                }
            }
            /**
             * getNodeConfigurations(): returns assocative array of values
             * Get the config data for each node
             * This is the point where we get the the vinMaxVal, vinMinVal, vmcuMaxVal, vmcuMinVal
             * Since only configured nodes are saved to the database, there shouldn't be an unassigned variable.
              */
            foreach ($nodeConf as $nodeConfig) {
                if ($nodeConfig->txt_value === $node->TXT) {// if the txt matches then get the config info
                    $vinMaxVal = $nodeConfig->v_in_max_value;
                    $vinMinVal = $nodeConfig->v_in_min_value;
                    $vmcuMaxVal = $nodeConfig->v_mcu_max_value;
                    $vmcuMinVal = $nodeConfig->v_mcu_min_value;
                    break;// exit loop since we have the info we need.
                }
            }

            /**
             * pick problem station configurations
             */
            // problem_id, station_id, max_track_counter, criticality
            $stn_prb_conf = DB::table('station_problem_settings')->where('station_id',$stn_id)->select('problem_id','max_track_counter','criticality')->get();
            // initialize variables with default values
            $criticality = 'non-critical';
            $max_track_counter = 12;
            
            // ------------------------------------------------------------------------------
            //check for nulls
            if ($node->V_MCU == '' || $node->V_MCU == null) {
                $vmcuNull++;
                $nullV_IN[] = $node->TXT . $stn_name;
                // get problem
                foreach ($problemClassfications as $problem) {
                    // do a case insensitive check
                    if (stripos($problem->problem_description, "V_MCU") !== false) {
                        if (stripos($problem->problem_description, "empty") !== false) {
                            // check data in the problems table to see if problem has been reported yet. // id, source_id, track_counter
                            $prob = DB::table('problems')-select('id','source_id','track_counter')->where('source_id','=',$nd_id)->get();
                            if ($prob !== null || $prob !== '') {
                                # code...
                            }
                            else {
                                /**
                                 * insert into the the problem into the database
                                 * at this point, we get the criticality of this problem
                                  */
                                // id, source[enum('sensor','station','2m_node','10m_node','sink_node','ground_node')], source_id, criticality[enum('critical', 'non-critical')], classification_id, track_counter, status[enum('reported', 'investigation', 'solved')]
                                DB::table('problems')->insert(
                                    ['source'=>$nd_name,'source_id'=>$nd_id,'criticality'=>]
                                );
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

    /**
     * get problem and test insertion
      */
    /* foreach ($problemClassfications as $problem) {
        // do a case insensitive check
        if (stripos($problem->problem_description, "V_MCU") !== false) {
            if (stripos($problem->problem_description, "maximum") !== false) {
                $prob = $problem->problem_description;
                // source, source_id, criticality, classification_id, status, created_at
                DB::table('problems')->insert([
                    ['source' => '2m_node','source_id' => $problem->id,'criticality' => 'critical','classification_id' => $problem->id, 'status' => 'investigation', 'created_at' => NOW()]
                ]);
                $prob .= " inserted :-)";
                if (stripos('2m_node', "2m") !== false) {
                    $prob .= " good News :-)";
                }
            }
        }
    } */


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

    //$funcs = get_defined_functions();
    dd($string);

    // return $datas;
    return view('layouts/tester', compact('datas'));
});