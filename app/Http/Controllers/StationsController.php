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
                                    "txt_key"=>"this",
                                    "mac_add"=>"",
                                    "date_reg"=>"",
                                    "vin_label"=>"",
                                    "v_in_key_title"=>"",
                                    "v_in_key_value"=>"",
                                    "v_in_max_value"=>"",
                                    "v_in_min_value"=>"",
                                    "v_mcu_key_title"=>"",
                                    "v_mcu_key_value"=>"",
                                    "v_mcu_max_value"=>"",
                                    "v_mcu_min_value"=>"",
                                    "v_mcu_label"=>"",
                                ),
                                "ground_node"=>array(
                                    "name"=>"10m node",
                                    "txt_key"=>"this",
                                    "mac_add"=>"",
                                    "date_reg"=>"",
                                    "vin_label"=>"",
                                    "v_in_key_title"=>"",
                                    "v_in_key_value"=>"",
                                    "v_in_max_value"=>"",
                                    "v_in_min_value"=>"",
                                    "v_mcu_key_title"=>"",
                                    "v_mcu_key_value"=>"",
                                    "v_mcu_max_value"=>"",
                                    "v_mcu_min_value"=>"",
                                    "v_mcu_label"=>"",
                                ),
                                "sink_node"=>array(
                                    "name"=>"10m node",
                                    "txt_key"=>"this",
                                    "mac_add"=>"",
                                    "date_reg"=>"",
                                    "vin_label"=>"",
                                    "v_in_key_title"=>"",
                                    "v_in_key_value"=>"",
                                    "v_in_max_value"=>"",
                                    "v_in_min_value"=>"",
                                    "v_mcu_key_title"=>"",
                                    "v_mcu_key_value"=>"",
                                    "v_mcu_max_value"=>"",
                                    "v_mcu_min_value"=>"",
                                    "v_mcu_label"=>"",
                                ),
                                "2m_node"=>array(
                                    "name"=>"10m node",
                                    "txt_key"=>"this",
                                    "mac_add"=>"",
                                    "date_reg"=>"",
                                    "vin_label"=>"",
                                    "v_in_key_title"=>"",
                                    "v_in_key_value"=>"",
                                    "v_in_max_value"=>"",
                                    "v_in_min_value"=>"",
                                    "v_mcu_key_title"=>"",
                                    "v_mcu_key_value"=>"",
                                    "v_mcu_max_value"=>"",
                                    "v_mcu_min_value"=>"",
                                    "v_mcu_label"=>"",
                                ),
                                "Temp_semsor"=>array(
                                    "parameter_read"=>"",
                                    "identifier_used"=>"",
                                    "report_key_title"=>"",
                                    "report_key_value"=>"",
                                    "max_value"=>"",
                                    "min_value"=>"",
                                ),
                                "insulation_semsor"=>array(
                                    "parameter_read"=>"",
                                    "identifier_used"=>"",
                                    "report_key_title"=>"",
                                    "report_key_value"=>"",
                                    "max_value"=>"",
                                    "min_value"=>"",
                                ),
                                "wind_speed_semsor"=>array(
                                    "parameter_read"=>"",
                                    "identifier_used"=>"",
                                    "report_key_title"=>"",
                                    "report_key_value"=>"",
                                    "max_value"=>"",
                                    "min_value"=>"",
                                ),
                                "wind_direction_semsor"=>array(
                                    "parameter_read"=>"",
                                    "identifier_used"=>"",
                                    "report_key_title"=>"",
                                    "report_key_value"=>"",
                                    "max_value"=>"",
                                    "min_value"=>"",
                                ),
                                "insulation_sensor"=>array(
                                    "parameter_read"=>"",
                                    "identifier_used"=>"",
                                    "report_key_title"=>"",
                                    "report_key_value"=>"",
                                    "max_value"=>"",
                                    "min_value"=>"",
                                ),
                                "relative_humidity_semsor"=>array(
                                    "parameter_read"=>"",
                                    "identifier_used"=>"",
                                    "report_key_title"=>"",
                                    "report_key_value"=>"",
                                    "max_value"=>"",
                                    "min_value"=>"",
                                ),
                                "soil_moisture_semsor"=>array(
                                    "parameter_read"=>"",
                                    "identifier_used"=>"",
                                    "report_key_title"=>"",
                                    "report_key_value"=>"",
                                    "max_value"=>"",
                                    "min_value"=>"",
                                ),
                                "soil_temp_semsor"=>array(
                                    "parameter_read"=>"",
                                    "identifier_used"=>"",
                                    "report_key_title"=>"",
                                    "report_key_value"=>"",
                                    "max_value"=>"",
                                    "min_value"=>"",
                                ),
                                "preciptation_semsor"=>array(
                                    "parameter_read"=>"",
                                    "identifier_used"=>"",
                                    "report_key_title"=>"",
                                    "report_key_value"=>"",
                                    "max_value"=>"",
                                    "min_value"=>"",
                                ),
                                "pressure_semsor"=>array(
                                    "parameter_read"=>"",
                                    "identifier_used"=>"",
                                    "report_key_title"=>"",
                                    "report_key_value"=>"",
                                    "max_value"=>"",
                                    "min_value"=>"",
                                ));

        return View('layouts.addstation')
        ->with('stationdetails', $StationDetails);
    }

}
