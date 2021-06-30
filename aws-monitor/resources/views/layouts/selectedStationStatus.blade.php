@extends('main')

@section('content')
    <div class="row">
    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h1 class="panel-title">{{$stationTaken['Location']."(".$stationTaken['StationName'].")"}} </h1></div>
                            <div class="panel-body">
                            
                                <form class="form-horizontal" role="form">
                                    
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label status_label" >2m Node</label>
                                                <div class="col-sm-2 control-label">

                                                <!--'twoMFlag','tenMFlag','gndFlag','sinkFlag','Twomnodesensors','Tenmnodesensors','Groundnodesensors','sinkNodesensors'-->
                                                <!---->
                                                
                                                <!--
                                                    S WHY NODES GO OFF-->
                                                <?php $Reasons = array(); ?>
                                                @foreach($classification as $m)
                                                <?php array_push($Reasons, $m['NodeType']) ?>

                                                @endforeach
                                                <!--+++++++++++++++++++++-->


												                        @if(($twoMFlag==0))
                                                <i class="ion-ios7-circle-filled status_btn" ></i>
                                                @endif
                                                   
                                                @if(($twoMFlag==2))
                                                 <?php $twoMproblems = array(); ?>
                                                    @foreach($classification as $mprob)
                                                       @if($mprob['NodeType'] == 'TwoMeterNode')
                                                               <?php array_push($twoMproblems, $mprob['classification_id']) ?>
                                                        @endif       
                                                    @endforeach 
                                                       @if(count($twoMproblems) != 0)
                                                       <a  href = "#datatable" title = "Current Problems &#10;&#13;

                                                        <?php foreach( $twoMproblems as $i ) echo $i ."\n" ; ?> "

                                                        class="ion-ios7-circle-filled off_status_btn" style="color:#FFA500" ></a>
                                                        @else
                                                       <!-- <i class="ion-ios7-circle-filled status_btn" style="color:#FFA500" ></i>-->
                                                       <a  href = "#datatable" title = "" class="ion-ios7-circle-filled off_status_btn" style="color:#FFA500" ></a>

                                                       @endif
                                                @endif


                                                @if($twoMFlag==1)
                                                <?php $twoMproblem = array(); ?>
                                                @foreach($classification as $mprob)
                                                   @if($mprob['NodeType'] == 'TwoMeterNode')
                                                           <?php array_push($twoMproblem, $mprob['classification_id']) ?>
                                                    @endif       
                                                @endforeach 
                                                   @if(count($twoMproblem) != 0)
                                                   <a  href = "#datatable" title = "TwoMeterNode_off &#10;&#13; <?php foreach( $twoMproblem as $i ) echo $i ."\n" ; ?> " class="ion-ios7-circle-filled off_status_btn" ></a>
                                                   @else
                                                   <a  href = "#" title = "TwoMeterNode_off &#10;&#13; <?php echo 'Node Inaccessible' ."\n" ; ?> " class="ion-ios7-circle-filled off_status_btn" ></a>
                                                   @endif

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

                                                @if(($gndFlag==2))
                                               	
                                                   <?php $gndproblems = array(); ?>
                                                 @foreach($classification as $mprob)
                                                   @if($mprob['NodeType'] == 'GroundNode')
                                                           <?php array_push($gndproblems, $mprob['classification_id']) ?>
                                                    @endif       
                                                 @endforeach 
                                                   @if(count($gndproblems) != 0)
                                                    <a  href = "#" title = "Current Problems &#10;&#13; <?php foreach( $gndproblems as $i ) echo $i ."\n" ; 
                                                    ?> " class="ion-ios7-circle-filled off_status_btn" style="color:#FFA500" ></a>
                                                     @else
                                                    <a  href = "#" title = "" class="ion-ios7-circle-filled off_status_btn" style="color:#FFA500" ></a>

                                                   @endif
                                                @endif


                                                @if($gndFlag==1)
                                                <?php $gndproblem = array(); ?>
                                                @foreach($classification as $mprob)
                                                   @if($mprob['NodeType'] == 'GroundNode')
                                                           <?php array_push($gndproblem, $mprob['classification_id']) ?>
                                                    @endif       
                                                @endforeach
                                                @if(count($gndproblem) != 0)
                                                <a href = "#" title = "GroundNode_off &#10;&#13; <?php foreach( $gndproblem as $i ) echo $i ."\n" ; ?> " class="ion-ios7-circle-filled off_status_btn" ></a>
                                                @else
                                                <a href = "#" title = "GroundNode_off &#10;&#13; <?php  echo 'Node Inaccessible'."\n" ; ?> " class="ion-ios7-circle-filled off_status_btn" ></a>

                                                @endif
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


                                                @if(($sinkFlag==2))
                               
                                                   <?php $snkproblems = array(); ?>
                                                 @foreach($classification as $mprob)
                                                   @if($mprob['NodeType'] == 'SinkNode')
                                                           <?php array_push($snkproblems, $mprob['classification_id']) ?>
                                                    @endif       
                                                 @endforeach 
                                                   @if(count($snkproblems) != 0)
                                                    <a  href = "#" title = "Current Problems &#10;&#13; <?php foreach( $snkproblems as $i ) echo $i ."\n" ;
                                                     ?> " class="ion-ios7-circle-filled off_status_btn" style="color:#FFA500" ></a>
                                                   @else
                                                    <a  href = "#" title = "" class="ion-ios7-circle-filled off_status_btn" style="color:#FFA500" ></a>
                                                   @endif
                                                
                                                @endif

                                                @if($sinkFlag==1)
                                                <?php $snkproblem = array(); ?>
                                                @foreach($classification as $mprob)
                                                   @if($mprob['NodeType'] == 'SinkNode')
                                                   
                                                   
                                                           <?php array_push($snkproblem, $mprob['classification_id']) ?>
                                                    @endif       
                                                @endforeach
                                                @if(count($snkproblem) != 0)
                                            <a href = "#" title = "SinkNode_off &#10;&#13; <?php foreach( $snkproblem as $i ) echo $i ."\n" ; ?> " class="ion-ios7-circle-filled off_status_btn" ></a>
                                                @else
                                                <a href = "#" title = "SinkNode_off &#10;&#13; <?php echo 'Node Inaccessible'."\n" ; ?> " class="ion-ios7-circle-filled off_status_btn" ></a>

                                                @endif
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


                                                @if(($tenMFlag==2))
                                                <?php $tenproblems = array(); ?>
                                                 @foreach($classification as $mprob)
                                                   @if($mprob['NodeType'] == 'TenMeterNode')
                                                           <?php array_push($tenproblems, $mprob['classification_id']) ?>
                                                    @endif       
                                                 @endforeach 
                                                   @if(count($tenproblems) != 0)
                                                    <a  href = "#" title = "Current Problems &#10;&#13; <?php foreach( $tenproblems as $i ) echo $i ."\n" ;
                                                    
                                                     ?> " class="ion-ios7-circle-filled off_status_btn" style="color:#FFA500" ></a>
                                                    @else
                                                    <a  href = "#" title = "" class="ion-ios7-circle-filled off_status_btn" style="color:#FFA500" ></a>
                                                   @endif
                                                 @endif
                                                 

                                                @if($tenMFlag==1)
                                                <?php $tenproblem = array(); ?>
                                                @foreach($classification as $mprob)
                                                   @if($mprob['NodeType'] == 'TenMeterNode')
                                                           <?php array_push($tenproblem, $mprob['classification_id']) ?>
                                                    @endif       
                                                @endforeach
                                                @if(count($tenproblem) != 0 )
                                        <a href = "#" title = "TenMeterNode_off &#10;&#13; <?php foreach( $tenproblem as $i ) echo $i ."\n" ; ?> " class="ion-ios7-circle-filled off_status_btn" ></a>
                                                @else
                                                <a href = "#" title = "SinkNode_off &#10;&#13; <?php echo 'Node Inaccessible'."\n" ; ?> " class="ion-ios7-circle-filled off_status_btn" ></a>
                                                @endif
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <!-- ============SENSORS=========== -->
                                    <div class="row">
                                    
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label status_label">Temperature Sensor</label>
                                                
                                                <div class="col-sm-2 control-label">
                                                @if($TempSensorFlag==0)
                                                <i class="ion-ios7-circle-filled status_btn" ></i>
                                                @endif
                                                @if($TempSensorFlag==1)
                                                <a href = "#" title = "current problems &#10;&#13; Missing T_SHT2X value " class="ion-ios7-circle-filled off_status_btn" ></a>
                                                @endif
                                                @if($TempSensorFlag==2)
                                                <a class="ion-ios7-circle-filled off_status_btn" style="color:#FFA500" ></a>
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
                                                <a href = "#" title = "current problems &#10;&#13; Missing RH_SHT2X value" class="ion-ios7-circle-filled off_status_btn" ></a>
                                                @endif
                                                @if($relativeHumidity==2)
                                                <a class="ion-ios7-circle-filled off_status_btn" style="color:#FFA500" ></a>
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
                                                <a href = "#" title = "current problems &#10;&#13; Missing P0_LST60 values" class="ion-ios7-circle-filled off_status_btn" ></a>
                                                @endif
                                                @if($PreciptationFlag==2)
                                                <a class="ion-ios7-circle-filled off_status_btn" style="color:#FFA500" ></a>
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
                                                <a href = "#" title = "current problems &#10;&#13; Missing T1 value" class="ion-ios7-circle-filled off_status_btn" ></a>
                                                @endif
                                                @if($SoilTempFlag==2)
                                                <a class="ion-ios7-circle-filled off_status_btn" style="color:#FFA500" ></a>
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
                                                <a href = "#" title = "current problems &#10;&#13; Missing V_A1 or V_A2 value" class="ion-ios7-circle-filled off_status_btn" ></a>
                                                @endif
                                                @if($SoilMoistureFlag==2)
                                                <a class="ion-ios7-circle-filled off_status_btn" style="color:#FFA500" ></a>
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
                                                <a href = "#" title = "current problems &#10;&#13; Missing V_AD1 value" class="ion-ios7-circle-filled off_status_btn" ></a>
                                                @endif
                                                @if($insolationFlag==2)
                                                <a class="ion-ios7-circle-filled off_status_btn" style="color:#FFA500" ></a>
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
                                                <a href = "#" title = "current problems &#10;&#13; Missing PO_LST value" class="ion-ios7-circle-filled off_status_btn" ></a>
                                                @endif
                                                @if($WindSpeedFlag==2)
                                                <a class="ion-ios7-circle-filled off_status_btn" style="color:#FFA500" ></a>
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
                                                <a href = "#" title = "current problems &#10;&#13; Missing V_A1 value " class="ion-ios7-circle-filled off_status_btn" ></a>
                                                @endif
                                                @if($WindDirectionFlag==2)
                                                <a class="ion-ios7-circle-filled off_status_btn" style="color:#FFA500" ></a>
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
                                <h3 class="panel-title">Identified problems  on <?php echo $stationTaken['Location']?></h3>
                                <h5><a href = "{{URL::to('archivedProblems/'.$stationTaken['station_id'])}}" style="color:#FF0000;">Archived problems</a></h5>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                       <table id="datatable" class="table table-striped table-bordered">
                                       
                                            <thead>
                                                <tr>
                                                   <th>id</th>
                                                    <th>NodeType</th>
                                                    <th>Problem Description</th>
                                                    <th>Value</th>
                                                    <th>Report Status</th>
                                                    <th>When reported</th>
                                                                                                       
                                                </tr>
                                            </thead>

                                     
                                            <tbody>
                                            	<?php $j=0; ?>
                                            @foreach($problemsForStation as $probs)
                                            <?php $j=$j+1; ?>
                                                <!--<tr>-->
                                                	<tr >
                                                		<td>{{$j}}</td>
                                                    <td>{{$probs['NodeType']}}</td>
                                                    <td>{{$probs['problem_description']}}</td>
                                                    <td>{{$probs['Value']}}</td>
                                                    <td>{{$probs['status']}}</td>
                                                    <td>{{$probs['when_reported']}}</td>
                                                    </tr>                                          
                                                <!--</tr>-->    
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





