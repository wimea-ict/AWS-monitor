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
                                                                                <label class="col-lg-2 col-lg-offset-3 control-label" for="10name">Node name</label>
                                                                                <div class="col-lg-4">
                                                                                    <input class="form-control" id="10name" name="10name" type="text" value="{{ $stationdetails['10m_node']['name']}}" disabled>
                                                                                </div>
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
                                                                                <label class="col-lg-2 control-label " for="10vin_label">v_in label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10vin_label" name="10vin_label" type="text" class="form-control" value="{{ $stationdetails['10m_node']['vin_label']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10txt_key">TXT key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10txt_key" name="10txt_key" type="text" class="form-control" value="{{ $stationdetails['10m_node']['txt_key']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10mac_add">MAK key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10mac_add" name="10mac_add" type="text" class="form-control" value="{{ $stationdetails['10m_node']['mac_add']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10v_in_min_value">v_in min value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_in_min_value" name="10v_in_min_value" type="number" class="form-control" value="{{ $stationdetails['10m_node']['v_in_min_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10v_in_max_value">v_in max value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_in_max_value" name="10v_in_max_value" type="number" class="form-control" value="{{ $stationdetails['10m_node']['v_in_max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="userName2">v_mcu label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_mcu_label" name="10v_mcu_label" type="text" class="form-control" value="{{ $stationdetails['10m_node']['v_mcu_label']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10gwlat">latitude key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10gwlat" name="10gwlat" type="text" class="form-control" value="{{ $stationdetails['10m_node']['gwlat']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10gwlong">longitude key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10gwlong" name="10gwlong" type="text" class="form-control" value="{{ $stationdetails['10m_node']['gwlong']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10v_mcu_max_value">v_mcu max value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_mcu_max_value" name="10v_mcu_max_value" type="number" class="form-control" value="{{ $stationdetails['10m_node']['v_mcu_max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10v_mcu_min_value">v_mcu min value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10v_mcu_min_value" name="10v_mcu_min_value" type="text" class="form-control" value="{{ $stationdetails['10m_node']['v_mcu_min_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10rssi">RSSI key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10rssi" name="10rssi" type="text" class="form-control" value="{{ $stationdetails['10m_node']['rssi']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10lqi">LQI key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10lqi" name="10lqi" type="text" class="form-control" value="{{ $stationdetails['10m_node']['lqi']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10drp">drp key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10drp" name="10drp" type="text" class="form-control" value="{{ $stationdetails['10m_node']['drp']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10ttl">TTL key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10ttl" name="10ttl" type="text" class="form-control" value="{{ $stationdetails['10m_node']['ttl']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10date">Date identifier</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10date" name="10date" type="text" class="form-control" value="{{ $stationdetails['10m_node']['date']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10time">Time identifier</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10time" name="10time" type="text" class="form-control" value="{{ $stationdetails['10m_node']['time']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="10date">PS key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10ps" name="10ps" type="text" class="form-control" value="{{ $stationdetails['10m_node']['ps']}}">
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
                                                                                    <input id="10parameter_read" name="10parameter_read" type="text" class="form-control" value="{{ $stationdetails['insulation_sensor']['parameter_read']}}" disabled>
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10identifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="10identifier_used" name="10identifier_used" type="text" class="form-control" value="{{ $stationdetails['insulation_sensor']['identifier_used']}}">
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
                                                                                <label class="col-lg-2 col-lg-offset-3 control-label" for="2mname">Node name</label>
                                                                                <div class="col-lg-4">
                                                                                    <input class="form-control" id="2mname" name="2mname" type="text" value="{{ $stationdetails['2m_node']['name']}}" disabled>
                                                                                </div>
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
                                                                                <label class="col-lg-2 control-label " for="2mv_in_min_value">v_in_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_in_min_value" name="2mv_in_min_value" type="number" class="form-control" value="{{ $stationdetails['2m_node']['v_in_min_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2gwlat">latitude key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2gwlat" name="2gwlat" type="text" class="form-control" value="{{ $stationdetails['2m_node']['gwlat']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2gwlong">longitude key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2gwlong" name="2gwlong" type="text" class="form-control" value="{{ $stationdetails['2m_node']['gwlong']}}">
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
                                                                                <label class="col-lg-2 control-label " for="2mv_mcu_max_value">v_mcu_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_mcu_max_value" name="2mv_mcu_max_value" type="number" class="form-control" value="{{ $stationdetails['2m_node']['v_mcu_max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2mv_mcu_min_value">v_mcu_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2mv_mcu_min_value" name="2mv_mcu_min_value" type="text" class="form-control" value="{{ $stationdetails['2m_node']['v_mcu_min_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2rssi">RSSI key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2rssi" name="2rssi" type="text" class="form-control" value="{{ $stationdetails['2m_node']['rssi']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2lqi">LQI key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2lqi" name="2lqi" type="text" class="form-control" value="{{ $stationdetails['2m_node']['lqi']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2drp">drp key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2drp" name="2drp" type="text" class="form-control" value="{{ $stationdetails['2m_node']['drp']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2ttl">TTL key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2ttl" name="2ttl" type="text" class="form-control" value="{{ $stationdetails['2m_node']['ttl']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="2date">Date identifier</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2date" name="2date" type="text" class="form-control" value="{{ $stationdetails['2m_node']['date']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="2time">Time identifier</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="2time" name="2time" type="text" class="form-control" value="{{ $stationdetails['2m_node']['time']}}">
                                                                                </div>
                                                                            </div>
                                                                                                                                                         
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-5" href="#collapseseven-2" aria-expanded="false" class="collapsed">
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
                                                            <a data-toggle="collapse" data-parent="#accordion-test-5" href="#collapseeight-2" class="collapsed" aria-expanded="false">
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
                                                                                <label class="col-lg-2 col-lg-offset-3 control-label" for="gdname">Node name</label>
                                                                                <div class="col-lg-4">
                                                                                    <input class="form-control" id="gdname" name="gdname" type="text" value="{{ $stationdetails['ground_node']['name']}}">
                                                                                </div>
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
                                                                                <label class="col-lg-2 control-label " for="gndvin_label">v_in label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndvin_label" name="gndvin_label" type="text" class="form-control" value="{{ $stationdetails['10m_node']['vin_label']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="10txt_key">TXT key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndtxt_key" name="gndtxt_key" type="text" class="form-control" value="{{ $stationdetails['10m_node']['txt_key']}}">
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
                                                                                <label class="col-lg-2 control-label " for="gndmac_add">MAK key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndmac_add" name="gndmac_add" type="text" class="form-control" value="{{ $stationdetails['ground_node']['mac_add']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gndv_in_min_value">v_in min value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndv_in_min_value" name="gndv_in_min_value" type="number" class="form-control" value="{{ $stationdetails['ground_node']['v_in_min_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gndgwlat">latitude key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndgwlat" name="gndgwlat" type="text" class="form-control" value="{{ $stationdetails['ground_node']['gwlat']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gndgwlong">longitude key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndgwlong" name="gndgwlong" type="text" class="form-control" value="{{ $stationdetails['ground_node']['gwlong']}}">
                                                                                </div>
                                                                            </div>
                                                                           
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gndrssi">RSSI key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndrssi" name="gndrssi" type="text" class="form-control" value="{{ $stationdetails['ground_node']['rssi']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gndlqi">LQI key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndlqi" name="gndlqi" type="text" class="form-control" value="{{ $stationdetails['ground_node']['lqi']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gnddrp">drp key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gnddrp" name="gnddrp" type="text" class="form-control" value="{{ $stationdetails['ground_node']['drp']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="gndttl">TTL key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gndttl" name="gndttl" type="text" class="form-control" value="{{ $stationdetails['ground_node']['ttl']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="gnddate">Date identifier</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="gnddate" name="gnddate" type="text" class="form-control" value="{{ $stationdetails['ground_node']['date']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="grndtime">Time identifier</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="grndtime" name="grndtime" type="text" class="form-control" value="{{ $stationdetails['ground_node']['time']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="groundps">PS key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="groundps" name="groundps" type="text" class="form-control" value="{{ $stationdetails['ground_node']['ps']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="groundrain_pulses">Rain Pulses</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="groundrain_pulses" name="groundrain_pulses" type="text" class="form-control" value="{{ $stationdetails['ground_node']['rain_pulses']}}">
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="groundpo">PO key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="groundpo" name="groundpo" type="text" class="form-control" value="{{ $stationdetails['ground_node']['po']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="groundup">Rain Pulses</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="groundup" name="groundup" type="text" class="form-control" value="{{ $stationdetails['ground_node']['up']}}">
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            
                                                                                                                                                              
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-4" href="#collapseten-2" aria-expanded="false" class="collapsed">
                                                                Precipitation
                                                                <span class="btn btn-default pull-right activate-style">Activate</span>
                                                            
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseten-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="ppparameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="ppparameter_read" name="ppparameter_read" type="text" class="form-control" value="{{ $stationdetails['preciptation_semsor']['parameter_read']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="ppidentifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="ppidentifier_used" name="ppidentifier_used" type="text" class="form-control" value="{{ $stationdetails['preciptation_semsor']['identifier_used']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="ppmax_value">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="ppmax_value" name="ppmax_value" type="number" class="form-control" value="{{ $stationdetails['preciptation_semsor']['max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="ppmin_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="ppmin_value" name="ppmin_value" type="number" class="form-control" value="{{ $stationdetails['preciptation_semsor']['min_value']}}">
                                                                                </div>
                                                                            </div>
                                                                               
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-4" href="#collapseeleven-2" class="collapsed" aria-expanded="false">
                                                                Soil temperature

                                                                <span class="btn btn-default pull-right activate-style">Activate</span>
                                                            
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapseeleven-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                        <div class="form-group clearfix">
                                                        
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="stparameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="stparameter_read" name="stparameter_read" type="text" class="form-control" value="{{ $stationdetails['soil_temp_semsor']['parameter_read']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="stidentifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="stidentifier_used" name="stidentifier_used" type="text" class="form-control" value="{{ $stationdetails['soil_temp_semsor']['identifier_used']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="stmax_value">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="stmax_value" name="stmax_value" type="number" class="form-control" value="{{ $stationdetails['soil_temp_semsor']['max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="stmin_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="stmin_value" name="stmin_value" type="number" class="form-control" value="{{ $stationdetails['soil_temp_semsor']['min_value']}}">
                                                                                </div>
                                                                            </div>  
                                                        </div> 
                                                    </div>
                                                    </div> 
                                                </div> 
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-4" href="#collapsetweleve-2" class="collapsed" aria-expanded="false">
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
                                                                                <label class="col-lg-2 control-label " for="smparameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="smparameter_read" name="smparameter_read" type="text" class="form-control" value="{{ $stationdetails['soil_moisture_semsor']['parameter_read']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="smidentifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="smidentifier_used" name="smidentifier_used" type="text" class="form-control" value="{{ $stationdetails['soil_moisture_semsor']['identifier_used']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="smmax_value">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="smmax_value" name="smmax_value" type="number" class="form-control" value="{{ $stationdetails['soil_moisture_semsor']['max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="smmin_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="smmin_value" name="smmin_value" type="number" class="form-control" value="{{ $stationdetails['soil_moisture_semsor']['min_value']}}">
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
                                                                                <label class="col-lg-2 col-lg-offset-3 control-label" for="sinkname">Node name</label>
                                                                                <div class="col-lg-4">
                                                                                    <input class="form-control" id="sinkname" name="sinkname" type="text" value="{{ $stationdetails['sink_node']['name']}}">
                                                                                </div>
                                                                                
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
                                                                                <label class="col-lg-2 control-label " for="sinkvin_label">v_in label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkvin_label" name="sinkvin_label" type="text" class="form-control" value="{{ $stationdetails['sink_node']['vin_label']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinktxt_key">TXT key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinktxt_key" name="sinktxt_key" type="text" class="form-control" value="{{ $stationdetails['sink_node']['txt_key']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkv_mcu_max_value">v_mcu_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkv_mcu_max_value" name="sinkv_mcu_max_value" type="number" class="form-control" value="{{ $stationdetails['sink_node']['v_mcu_max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinkv_mcu_min_value">v_mcu_min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkv_mcu_min_value" name="sinkv_mcu_min_value" type="text" class="form-control" value="{{ $stationdetails['sink_node']['v_mcu_min_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkv_in_max_value">v_in_max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkv_in_max_value" name="sinkv_in_max_value" type="number" class="form-control" value="{{ $stationdetails['sink_node']['v_in_max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinkv_mcu_label">v_mcu_label</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkv_mcu_label" name="sinkv_mcu_label" type="text" class="form-control" value="{{ $stationdetails['sink_node']['v_mcu_label']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkmac_add">MAK key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkmac_add" name="sinkmac_add" type="text" class="form-control" value="{{ $stationdetails['sink_node']['mac_add']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinkv_in_min_value">v_in min value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkv_in_min_value" name="sinkv_in_min_value" type="number" class="form-control" value="{{ $stationdetails['sink_node']['v_in_min_value']}}">
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkgwlat">latitude key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkgwlat" name="sinkgwlat" type="text" class="form-control" value="{{ $stationdetails['sink_node']['gwlat']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinkgwlong">longitude key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkgwlong" name="sinkgwlong" type="text" class="form-control" value="{{ $stationdetails['sink_node']['gwlong']}}">
                                                                                </div>
                                                                            </div>
                                                                           
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkrssi">RSSI key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkrssi" name="sinkrssi" type="text" class="form-control" value="{{ $stationdetails['sink_node']['rssi']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinklqi">LQI key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinklqi" name="sinklqi" type="text" class="form-control" value="{{ $stationdetails['sink_node']['lqi']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkdrp">drp key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkdrp" name="sinkdrp" type="text" class="form-control" value="{{ $stationdetails['sink_node']['drp']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinkttl">TTL key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkttl" name="sinkttl" type="text" class="form-control" value="{{ $stationdetails['sink_node']['ttl']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkdate">Date identifier</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkdate" name="sinkdate" type="text" class="form-control" value="{{ $stationdetails['sink_node']['date']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="sinktime">Time identifier</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinktime" name="sinktime" type="text" class="form-control" value="{{ $stationdetails['sink_node']['time']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="sinkps">PS key</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="sinkps" name="sinkps" type="text" class="form-control" value="{{ $stationdetails['sink_node']['ps']}}">
                                                                                </div>
                                                                                
                                                                            </div>
                                                                            

                                                                                                                                                           
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="panel panel-default"> 
                                                    <div class="panel-heading"> 
                                                        <h4 class="panel-title"> 
                                                            <a data-toggle="collapse" data-parent="#accordion-test-3" href="#collapsefourteen-2" aria-expanded="false" class="collapsed">
                                                                Pressure sensor
                                                                <span class="btn btn-default pull-right activate-style">Activate</span>
                                                            
                                                            </a> 
                                                        </h4> 
                                                    </div> 
                                                    <div id="collapsefourteen-2" class="panel-collapse collapse"> 
                                                        <div class="panel-body">
                                                                            
                                                        <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="psparameter_read">Parameter read</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="psparameter_read" name="psparameter_read" type="text" class="form-control" value="{{ $stationdetails['pressure_semsor']['parameter_read']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="psidentifier_used">Identifier used</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="psidentifier_used" name="psidentifier_used" type="text" class="form-control" value="{{ $stationdetails['pressure_semsor']['identifier_used']}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group clearfix">
                                                                                <label class="col-lg-2 control-label " for="psmax_value">max_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="psmax_value" name="psmax_value" type="number" class="form-control" value="{{ $stationdetails['pressure_semsor']['max_value']}}">
                                                                                </div>
                                                                                <label class="col-lg-2 control-label " for="psmin_value">min_value</label>
                                                                                <div class="col-lg-4">
                                                                                    <input id="psmin_value" name="psmin_value" type="number" class="form-control" value="{{ $stationdetails['pressure_semsor']['min_value']}}">
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