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

Route::get('/faker',function(){

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
    $vinNull = 0;
    $vmcuNull = 0;
    $dateNull = 0;
    $vinMin = 0;
    $vinMax = 0;
    $vmcuMin = 0;
    $vmcuMax = 0;
    $dateMin = 0;
    $dateMax = 0;
    $date1970 = 0;
    $dateArray = array();
    // pick only columns that we'll be using. We won't need date_time_recorded because we have
    $counts = DB::table('nodestatus')->select('V_MCU','V_IN','date','time','TXT','StationNumber')->orderBy('id')->chunk(100, function($nodes) use(&$vinNull, &$vmcuNull, &$dateNull, &$vinMin, &$vinMax, &$vmcuMin, &$vmcuMax, &$dateMin, &$dateMax, &$date, &$date1970, &$dateArray){
        foreach ($nodes as $node) {
            //check for nulls
            if ($node->V_MCU == ''| $node->V_MCU == null) {
                $vmcuNull++;
            }
            if ($node->V_IN == ''| $node->V_IN == null) {
                $vinNull++;
            }
            if ($node->date == ''| $node->date == null) {
                $dateNull++;
            }    
            // check for mins        
            if ($node->V_MCU < '3.5') {
                $vinMin++;
            }
            if ($node->V_IN < '3.5') {
                $vmcuMin++;
            }
            $yearNow = substr($date,0,4);
            $yearRec = substr($node->date,0,4);
            if ($yearRec < $yearNow) {
                $dateMin++;
                $dateArray[] = $yearRec;
            }            
            // check for maxs        
            if ($node->V_MCU > '3.5') {
                $vinMax++;
            }
            if ($node->V_IN > '3.5') {
                $vmcuMax++;
            }
            $yearNow = substr($date,0,4);
            $yearRec = substr($node->date,0,4);
            if ($yearRec > $yearNow) {
                $dateMax++;
                $dateArray[] = $yearRec;
            }            
            if ($yearRec == '1970') {
                $date1970++;
            }            
        }
    });
    $wrongDateString = "";
    $wrongDates = array_count_values($dateArray);
    foreach ($wrongDates as $key => $value) {
        $wrongDateString .= $key." appears ". $value." times. \n";
    };
    $string = "V_IN nulls: ".$vinNull."\n"."V_MCU nulls: ".$vmcuNull."\n"."Date nulls: ".$dateNull."\n"."V_IN mins: ".$vinMin."\n"."V_IN max: ".$vinMax."\n"."V_MCU mins: ".$vmcuMin."\n"."V_MCU max: ".$vmcuMax."\n"."V_IN nulls: ".$dateMin."\n"."Date Max: ".$dateMax."\n"."1970 Date: ".$date1970."\n"."Wrong Dates: ".$wrongDateString;

    
    dd($string);

    // return $datas;
    return view('layouts/fakerTests', compact('datas'));
});