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
        $problems_identified = Problems::all()->toArray();
        //dd( $problems_identified);
        foreach($problems_identified as $problem){
            if($problem['source']=='station'){
                array_push($stations_with_problems,array("id"=>$problem['source_id'], "category"=>$problem['criticality']));
            }
            elseif($problem['source']=='2m_node'){
                $TwomNode = TwoMeterNode::where('station_id', $problem['source_id'])->first()->toArray();
                //array_push($stations_with_problems,$TwomNode['station_id']);
                array_push($stations_with_problems,array("id"=>$TwomNode['station_id'], "category"=>$problem['criticality']));
            }
            elseif($problem['source']=='10m_node'){
                $TenmNode = TenMeterNode::where('station_id', $problem['source_id'])->first()->toArray();
                //array_push($stations_with_problems,$TenmNode['station_id']);
                array_push($stations_with_problems,array("id"=>$TenmNode['station_id'], "category"=>$problem['criticality']));
            }
            elseif($problem['source']=='sink_node'){
                $sinkNode = SinkNode::where('station_id', $problem['source_id'])->first()->toArray();
                //array_push($stations_with_problems,$sinkNode['station_id']);
                array_push($stations_with_problems,array("id"=>$sinkNode['station_id'], "category"=>$problem['criticality']));
            }
            elseif($problem['source']=='ground_node'){
                $groundNode = GroundNode::where('station_id', $problem['source_id'])->first()->toArray();
                //array_push($stations_with_problems,$groundNode['station_id']);
                array_push($stations_with_problems,array("id"=>$groundNode['station_id'], "category"=>$problem['criticality']));
            }
            elseif($problem['source']=='sensor'){
                $sensor = Sensor::where('id',$problem['source_id'])->first()->toArray();
                //dd($sensor);
                if($sensor['node_type']=='twoMeterNode'){
                    $TwomNodeFromSensor = TwoMeterNode::where('node_id', $sensor['node_id'])->first()->toArray();
                //array_push($stations_with_problems,$TwomNodeFromSensor['station_id']);
                array_push($stations_with_problems,array("id"=>$TwomNodeFromSensor['station_id'], "category"=>$problem['criticality']));
                }
                elseif($sensor['node_type']=='tenMeterNode'){
                    $TenmNodeFromSensor = TenMeterNode::where('node_id', $sensor['node_id'])->first()->toArray();
                //array_push($stations_with_problems,$TenmNodeFromSensor['station_id']);
                array_push($stations_with_problems,array("id"=>$TenmNodeFromSensor['station_id'], "category"=>$problem['criticality']));
                
                }
                elseif($sensor['node_type']=='groundNode'){
                    $groundNodeFromSensor = GroundNode::where('node_id', $sensor['node_id'])->first()->toArray();
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
        //dd($stations);
        
        return view('layouts.viewStationStatus', compact('stations','stations_with_problems'));

        
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
            elseif($problem['source']=="2m_node"){
                if(!empty($TwomNode)){
                    if($problem['source_id']==$TwomNode['node_id']){
                        $twoMFlag = 1;
                    }
                }
            }
            elseif($problem['source']=="10m_node"){
                if(!empty($TenmNode)){
                    if($problem['source_id']==$TenmNode['node_id']){
                        $tenMFlag =1;
                    }
                }
            }
            elseif($problem['source']=="ground_node"){
                if(!empty($groundNode)){
                    if($problem['source_id']==$groundNode['node_id']){
                        $gndFlag = 1;
                    }
                }
            }
            elseif($problem['source']=="sink_node"){
                if(!empty($sinknode)){
                    if($problem['source_id']==$sinknode['node_id']){
                        $sinkFlag =1;
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
                    $TempSensorFlag =1;
                }
                if($Twomnodesensor['parameter_read']=='relative humidity'){
                    $relativeHumidity =1;
                }
            }
        }
        //dd($Twomnodesensors);
        $Tenmnodesensors = Sensor::whereIn('id', $sensors)->where('node_id', $TenmNode['node_id'])->get()->toArray();
        if(!empty($Tenmnodesensors)){
         
            foreach($Tenmnodesensors as $Tenmnodesensor){
                if($Tenmnodesensor['parameter_read']=='wind speed'){
                    $WindSpeedFlag =1;
                }
                if($Tenmnodesensor['parameter_read']=='wind direction'){
                    $WindDirectionFlag =1;
                }
                if($Tenmnodesensor['parameter_read']=='insolation'){
                    $insolationFlag =1;
                }
            }
        }
        $Groundnodesensors = Sensor::whereIn('id', $sensors)->where('node_id', $groundNode['node_id'])->get()->toArray();
        if(!empty($Groundnodesensors)){
           
            foreach($Groundnodesensors as $Groundnodesensor){
                if($Groundnodesensor['parameter_read']=='soil temperature'){
                    $SoilTempFlag =1;
                }
                if($Groundnodesensor['parameter_read']=='soil moisture'){
                    $SoilMoistureFlag =1;
                }
                if($Groundnodesensor['parameter_read']=='preciptation'){
                    $PreciptationFlag=1;
                }
            }
        }
        $sinkNodesensors = Sensor::whereIn('id', $sensors)->where('node_id', $sinknode['node_id'])->get()->toArray();
        }
        if(!empty($sinkNodesensors)){
           
            foreach($sinkNodesensors as $sinkNodesensor){
                if($sinkNodesensor['parameter_read']=='pressure'){
                    $PressureFlag =1;
                }
                
            }
        }
        
        
        return view('layouts.selectedStationStatus',compact('twoMFlag','tenMFlag','gndFlag','sinkFlag','TempSensorFlag','SoilMoistureFlag','SoilTempFlag','PreciptationFlag','PressureFlag','RainfallFlag','WindSpeedFlag','WindDirectionFlag','insolationFlag','relativeHumidity','stationTaken')); 
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
