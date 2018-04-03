<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use station\Station;
use station\GroundNode;
use station\NodeStatus;
use station\ObservationSlip;
use DB;
class GroundNodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('layouts.configureGroundNode');
    }


    public function report1(){
        $data["action"]="/reportsGnd";
        $data["stations"]=Station::all();
        $data["heading"]="Ground Node Reports";
        
        $data["vin_vmcu"]=array(0,0);
        $data["precipitation"]=array(0,0);
        $data["soil_templature"]=array(0,0);
        $data["soil_moisture"]=array(0,0);
        return view("reports.nodegnd",$data);
    }


    public function getGndStationReports(Request $request){
        $station_id=request("id");
        $data=array();
       
       //get the txt value used for the particular station 10m node

       $stationgndNodeCofigs = GroundNode::where('station_id', '=', $station_id)
            
            ->select('txt_gnd_value')
            ->first();
       
        //get node status where the configulations are the ones specifie above
        $nodeStatus=NodeStatus::where('TXT','=',$stationgndNodeCofigs->txt_gnd_value)
                        
                        ->select(DB::raw("CONCAT(date,' ',time)  AS y"),
                                    'V_MCU','V_IN')
                        ->oldest('date_time_recorded')
                        ->limit(25)
                        ->get();
        
        

        foreach ($nodeStatus as $status){
            if($status->V_MCU=="" || $status->V_MCU==null){
              $status->V_MCU=0;  
            }
            if($status->V_IN=="" || $status->V_IN==null){
              $status->V_IN=0;  
            }
        }

        $data["vin_vmcu"]=$nodeStatus;
        //get values for other graphs as well
        
        //get precipitation for ground node

         $precipitations=ObservationSlip::where('station','=',$station_id)
                        
                        ->select(DB::raw("CONCAT(date,' ',time)  AS y"),
                                    'DurationOfPeriodOfPrecipitation')
                        ->oldest('creationDate')
                        ->limit(25)
                        ->get();
        foreach($precipitations as $precipitation){
            $precipitation->DurationOfPeriodOfPrecipitation=$precipitation->DurationOfPeriodOfPrecipitation*0.2;
        }

        $data["precipitation"]=$precipitations;


        //get soil teplature
        $soilTemplature=ObservationSlip::where('station','=',$station_id)
                        
                        ->select(DB::raw("CONCAT(date,' ',time)  AS y"),
                                    'SoilTemperature')
                        ->oldest('creationDate')
                        ->limit(50)
                        ->get();
        
        $data["soil_templature"]=$soilTemplature;
        //get soil moisture

        $SoilMoisture=ObservationSlip::where('station','=',$station_id)
                        
                        ->select(DB::raw("CONCAT(date,' ',time)  AS y"),
                                    'SoilMoisture')
                        ->oldest('creationDate')
                        ->limit(50)
                        ->get();

        $data["soil_moisture"]=$SoilMoisture;

        $data["action"]="/reportsGnd";
        $data["stations"]=Station::all();
        $data["heading"]="Ground Node Reports";
        return view("reports.nodegnd",$data);
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
