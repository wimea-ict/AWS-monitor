<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use station\GroundNode;
use station\Station;
use station\Sensor;

class GroundNodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all()->toArray();
        $groundNodes = GroundNode::all()->toArray();
        $precipitationsensors = Sensor::where('node_type','grnd_node')
                                    ->where('parameter_read', 'preciptation')
                                    ->get();
        $soilTempsensors = Sensor::where('node_type','grnd_node')
                                    ->where('parameter_read', 'soil temperature')
                                    ->get();
        $soilMoisturesensors = Sensor::where('node_type','grnd_node')
                                    ->where('parameter_read', 'soil moisture')
                                    ->get();
        
        return view('layouts.configureGroundNode',compact('groundNodes','stations','precipitationsensors','soilTempsensors','soilMoisturesensors'));
    
        
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
    public function update(Request $request)
    {
        if($request->get('gndnode_id')!= null){
            $id=$request->get('gndnode_id');
            $groundNode = GroundNode::where('id',$id)->first();
            $groundNode->txt_gnd = $request->get('gndtxt_key');
            $groundNode->e64_gnd = $request->get('gndmac_add');
            $groundNode->v_in_gnd = $request->get('gndvin_label');
            $groundNode->time_gnd = $request->get('grndtime');
            $groundNode->ut_gnd = $request->get('gndut');
            $groundNode->date_gnd = $request->get('gnddate');
            $groundNode->gw_lat_gnd = $request->get('gndgwlat');
            $groundNode->gw_long_gnd = $request->get('gndgwlong');
            $groundNode->v_in_min_value = $request->get('gndv_in_min_value');
            $groundNode->v_in_max_value = $request->get('gdv_in_max_value');
            $groundNode->ttl_gnd = $request->get('gndttl');
            $groundNode->rssi_gnd = $request->get('gndrssi');
            $groundNode->drp_gnd = $request->get('gnddrp');
            $groundNode->lqi_gnd = $request->get('gndlqi');
            $groundNode->v_mcu_max_value = $request->get('gdv_mcu_max_value');
            $groundNode->v_mcu_min_value = $request->get('gdv_mcu_min_value');
            $groundNode->v_mcu_gnd  = $request->get('gdv_mcu_label');
            $groundNode->v_a1_gnd= $request->get('smidentifier_used');
            $groundNode->v_a2_gnd =$request->get('stidentifier_used');
            $groundNode->ps_gnd =$request->get('groundps');
            $groundNode->node_status= $this->getStatus($request,'gndnode_status');
            $groundNode->txt_value_gnd = $request->get('gndtxt_value');
            $groundNode->up_gnd = $request->get('gndup');
            $groundNode->po_lst60_gnd = $request->get('groundpo');
                     
            $groundNode->save();
        $soilTemperature = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'soil temperature')
                                    ->first();
            
            $soilTemperature->parameter_read = $request->get('stparameter_read');
            $soilTemperature->identifier_used= $request->get('stidentifier_used');
            $soilTemperature->min_value = $request->get('stmin_value');
            $soilTemperature->max_value= $request->get('stmax_value');
            $soilTemperature->sensor_status= $this->getStatus($request,'stsensor_status');
            $soilTemperature->report_time_interval=$request->get('strptTime');
            $soilTemperature->save();
            
        $soilMoisture = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'soil moisture')
                                    ->first();
            
            $soilMoisture->parameter_read = $request->get('smparameter_read');
            $soilMoisture->identifier_used= $request->get('smidentifier_used');
            $soilMoisture->min_value = $request->get('smmin_value');
            $soilMoisture->max_value= $request->get('smmax_value');
            $soilMoisture->sensor_status= $this->getStatus($request,'smsensor_status');
            $soilMoisture->report_time_interval=$request->get('smrptTime');
            $soilMoisture->save();
            
        $preciptation = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'preciptation')
                                    ->first();
            
            $preciptation->parameter_read = $request->get('ppparameter_read');
            $preciptation->identifier_used= $request->get('ppidentifier_used');
            $preciptation->min_value = $request->get('ppmin_value');
            $preciptation->max_value= $request->get('ppmax_value');
            $preciptation->sensor_status= $this->getStatus($request,'ppsensor_status');
            $preciptation->report_time_interval=$request->get('pprptTime');
            $preciptation->save();
        
        
        
        }
        return redirect('/configuregroundnode');
    }

    public function getStatus(Request $request, $status){
        $value = 'on';
          if($request->has($status)) {
            $value = 'on';
            }
            else{
                $value = 'off';
            }
        return $value;
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
