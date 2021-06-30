@extends('main')

@section('content')

    <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Weather Overview on <?php echo $stationTaken['Location']?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                       <table id="datatable" class="table table-striped table-bordered">
                                       
                                            <thead>
                                                <tr>
                                                   <!-- <th>Source</th> -->
                                                    <th>Formula</th>
                                                    <th>Latest</th>
                                                    <th>Today</th>
                                                    <th>7 days</th>
                                                    <th>Month</th>
                                                    <th>Year</th>
                                                                                                       
                                                </tr>
                                            </thead>

                                     
                                            <tbody>
                                            
                                                <!--<tr>-->
                                                @if(count($dat)>1)
                                                	<tr >
                                                    <td>{{$dat[1][1]}}</td>
                                                    <td>{{$dat[1][2]}}</td>

                                                    <td>{{$dat[1][3]}}</td>
                                                    <td>{{$dat[1][4]}}</td>
                                                    <td>{{$dat[1][5]}}</td>
                                                    <td>{{$dat[1][6]}}</td>
                                                    </tr>        
                                                @endif                                  
                                                <!--</tr>--> 

                                                <!--<tr>-->
                                                @if(count($dat)>2)
                                                    <tr >
                                                    <td>{{$dat[2][1]}}</td>
                                                    <td>{{$dat[2][2]}}</td>

                                                    <td>{{$dat[2][3]}}</td>
                                                    <td>{{$dat[2][4]}}</td>
                                                    <td>{{$dat[2][5]}}</td>
                                                    <td>{{$dat[2][6]}}</td>
                                                    </tr>        
                                                @endif                                  
                                                <!--</tr>--> 


                                                <!--<tr>-->
                                            @if(count($dat)>3)
                                                    <tr >
                                                    <td>{{$dat[3][1]}}</td>
                                                    <td>{{$dat[3][2]}}</td>
                                                    <td>{{$dat[3][3]}}</td>
                                                    <td>{{$dat[3][4]}}</td>
                                                    <td>{{$dat[3][5]}}</td>
                                                    <td>{{$dat[3][6]}}</td>
                                                    </tr>                
                                            @endif                          
                                                <!--</tr>--> 
                                            @if(count($dat)>4)
                                                    <tr >
                                                    <td>{{$dat[4][1]}}</td>
                                                    <td>{{$dat[4][2]}}</td>
                                                    <td>{{$dat[4][3]}}</td>
                                                    <td>{{$dat[4][4]}}</td>
                                                    <td>{{$dat[4][5]}}</td>
                                                    <td>{{$dat[4][6]}}</td>
                                                    </tr>    
                                            @endif
                                            <!--</tr>--> 
                                            @if(count($dat)>5)
                                                    <tr >
                                                    <td>{{$dat[5][1]}}</td>
                                                    <td>{{$dat[5][2]}}</td>
                                                    <td>{{$dat[5][3]}}</td>
                                                    <td>{{$dat[5][4]}}</td>
                                                    <td>{{$dat[5][5]}}</td>
                                                    <td>{{$dat[5][6]}}</td>
                                                    </tr>    
                                            @endif
                                                <!--<tr>-->  
                                            @if(count($dat)>6)
                                                    <tr >
                                                    <td>{{$dat[6][1]}}</td>
                                                    <td>{{$dat[6][2]}}</td>
                                                    <td>{{$dat[6][3]}}</td>
                                                    <td>{{$dat[6][4]}}</td>
                                                    <td>{{$dat[6][5]}}</td>
                                                    <td>{{$dat[6][6]}}</td>
                                                    </tr>    
                                            @endif
                                            
                                            </tbody>
                                            
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div> <!-- End Row -->

           @endsection





