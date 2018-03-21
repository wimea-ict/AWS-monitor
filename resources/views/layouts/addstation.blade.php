@extends('main')

@section('content')


<!-- Wizard with Validation -->
<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Add Station</h3> 
                            </div> 
                            <div class="panel-body"> 
                                <form id="wizard-validation-form" action="#" style="margin-bottom: 30px;">
                                    <div>
                                        <h3>Station Credentials</h3>
                                        <section style="padding-bottom:30px;">
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label" for="sname">Station name</label>
                                                <div class="col-lg-4">
                                                    <input class="form-control" id="sname" name="sname" type="text">
                                                </div>
                                                <label class="col-lg-2 control-label" for="snumber">Station number</label>
                                                <div class="col-lg-4">
                                                    <input class="form-control" id="snumber" name="snumber" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="slocation">Station location</label>
                                                <div class="col-lg-4">
                                                    <input id="slocation" name="slocation" type="text" class="form-control">

                                                </div>
                                                <label class="col-lg-2 control-label " for="city" >City</label>
                                                <div class="col-lg-4">
                                                    <input id="city" name="city" type="text" class="form-control">

                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="longitude">Longitude</label>
                                                <div class="col-lg-4">
                                                    <input id="longitude" name="longitude" type="number" class="form-control">
                                                </div>
                                                <label class="col-lg-2 control-label " for="latitude">Latitude</label>
                                                <div class="col-lg-4">
                                                    <input id="latitude" name="latitude" type="number" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="code">Code</label>
                                                <div class="col-lg-4">
                                                    <input id="code" name="code" type="text" class="form-control">
                                                </div>
                                                <label class="col-lg-2 control-label " for="region">Region</label>
                                                <div class="col-lg-4">
                                                    <input id="region" name="region" type="number" class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="dateopened">Date opened</label>
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <input type="date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker" name="dateopened">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                </div>
                                                <label class="col-lg-2 control-label " for="dateclosed">Date closed</label>
                                                <div class="col-lg-4">
                                                <div class="input-group">
                                                        <input type="date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker" name="dateclosed">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </section>
                                        <h3>10m Node</h3>
                                        <section>
                                            <div class="col-lg-12">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label" for="10name">Node name</label>
                                                                                <div class="col-lg-4">
                                                                                    <input class="form-control" id="10name" name="10name" type="text" value="{{ $stationdetails['10m_node']['name']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label" for="10txt_key">TXT key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input class="form-control" id="10txt_key" name="10txt_key" type="text" value="{{ $stationdetails['10m_node']['txt_key']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10mac_add">MAC address</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10mac_add" name="10mac_add" type="text" class="form-control" value="{{ $stationdetails['10m_node']['mac_add']}}">

                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10datereg">Date Registered</label>
                                                                                <div class="col-lg-4">
                                                                                <div class="input-group">
                                                                                    <input type="date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker" name="10datereg">
                                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                                </div>                                                                               </div>
                                                                            </div>

                                                                            
                                                                            
                                                                 
                                                     
                                                </div>
                                        <div class="col-lg-12"> 
                                            <div class="panel-group panel-group-joined" id="accordion-test-2"> 
                                            <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapsefour-2" aria-expanded="false" class="collapsed" >
                                                                Node Status Configurations

                                                               </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsefour-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10vin_label">v_in_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10vin_label" name="10vin_label" type="text" class="form-control" value="{{ $stationdetails['10m_node']['vin_label']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10v_in_key_title">v_in_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_in_key_title" name="10v_in_key_title" type="text" class="form-control" value="{{ $stationdetails['10m_node']['v_in_key_title']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10v_in_key_value">v_in_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_in_key_value" name="10v_in_key_value" type="text" class="form-control" value="{{ $stationdetails['10m_node']['v_in_key_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10v_in_min_value">v_in_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_in_min_value" name="10v_in_min_value" type="number" class="form-control" value="{{ $stationdetails['10m_node']['v_in_min_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10v_in_max_value">v_in_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_in_max_value" name="10v_in_max_value" type="number" class="form-control" value="{{ $stationdetails['10m_node']['v_in_max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">10v_mcu_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_mcu_label" name="10v_mcu_label" type="text" class="form-control" value="{{ $stationdetails['10m_node']['v_mcu_label']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10v_mcu_key_title">v_mcu_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_mcu_key_title" name="10v_mcu_key_title" type="text" class="form-control" value="{{ $stationdetails['10m_node']['v_mcu_key_title']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10v_mcu_key_value">v_mcu_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_mcu_key_value" name="10v_mcu_key_value" type="number" class="form-control" value="{{ $stationdetails['10m_node']['v_mcu_key_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10v_mcu_max_value">v_mcu_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_mcu_max_value" name="10v_mcu_max_value" type="number" class="form-control" value="{{ $stationdetails['10m_node']['v_mcu_max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10v_mcu_min_value">v_mcu_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_mcu_min_value" name="10v_mcu_min_value" type="text" class="form-control" value="{{ $stationdetails['10m_node']['v_mcu_min_value']}}">
                                                                                </div>
                                                                            </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                                                                Insulation sensor
                                                                <span class="btn btn-default pull-right activate-style">Activate</span>
                                                            
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseOne-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10parameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10parameter_read" name="10parameter_read" type="text" class="form-control" value="{{ $stationdetails['insulation_sensor']['parameter_read']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10identifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10identifier_used" name="10identifier_used" type="text" class="form-control" value="{{ $stationdetails['insulation_sensor']['identifier_used']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10report_key_title">report_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10report_key_title" name="10report_key_title" type="text" class="form-control" value="{{ $stationdetails['insulation_sensor']['report_key_title']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10report_key_value">report_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10report_key_value" name="10report_key_value" type="number" class="form-control" value="{{ $stationdetails['insulation_sensor']['report_key_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10max_value">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10max_value" name="10max_value" type="number" class="form-control" value="{{ $stationdetails['insulation_sensor']['max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10min_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10min_value" name="10min_value" type="number" class="form-control" value="{{ $stationdetails['insulation_sensor']['min_value']}}">
                                                                                </div>
                                                                    </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-2" class="collapsed" aria-expanded="false">
                                                                wind speed Sensor

                                                                <span class="btn btn-default pull-right activate-style">Activate</span>
                                                            
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseTwo-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="wsparameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wsparameter_read" name="wsparameter_read" type="text" class="form-control" value="{{ $stationdetails['wind_speed_semsor']['parameter_read']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="wsidentifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wsidentifier_used" name="wsidentifier_used" type="text" class="form-control" value="{{ $stationdetails['wind_speed_semsor']['identifier_used']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="wsreport_key_title">report_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wsreport_key_title" name="wsreport_key_title" type="text" class="form-control" value="{{ $stationdetails['wind_speed_semsor']['report_key_title']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="wsreport_key_value">report_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wsreport_key_value" name="wsreport_key_value" type="number" class="form-control" value="{{ $stationdetails['wind_speed_semsor']['report_key_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="wsmax_value">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wsmax_value" name="wsmax_value" type="number" class="form-control" value="{{ $stationdetails['wind_speed_semsor']['max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="wsmin_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wsmin_value" name="wsmin_value" type="number" class="form-control" value="{{ $stationdetails['wind_speed_semsor']['min_value']}}">
                                                                                </div>
                                                                            </div> 
                                                    </div>
                                                    </div> 
                                                </div> 
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseThree-2" class="collapsed" aria-expanded="false">
                                                                wind Direction sensor
                                                                <span class="btn btn-default pull-right activate-style">Activate</span>
                                                            
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseThree-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="wdparameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wdparameter_read" name="wdparameter_read" type="text" class="form-control" value="{{ $stationdetails['wind_direction_semsor']['parameter_read']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="wdidentifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wdidentifier_used" name="wdidentifier_used" type="text" class="form-control" value="{{ $stationdetails['wind_direction_semsor']['identifier_used']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="wdreport_key_title">report_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wdreport_key_title" name="wdreport_key_title" type="text" class="form-control" value="{{ $stationdetails['wind_direction_semsor']['report_key_title']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="wdreport_key_value">report_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wdreport_key_value" name="wdreport_key_value" type="number" class="form-control" value="{{ $stationdetails['wind_direction_semsor']['report_key_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wdmax_value" name="wdmax_value" type="number" class="form-control" value="{{ $stationdetails['wind_direction_semsor']['max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="wdmin_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="wdmin_value" name="wdmin_value" type="number" class="form-control" value="{{ $stationdetails['wind_direction_semsor']['min_value']}}">
                                                                                </div>
                                                                            </div> 
                                                    </div> 
                                                    </div> 
                                                </div> 
                                            </div> 
                                        </div> 

                                        </section>
                                        <h3>2m node</h3>
                                        <section>
                                           
                                        <div class="col-lg-12">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label" for="2mname">Node name</label>
                                                                                <div class="col-lg-4">
                                                                                    <input class="form-control" id="2mname" name="2mname" type="text" value="{{ $stationdetails['2m_node']['name']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label" for="2mnumber">TXT key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input class="form-control" id="2mnumber" name="2mnumber" type="text" value="{{ $stationdetails['2m_node']['txt_key']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2mmcaddress">MAC address</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mmcaddress" name="2mmcaddress" type="text" class="form-control" value="{{ $stationdetails['2m_node']['mac_add']}}">

                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2mdatereg">Date Registered</label>
                                                                                <div class="col-lg-4">
                                                                                <div class="input-group">
                                                                                    <input type="date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker" name="2mdatereg">
                                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                                </div>                                                                               </div>
                                                                            </div>

                                                                            
                                                                            
                                                                 
                                                     
                                                </div>
                                        <div class="col-lg-12"> 
                                            <div class="panel-group panel-group-joined" id="accordion-test-5"> 
                                            <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-5" href="#collapsesix-2" aria-expanded="false" class="collapsed" >
                                                                Node Status Configurations

                                                               </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsesix-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                             
                                                        <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2mvin_label">v_in_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mvin_label" name="2mvin_label" type="text" class="form-control" value="{{ $stationdetails['2m_node']['vin_label']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2mv_in_key_title">v_in_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_in_key_title" name="2mv_in_key_title" type="text" class="form-control" value="{{ $stationdetails['2m_node']['v_in_key_title']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2mv_in_key_value">v_in_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_in_key_value" name="2mv_in_key_value" type="text" class="form-control" value="{{ $stationdetails['2m_node']['v_in_key_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2mv_in_min_value">v_in_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_in_min_value" name="2mv_in_min_value" type="number" class="form-control" value="{{ $stationdetails['2m_node']['v_in_min_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2mv_in_max_value">v_in_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_in_max_value" name="2mv_in_max_value" type="number" class="form-control" value="{{ $stationdetails['2m_node']['v_in_max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2mv_mcu_label">v_mcu_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_mcu_label" name="2mv_mcu_label" type="text" class="form-control" value="{{ $stationdetails['2m_node']['v_mcu_label']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2mv_mcu_key_title">v_mcu_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_mcu_key_title" name="2mv_mcu_key_title" type="text" class="form-control" value="{{ $stationdetails['2m_node']['v_mcu_key_title']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2mv_mcu_key_value">v_mcu_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_mcu_key_value" name="2mv_mcu_key_value" type="number" class="form-control" value="{{ $stationdetails['2m_node']['v_mcu_key_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2mv_mcu_max_value">v_mcu_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_mcu_max_value" name="2mv_mcu_max_value" type="number" class="form-control" value="{{ $stationdetails['2m_node']['v_mcu_max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2mv_mcu_min_value">v_mcu_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_mcu_min_value" name="2mv_mcu_min_value" type="text" class="form-control" value="{{ $stationdetails['2m_node']['v_mcu_min_value']}}">
                                                                                </div>
                                                                            </div>                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseseven-2" aria-expanded="false" class="collapsed">
                                                                Relative humidity sensor
                                                                <span class="btn btn-default pull-right activate-style">Activate</span>
                                                            
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseseven-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            
                                                        <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="rhparameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="rhparameter_read" name="rhparameter_read" type="text" class="form-control" value="{{ $stationdetails['relative_humidity_semsor']['parameter_read']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="rhidentifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="rhidentifier_used" name="rhidentifier_used" type="text" class="form-control" value="{{ $stationdetails['relative_humidity_semsor']['identifier_used']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="rhreport_key_title">report_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="rhreport_key_title" name="rhreport_key_title" type="text" class="form-control" value="{{ $stationdetails['relative_humidity_semsor']['report_key_title']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="rhreport_key_value">report_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="rhreport_key_value" name="rhreport_key_value" type="number" class="form-control" value="{{ $stationdetails['relative_humidity_semsor']['report_key_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="rhmax_value">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="rhmax_value" name="rhmax_value" type="number" class="form-control" value="{{ $stationdetails['relative_humidity_semsor']['max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="rhmin_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="rhmin_value" name="rhmin_value" type="number" class="form-control" value="{{ $stationdetails['relative_humidity_semsor']['min_value']}}">
                                                                                </div>
                                                                            </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseeight-2" class="collapsed" aria-expanded="false">
                                                                Temperature Sensor

                                                                <span class="btn btn-default pull-right activate-style">Activate</span>
                                                            
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseeight-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                        
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="tsparameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="tsparameter_read" name="tsparameter_read" type="text" class="form-control" value="{{ $stationdetails['Temp_semsor']['parameter_read']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="tsidentifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="tsidentifier_used" name="tsidentifier_used" type="text" class="form-control" value="{{ $stationdetails['Temp_semsor']['identifier_used']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="tsreport_key_title">report_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="tsreport_key_title" name="tsreport_key_title" type="text" class="form-control" value="{{ $stationdetails['Temp_semsor']['report_key_title']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="tsreport_key_value">report_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="tsreport_key_value" name="tsreport_key_value" type="number" class="form-control" value="{{ $stationdetails['Temp_semsor']['report_key_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="tsmax_value">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="tsmax_value" name="tsmax_value" type="number" class="form-control" value="{{ $stationdetails['Temp_semsor']['max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="tsmin_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="tsmin_value" name="tsmin_value" type="number" class="form-control" value="{{ $stationdetails['Temp_semsor']['min_value']}}">
                                                                                </div>
                                                                            </div>  
                                                        </div> 
                                                    </div>
                                                    </div> 
                                                </div> 
                                                 
                                            </div> 
                                        </div>   
                                        </section>
                                        <h3>Ground Node</h3>
                                        <section>
                                        <div class="col-lg-12">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label" for="gdname">Node name</label>
                                                                                <div class="col-lg-4">
                                                                                    <input class="form-control" id="gdname" name="gdname" type="text" value="{{ $stationdetails['ground_node']['name']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label" for="gdtxt_key">TXT key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input class="form-control" id="gdtxt_key" name="gdtxt_key" type="text" value="{{ $stationdetails['ground_node']['txt_key']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gdmac_add">MAC address</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gdmac_add" name="gdmac_add" type="text" class="form-control" value="{{ $stationdetails['ground_node']['mac_add']}}">

                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gddatereg">Date Registered</label>
                                                                                <div class="col-lg-4">
                                                                                <div class="input-group">
                                                                                    <input type="date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker" name="gddatereg">
                                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                                </div>                                                                               </div>
                                                                            </div>

                                                                            
                                                                            
                                                                 
                                                     
                                                </div>
                                        <div class="col-lg-12"> 
                                            <div class="panel-group panel-group-joined" id="accordion-test-4"> 
                                            <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-4" href="#collapsenight-2" aria-expanded="false" class="collapsed" >
                                                                Node Status Configurations

                                                               </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsenight-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                             
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gdvin_label">v_in_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gdvin_label" name="gdvin_label" type="text" class="form-control" value="{{ $stationdetails['ground_node']['vin_label']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gdv_in_key_title">v_in_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gdv_in_key_title" name="gdv_in_key_title" type="text" class="form-control" value="{{ $stationdetails['ground_node']['v_in_key_title']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gdv_in_key_value">v_in_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gdv_in_key_value" name="gdv_in_key_value" type="text" class="form-control" value="{{ $stationdetails['ground_node']['v_in_key_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gdv_in_min_value">v_in_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gdv_in_min_value" name="gdv_in_min_value" type="number" class="form-control" value="{{ $stationdetails['ground_node']['v_in_min_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gdv_in_max_value">v_in_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gdv_in_max_value" name="gdv_in_max_value" type="number" class="form-control" value="{{ $stationdetails['ground_node']['v_in_max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gdv_mcu_label">v_mcu_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gdv_mcu_label" name="gdv_mcu_label" type="text" class="form-control" value="{{ $stationdetails['ground_node']['v_mcu_label']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gdv_mcu_key_title">v_mcu_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gdv_mcu_key_title" name="gdv_mcu_key_title" type="text" class="form-control" value="{{ $stationdetails['ground_node']['v_mcu_key_title']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gdv_mcu_key_value">v_mcu_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gdv_mcu_key_value" name="gdv_mcu_key_value" type="number" class="form-control" value="{{ $stationdetails['ground_node']['v_mcu_key_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gdv_mcu_max_value">v_mcu_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gdv_mcu_max_value" name="gdv_mcu_max_value" type="number" class="form-control" value="{{ $stationdetails['ground_node']['v_mcu_max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gdv_mcu_min_value">v_mcu_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gdv_mcu_min_value" name="gdv_mcu_min_value" type="text" class="form-control" value="{{ $stationdetails['ground_node']['v_mcu_min_value']}}">
                                                                                </div>
                                                                            </div>                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseten-2" aria-expanded="false" class="collapsed">
                                                                Precipitation
                                                                <span class="btn btn-default pull-right activate-style">Activate</span>
                                                            
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseten-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="parameter_read" name="parameter_read" type="text" class="form-control" value="{{ $stationdetails['preciptation_semsor']['parameter_read']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="id_used" name="id_used" type="text" class="form-control" value="{{ $stationdetails['preciptation_semsor']['identifier_used']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_title" name="report_key_title" type="text" class="form-control" value="{{ $stationdetails['preciptation_semsor']['report_key_title']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_value" name="report_key_value" type="number" class="form-control" value="{{ $stationdetails['preciptation_semsor']['report_key_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="max_value" name="max_value" type="number" class="form-control" value="{{ $stationdetails['preciptation_semsor']['max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="min_value" name="min_value" type="number" class="form-control" value="{{ $stationdetails['preciptation_semsor']['min_value']}}">
                                                                                </div>
                                                                            </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseeleven-2" class="collapsed" aria-expanded="false">
                                                                Soil temperature

                                                                <span class="btn btn-default pull-right activate-style">Activate</span>
                                                            
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseeleven-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                        
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="parameter_read" name="parameter_read" type="text" class="form-control" value="{{ $stationdetails['soil_temp_semsor']['parameter_read']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="id_used" name="id_used" type="text" class="form-control" value="{{ $stationdetails['soil_temp_semsor']['identifier_used']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_title" name="report_key_title" type="text" class="form-control" value="{{ $stationdetails['soil_temp_semsor']['report_key_title']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_value" name="report_key_value" type="number" class="form-control" value="{{ $stationdetails['soil_temp_semsor']['report_key_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="max_value" name="max_value" type="number" class="form-control" value="{{ $stationdetails['soil_temp_semsor']['max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="min_value" name="min_value" type="number" class="form-control" value="{{ $stationdetails['soil_temp_semsor']['min_value']}}">
                                                                                </div>
                                                                            </div>  
                                                        </div> 
                                                    </div>
                                                    </div> 
                                                </div> 
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapsetweleve-2" class="collapsed" aria-expanded="false">
                                                                Soil moisture sensor
                                                                <span class="btn btn-default pull-right activate-style">Activate</span>
                                                            
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsetweleve-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                                                    
                                                                                    
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="parameter_read" name="parameter_read" type="text" class="form-control" value="{{ $stationdetails['soil_moisture_semsor']['parameter_read']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="id_used" name="id_used" type="text" class="form-control" value="{{ $stationdetails['soil_moisture_semsor']['identifier_used']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_title" name="report_key_title" type="text" class="form-control" value="{{ $stationdetails['soil_moisture_semsor']['report_key_title']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_value" name="report_key_value" type="number" class="form-control" value="{{ $stationdetails['soil_moisture_semsor']['report_key_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="max_value" name="max_value" type="number" class="form-control" value="{{ $stationdetails['soil_moisture_semsor']['max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="min_value" name="min_value" type="number" class="form-control" value="{{ $stationdetails['soil_moisture_semsor']['min_value']}}">
                                                                                </div>
                                                                            </div>  
                                                        </div> 
                                                    </div> 
                                                </div> 
                                            </div> 
                                        </div> 
                                        </section>
                                        <h3>Sink Node</h3>
                                        <section>
                                        <div class="col-lg-12">
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label" for="userName2">Node name</label>
                                                                                <div class="col-lg-4">
                                                                                    <input class="form-control" id="nname" name="nname" type="text" value="{{ $stationdetails['sink_node']['name']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label" for="userName2">TXT key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input class="form-control" id="nnumber" name="nnumber" type="text" value="{{ $stationdetails['sink_node']['txt_key']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="userName2">MAC address</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="mcaddress" name="mcaddress" type="text" class="form-control" value="{{ $stationdetails['sink_node']['mac_add']}}">

                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">Date Registered</label>
                                                                                <div class="col-lg-4">
                                                                                <div class="input-group">
                                                                                    <input type="date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker">
                                                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                                                </div>                                                                               </div>
                                                                            </div>
                                                                            
                                                                            
                                                                 
                                                     
                                                </div>
                                        <div class="col-lg-12"> 
                                            <div class="panel-group panel-group-joined" id="accordion-test-3"> 
                                            <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-3" href="#collapsethirteen-2" aria-expanded="false" class="collapsed" >
                                                                Node Status Configurations

                                                               </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsethirteen-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                             
                                                        <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="userName2">v_in_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_in_label" name="v_in_label" type="text" class="form-control" value="{{ $stationdetails['sink_node']['vin_label']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">v_in_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_in_key_title" name="v_in_key_title" type="text" class="form-control" value="{{ $stationdetails['sink_node']['v_in_key_title']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_in_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_in_key_value" name="v_in_key_value" type="text" class="form-control" value="{{ $stationdetails['sink_node']['v_in_key_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_in_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="region" name="v_in_min_value" type="number" class="form-control" value="{{ $stationdetails['sink_node']['v_in_min_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_in_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_in_max_value" name="v_in_max_value" type="number" class="form-control" value="{{ $stationdetails['sink_node']['v_in_max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">v_mcu_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_mcu_label" name="v_mcu_label" type="text" class="form-control" value="{{ $stationdetails['sink_node']['v_mcu_label']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_mcu_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_mcu_key_title" name="v_mcu_key_title" type="text" class="form-control" value="{{ $stationdetails['sink_node']['v_mcu_key_title']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_mcu_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_mcu_key_value" name="v_mcu_key_value" type="number" class="form-control" value="{{ $stationdetails['sink_node']['v_mcu_key_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">v_mcu_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_mcu_max_value" name="v_mcu_max_value" type="number" class="form-control" value="{{ $stationdetails['sink_node']['v_mcu_max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">v_mcu_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="v_mcu_min_value" name="v_mcu_min_value" type="text" class="form-control" value="{{ $stationdetails['sink_node']['v_mcu_min_value']}}">
                                                                                </div>
                                                                            </div>                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapsefourteen-2" aria-expanded="false" class="collapsed">
                                                                Pressure sensor
                                                                <span class="btn btn-default pull-right activate-style">Activate</span>
                                                            
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsefourteen-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            
                                                        <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="parameter_read" name="parameter_read" type="text" class="form-control" value="{{ $stationdetails['pressure_semsor']['parameter_read']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="id_used" name="id_used" type="text" class="form-control" value="{{ $stationdetails['pressure_semsor']['identifier_used']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_title</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_title" name="report_key_title" type="text" class="form-control" value="{{ $stationdetails['pressure_semsor']['report_key_title']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="confirm2">report_key_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="report_key_value" name="report_key_value" type="number" class="form-control" value="{{ $stationdetails['pressure_semsor']['report_key_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="confirm2">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="max_value" name="max_value" type="number" class="form-control" value="{{ $stationdetails['pressure_semsor']['max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="min_value" name="min_value" type="number" class="form-control" value="{{ $stationdetails['pressure_semsor']['min_value']}}">
                                                                                </div>
                                                                            </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                
                                            </div> 
                                        </div> 
                                        </section>
                                    </div>
                                </form>
                            </div>  <!-- End panel-body -->
                        </div> <!-- End panel -->

                    </div> <!-- end col -->

</div> <!-- End row -->
 
@endsection