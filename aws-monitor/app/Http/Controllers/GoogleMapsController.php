<?php

namespace station\Http\Controllers;


use App\layouts;
use station\Station;
use station\TwoMeterNode;
use station\TenMeterNode;
use station\SinkNode;
use station\GroundNode;
use station\Sensor;
use station\ReportIntervalClusters;
use station\ChangeTracker;
use station\Problems;
use station\PotentialProblem;
use station\DetectedAnalyzerProblems;
use station\problem_classification;
use Illuminate\Http\Request;
use Carbon\Carbon;
//use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Request;
//  use station\DetectedAnalyzerProblems;
use DB;


class GoogleMapsController extends Controller
{
	 public function index()
    {
    
  $stations_off = DetectedAnalyzerProblems::select('stationID')->where('Problem', '=', 'Station_off')->where('status', '<>','fixed')->get();//->toArray(); 
  $data= DB::table('stations')->select('Latitude','Longitude','Location','station_id')->where('stationCategory','=','aws')->orderBy('station_id','DESC')->get();
$stations = Station::select('station_id')->where('stationCategory','aws')->get()->toArray();

$Actualpackets= array();
$expectedpackets = array();

foreach ($stations as $key => $value) {

  $SNPackects = DB::table('SinkNode')
            ->where('stationID',$value['station_id'])
            ->count('stationID');
  $TwoMPackects = DB::table('TwoMeterNode')
            ->where('stationID',$value['station_id'])
            ->count('stationID');
  $TnMPackects = DB::table('TenMeterNode')
            ->where('stationID',$value['station_id'])
            ->count('stationID');
  $GNPackects = DB::table('GroundNode')
            ->where('stationID',$value['station_id'])
            ->count('stationID');

   $totalPackets= $SNPackects+$TwoMPackects+$TnMPackects+$GNPackects;
   $Actualpackets[$value['station_id']]=$totalPackets;


   	$towMs=TenMeterNode::select('hoursSinceEpoch')->orderBy('id','ASC')->where('stationID', $value['station_id'])->limit(1)->pluck('hoursSinceEpoch')->first();
   	//print_r($towMs);
   //	$currentTime = Carbon::now()->toDateTimeString();
   	//print_r(($towMs*60)-$timeNow);
   	$timeNow=time()/60;
	$tenMs=TenMeterNode::select('hoursSinceEpoch')->orderBy('id','ASC')->where('stationID', $value['station_id'])->limit(1)->pluck('hoursSinceEpoch')->first();
	$Snks=SinkNode::select('hoursSinceEpoch')->orderBy('id','ASC')->where('stationID', $value['station_id'])->limit(1)->pluck('hoursSinceEpoch')->first();
	$Gnds=GroundNode::select('hoursSinceEpoch')->orderBy('id','ASC')->where('stationID', $value['station_id'])->limit(1)->pluck('hoursSinceEpoch')->first();
	$totalExpected= $timeNow-$towMs*60 + $timeNow-$tenMs*60 + $timeNow-$Gnds*60 + $timeNow-$Snks*60;


   	$expectedpackets[$value['station_id']]=($totalExpected);
	# code...
}

//=====================ACTUAL PACKETS RECEIVED SINCE DEPLOYMENT========================================


   //print_r($f);
   //print_r($f);
   return view('reports/googlemaps',compact('expectedpackets','tenMs','Snks','Gnds','data','Actualpackets','stations_off'));
     }

}
