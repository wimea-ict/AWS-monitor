<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;
use App\layouts;
use station\Station;
use station\TwoMeterNode;
use station\TenMeterNode;
use station\GroundNode;
use station\SinkNode;
class StationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $StationDetails = array("station_name"=>"",
                                "station_number"=>"",
                                "city"=>"hi",
                                "longitude"=>"",
                                "latitude"=>"",
                                "code"=>"",
                                "region"=>"",
                                "10m_node"=>array(
                                    "name"=>"10m node",
                                    "txt_key"=>"TXT",
                                    "mac_add"=>"E64",
                                    "date"=>"D",
                                    "vin_label"=>"VIN",
                                    "time"=>"TZ",
                                    "gwlat"=>"GW_LAT",
                                    "gwlong"=>"GW_LONG",
                                    "v_in_max_value"=>"4",
                                    "v_in_min_value"=>"2",
                                    "ttl"=>"TTL",
                                    "rssi"=>"RSSI",
                                    "lqi"=>"LQI",
                                    "drp"=>"DRP",
                                    "ps"=>"PS",
                                    "v_mcu_max_value"=>"3",
                                    "v_mcu_min_value"=>"1",
                                    "v_mcu_label"=>"VMCU",
                                    "ut"=>"UT",
                                ),
                                "ground_node"=>array(
                                    "name"=>"ground node",
                                    "txt_key"=>"TXT",
                                    "mac_add"=>"E64",
                                    "date"=>"D",
                                    "vin_label"=>"VIN",
                                    "time"=>"TZ",
                                    "ut"=>"UT",
                                    "gwlat"=>"GW_LAT",
                                    "gwlong"=>"GW_LONG",
                                    "v_in_max_value"=>"4",
                                    "v_in_min_value"=>"2",
                                    "ttl"=>"TTL",
                                    "rssi"=>"RSSI",
                                    "lqi"=>"LQI",
                                    "drp"=>"DRP",
                                    "ps"=>"PS",
                                    "v_mcu_max_value"=>"3",
                                    "v_mcu_min_value"=>"1",
                                    "v_mcu_label"=>"VMCU",
                                    "po"=>"PO",
                                    "rain_pulses"=>"PO_IST60",
                                    "up"=>"UP",
                                ),
                                "sink_node"=>array(
                                    "name"=>"Sink node",
                                    "txt_key"=>"TXT",
                                    "mac_add"=>"E64",
                                    "date"=>"D",
                                    "vin_label"=>"VIN",
                                    "time"=>"TZ",
                                    "gwlat"=>"GW_LAT",
                                    "gwlong"=>"GW_LONG",
                                    "v_in_max_value"=>"4",
                                    "v_in_min_value"=>"2",
                                    "ttl"=>"TTL",
                                    "rssi"=>"RSSI",
                                    "lqi"=>"LQI",
                                    "drp"=>"DRP",
                                    "ps"=>"PS",
                                    "v_mcu_max_value"=>"3",
                                    "v_mcu_min_value"=>"1",
                                    "v_mcu_label"=>"VMCU",
                                    "ut"=>"UT",
                                    "up"=>"UP",
                                ),
                                "2m_node"=>array(
                                    "name"=>"2m node",
                                    "txt_key"=>"TXT",
                                    "mac_add"=>"E64",
                                    "date"=>"D",
                                    "vin_label"=>"VIN",
                                    "time"=>"TZ",
                                    "gwlat"=>"GW_LAT",
                                    "gwlong"=>"GW_LONG",
                                    "v_in_max_value"=>"4",
                                    "v_in_min_value"=>"2",
                                    "ttl"=>"TTL",
                                    "rssi"=>"RSSI",
                                    "lqi"=>"LQI",
                                    "drp"=>"DRP",
                                    "ps"=>"PS",
                                    "v_mcu_max_value"=>"3",
                                    "v_mcu_min_value"=>"1",
                                    "v_mcu_label"=>"VMCU",
                                    "ut"=>"UT",
                                ),
                                "Temp_semsor"=>array(
                                    "parameter_read"=>"Temperature",
                                    "identifier_used"=>"t_sht2x",
                                    "max_value"=>"6",
                                    "min_value"=>"2",
                                ),
                                
                                "wind_speed_semsor"=>array(
                                    "parameter_read"=>"wind speed",
                                    "identifier_used"=>"v_a2",
                                    "max_value"=>"5",
                                    "min_value"=>"3",
                                ),
                                "wind_direction_semsor"=>array(
                                    "parameter_read"=>"wind direction",
                                    "identifier_used"=>"v_a3",
                                    "max_value"=>"4",
                                    "min_value"=>"1",
                                ),
                                "insulation_sensor"=>array(
                                    "parameter_read"=>"insulation",
                                    "identifier_used"=>"v_a1",
                                    "max_value"=>"2",
                                    "min_value"=>"1",
                                ),
                                "relative_humidity_semsor"=>array(
                                    "parameter_read"=>"relative humidity",
                                    "identifier_used"=>"rh_sht2x",
                                    "max_value"=>"6",
                                    "min_value"=>"1",
                                ),
                                "soil_moisture_semsor"=>array(
                                    "parameter_read"=>"soil moisture",
                                    "identifier_used"=>"v_a1",
                                    "max_value"=>"5",
                                    "min_value"=>"2",
                                ),
                                "soil_temp_semsor"=>array(
                                    "parameter_read"=>"soil temperature",
                                    "identifier_used"=>"v_a2",
                                    "max_value"=>"2",
                                    "min_value"=>"1",
                                ),
                                "preciptation_semsor"=>array(
                                    "parameter_read"=>"preciptation",
                                    "identifier_used"=>"v_a1",
                                    "max_value"=>"4.5",
                                    "min_value"=>"4.7",
                                ),
                                "pressure_semsor"=>array(
                                    "parameter_read"=>"pressure",
                                    "identifier_used"=>"P_ms5611",
                                    "max_value"=>"8",
                                    "min_value"=>"1",
                                ));

        return view('layouts.addstation')
        ->with('stationdetails', $StationDetails);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(layouts.configurestation);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $stationcreation = new Station([
            'station_name' => $request->get('sname'),
            'station_number' => $request->get('snumber'),
            'station_location' => $request->get('slocation'),
            'latitude' => $request->get('latitude'),
            'longitude' => $request->get('longitude'),
            'city' => $request->get('city'),
            'code' => $request->get('code'),
            'region' => $request->get('region'),
            'date_opened' => $request->get('date_opened'),
            'date_closed' => $request->get('date_closed'),
            'station_type' => $request->get('station_type'),
            
          ]);

          $stationcreation->save();

          $station = Station::where('station_name', $request->get('sname'))->first();
        

        $TwomnodeCreation = new TwoMeterNode([
            
            'station_id' => $station['station_id'],
            'txt_2m' => $request->get('2txt_key'),
            'e64_2m' => $request->get('2mac_add'),
            'v_in_2m' => $request->get('2mvin_label'),
            'time_2m' => $request->get('2time'),
            'ut_2m' => $request->get('2ut'),
            'date_2m' => $request->get('2date'),
            'gw_lat_2m' => $request->get('2gwlat'),
            'gw_long_2m' => $request->get('2gwlong'),
            'v_in_min_value' => $request->get('2mv_in_max_value'),
            'v_in_max_value' => $request->get('2mv_in_min_value'),
            'ttl_2m' => $request->get('2ttl'),
            'rssi_2m' => $request->get('2rssi'),
            'drp_2m' => $request->get('2drp'),
            'lqi_2m' => $request->get('2lqi'),
            'v_mcu_max_value' => $request->get('2mv_mcu_max_value'),
            'v_mcu_min_value' => $request->get('2mv_mcu_min_value'),
            'v_mcu_2m' => $request->get('2mv_mcu_label'),
            't_sht2x_2m'=>$request->get('tsidentifier_used'),
            'rh_sh2x_2m'=>$request->get('rhidentifier_used'),
            'node_status'=>'on',
            'txt_value_10m'=>$request->get('2txt_value'), 
            
                         
            
        ]);

        $TwomnodeCreation->save();

        $TenmnodeCreation = new TenMeterNode([
            
            'station_id' => $station['station_id'],
            'txt_10m' => $request->get('10txt_key'),
            'e64_10m' => $request->get('10mac_add'),
            'v_in_10m' => $request->get('10vin_label'),
            'time_10m' => $request->get('10time'),
            'ut_10m' => $request->get('10ut'),
            'date_10m' => $request->get('10date'),
            'gw_lat_10m' => $request->get('10gwlat'),
            'gw_long_10m' => $request->get('10gwlong'),
            'v_in_min_value' => $request->get('10v_in_max_value'),
            'v_in_max_value' => $request->get('10v_in_min_value'),
            'ttl_10m' => $request->get('10ttl'),
            'rssi_10m' => $request->get('10rssi'),
            'drp_10m' => $request->get('10drp'),
            'lqi_10m' => $request->get('10lqi'),
            'ps_10m' => $request->get('10ps'),
            'v_mcu_max_value' => $request->get('10v_mcu_max_value'),
            'v_mcu_min_value' => $request->get('10v_mcu_min_value'),
            'v_mcu_10m' => $request->get('10v_mcu_label'),
            'v_a1_10m'=>$request->get('10identifier_used'),
            'v_a2_10m'=>$request->get('wsidentifier_used'),
            'v_a3_10m'=>$request->get('wdidentifier_used'),
            'node_status'=>'on',
            'txt_value_10m'=>$request->get('10txt_value'),              
            
        ]);

        $TenmnodeCreation->save();

        $groundnodeCreation = new GroundNode([
            
            'station_id' => $station['station_id'],
            'txt_gnd' => $request->get('gndtxt_key'),
            'e64_gnd' => $request->get('gndmac_add'),
            'v_in_gnd' => $request->get('gndvin_label'),
            'time_gnd' => $request->get('grndtime'),
            'ut_gnd' => $request->get('gndut'),
            'date_gnd' => $request->get('gnddate'),
            'gw_lat_gnd' => $request->get('gndgwlat'),
            'gw_long_gnd' => $request->get('gndgwlong'),
            'v_in_min_value' => $request->get('gndv_in_min_value'),
            'v_in_max_value' => $request->get('gdv_in_max_value'),
            'ttl_gnd' => $request->get('gndttl'),
            'rssi_gnd' => $request->get('gndrssi'),
            'drp_gnd' => $request->get('gnddrp'),
            'lqi_gnd' => $request->get('gndlqi'),
            'v_mcu_max_value' => $request->get('gdv_mcu_max_value'),
            'v_mcu_min_value' => $request->get('gdv_mcu_min_value'),
            'v_mcu_gnd' => $request->get('gdv_mcu_label'),
            'v_a1_gnd'=>$request->get('smidentifier_used'),
            'v_a2_gnd'=>$request->get('stidentifier_used'),
            'ps_gnd'=>$request->get('groundps'),
            'node_status'=>'on',
            'txt_value_gnd'=>$request->get('gndtxt_value'),
            'up_gnd'=>$request->get('gndup'),
            'po_lst60_gnd'=> $request->get('groundrain_pulses'),
                          
            
        ]);

        $groundnodeCreation->save();

            $sinkCreation = new SinkNode([
            
                'station_id' => $station['station_id'],
                'txt_sink' => $request->get('sinktxt_key'),
                'e64_sink' => $request->get('sinkmac_add'),
                'v_in_sink' => $request->get('sinkvin_label'),
                'time_sink' => $request->get('sinktime'),
                'ut_sink' => $request->get('sinkut'),
                'date_sink' => $request->get('sinkdate'),
                'gw_lat_sink' => $request->get('sinkgwlat'),
                'gw_long_sink' => $request->get('sinkgwlong'),
                'v_in_min_value' => $request->get('sinkv_in_max_value'),
                'v_in_max_value' => $request->get('sinkv_in_min_value'),
                'ttl_sink' => $request->get('sinkttl'),
                'rssi_sink' => $request->get('sinkrssi'),
                'drp_sink' => $request->get('sinkdrp'),
                'lqi_sink' => $request->get('sinklqi'),
                'v_mcu_max_value' => $request->get('sinkv_mcu_max_value'),
                'v_mcu_min_value' => $request->get('sinkv_mcu_min_value'),
                'v_mcu_sink' => $request->get('sinkv_mcu_label'),
                'p_ms5611_sink'=>$request->get('psidentifier_used'),
                't_sink'=>'T',
                'ps_sink'=>$request->get('sinkps'),
                'node_status'=>'on',
                'txt_value_sink'=>$request->get('sinktxt_value'),
                'up_sink'=>$request->get('sinkup'),
                
                              
                
            ]);
    
            $sinkCreation->save();
            
          return redirect('/addstation');
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
