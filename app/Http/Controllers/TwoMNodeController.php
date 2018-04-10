<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use station\Station;
use station\TwoMeterNode;
use station\NodeStatus;
use station\ObservationSlip;
use DB;
class TwoMNodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all()->toArray();
        $twoMeterNodes = TwoMeterNode::all()->toArray();
        return view('layouts.configureTwomNode', compact('twoMeterNodes','stations'));
    }

    public function report1(){
        $data["action"]="/reports2m";
        $data["stations"]=Station::all();
        $data["heading"]="2m Node Reports";
           
        $data["vin_vmcu_2m"]=array(0,0);
        $data["humidity"]=array(0,0);
        $data["templature"]=array(0,0);
        return view("reports.node2m",$data);
    }


    public function get2mStationReports(Request $request){
        $station_id=request("id");
        $data=array();
       
       //get the txt value used for the particular station 10m node

       
       $station2mNodeCofigs = TwoMeterNode::where('station_id', '=', $station_id)
            
            ->select('txt_2m_value')
            ->first();
       
        
        //get node status where the configulations are the ones specifie above
        $nodeStatus=NodeStatus::where('TXT','=',$station2mNodeCofigs->txt_2m_value)
                        
                        ->select(DB::raw("CONCAT(date,' ',time)  AS y"),
                                    'V_MCU','V_IN')
                        ->oldest('date_time_recorded')
                        ->limit(1000)
                        ->get();
        
        
        

        foreach ($nodeStatus as $status){
            if($status->V_MCU=="" || $status->V_MCU==null){
              $status->V_MCU=0;  
            }
            if($status->V_IN=="" || $status->V_IN==null){
              $status->V_IN=0;  
            }
        }

        
        
        $dyGraph_data=array();
        $i=1;

        //need to change instead of i pass the value of y but need to pass it as a string
        foreach($nodeStatus as $status){
            $temp_array=array($i,(float)$status->V_MCU,(float)$status->V_IN);
            $dyGraph_data[]=$temp_array;
            $i++;
        }
        $data["vin_vmcu_2m"]=$dyGraph_data;

        //get values for other graphs as well
        
        //get precipitation for ground node

        //nop
         $humidity=ObservationSlip::where('station','=',$station_id)
                        
                        ->select(DB::raw("CONCAT(date,' ',time)  AS y"),
                                    'DurationOfPeriodOfPrecipitation')
                        ->oldest('creationDate')
                        ->limit(100)
                        ->get();

        

        $humidity_graph_data=array();
        $i=1;

        //need to change instead of i pass the value of y but need to pass it as a string
        foreach($humidity as $humid){
            $temp_array=array($i,(float)$humid->DurationOfPeriodOfPrecipitation);
            $humidity_graph_data[]=$temp_array;
            $i++;
        }


        $data["humidity"]=$humidity_graph_data;


        //get soil teplature
        $templature=ObservationSlip::where('station','=',$station_id)
                        
                        ->select(DB::raw("CONCAT(date,' ',time)  AS y"),
                                    'Wind_Speed')
                        ->oldest('creationDate')
                        ->limit(50)
                        ->get();
        

        $temp_graph_data=array();
        $i=1;

        //need to change instead of i pass the value of y but need to pass it as a string
        foreach($templature as $temp){
            $temp_array=array($i,(float)$temp->Wind_Speed);
            $temp_graph_data[]=$temp_array;
            $i++;
        }

        $data["templature"]=$temp_graph_data;
        //get soil moisture

       
        
        $data["action"]="/reports2m";
        $data["stations"]=Station::all();
        $data["heading"]="2m Node Reports";
        return view("reports.node2m",$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
        //
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
