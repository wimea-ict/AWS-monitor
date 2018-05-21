@extends('main')

@section('content')
                <div class=""> 
                    <h3 class="title">Automatic weather Station Statuses</h3> 
                </div>

               

                    
                <div class="row text-center">
                    @foreach($stations as $station)
                    
                    <?php $counter=0 ?>
                    <?php $flag=0 ?>
                    @foreach ($problems_identified as $problem)
                        @if($problem['status']== "reported")
                        @if($problem['source_id']== $station['station_id'])
                            @if($problem['criticality']=="critical")
                            <?php $flag=1 ?>
                            @endif
                            @if($problem['criticality']=="non-critical")
                                <?php print $flag=2 ?>
                            @endif
                            <?php print $counter++ ?>
                        @endif
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
                

               

@endsection