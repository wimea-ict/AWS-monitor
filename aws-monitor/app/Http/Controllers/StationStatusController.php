<?php

namespace App\Http\Controllers;

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
use App\Models\problem_classification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class StationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations_with_problems = array();
        $problems_identified = array();
        $TwoM = array();
        $TenM = array();
        $SinkN = array();
        $GroundN = array();
        $stations_off = array();

        $problems_identified = problems::join('DetectedAnalyzerProblems', 'DetectedAnalyzerProblems.stationID', '=', 'problems.stationID')->groupBy('DetectedAnalyzerProblems.stationID')->groupBy('problems.stationID')->where('DetectedAnalyzerProblems.status', '<>', 'fixed')->where('problems.status', '<>', 'fixed')->where('problems.classification_id', '<', 9)->where('problems.classification_id', '<>', 5)->get()->toArray();

        $problems_analyzed = DetectedAnalyzerProblems::where('Problem', '!=', 'Station_off')->where('status', '<>', 'fixed')->get()->toArray();
        $classified_problems = Problems::select('stationID', 'status', 'Value')->where('status', '<>', 'fixed')->where('classification_id', '<>', 5)->take(100)->where('classification_id', '<>', 6)->where('classification_id', '<', 8)->take(100)->get()->toArray();
        $problems_identified = array_merge($problems_analyzed, $classified_problems);



        $userId = Auth::id();
        $userdetails = User::all()->where("id", $userId)->toArray();

        // foreach ($userdetails as $u) {
        //     if ($u['station'] != NULL) {

        //         $stations_off = DetectedAnalyzerProblems::where('Problem', '=', 'Station_off')->where('status', '<>', 'fixed')->get()->toArray();
        //         $stations = Station::all()->where('station_id', $u['station']);

        //         foreach ($stations as $station) {

        //             $TwoM_lastcom = TwoMeterNode::orderBy('id', 'DESC')->where('stationID', $station['station_id'])->take(1)->get();
        //             $TwoM[$station['station_id']] = $TwoM_lastcom;
        //             $TenM_lastcom = TenMeterNode::orderBy('id', 'DESC')->where('stationID', $station['station_id'])->take(1)->get();
        //             $TenM[$station['station_id']] = $TenM_lastcom;
        //             $SinkN_lastcom = SinkNode::orderBy('id', 'DESC')->where('stationID', $station['station_id'])->take(1)->get();
        //             $SinkN[$station['station_id']] = $SinkN_lastcom;
        //             $GroundN_lastcom = GroundNode::orderBy('id', 'DESC')->where('stationID', $station['station_id'])->take(1)->get();
        //             $GroundN[$station['station_id']] = $GroundN_lastcom;

        //             # code...
        //         }

        //         return view('layouts.viewStationStatus', compact('problems_identified', 'problems_analyzed', 'stations', 'TwoM', 'TenM', 'SinkN', 'GroundN', 'stations_off'));
        //     }
        // }





        $stations_off = DetectedAnalyzerProblems::where('Problem', '=', 'Station_off')->where('status', '<>', 'fixed')->get()->toArray();
        $stations = Station::orderBy('StationRegion', 'ASC')->where("stationCategory", "aws")->get();

        foreach ($stations as $station) {
            $TwoM_lastcom = TwoMeterNode::orderBy('id', 'DESC')->where('stationID', $station['station_id'])->take(1)->get();
            $TwoM[$station['station_id']] = $TwoM_lastcom;
            $TenM_lastcom = TenMeterNode::orderBy('id', 'DESC')->where('stationID', $station['station_id'])->take(1)->get();
            $TenM[$station['station_id']] = $TenM_lastcom;
            $SinkN_lastcom = SinkNode::orderBy('id', 'DESC')->where('stationID', $station['station_id'])->take(1)->get();
            $SinkN[$station['station_id']] = $SinkN_lastcom;
            $GroundN_lastcom = GroundNode::orderBy('id', 'DESC')->where('stationID', $station['station_id'])->take(1)->get();
            $GroundN[$station['station_id']] = $GroundN_lastcom;

            # code...
        }




        return view('layouts.viewStationStatus', compact('problems_identified', 'problems_analyzed', 'stations', 'TwoM', 'TenM', 'SinkN', 'GroundN', 'stations_off'));
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
        $twoMFlag = 0;
        $tenMFlag = 0;
        $gndFlag = 0;
        $sinkFlag = 0;
        $TempSensorFlag = 0;
        $SoilMoistureFlag = 0;
        $SoilTempFlag = 0;
        $PreciptationFlag = 0;
        $PressureFlag = 0;
        $RainfallFlag = 0;
        $WindSpeedFlag = 0;
        $WindDirectionFlag = 0;
        $insolationFlag = 0;
        $relativeHumidity = 0;
        $sensor_off = 0;



        //==========================================================================================

        // $TwoM_sensors = TwoMeterNode::where('stationID',$id)->orderBy('id','DESC')->take(1)->get()->toArray();
        // $TenM_sensors =TenMeterNode::where('stationID',$id)->orderBy('id','DESC')->take(1)->get()->toArray();
        // $SinkN_sensors =SinkNode::where('stationID',$id)->orderBy('id','DESC')->take(1)->get()->toArray();
        // $GroundN_sensors =GroundNode::where('stationID',$id)->orderBy('id','DESC')->take(1)->get()->toArray();

        $missing_values = problems::select('Value')->where('stationID', $id)->groupBy('NodeType', 'Value')->get()->toArray();
        $SensorOff = DetectedAnalyzerProblems::select('Value')->where('stationID', $id)->where('Problem', 'Sensor_off')->where('status', '<>', 'fixed')->get()->toArray();
        $sensor_problm = Problems::where('stationID', $id)->where('status', '<>', 'fixed')->groupBy('stationID', 'Value')->get()->toArray();
        // print_r($sensor_problm);
        $AnalyzerProblems = DetectedAnalyzerProblems::where('stationID', $id)->where('status', '<>', 'fixed')->get()->toArray();

        $classification = Problems::where('stationID', $id)->where('status', '<>', 'fixed')->groupBy('stationID', 'classification_id')->get()->toArray();
        $classifiedPrb = problems::select('NodeType')->where('stationID', $id)->where('status', '<>', 'fixed')->groupBy('stationID', 'NodeType')->get()->toArray();
        $stationTaken = Station::where('station_id', $id)->first()->toArray();
        $problemsForStation = array();
        $problemsForStation = problems::join('problem_classification', 'problems.classification_id', '=', 'problem_classification.id')->where('status', '<>', 'fixed')->where('stationID', $id)->get();

        $Node_Missing_Value = problems::select('Value')->where('stationID', $id)->where('status', '<>', 'fixed')->groupBy('stationID', 'NodeType')->get()->toArray();

        //=========================================WHEN SENSORS ARE OFF=====================================


        if (!empty($AnalyzerProblems)) {
            foreach ($AnalyzerProblems as $problem) {
                print_r($AnalyzerProblems, "===========================================");
                //++++++++++++++++++++++++++++showing red++++++when a node is off
                if (strcmp($problem['status'], "fixed")) {
                    if ($problem['Problem'] == "Station_off") {
                        if ($problem['stationID'] == $id) {
                            // array_push($ids,array("id"=>$id, "source"=>$problem['NodeType']));

                            $twoMFlag = 1;
                            $tenMFlag = 1;
                            $gndFlag = 1;
                            $sinkFlag = 1;
                            $TempSensorFlag = 1;
                            $SoilMoistureFlag = 1;
                            $SoilTempFlag = 1;
                            $PreciptationFlag = 1;
                            $PressureFlag = 1;
                            $RainfallFlag = 1;
                            $WindSpeedFlag = 1;
                            $WindDirectionFlag = 1;
                            $insolationFlag = 1;
                            $relativeHumidity = 1;
                        }
                    } elseif ($problem['Problem'] == "TwoMeterNode_off") {
                        if ($problem['stationID'] == $id) {
                            $twoMFlag = 1;
                            $TempSensorFlag = 1;
                            $relativeHumidity = 1;
                        }
                    } elseif ($problem['Problem'] == "TenMeterNode_off") {
                        if ($problem['stationID'] == $id) {
                            $tenMFlag = 1;
                            $WindSpeedFlag = 1;
                            $WindDirectionFlag = 1;
                            $insolationFlag = 1;
                        }
                    } elseif ($problem['Problem'] == "GroundNode_off") {
                        if ($problem['stationID'] == $id) {
                            $gndFlag = 1;
                            $SoilMoistureFlag = 1;
                            $SoilTempFlag = 1;
                            $PreciptationFlag = 1;
                        }
                    } elseif ($problem['Problem'] == "SinkNode_off") {
                        if ($problem['stationID'] == $id) {
                            $sinkFlag = 1;
                            #$PressureFlag = 1;
                        }
                    }
                } //when problem is not fixed

            } //end of forloop
        }

        // When sensors are orange

        foreach ($classifiedPrb as $classied_prob) {
            # code...
            // if ($problem['stationID']==$classifiedPrb['stationID']) {
            # code...

            # if the Node is on 
            if (($classied_prob['NodeType'] == 'TenMeterNode') && ($tenMFlag == 0)) {
                $tenMFlag = 2;
            }


            if (($classied_prob['NodeType'] == "TwoMeterNode") && ($twoMFlag == 0)) {
                $twoMFlag = 2;
            }


            if (($classied_prob['NodeType'] == "GroundNode") && ($gndFlag == 0)) {
                $gndFlag = 2;
            }


            if (($classied_prob['NodeType'] == "SinkNode") && ($sinkFlag == 0)) {
                $sinkFlag = 2;
            }

            //}
        }


        //====================================================END==========================================================

        //==================================SO SENSORS SHOULD SHOW RED WHEN THEY'RE OFF=====================================

        $Sensor_Off = array();
        foreach ($SensorOff as $key => $value) {
            array_push($Sensor_Off, $value['Value']);
            # code...
        }


        $Sensor_issues = array();
        foreach ($sensor_problm as $key => $value) {
            array_push($Sensor_issues, $value['Value']);
            # code...
        }
        $Missing_values = array();
        foreach ($Node_Missing_Value as $key => $value) {
            array_push($Missing_values, $value['Value']);
            # code...
        }

        //print_r($Sensor_Off);
        if (count($Sensor_Off) != 0) {
            if (in_array('Temperature', $Sensor_Off)) {
                // array_push($ids,array("id"=>$Twomnodesensor['id'], "source"=>"sensor"));
                $TempSensorFlag = 1;
                //$twoMFlag = 2;
                $sensor_off = "2MN_missingVlu";
            }
            if (in_array('Humidity', $Sensor_Off)) {
                //array_push($ids,array("id"=>$Twomnodesensor['id'], "source"=>"sensor"));
                $relativeHumidity = 1;
                //$twoMFlag = 2;
                $sensor_off = "2MN_missingVlu";
            }
            if (in_array('Wind Speed', $Sensor_Off)) { //PO_T instead ofPO_LST60

                $WindSpeedFlag = 1;
                $sensor_off = "10MN_missingVlu";
            }
            if (in_array('WindDirection', $Sensor_Off)) {
                //array_push($ids,array("id"=>$Tenmnodesensor['id'], "source"=>"sensor"));
                $WindDirectionFlag = 1;
                //$tenMFlag = 2;
                $sensor_off = "10MN_missingVlu";
            }
            if (in_array('Isolation', $Sensor_Off)) {
                // array_push($ids,array("id"=>$Tenmnodesensor['id'], "source"=>"sensor"));
                $insolationFlag = 1;
                //$tenMFlag = 2;
                $sensor_off = "10MN_missingVlu";
            }
            if (in_array('Soil Temperature', $Sensor_Off)) {
                // array_push($ids,array("id"=>$Groundnodesensor['id'], "source"=>"sensor"));
                $SoilTempFlag = 1;
                //$gndFlag =2;
                $sensor_off = "GN_missingVlu";
            }
            if (in_array('Soil Moisture', $Sensor_Off)) {
                // array_push($ids,array("id"=>$Groundnodesensor['id'], "source"=>"sensor"));
                $SoilMoistureFlag = 1;
                //$gndFlag =2;
                $sensor_off = "GN_missingVlu";
            }
            if (in_array('Preciptation', $Sensor_Off)) {
                //array_push($ids,array("id"=>$Groundnodesensor['id'], "source"=>"sensor"));
                $PreciptationFlag = 1;
                //$gndFlag =2;
                $sensor_off = "GN_missingVlu";
            }
            if (in_array('Pressure', $Sensor_Off)) {
                //array_push($ids,array("id"=>$sinkNodesensors['id'], "source"=>"sensor"));
                $PressureFlag = 1;
                //$sinkFlag = 2;
                $sensor_off = "SNK_missingVlu";
            }
        }

        //====================================================END============================================

        //================AGAIN SENSORS CAN BE ON BUT WITH SOME ISSUES=======================================

        if (count(array($Sensor_issues)) != 0) {
            // printf("===========");
            // print_r(array($Sensor_issues));

            // if($twoMFlag==0){//if the node is ON
            if (!($TempSensorFlag == 1) && (in_array('Temperature', $Sensor_issues))) { //AND the sensor is also on buh has issues
                $TempSensorFlag = 2;
                $sensor_off = "2MN_missingVlu";
            }
            if (!($relativeHumidity == 1) && (in_array('Humidity', $Sensor_issues))) {
                $relativeHumidity = 2;
                $sensor_off = "2MN_missingVlu";
            }
            // }

            // if($tenMFlag==0){
            if (!($WindSpeedFlag == 1) && (in_array('Wind Speed', $Sensor_issues))) { //PO_T instead ofPO_LST60
                $WindSpeedFlag = 2;
                $sensor_off = "10MN_missingVlu";
            }
            if (!($WindDirectionFlag == 1) && (in_array('WindDirection', $Sensor_issues))) {
                $WindDirectionFlag = 2;
                $sensor_off = "10MN_missingVlu";
            }
            if (!($insolationFlag == 1) && (in_array('Isolation', $Sensor_issues))) {
                $insolationFlag = 2;
                $sensor_off = "10MN_missingVlu";
            }
            // }

            // if($gndFlag==0){
            if (!($SoilTempFlag == 1) && (in_array('Soil Temperature', $Sensor_issues))) {
                $SoilTempFlag = 2;
                $sensor_off = "GN_missingVlu";
            }
            if (!($SoilMoistureFlag == 1) && (in_array('Soil Moisture', $Sensor_issues))) {
                $SoilMoistureFlag = 2;
                $sensor_off = "GN_missingVlu";
            }
            if (!($PreciptationFlag == 1) && (in_array('Preciptation', $Sensor_issues))) {
                $PreciptationFlag = 2;
                $sensor_off = "GN_missingVlu";
            }
            // }

            if ($sinkFlag == 0) {
                if (!($PressureFlag == 1) && (in_array('Pressure', $Sensor_issues))) {
                    $PressureFlag = 2;
                    $sensor_off = "SNK_missingVlu";
                }
            }
        }

        //====================================================END================================================
        return view('layouts.selectedStationStatus', compact('sensor_off', 'twoMFlag', 'tenMFlag', 'gndFlag', 'sinkFlag', 'TempSensorFlag', 'SoilMoistureFlag', 'SoilTempFlag', 'PreciptationFlag', 'PressureFlag', 'RainfallFlag', 'WindSpeedFlag', 'WindDirectionFlag', 'insolationFlag', 'relativeHumidity', 'stationTaken', 'problemsForStation', 'classification'));
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
    public function update(Request $request, $id)
    {
        //
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

    public function archivedProblems($id)
    {
        $problems = array();

        //find how to do joins in laravel 
        //find how to write to text files in laravel

        //$problems = DetectedAnalyzerProblems::where('stationID', $id)->orderBy('id','DESC')->paginate(15);//take(1000)->get()->toArray();
        //$stationTaken = Station::where('station_id', $id)->first()->toArray();

        $problems = Problems::leftjoin('problem_classification', 'problems.classification_id', '=', 'problem_classification.id')->select('problems.stationID', 'problem_classification.problem_description', 'problems.status', 'problems.NodeType', 'problems.Value as Value', 'problems.when_reported', 'problems.when_fixed')->orderBy('problems.id', 'DESC')->take(1000)->get()->toArray();


        $stationTaken = Station::where('station_id', $id)->first()->toArray();

        return view('layouts.archivedProblems', compact('problems', 'stationTaken'));
    }
}
