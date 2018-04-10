<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use station\TenMeterNode;
use station\Station;
use station\Sensor;

class TenMNodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stations = Station::all()->toArray();
        $tenMeterNodes = TenMeterNode::all()->toArray();
        $insulationsensors = Sensor::where('node_type','10m_node')
                                    ->where('parameter_read', 'insulation')
                                    ->get();
        $windspeedsensors = Sensor::where('node_type','10m_node')
                                    ->where('parameter_read', 'wind speed')
                                    ->get();
        $winddirectionsensors = Sensor::where('node_type','10m_node')
                                    ->where('parameter_read', 'wind direction')
                                    ->get();
        
        
        return view('layouts.configureTenmNode',compact('tenMeterNodes','stations','insulationsensors','windspeedsensors','winddirectionsensors'));
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
        if($request->get('10node_id')!= null){
            $id=$request->get('10node_id');
            $TenmNode = TenMeterNode::where('id',$id)->first();
            $TenmNode->txt_10m = $request->get('10txt_key');
            $TenmNode->e64_10m = $request->get('10mac_add');
            $TenmNode->v_in_10m = $request->get('10vin_label');
            $TenmNode->time_10m = $request->get('10time');
            $TenmNode->ut_10m = $request->get('10ut');
            $TenmNode->date_10m = $request->get('10date');
            $TenmNode->gw_lat_10m = $request->get('10gwlat');
            $TenmNode->gw_long_10m = $request->get('10gwlong');
            $TenmNode->v_in_min_value = $request->get('10v_in_max_value');
            $TenmNode->v_in_max_value = $request->get('10v_in_min_value');
            $TenmNode->ttl_10m = $request->get('10ttl');
            $TenmNode->rssi_10m = $request->get('10rssi');
            $TenmNode->drp_10m = $request->get('10drp');
            $TenmNode->lqi_10m = $request->get('10lqi');
            $TenmNode->ps_10m = $request->get('10ps');
            $TenmNode->v_mcu_max_value =  $request->get('10v_mcu_max_value');
            $TenmNode->v_mcu_min_value =  $request->get('10v_mcu_min_value');
            $TenmNode->v_mcu_10m =  $request->get('10v_mcu_label');
            $TenmNode->v_a1_10m= $request->get('10identifier_used');
            $TenmNode->v_a2_10m= $request->get('wsidentifier_used');
            $TenmNode->v_a3_10m= $request->get('wdidentifier_used');
            $TenmNode->node_status= $this->getStatus($request,'10mnode_status');
            $TenmNode->txt_value_10m= $request->get('10txt_value');              
            
            $TenmNode->save();
        $insulation = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'insulation')
                                    ->first();
            
            $insulation->parameter_read = $request->get('10parameter_read');
            $insulation->identifier_used= $request->get('10identifier_used');
            $insulation->min_value = $request->get('10min_value');
            $insulation->max_value= $request->get('10max_value');
            $insulation->sensor_status= $this->getStatus($request,'10sensor_status');
            $insulation->report_time_interval=$request->get('10rptTime');
            $insulation->save();
            
        $windspeed = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'wind speed')
                                    ->first();
            
            $windspeed->parameter_read = $request->get('wsparameter_read');
            $windspeed->identifier_used= $request->get('wsidentifier_used');
            $windspeed->min_value = $request->get('wsmin_value');
            $windspeed->max_value= $request->get('wsmax_value');
            $windspeed->sensor_status= $this->getStatus($request,'wssensor_status');
            $windspeed->report_time_interval=$request->get('wsrptTime');
            $windspeed->save();
        
        $winddirection = Sensor::where('node_id',$id)
                                    ->where('parameter_read', 'wind direction')
                                    ->first();
            
            $winddirection->parameter_read = $request->get('wdparameter_read');
            $winddirection->identifier_used= $request->get('wdidentifier_used');
            $winddirection->min_value = $request->get('wdmin_value');
            $winddirection->max_value= $request->get('wdmax_value');
            $winddirection->sensor_status= $this->getStatus($request,'wdsensor_status');
            $winddirection->report_time_interval=$request->get('wdrptTime');
            $winddirection->save();
        
        }
        return redirect('/configure10mnode');
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
