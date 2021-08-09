<?php

namespace station\Http\Controllers;

use App\layouts;
use station\Models\Station;
use station\TwoMeterNode;
use station\TenMeterNode;
use station\SinkNode;
use station\GroundNode;
use station\Sensor;
use station\ReportIntervalClusters;
use station\ChangeTracker;
use station\Models\Problems;
use station\PotentialProblem;
use station\DetectedAnalyzerProblems;
use station\problem_classification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use station\Models\User;
use Carbon\Carbon;

class livedataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

$stations = Station::where('StationCategory', 'aws')->get();
// third tier users ...//
$userId = Auth::id();
$userdetails = User::all()->where("id",$userId)->toArray();
foreach($userdetails as $u){
    if ($u['station'] != NULL){

  $stationNames = Station::where('StationCategory','aws')->where('station_id', $u['station'])->orderBy('station_id','DESC')->get()->toArray();
  $stationsLivedata=array();
  foreach ($stationNames as $stationName) {
    $fp = fopen(asset('stationsData/cleanedData/'.$stationName['StationName'].'.csv'), "r");
    $data = array();
    while (($line = fgetcsv($fp)) !== FALSE) {
      array_push($data, $line);
    }
    fclose($fp);
    array_push($stationsLivedata,(array_pop($data)));
    # code...
  }
     return view('layouts.livedata', compact('stationsLivedata','stations'));
    }
}


//third tier users...///
  $stationNames = Station::where('StationCategory','aws')->orderBy('station_id','DESC')->get()->toArray();
  $stationsLivedata=array();
  foreach ($stationNames as $stationName) {
    $fp = fopen(asset('stationsData/cleanedData/'.$stationName['StationName'].'.csv'), "r");
    $data = array();
    while (($line = fgetcsv($fp)) !== FALSE) {
      array_push($data, $line);
    }
    fclose($fp);
    array_push($stationsLivedata,(array_pop($data)));
  	# code...
  }
        return view('layouts.livedata', compact('stationsLivedata','stations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      
  $stationNames = Station::where('StationCategory','aws')->where('station_id',$id)->orderBy('station_id','DESC')->get()->toArray();
  $weatherOverview=array();
  foreach ($stationNames as $stationName) {
    $fp = fopen(asset('stationsData/weatherOverview/'.$stationName['StationName'].'.csv'), "r");
    $dat = array();
    while (($lin = fgetcsv($fp)) !== FALSE) {
      array_push($dat, $lin);
    }
    fclose($fp);
    // echo("----------------------");
    // print_r($dat[1][1]);
    // array_push($weatherOverview,(array_pop($data)));
    # code...
  }


$stationTaken = Station::where('station_id', $id)->first()->toArray();
$problemsForStation = array();
$problemsForStation = problems::join('problem_classification','problems.classification_id','=','problem_classification.id')->where('status','<>','fixed')->where('stationID',$id)->get();

        return view('layouts.selectedAwsLivedata',compact('stationTaken','dat','problemsForStation',));
    

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /* 
        'station_id', 'StationName', 'StationNumber', 'StationRegNumber', 'Location', 'Indicator', 'StationRegion', 'Country', 'Latitude', 'Longitude', 'Altitude', 'StationStatus', 'StationType', 'Opened', 'Closed', 'SubmittedBy', 'CreationDate'
        */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
