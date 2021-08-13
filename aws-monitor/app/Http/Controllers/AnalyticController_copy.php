<?php

namespace App\Http\Controllers;

//namespace App\Http\Controllers;

use App\layouts;
use App\Models\Station;
use App\Models\TwoMeterNode;
use App\Models\TenMeterNode;
use App\Models\SinkNode;
use App\Models\GroundNode;
use App\Models\Sensor;
use App\Models\ReportIntervalClusters;
use App\Models\ChangeTracker;
use App\Models\Problems;
use App\Models\PotentialProblem;
use App\Models\DetectedAnalyzerProblems;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
//use Illuminate\Http\Request;


use Illuminate\Http\Request;
//use App\Station;

class AnalyticController extends Controller
{
  //
  public function index()
  {

    // $data["headinga"]="Entebbe Station Reports";
    $stations = Station::all()->where("stationCategory", "aws");
    $x_axix = Station::select('StationName')->where("stationCategory", "aws")->pluck('StationName')->toArray();



    $Actualpackets = array();
    $expectedpackets = array();
    $y_axis = array();
    // =======================================STATION PERFORMANCE SINCE DEPLOYMENT=================================
    foreach ($stations as $key => $value) {

      $SNPackects = DB::table('SinkNode')
        ->where('stationID', $value['station_id'])
        ->count();
      $TwoMPackects = DB::table('TwoMeterNode')
        ->where('stationID', $value['station_id'])
        ->count();
      $TnMPackects = DB::table('TenMeterNode')
        ->where('stationID', $value['station_id'])
        ->count();
      $GNPackects = DB::table('GroundNode')
        ->where('stationID', $value['station_id'])
        ->count();

      $totalPackets = $SNPackects + $TwoMPackects + $TnMPackects + $GNPackects;
      $Actualpackets[$value['station_id']] = $totalPackets;


      $towMs = TenMeterNode::select('hoursSinceEpoch')->orderBy('id', 'ASC')->where('stationID', $value['station_id'])->limit(1)->pluck('hoursSinceEpoch')->first();

      $timeNow = time() / 60;
      $tenMs = TenMeterNode::select('hoursSinceEpoch')->orderBy('id', 'ASC')->where('stationID', $value['station_id'])->limit(1)->pluck('hoursSinceEpoch')->first();
      $Snks = SinkNode::select('hoursSinceEpoch')->orderBy('id', 'ASC')->where('stationID', $value['station_id'])->limit(1)->pluck('hoursSinceEpoch')->first();
      $Gnds = GroundNode::select('hoursSinceEpoch')->orderBy('id', 'ASC')->where('stationID', $value['station_id'])->limit(1)->pluck('hoursSinceEpoch')->first();

      $totalExpected = $timeNow - $towMs * 60 + $timeNow - $tenMs * 60 + $timeNow - $Gnds * 60 + $timeNow - $Snks * 60;


      $expectedpackets[$value['station_id']] = ($totalExpected);

      array_push($y_axis, round(($Actualpackets[$value['station_id']] / $expectedpackets[$value['station_id']]) * 100));
    }

    // =======================================STATION PERFORMANCE SINCE DEPLOYMENT END==================================

    // *****************************************************************************************************************



    // =======================================STATION PERFORMANCE LAST WEEK=============================================
    // function FunctionName($period)
    // {
    // $stations = Station::all()->where("stationCategory","aws");  
    // $ActualPct = array();
    // $y_axis4month = array();
    // $y_axis4week = array();
    // $y_axis4year = array();

    // foreach ($stations as $key => $value) {
    //   if ($period == "month"){
    //     $dateS = (time()/3600-(30*24));
    //   }
    //   if ($period == "week") {
    //     $dateS = (time()/3600-(7*24));
    //   }
    //   if ($period == "year") {
    //     $dateS = (time()/3600-(360*24));
    //   }

    // // print_r("=====================================");
    // // print_r($dateS);
    //   $SNPack = SinkNode::select('hoursSinceEpoch')
    //     ->where('stationID',$value['station_id'])
    //     ->orderBy('hoursSinceEpoch','DESC')
    //     ->where('hoursSinceEpoch','>',$dateS)
    //     ->count();
    //   $TwoMPack = TwoMeterNode::select('hoursSinceEpoch')
    //     ->where('stationID',$value['station_id'])
    //     ->orderBy('hoursSinceEpoch','DESC')
    //     ->where('hoursSinceEpoch','>',$dateS)
    //     ->count();
    //   $TnMPack = TenMeterNode::select('hoursSinceEpoch')
    //     ->where('stationID',$value['station_id'])
    //     ->orderBy('hoursSinceEpoch','DESC')
    //     ->where('hoursSinceEpoch','>',$dateS)
    //     ->count();
    //   $GNPack = GroundNode::select('hoursSinceEpoch')
    //     ->where('stationID',$value['station_id'])
    //     ->orderBy('hoursSinceEpoch','DESC')
    //     ->where('hoursSinceEpoch','>',$dateS)
    //     ->count();
    //      $totalPack= $SNPack + $TwoMPack + $TnMPack + $GNPack;
    // 	 $ActualPct[$value['station_id']]=$totalPack;

    //     // if ($period == "month"){
    //     //   $totalExpected = 43800*4;
    //     //   $expectedpackets[$value['station_id']]=($totalExpected);
    //     //   array_push($y_axis4month, round(($ActualPct[$value['station_id']]/$expectedpackets[$value['station_id']])*100));
    //     // }
    //     // if ($period == "week") {
    //     //   $totalExpected = 10080*4;
    //     //   $expectedpackets[$value['station_id']]=($totalExpected);
    //     //   array_push($y_axis4week, round(($ActualPct[$value['station_id']]/$expectedpackets[$value['station_id']])*100));
    //     // }
    //     // if ($period == "year") {
    //     //   $totalExpected = 525600*4;
    //     //   $expectedpackets[$value['station_id']]=($totalExpected);
    //     //   array_push($y_axis4year, round(($ActualPct[$value['station_id']]/$expectedpackets[$value['station_id']])*100));
    //     // }
    //   }

    //   if ($period == "month"){
    //     return $y_axis4month;  
    //   }
    //   if ($period == "week") {
    //     return $y_axis4week;
    //   }
    //   if ($period == "year") {
    //     return $y_axis4year;
    //   }

    // }

    // // =================================================================================================================

    // $y_axis4month =FunctionName("month");

    // $y_axis4week = FunctionName("week");

    // $y_axis4year = FunctionName("year");










    return view("reports.analytic", compact('stations', 'x_axix', 'y_axis', 'y_axis4month', 'y_axis4week', 'y_axis4year'));
  }
  public function show($id)
  {


    $stationTaken = Station::where('station_id', $id)->first()->toArray();
    $data["headinga"] = "Entebbe Station Reports";
    $axis = DetectedAnalyzerProblems::select('when_reported', 'Problem')->where('stationID', $id)->orderBy('id', 'DESC')->take(1000)->get()->toArray();
    $Reporting_intervals = ReportIntervalClusters::select('Node', 'cluster')->orderBy('id', 'DESC')->groupBy('Node')->where('stationID', $id)->get();
    $packets_recieved_GND = GroundNode::whereDate('DATE', Carbon::today())->where('stationID', $id)->count();
    $packets_recieved_TMN = TenMeterNode::whereDate('DATE', Carbon::today())->where('stationID', $id)->count();
    $packets_recieved_TWN = TwoMeterNode::whereDate('DATE', Carbon::today())->where('stationID', $id)->count();
    $packets_recieved_SNK = SinkNode::whereDate('DATE', Carbon::today())->where('stationID', $id)->count();
    $time_now = Carbon::now('Africa/Kampala')->format('H');



    return view('reports.selected_aws', $data, compact('stationTaken', 'axis', 'Reporting_intervals', 'ids', 'packets_recieved_GND', 'packets_recieved_TMN', 'packets_recieved_TWN', 'packets_recieved_SNK', 'time_now'));
  }
}
