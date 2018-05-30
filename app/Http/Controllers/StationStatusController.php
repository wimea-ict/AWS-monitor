<?php

namespace station\Http\Controllers;
use App\layouts;
use station\Station;
use station\TwoMeterNode;
use station\TenMeterNode;
use station\SinkNode;
use station\GroundNode;
use station\Sensor;
use station\Problems;
use station\PotentialProblem;
use Illuminate\Http\Request;

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
        //$problems_found = Station::where('StationCategory', 'aws')->get();
        $problems_identified = Problems::where('status', 'reported')->get()->toArray();
        //dd( $problems_identified);
        foreach($problems_identified as $problem){
            if($problem['source']=='station'){
                array_push($stations_with_problems,array("id"=>$problem['source_id'], "category"=>$problem['criticality']));
            }
            elseif($problem['source']=='twoMeterNode'){
                $TwomNode = TwoMeterNode::where('station_id', $problem['source_id'])->first();
                //array_push($stations_with_problems,$TwomNode['station_id']);
                array_push($stations_with_problems,array("id"=>$TwomNode['station_id'], "category"=>$problem['criticality']));
            }
            elseif($problem['source']=='tenMeterNode'){
                $TenmNode = TenMeterNode::where('station_id', $problem['source_id'])->first();
                //array_push($stations_with_problems,$TenmNode['station_id']);
                array_push($stations_with_problems,array("id"=>$TenmNode['station_id'], "category"=>$problem['criticality']));
            }
            elseif($problem['source']=='sinkNode'){
                $sinkNode = SinkNode::where('station_id', $problem['source_id'])->first();
                //array_push($stations_with_problems,$sinkNode['station_id']);
                array_push($stations_with_problems,array("id"=>$sinkNode['station_id'], "category"=>$problem['criticality']));
            }
            elseif($problem['source']=='groundNode'){
                $groundNode = GroundNode::where('station_id', $problem['source_id'])->first();
                //array_push($stations_with_problems,$groundNode['station_id']);
                array_push($stations_with_problems,array("id"=>$groundNode['station_id'], "category"=>$problem['criticality']));
            }
            elseif($problem['source']=='sensor'){
                $sensor = Sensor::where('id',$problem['source_id'])->first();
                //dd($sensor);
                if($sensor['node_type']=='twoMeterNode'){
                    $TwomNodeFromSensor = TwoMeterNode::where('node_id', $sensor['node_id'])->first();
                //array_push($stations_with_problems,$TwomNodeFromSensor['station_id']);
                array_push($stations_with_problems,array("id"=>$TwomNodeFromSensor['station_id'], "category"=>$problem['criticality']));
                }
                elseif($sensor['node_type']=='tenMeterNode'){
                    $TenmNodeFromSensor = TenMeterNode::where('node_id', $sensor['node_id'])->first();
                //array_push($stations_with_problems,$TenmNodeFromSensor['station_id']);
                array_push($stations_with_problems,array("id"=>$TenmNodeFromSensor['station_id'], "category"=>$problem['criticality']));
                
                }
                elseif($sensor['node_type']=='groundNode'){
                    $groundNodeFromSensor = GroundNode::where('node_id', $sensor['node_id'])->first();
                //array_push($stations_with_problems,$groundNodeFromSensor['station_id']);
                array_push($stations_with_problems,array("id"=>$groundNodeFromSensor['station_id'], "category"=>$problem['criticality']));
                }
                elseif($sensor['node_type']=='sinkNode'){
                    //$sinkNodeFromSensor = SinkNode::where('node_id', $sensor['node_id'])->first()->toArray();
                //array_push($stations_with_problems,$sinkNodeFromSensor['station_id']);
                //array_push($stations_with_problems,array("id"=>$sinkNodeFromSensor['station_id'], "category"=>$problem['id']));
                }
            }
        }
        //dd($stations_with_problems);
        //$problems = Problems::pluck('source_id')->all();
        $uniqueStationsWithProblems = array();
        foreach($stations_with_problems as $filteredStations){
            array_push($uniqueStationsWithProblems,$filteredStations['id']);
        }
        //dd($uniqueStationsWithProblems);
        $stations = Station::whereIn('station_id', $uniqueStationsWithProblems)->get()->toArray();
        $stationsOn = Station::whereNotIn('station_id', $uniqueStationsWithProblems)->where('stationCategory','aws')->get()->toArray();
        //dd($stations);
        
        return view('layouts.viewStationStatus', compact('stations','stations_with_problems','stationsOn'));

        
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
        $ids = array();
        $TwomNode = TwoMeterNode::where('station_id', $id)->first()->toArray();
        //dd($TwomNode);
        $TenmNode =TenMeterNode::where('station_id', $id)->first()->toArray();
        $sinknode =SinkNode::where('station_id', $id)->first()->toArray();
        $groundNode =GroundNode::where('station_id', $id)->first()->toArray();
        
        $twoMFlag =0;
        $tenMFlag =0;
        $gndFlag =0;
        $sinkFlag =0;
        $TempSensorFlag =0;
        $SoilMoistureFlag =0;
        $SoilTempFlag =0;
        $PreciptationFlag=0;
        $PressureFlag =0;
        $RainfallFlag =0;
        $WindSpeedFlag =0;
        $WindDirectionFlag =0;
        $insolationFlag =0;
        $relativeHumidity =0;
        


        //$problems = Problems::where('')

        $stationTaken = Station::where('station_id', $id)->first()->toArray();
        $problems = Problems::where('status', 'reported')->where('classification_id', '1')->orwhere('classification_id','2')->get()->toArray();
        //dd($problems);
        if(!empty($problems)){
        foreach($problems as $problem){
            if($problem['source']=="station"){
                if($problem['source_id']== $id){
                    array_push($ids,$id);
                    $twoMFlag =1;
                    $tenMFlag =1;
                    $gndFlag =1;
                    $sinkFlag =1;
                    $TempSensorFlag =1;
                    $SoilMoistureFlag =1;
                    $SoilTempFlag =1;
                    $PreciptationFlag=1;
                    $PressureFlag =1;
                    $RainfallFlag =1;
                    $WindSpeedFlag =1;
                    $WindDirectionFlag =1;
                    $insolationFlag =1;
                    $relativeHumidity =1;
                }
            }
            elseif($problem['source']=="twoMeterNode"){
                if(!empty($TwomNode)){
                    if($problem['source_id']==$TwomNode['node_id']){
                        array_push($ids,$TwomNode['node_id']);
                        $twoMFlag = 1;
                        $TempSensorFlag =1;
                        $relativeHumidity =1;
                    }
                }
            }
            elseif($problem['source']=="tenMeterNode"){
                if(!empty($TenmNode)){
                    if($problem['source_id']==$TenmNode['node_id']){
                        array_push($ids,$TenmNode['node_id']);
                        $tenMFlag =1;
                        $WindSpeedFlag =1;
                        $WindDirectionFlag =1;
                        $insolationFlag =1;
                    }
                }
            }
            elseif($problem['source']=="groundNode"){
                if(!empty($groundNode)){
                    if($problem['source_id']==$groundNode['node_id']){
                        array_push($ids,$groundNode['node_id']);
                        $gndFlag = 1;
                        $SoilMoistureFlag =1;
                        $SoilTempFlag =1;
                        $PreciptationFlag=1;
                    }
                }
            }
            elseif($problem['source']=="sinkNode"){
                if(!empty($sinknode)){
                    if($problem['source_id']==$sinknode['node_id']){
                        array_push($ids,$sinknode['node_id']);
                        $sinkFlag =1;
                        $PressureFlag =1;
                    }
                }
            }
        }
        $sensorproblems = Problems::where('status', 'reported')->where('classification_id', '3')->pluck('source_id')->all();
        
        $sensors = Sensor::whereIn('id', $sensorproblems)->get();
        $Twomnodesensors = Sensor::whereIn('id', $sensors)->where('node_id', $TwomNode['node_id'])->get()->toArray();
        if(!empty($Twomnodesensors)){
            foreach($Twomnodesensors as $Twomnodesensor){
                if($Twomnodesensor['parameter_read']=='Temperature'){
                    array_push($ids,$Twomnodesensor['id']);
                    $TempSensorFlag =1;
                }
                if($Twomnodesensor['parameter_read']=='relative humidity'){
                    array_push($ids,$Twomnodesensor['id']);
                    $relativeHumidity =1;
                }
            }
        }
        //dd($Twomnodesensors);
        $Tenmnodesensors = Sensor::whereIn('id', $sensors)->where('node_id', $TenmNode['node_id'])->get()->toArray();
        if(!empty($Tenmnodesensors)){
         
            foreach($Tenmnodesensors as $Tenmnodesensor){
                if($Tenmnodesensor['parameter_read']=='wind speed'){
                    array_push($ids,$Tenmnodesensor['id']);
                    $WindSpeedFlag =1;
                }
                if($Tenmnodesensor['parameter_read']=='wind direction'){
                    array_push($ids,$Tenmnodesensor['id']);
                    $WindDirectionFlag =1;
                }
                if($Tenmnodesensor['parameter_read']=='insolation'){
                    array_push($ids,$Tenmnodesensor['id']);
                    $insolationFlag =1;
                }
            }
        }
        $Groundnodesensors = Sensor::whereIn('id', $sensors)->where('node_id', $groundNode['node_id'])->get()->toArray();
        if(!empty($Groundnodesensors)){
           
            foreach($Groundnodesensors as $Groundnodesensor){
                if($Groundnodesensor['parameter_read']=='soil temperature'){
                    array_push($ids,$Groundnodesensor['id']);
                    $SoilTempFlag =1;
                }
                if($Groundnodesensor['parameter_read']=='soil moisture'){
                    array_push($ids,$Groundnodesensor['id']);
                    $SoilMoistureFlag =1;
                }
                if($Groundnodesensor['parameter_read']=='preciptation'){
                    array_push($ids,$Groundnodesensor['id']);
                    $PreciptationFlag=1;
                }
            }
        }
        $sinkNodesensors = Sensor::whereIn('id', $sensors)->where('node_id', $sinknode['node_id'])->get()->toArray();
        }
        if(!empty($sinkNodesensors)){
           
            foreach($sinkNodesensors as $sinkNodesensor){
                if($sinkNodesensor['parameter_read']=='pressure'){
                    array_push($ids,$sinkNodesensors['id']);
                    $PressureFlag =1;
                }
                
            }
        }
        

        $problemsForStation = Problems::whereIn('source_id',$ids)->leftJoin("problem_classification","problems.classification_id","=","problem_classification.id")->orderBy('problems.id', 'DESC')->get()->toArray();

        $problemsDesc =array_column($problemsForStation, 'problem_description');
        $problemFrequencies =array_count_values($problemsDesc);

        //$problemIds = 
        // = PotentialProblem::whereIn('id',$problemsIds);
        

        //dd($problemFrequencies);
        
        return view('layouts.selectedStationStatus',compact('twoMFlag','tenMFlag','gndFlag','sinkFlag','TempSensorFlag','SoilMoistureFlag','SoilTempFlag','PreciptationFlag','PressureFlag','RainfallFlag','WindSpeedFlag','WindDirectionFlag','insolationFlag','relativeHumidity','stationTaken','problemsForStation','problemFrequencies')); 
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
}
