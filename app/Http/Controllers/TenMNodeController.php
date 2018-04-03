<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use station\Station;
use station\TenMeterNode;
use station\NodeStatus;
use DB;
use station\ObservationSlip;
class TenMNodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.configureTenmNode');
    }

   
    public function report1(){
        $data["action"]="/reports10m";
        $data["stations"]=Station::all();
        $data["heading"]="10m Node Reports";
           
        $data["vin_vmcu_10m"]=array(0,0);
        $data["insulation_sensor"]=array(0,0);
        $data["windspeed_sensor"]=array(0,0);
        $data["wind_direction_sensor"]=array(0,0);
        return view("reports.node10m",$data);
    }


    public function get10mStationReports(Request $request){
        $station_id=request("id");
        $data=array();
       
       //get the txt value used for the particular station 10m node

       
       $station10mNodeCofigs = TenMeterNode::where('station_id', '=', $station_id)
            
            ->select('txt_10m_value')
            ->first();
       
        
        //get node status where the configulations are the ones specifie above
        $nodeStatus=NodeStatus::where('TXT','=',$station10mNodeCofigs->txt_10m_value)
                        
                        ->select(DB::raw("CONCAT(date,' ',time)  AS y"),
                                    'V_MCU','V_IN')
                        ->oldest('date_time_recorded')
                        ->limit(10)
                        ->get();
        
        

        foreach ($nodeStatus as $status){
            if($status->V_MCU=="" || $status->V_MCU==null){
              $status->V_MCU=0;  
            }
            if($status->V_IN=="" || $status->V_IN==null){
              $status->V_IN=0;  
            }
        }

        $data["vin_vmcu_10m"]=$nodeStatus;
        //get values for other graphs as well
        
        //get precipitation for ground node

         $insulation=ObservationSlip::where('station','=',$station_id)
                        
                        ->select(DB::raw("CONCAT(date,' ',time)  AS y"),
                                    'DurationOfPeriodOfPrecipitation')
                        ->oldest('creationDate')
                        ->limit(25)
                        ->get();

        // foreach($precipitations as $precipitation){
        //     $precipitation->DurationOfPeriodOfPrecipitation=$precipitation->DurationOfPeriodOfPrecipitation*0.2;
        // }

        $data["insulation_sensor"]=$insulation;


        //get soil teplature
        $windspeed=ObservationSlip::where('station','=',$station_id)
                        
                        ->select(DB::raw("CONCAT(date,' ',time)  AS y"),
                                    'Wind_Speed')
                        ->oldest('creationDate')
                        ->limit(50)
                        ->get();
        
        $data["windspeed_sensor"]=$windspeed;
        //get soil moisture

        $wind_direction=ObservationSlip::where('station','=',$station_id)
                        
                        ->select(DB::raw("CONCAT(date,' ',time)  AS y"),
                                    'Wind_Direction')
                        ->oldest('creationDate')
                        ->limit(50)
                        ->get();

        $data["wind_direction_sensor"]=$wind_direction;

        $data["action"]="/reports10m";
        $data["stations"]=Station::all();
        $data["heading"]="Ground Node Reports";
        return view("reports.node10m",$data);
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
