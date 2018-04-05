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
    $vinNull = 0; $vmcuNull = 0; $dateNull = 0; $vinMin = 0; $vinMax = 0; $vmcuMin = 0; $vmcuMax = 0; $dateMin = 0; $dateMax = 0; $date1970 = 0; $invalidDates = array(); $nullV_IN = array(); $nullVMCU = array(); $nodesAvailable = array();

    // pick configuration info
    $nodeConf = DB::table('node_status_configurations')->select('txt_value','v_in_min_value','v_in_max_value','v_mcu_min_value','v_mcu_max_value')->get();

    // pick problem classification data
    $problemClassification = DB::table('problem_classification')->select('id','problem_description','source')->get();
    $str = array();

    // pick only columns that we'll be using. We won't need date_time_recorded because we have
    $counts = DB::table('nodestatus')->select('V_MCU','V_IN','date','time','TXT','StationNumber')->orderBy('id')->chunk(400, function($nodes) use(&$vinNull, &$vmcuNull, &$dateNull, &$vinMin, &$vinMax, &$vmcuMin, &$vmcuMax, &$dateMin, &$dateMax, &$date, &$date1970, &$invalidDates, &$nodeConf, &$nullV_IN, &$nullVMCU, &$nodesAvailable, &$problemClassification, &$str){
        foreach ($nodes as $node) {
            /**
             * Get the config data for each node
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
            //store all the nodes in the data
            $nodesAvailable[] = $node->TXT;
            //check for nulls
            if ($node->V_MCU == ''| $node->V_MCU == null) {
                $vmcuNull++;
                $nullV_IN[] = $node->TXT;
                // get problem
                foreach ($problemClassification as $problem) {
                    // do a case insensitive check
                    if (stripos($problem->problem_description, "V_MCU") !== false) {
                        if (stripos($problem->problem_description, "empty") !== false) {
                            $str[] = $problem->problem_description;
                            break;
                        }
                    }
                }
            }
            if ($node->V_IN == ''| $node->V_IN == null) {
                $vinNull++;
                $nullVMCU[] = $node->TXT;
                // get problem
                foreach ($problemClassification as $problem) {
                    // do a case insensitive check
                    if (stripos($problem->problem_description, "V_IN") !== false) {
                        if (stripos($problem->problem_description, "empty") !== false) {
                            $str[] = $problem->problem_description;
                            break;
                        }
                    }
                }
            }
            if ($node->date == ''| $node->date == null) {
                $dateNull++;
            }    
            // check for mins        
            if ($node->V_MCU < $vmcuMinVal) {
                $vmcuMin++;
                // get problem
                foreach ($problemClassification as $problem) {
                    // do a case insensitive check
                    if (stripos($problem->problem_description, "V_MCU") !== false) {
                        if (stripos($problem->problem_description, "minimum") !== false) {
                            $str[] = $problem->problem_description;
                            break;
                        }
                    }
                }
            }
            if ($node->V_IN < $vinMinVal) {
                $vinMin++;
                // get problem
                foreach ($problemClassification as $problem) {
                    // do a case insensitive check
                    if (stripos($problem->problem_description, "V_IN") !== false) {
                        if (stripos($problem->problem_description, "minimum") !== false) {
                            $str[] = $problem->problem_description;
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
                foreach ($problemClassification as $problem) {
                    // do a case insensitive check
                    if (stripos($problem->problem_description, "V_MCU") !== false) {
                        if (stripos($problem->problem_description, "maximum") !== false) {
                            $str[] = $problem->problem_description;
                            break;
                        }
                    }
                }
            }
            if ($node->V_IN > $vinMaxVal) {
                $vinMax++;
                // get problem
                foreach ($problemClassification as $problem) {
                    // do a case insensitive check
                    if (stripos($problem->problem_description, "V_IN") !== false) {
                        if (stripos($problem->problem_description, "maximum") !== false) {
                            $str[] = $problem->problem_description;
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

    // get problem
    foreach ($problemClassification as $problem) {
        // do a case insensitive check
        if (stripos($problem->problem_description, "V_MCU") !== false) {
            if (stripos($problem->problem_description, "maximum") !== false) {
                $prob = $problem->problem_description;
                // source, source_id, criticality, classification_id, status, created_at
                DB::table('problems')->insert([
                    ['source' => 'node','source_id' => $problem->id,'criticality' => 'critical','classification_id' => $problem->id, 'status' => 'investigation', 'created_at' => NOW()]
                ]);
                $prob .= " inserted :-)";
                if (stripos('2m_node', "2m") !== false) {
                    $prob .= " good News :-)";
                }
            }
        }
    }


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

    $nodesRead = "\n";
    $nodesAvail = array_count_values($nodesAvailable);
    foreach ($nodesAvail as $key => $value) {
        $nodesRead .= $key." appears ". $value." time(s). \n";
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

    $string = "V_IN nulls: ".$vinNull."\n"."V_IN mins: ".$vinMin."\n"."V_IN max: ".$vinMax."\n"."V_MCU nulls: ".$vmcuNull."\n"."V_MCU mins: ".$vmcuMin."\n"."V_MCU max: ".$vmcuMax."\n"."Date nulls: ".$dateNull."\n"."Date mins: ".$dateMin."\n"."Date Max: ".$dateMax."\n"."Problems : ".$probs."\n"."Nodes present: ".$nodesRead."\n"."Wrong Dates: ".$wrongDateString."\n"."V_IN nulls: ".$vinNulls."\n"."V_IN nulls: ".$vmcuNulls;

    //$funcs = get_defined_functions();
    dd($prob);

    // return $datas;
    return view('layouts/tester', compact('datas'));
});