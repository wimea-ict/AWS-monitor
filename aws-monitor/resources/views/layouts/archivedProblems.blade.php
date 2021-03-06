@extends('main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Archived Problems on <?php echo $stationTaken['Location']//$stations['StationName']?></h3> 
                </div>
                <div class="panel-body">
                    <div class=" col-md-12 col-sm-12 col-xs-12">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                           
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="datatable" class="table table-striped table-bordered">
                                             <thead>
                                                <tr>
                                                    <th>NodeType</th>
                                                    <th>Problem</th>
                                                    <th>Value</th>
                                                    <th>Status</th>
                                                    <th>When_reported</th>
                                                    <th>When_fixed</th>
											                                                           
                                                </tr>
                                            </thead>

                                     
                                            <tbody>
		                                  
                                            
                                             @foreach($problems as $ue)
                                             
                                               <tr>
                                                    
                                                    <td>{{$ue['NodeType']}}</td>
                                                    <td>{{$ue['problem_description']}}</td>
                                                    <td>{{$ue['Value']}}</td>
                                                    <td>{{$ue['status']}}</td>
                                                    <td>{{$ue['when_reported']}}</td>
                                                    <td>{{$ue['when_fixed']}}</td>
                          
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
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

