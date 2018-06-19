@extends('main')

@section('content')
    <div class="row">
    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h1 class="panel-title">{{$stationTaken['StationName']}} </h1></div>
                            <div class="panel-body">
                            
                                <form class="form-horizontal" role="form">
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label status_label" >2m Node</label>
                                                <div class="col-sm-2 control-label">
                                                <!--'twoMFlag','tenMFlag','gndFlag','sinkFlag','Twomnodesensors','Tenmnodesensors','Groundnodesensors','sinkNodesensors'-->
                                                @if($twoMFlag==0)
                                                
                                                    <i class="ion-ios7-circle-filled status_btn" ></i>
                                                
                                                @endif
                                                @if($twoMFlag==1)
                                                   <i class="ion-ios7-circle-filled off_status_btn" ></i>
                                                @endif
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label status_label">Ground Node</label>
                                                <div class="col-sm-2 control-label">
                                                @if($gndFlag==0)
                                                <i class="ion-ios7-circle-filled status_btn" ></i>
                                                @endif
                                                @if($gndFlag==1)
                                                <i class="ion-ios7-circle-filled off_status_btn" ></i>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label status_label">Sink Node</label>
                                                <div class="col-sm-2 control-label">
                                                @if($sinkFlag==0)
                                                <i class="ion-ios7-circle-filled status_btn" ></i>
                                                @endif
                                                @if($sinkFlag==1)
                                                <i class="ion-ios7-circle-filled off_status_btn" ></i>
                                                @endif
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label status_label">10m Node</label>
                                                <div class="col-sm-2 control-label">
                                                @if($tenMFlag==0)
                                                <i class="ion-ios7-circle-filled status_btn" ></i>
                                                @endif
                                                @if($tenMFlag==1)
                                                <i class="ion-ios7-circle-filled off_status_btn" ></i>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label status_label">Temperature Sensor</label>
                                                
                                                <div class="col-sm-2 control-label">
                                                @if($TempSensorFlag==0)
                                                <i class="ion-ios7-circle-filled status_btn" ></i>
                                                @endif
                                                @if($TempSensorFlag==1)
                                                <i class="ion-ios7-circle-filled off_status_btn" ></i>
                                                @endif
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label status_label">Relative Humidity</label>
                                                <div class="col-sm-2 control-label">
                                                @if($relativeHumidity==0)
                                                <i class="ion-ios7-circle-filled status_btn" ></i>
                                                @endif
                                                @if($relativeHumidity==1)
                                                <i class="ion-ios7-circle-filled off_status_btn" ></i>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label status_label">Preciptation Sensor</label>
                                                <div class="col-sm-2 control-label">
                                                @if($PreciptationFlag==0)
                                                <i class="ion-ios7-circle-filled status_btn" ></i>
                                                @endif
                                                @if($PreciptationFlag==1)
                                                <i class="ion-ios7-circle-filled off_status_btn" ></i>
                                                @endif
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label status_label">Soil Temperature Sensor</label>
                                                <div class="col-sm-2 control-label">
                                                @if($SoilTempFlag==0)
                                                <i class="ion-ios7-circle-filled status_btn" ></i>
                                                @endif
                                                @if($SoilTempFlag==1)
                                                <i class="ion-ios7-circle-filled off_status_btn" ></i>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label status_label">Soil Moisture Sensor</label>
                                                <div class="col-sm-2 control-label">
                                                @if($SoilMoistureFlag==0)
                                                <i class="ion-ios7-circle-filled status_btn" ></i>
                                                @endif
                                                @if($SoilMoistureFlag==1)
                                                <i class="ion-ios7-circle-filled off_status_btn" ></i>
                                                @endif
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-sm-6">
                                        <!--'TempSensorFlag','SoilMoistureFlag','SoilTempFlag','PreciptationFlag','PressureFlag','RainfallFlag','WindSpeedFlag','WindDirectionFlag','insolationFlag','relativeHumidity'-->
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label status_label">Insolation Sensor</label>
                                                <div class="col-sm-2 control-label">
                                                @if($insolationFlag==0)
                                                <i class="ion-ios7-circle-filled status_btn" ></i>
                                                @endif
                                                @if($insolationFlag==1)
                                                <i class="ion-ios7-circle-filled off_status_btn" ></i>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label status_label">wind Speed Sensor</label>
                                                <div class="col-sm-2 control-label">
                                                @if($WindSpeedFlag==0)
                                                <i class="ion-ios7-circle-filled status_btn" ></i>
                                                @endif
                                                @if($WindSpeedFlag==1)
                                                <i class="ion-ios7-circle-filled off_status_btn" ></i>
                                                @endif
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label status_label">Wind Direction Sensor</label>
                                                <div class="col-sm-2 control-label">
                                                @if($WindDirectionFlag==0)
                                                <i class="ion-ios7-circle-filled status_btn" ></i>
                                                @endif
                                                @if($WindDirectionFlag==1)
                                                <i class="ion-ios7-circle-filled off_status_btn" ></i>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                                                      
                                                
                                </form>
                            
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div>
    </div>
    <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Identified problems</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Source</th>
                                                    <th>Problem</th>
                                                    <th>status</th>
                                                    <th>criticality</th>
                                                    
                                                </tr>
                                            </thead>

                                     
                                            <tbody>
                                            @foreach($problemsForStation as $probs)
                                                <tr>
                                                    <td>{{$probs['source']}}</td>
                                                    <td>{{$probs['problem_description']}}</td>
                                                    <td>{{$probs['status']}}</td>
                                                    <td>{{$probs['criticality']}}</td>
                                                    
                                                </tr>
                                                @endforeach    
                                                
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> <!-- End Row -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Problems Frequencies</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="datatable2" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Problem</th>
                                                    <th>Frequencies</th>
                                                   
                                                </tr>
                                            </thead>

                                     
                                            <tbody>
                                            
                                            @foreach ($problemFrequencies as $key => $value) 
                                            
                                                <tr>
                                                    <td>{{$key}}</td>
                                                    <td>{{$value}}</td>
                                                    
                                                    
                                                </tr>
                                                @endforeach    
                                                
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> <!-- End Row -->
@endsection