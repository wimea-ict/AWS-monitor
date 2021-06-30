@extends('main')

@section('content')
<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Stations Live-Data</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="datatable" class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Time</th>
                                                    <th>T Air</th>
                                                    
                                                    <!-- <th>Solar</th> -->
                                                    <th>RH</th>
                                                    <th>Rain</th>
                                                    <th>Windspeed</th>
                                                    <th>W.Direction</th>
                                                    <th>Pressure</th>
                                                </tr>
                                            </thead>

                                     
                                            <tbody>
                                              
                        @foreach($stations as $station)
                         @foreach($stationsLivedata as $livedata)
                         @if($station['station_id'] == $livedata[0])
                         <tr>
                          <td>
                          	<a href="{{URL::to('livedata/'.$station['station_id']) }}" class="link" style="color: blue; text-decoration: underline;">
                          	{{$station['Location']}}
                          	</a>
                            
                          </td>
                            <td>
                            {{$livedata[1]}}
                          </td>
                           <td>
                            {{round($livedata[2],1)}} <span>&#8451;</span>
                          </td>
                          <td>
                            {{round($livedata[3],1)}} <span>%</span>
                          </td>
                          <td>
                            {{round($livedata[7],1)}} <span>mm</span>
                          </td>
                          <td>
                            {{round($livedata[5],1)}} <span>mps</span>
                          </td>
                          <td>
                            {{round($livedata[6],0)}} <span>&deg;</span>
                          </td>
                          <td>
                            {{round($livedata[9],1)}} <span>hPa</span>
                          </td>
                        </tr>
                          @endif
                        @endforeach
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
