@extends('main')

@section('content')
<div class="row">
                    <div class="col-lg-2 col-lg-offset-3">
                        <div class="widget-panel widget-style-2 bg-danger">
                            
                            <h3 class="m-0 counter">Critical issues</h3>
                            
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="widget-panel widget-style-2 bg-warning">
                           
                            <h3 class="m-0 counter">Non Critical issues</h3>
                            
                        </div>
                    </div>
                    <div class="col-lg-2 col-sm-6">
                        <div class="widget-panel widget-style-2 bg-success">
                            
                            <h3 class="m-0 counter">No Station issues</h3>
                            
                        </div>
                    </div>
                    
                </div> <!-- end row -->
<div class="row text-center">
                    @foreach($stations as $station)
                    
                    <?php $counter=0 ?>
                    <?php $flag=0 ?>
                    @foreach ($stations_with_problems as $problem)
                        @if($problem['id']== $station['station_id'])
                            @if($problem['category']=="critical")
                            <?php $flag=1 ?>
                            @endif
                            @if($problem['category']=="non-critical")
                                <?php $flag=2 ?>
                            @endif
                            <?php $counter++ ?>
                        @endif
                        
                    @endforeach
                    <div class="col-sm-5 col-md-2">
                        <div class="panel">
                            <a href="{{URL::to('selectedStationStatus/'.$station['station_id'])}}">
                            <div class="h4 text-purple">{{$station['StationName']}}</div>
                            <span class="text-muted">{{$counter}}</span>
                            @if($flag ==0)
                            <div class="text-right">
                              <i class="ion-ios7-circle-filled" style="font-size:30px; color:#2b542c"></i>
                            </div>
                            @endif
                            @if($flag ==1)
                            <div class="text-right">
                              <i class="ion-ios7-circle-filled" style="font-size:30px; color:#a94442"></i>
                            </div>
                            @endif
                            @if($flag==2)
                            <div class="text-right">
                              <i class="ion-ios7-circle-filled" style="font-size:30px; color:#8a6d3b"></i>
                            </div>
                            @endif
                            
                            </a>
                    </div>
                          
                    

                </div>
                @endforeach
                <div class="row text-center">
                    @foreach($stationsOn as $station)
                    
                    <div class="col-sm-5 col-md-2">
                        <div class="panel">
                            <a href="{{URL::to('selectedStationStatus/'.$station['station_id'])}}">
                            <div class="h4 text-purple">{{$station['StationName']}}</div>
                            <span class="text-muted">0</span>
                           
                            <div class="text-right">
                              <i class="ion-ios7-circle-filled" style="font-size:30px; color:#2b542c"></i>
                            </div>
                            
                            
                            </a>
                    </div>
                          
                    

                </div>
                @endforeach 
                

               

               

               

@endsection