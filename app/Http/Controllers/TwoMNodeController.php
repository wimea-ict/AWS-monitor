<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use App\layouts;
use station\TwoMeterNode;
use station\Station;
use station\Sensor;
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
        $relativeHumiditysensors = Sensor::where('node_type','2m_node')
                                    ->where('parameter_read', 'relative humidity')
                                    ->get();
        $Temperaturesensors = Sensor::where('node_type','2m_node')
                                    ->where('parameter_read', 'Temperature')
                                    ->get();
        
        return view('layouts.configureTwomNode', compact('twoMeterNodes','stations','relativeHumiditysensors','Temperaturesensors'));
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
    public function update(Request $request)
    {
        if($request->get('2mnode_id')!= null){
            $id=$request->get('2mnode_id');
            $TwomNode = TwoMeterNode::where('id',$id)->first();
            $TwomNode->txt_2m = $request->get('2txt_key');
            $TwomNode->e64_2m = $request->get('2mac_add');
            $TwomNode->v_in_2m = $request->get('2mvin_label');
            $TwomNode->time_2m = $request->get('2time');
            $TwomNode->ut_2m = $request->get('2ut');
            $TwomNode->date_2m = $request->get('2date');
            $TwomNode->gw_lat_2m = $request->get('2gwlat');
            $TwomNode->gw_long_2m = $request->get('2gwlong');
            $TwomNode->v_in_min_value = $request->get('2mv_in_max_value');
            $TwomNode->v_in_max_value = $request->get('2mv_in_min_value');
            $TwomNode->ttl_2m = $request->get('2ttl');
            $TwomNode->rssi_2m = $request->get('2rssi');
            $TwomNode->drp_2m = $request->get('2drp');
            $TwomNode->lqi_2m = $request->get('2lqi');
            $TwomNode->v_mcu_max_value = $request->get('2mv_mcu_max_value');
            $TwomNode->v_mcu_min_value = $request->get('2mv_mcu_min_value');
            $TwomNode->v_mcu_2m = $request->get('2mv_mcu_label');
            $TwomNode->t_sht2x_2m = $request->get('tsidentifier_used');
            $TwomNode->rh_sh2x_2m = $request->get('rhidentifier_used');
            $TwomNode->node_status= $this->getStatus($request,'2mnode_status');
            $TwomNode->txt_value2m= $request->get('2txt_value'); 
            
            $TwomNode->save();
        $relativeHumidity = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'relative humidity')
                                    ->first();
            
            $relativeHumidity->parameter_read = $request->get('rhparameter_read');
            $relativeHumidity->identifier_used= $request->get('rhidentifier_used');
            $relativeHumidity->min_value = $request->get('rhmin_value');
            $relativeHumidity->max_value= $request->get('rhmax_value');
            $relativeHumidity->sensor_status= $this->getStatus($request,'rhsensor_status');
            $relativeHumidity->report_time_interval=$request->get('rhrptTime');
            $relativeHumidity->save();
            
        $temperature = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'Temperature')
                                    ->first();
            
            $temperature->parameter_read = $request->get('tsparameter_read');
            $temperature->identifier_used= $request->get('tsidentifier_used');
            $temperature->min_value = $request->get('tsmin_value');
            $temperature->max_value= $request->get('tsmax_value');
            $temperature->sensor_status= $this->getStatus($request,'tssensor_status');
            $temperature->report_time_interval=$request->get('tsrptTime');
            $temperature->save();
        
        
        
        }
        return redirect('/configure2mnode');
    
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
