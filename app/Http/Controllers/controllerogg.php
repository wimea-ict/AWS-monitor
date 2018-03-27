<?php

namespace station\Http\Controllers;

use Illuminate\Http\Request;

class StationsController extends Controller
{


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

    public function create()
    {
        
    }

}
