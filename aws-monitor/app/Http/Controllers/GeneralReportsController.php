<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Station;
use App\Sensor;

use App\TenMeterNode;
use App\NodeStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\ObservationSlip;

use App\Http\Controllers\TenMNodeController;
use App\Http\Controllers\GroundNodeController;
use App\Http\Controllers\SinkNodeController;
use App\Http\Controllers\TwoMNodeController;

class GeneralReportsController extends Controller
{

  public function index()
  {
    $data["action"] = URL::to('plot_reports');
    $data["stations"] = Station::all()->where("stationCategory", "aws");
    $data["heading"] = "General Reports";

    $first_station = -1;
    foreach ($data["stations"] as $station) {
      $first_station = $station->station_id;
      break;
    }

    $data["submit_form"] = $first_station;
    //10m node
    $data["vin_vmcu_10m"] = "";
    $data["insulation_sensor"] = "";
    $data["windspeed_sensor"] = "";
    $data["wind_direction_sensor"] = "";

    //2m node
    $data["vin_vmcu_2m"] = "";
    $data["humidity"] = "";
    $data["templature"] = "";

    //ground node
    $data["vin_vmcu"] = "";
    $data["precipitation"] = "";
    $data["soil_templature"] = "";
    $data["soil_moisture"] = "";

    //sink node
    $data["vin_vmcu_sink"] = "";
    $data["pressure"] = "";



    return view("reports.generalreports", $data);
  }

  public function plotGraphs(Request $request)
  {
    $station_id = request("id");
    $data["submit_form"] = "";
    $data["action"] = URL::to('plot_reports');
    $data["stations"] = Station::all()->where("stationCategory", "aws");
    $data["heading"] = "General Reports";


    $node10m_data = (new TenMNodeController())->get10mStationReports($station_id);

    //10m node
    $data["vin_vmcu_10m"] = $node10m_data["vin_vmcu_10m"];

    $data["insulation_sensor"] = $node10m_data["insulation_sensor"];
    $data["windspeed_sensor"] = $node10m_data["windspeed_sensor"];
    $data["wind_direction_sensor"] = $node10m_data["wind_direction_sensor"];

    $node2m_data = (new TwoMNodeController())->get2mStationReports($station_id);

    $data["vin_vmcu_2m"] = $node2m_data["vin_vmcu_2m"];
    $data["humidity"] = $node2m_data["humidity"];
    $data["templature"] = $node2m_data["templature"];

    //ground node
    $nodegnd_data = (new GroundNodeController())->getGndStationReports($station_id);

    $data["vin_vmcu"] = $nodegnd_data["vin_vmcu"];
    $data["precipitation"] = $nodegnd_data["precipitation"];
    $data["soil_templature"] = $nodegnd_data["soil_templature"];
    $data["soil_moisture"] = $nodegnd_data["soil_moisture"];

    //sink node
    $nodesink_data = (new SinkNodeController())->getSinkStationReports($station_id);

    $data["vin_vmcu_sink"] = $nodesink_data["vin_vmcu_sink"];
    $data["pressure"] = $nodesink_data["pressure"];


    $data["selected_station"] = $station_id;

    return view("reports.generalreports", $data);
  }
}
