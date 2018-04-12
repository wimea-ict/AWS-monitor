<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use station\SinkNode;
use station\Station;
use station\Sensor;

class SinkNodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all()->toArray();
        $sinkNodes = SinkNode::all()->toArray();
        $pressuresensors = Sensor::where('node_type','sink_node')
                                    ->where('parameter_read', 'pressure')
                                    ->get();
        return view('layouts.configureSinkNode',compact('sinkNodes','stations','pressuresensors'));
    
        
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
        if($request->get('sinknode_id')!= null){
            $id=$request->get('sinknode_id');
            $sinkNode = SinkNode::where('id',$id)->first();
            $sinkNode->txt_sink = $request->get('sinktxt_key');
            $sinkNode->e64_sink = $request->get('sinkmac_add');
            $sinkNode->v_in_sink = $request->get('sinkvin_label');
            $sinkNode->time_sink = $request->get('sinktime');
            $sinkNode->ut_sink = $request->get('sinkut');
            $sinkNode->date_sink = $request->get('sinkdate');
            $sinkNode->gw_lat_sink = $request->get('sinkgwlat');
            $sinkNode->gw_long_sink = $request->get('sinkgwlong');
            $sinkNode->v_in_min_value = $request->get('sinkv_in_max_value');
            $sinkNode->v_in_max_value = $request->get('sinkv_in_min_value');
            $sinkNode->ttl_sink = $request->get('sinkttl');
            $sinkNode->rssi_sink = $request->get('sinkrssi');
            $sinkNode->drp_sink = $request->get('sinkdrp');
            $sinkNode->lqi_sink = $request->get('sinklqi');
            $sinkNode->v_mcu_max_value = $request->get('sinkv_mcu_max_value');
            $sinkNode->v_mcu_min_value = $request->get('sinkv_mcu_min_value');
            $sinkNode->v_mcu_sink = $request->get('sinkv_mcu_label');
            $sinkNode->p_ms5611_sink= $request->get('psidentifier_used');
            $sinkNode->t_sink= 'T';
            $sinkNode->ps_sink = $request->get('sinkps');
            $sinkNode->node_status= $this->getStatus($request,'sinknode_status');
            $sinkNode->txt_value_sink= $request->get('sinktxt_value');
            $sinkNode->up_sink =$request->get('sinkup');
            $sinkNode->save();
        $pressure = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'pressure')
                                    ->first();
            
            $pressure->parameter_read = $request->get('psparameter_read');
            $pressure->identifier_used= $request->get('psidentifier_used');
            $pressure->min_value = $request->get('psmin_value');
            $pressure->max_value= $request->get('psmax_value');
            $pressure->sensor_status= $this->getStatus($request,'pssensor_status');
            $pressure->report_time_interval=$request->get('psrptTime');
            $pressure->save();
        
        
        
        
        }
        return redirect('/configuresinknode');
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
