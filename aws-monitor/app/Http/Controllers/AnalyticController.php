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
use App\Models\problem_classification;
use App\Models\DetectedAnalyzerProblems;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
//use Illuminate\Http\Request;


use Illuminate\Http\Request;
//use App\App;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AnalyticController extends Controller
{
  //
  public function index()
  {


    $stations = Station::all()->where("stationCategory", "aws")->toArray();
    $userId = Auth::id();
    $userdetails = User::all()->where("id", $userId)->toArray();


    //========================================= Automatic Weather Stn Problems===============================================
    $x_awsProblems = array();
    $y_AwsPrbmOccurence = array();
    $probmClass = problem_classification::all()->where('id', '>', 0)->toArray();


    foreach ($userdetails as $u) {
      if ($u['station'] != NULL) {
        $months = Carbon::today()->subDays(30);

        $x_awsProblems = array();
        $y_AwsPrbmOccurence = array();
        $probmClass = problem_classification::all()->where('id', '>', 2)->toArray();


        foreach ($probmClass as $value) {
          # code...
          array_push($x_awsProblems, $value['problem_description']);

          // $occurenceOfprobm = Problems::where('classification_id',$value['id'])->where('stationID', $u['station'])->count();
          $occurenceOfprobm = Problems::orderByDesc('id')->where('classification_id', $value['id'])->where('when_reported', '>=', $months)->count();
          array_push($y_AwsPrbmOccurence, $occurenceOfprobm);
        }
      }
    }

    $months = Carbon::today()->subDays(30);
    // $avgTemp_Months = TwoMeterNode::whereNotNull('T_SHT2X')->where('stationID',$id)->where('RTC_T','>=',$months)->avg('T_SHT2X');


    foreach ($probmClass as $value) {
      # code...
      array_push($x_awsProblems, $value['problem_description']);

      $occurenceOfprobm = Problems::orderByDesc('id')->where('classification_id', $value['id'])->where('when_reported', '>=', $months)->count();
      // $occurenceOfprobm =100;

      array_push($y_AwsPrbmOccurence, $occurenceOfprobm);
    }
    // print_r($y_AwsPrbmOccurence);




    //***********************************************************************************************************************




    //==========================================AWS PERFORMANCES=============================================================
    $xValues = array();

    foreach ($stations as $stn) {
      $yDownTime = DetectedAnalyzerProblems::select('when_reported', 'when_fixed')->where('stationID', $stn['station_id'])->where('status', '<>', 'fixed')->where('Problem', 'Station_off')->orderBy('id', 'DESC')->limit(1)->get('when_reported', 'when_fixed');
      // echo("==============");
      $yDownTim = DetectedAnalyzerProblems::select('when_reported', 'when_fixed')->where('stationID', $stn['station_id'])->where('status', 'fixed')->where('Problem', 'Station_off')->orderBy('id', 'DESC')->limit(1)->get('when_reported', 'when_fixed');

      if (sizeof($yDownTime) == 0) {
        if (sizeof($yDownTim) != 0) {
          $downT = (strtotime($yDownTim[0]['when_fixed']) - strtotime($yDownTim[0]['when_reported'])) / 3600;
          array_push($xValues, $downT);
        }
      } else {
        $downT = (strtotime(date('Y-m-d H:i:s')) - strtotime($yDownTime[0]['when_reported'])) / 3600;
        array_push($xValues, $downT);
      }
    }
    $x_axix = Station::select('StationName')->where("stationCategory", "aws")->pluck('StationName')->toArray();
    //*************************************************************************************************************************

    //====================================== SENSOR PERFORMANCE GRAHP==========================================================

    $sensors = Problems::select('Value')->where("classification_id", 6)->groupBy('Value')->get('Value');



    //third tier users....

    foreach ($userdetails as $u) {
      if ($u['station'] != NULL) {
        $sensors = Problems::select('Value')->where("classification_id", 6)->where("stationID", $u['station'])->groupBy('Value')->get('Value');
        $y4Sensor = array();
        $x4Sensor = array();

        foreach ($sensors as $value) {


          // $occurence = Problems::where('Value',$value['Value'])->count();
          $occurence = Problems::where('Value', $value['Value'])->where('when_reported', '>=', $months)->count();


          array_push($y4Sensor, $value['Value']);

          array_push($x4Sensor, $occurence);
          # code...
        }
        return view("reports.analytic", compact('stations', 'x_axix', 'xValues', 'x_awsProblems', 'y_AwsPrbmOccurence', 'y4Sensor', 'x4Sensor'));
      }
    }
    //




    $y4Sensor = array();
    $x4Sensor = array();
    foreach ($sensors as $value) {

      $occurence = Problems::where('Value', $value['Value'])->count();

      array_push($y4Sensor, $value['Value']);

      array_push($x4Sensor, $occurence);
      # code...
    }
    //=========================================================================================================================================

    return view("reports.analytic", compact('stations', 'x_axix', 'xValues', 'x_awsProblems', 'y_AwsPrbmOccurence', 'y4Sensor', 'x4Sensor'));
  }


  public function show($id)
  {

    if ((Auth::user()->station == $id) || (Auth::user()->station == NULL)) {
      $stationTaken = Station::where('station_id', $id)->first()->toArray();
      $TwoM = DetectedAnalyzerProblems::where('stationID', $id)->where('Value', '-')->where('status', '<>', 'fixed')->where('NodeType', 'TwoMeterNode')->orderBy('id', 'DESC')->limit(1)->get();
      $TenM = DetectedAnalyzerProblems::where('stationID', $id)->where('Value', '-')->where('status', '<>', 'fixed')->where('NodeType', 'TenMeterNode')->orderBy('id', 'DESC')->limit(1)->get();
      $SnkN = DetectedAnalyzerProblems::where('stationID', $id)->where('Value', '-')->where('status', '<>', 'fixed')->where('NodeType', 'SinkNode')->orderBy('id', 'DESC')->limit(1)->get();
      $GrdN = DetectedAnalyzerProblems::where('stationID', $id)->where('Value', '-')->where('status', '<>', 'fixed')->where('NodeType', 'GroundNode')->orderBy('id', 'DESC')->limit(1)->get();

      $TwoM_ON = DetectedAnalyzerProblems::where('stationID', $id)->where('Value', '-')->where('status', 'fixed')->where('NodeType', 'TwoMeterNode')->orderBy('id', 'DESC')->limit(1)->get();
      $TenM_ON = DetectedAnalyzerProblems::where('stationID', $id)->where('Value', '-')->where('status', 'fixed')->where('NodeType', 'TenMeterNode')->orderBy('id', 'DESC')->limit(1)->get();
      $SnkN_ON = DetectedAnalyzerProblems::where('stationID', $id)->where('Value', '-')->where('status', 'fixed')->where('NodeType', 'SinkNode')->orderBy('id', 'DESC')->limit(1)->get();
      $GrdN_ON = DetectedAnalyzerProblems::where('stationID', $id)->where('Value', '-')->where('status', 'fixed')->where('NodeType', 'GroundNode')->orderBy('id', 'DESC')->limit(1)->get();
      //print_r($NodeDownTime);


      function getTimeDown($arra)
      {
        $var = 0;
        if (!empty($arra)) {
          foreach ($arra as $key) {
            if (($key['status']) != 'fixed') {
              $var = ((strtotime(date('Y-m-d H:i:s'))) - strtotime($key['when_reported'])) / (60);
            } elseif (!empty($key['when_fixed'])) {
              $var = (strtotime($key['when_fixed']) - strtotime($key['when_reported'])) / (60);
            } else {
              $var = ((strtotime(date('Y-m-d H:i:s'))) - strtotime($key['when_reported'])) / (60);
            }
          }
          return ($var);
        } else {
          return (0);
        }
      }


      if (sizeof($TwoM) == 1) {
        $var4TwoM = getTimeDown($TwoM);
      } else {
        $var4TwoM = getTimeDown($TwoM_ON);
      }
      if (sizeof($TenM) == 1) {
        $var4TenM = getTimeDown($TenM);
      } else {
        $var4TenM = getTimeDown($TenM_ON);
      }
      if (sizeof($SnkN) == 1) {
        $var4SinkN = getTimeDown($SnkN);
      } else {
        $var4SinkN = getTimeDown($SnkN_ON);
      }
      if (sizeof($GrdN) == 1) {
        $var4GrdN = getTimeDown($GrdN);
      } else {
        $var4GrdN = getTimeDown($GrdN_ON);
      }


      $twoNodeProblems = DetectedAnalyzerProblems::select('when_reported', 'Problem')->where('stationID', $id)->where('NodeType', 'TwoMeterNode')->orderBy('id', 'DESC')->take(1000)->get()->toArray();
      $tenNodeProblems = DetectedAnalyzerProblems::select('when_reported', 'Problem')->where('stationID', $id)->where('NodeType', 'TenMeterNode')->orderBy('id', 'DESC')->take(1000)->get()->toArray();
      $groundNodeProblems = DetectedAnalyzerProblems::select('when_reported', 'Problem')->where('stationID', $id)->where('NodeType', 'GroundNode')->orderBy('id', 'DESC')->take(1000)->get()->toArray();
      $sinkNodeProblems = DetectedAnalyzerProblems::select('when_reported', 'Problem')->where('stationID', $id)->where('NodeType', 'SinkNode')->orderBy('id', 'DESC')->take(1000)->get()->toArray();


      $yaxis4twoM = array();

      function countOccurence($arr)
      {
        $m = 0;
        $a = 0;
        $e = 0;
        $n = 0;
        # code...
        foreach ($arr as $value) {
          $H = (int)date("H", strtotime($value['when_reported']));
          if (($H >= 5) && ($H < 12)) {
            $m = $m + 1;
          } elseif (($H >= 12) && ($H < 17)) {
            $a = $a + 1;
          } elseif (($H >= 17) && ($H < 21)) {
            $e = $e + 1;
          } else {
            $n = $n + 1;
          }
        }
        return ([$m, $a, $e, $n]);
      }
      $yaxis4twoM = countOccurence($twoNodeProblems);
      $yaxis4tenM = countOccurence($tenNodeProblems);
      $yaxis4sink = countOccurence($sinkNodeProblems);
      $yaxis4grd = countOccurence($groundNodeProblems);

      return view('reports.selected_aws', compact('stationTaken', 'var4TwoM', 'var4TenM', 'var4SinkN', 'var4GrdN', 'yaxis4twoM', 'yaxis4tenM', 'yaxis4sink', 'yaxis4grd'));
    } else {
      echo ('<html><title>403</title><body><h1>403.....YOU DONT HAVE PERMISSION TO ACCESS THOSE STATISTICS.<h1></body></html>');
    }
  }
}
