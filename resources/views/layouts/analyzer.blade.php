@extends('main')

@section('content')
{{-- some js to enable data table --}}
{{-- <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script> --}}
{{-- source, source_id, criticality, classification_id, track_counter, status --}}
<!-- Wizard with Validation -->
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12 panel panel-default">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h2><a  class=" btn btn-info pull-left" href="{{ URL::to('analyzeNodeStatus') }}"> Analyze Node Status Data</a></h2>
            <h2><a  class=" btn btn-info pull-right" href="{{ URL::to('analyzeObservationSlip') }}"> Analyze ObservationSlip Data</a></h2>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12 panel panel-default">
            <div class="panel-heading"> 
                <h3 class="panel-title">Problems</h3> 
            </div> 
            <div class="panel-body"> 
                <div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table table-hover table-bordered">
                            <thead class="thead-light">
                                <th>STATION NAME</th>
                                <th>SOURCE</th>
                                <th>CRITICALITY</th>
                                <th>PROBLEM </th>
                                <th>STATUS</th>
                                <th>DATE (1ST OCCURRENCE)</th>
                            </thead>    
                            @foreach($data as $dt)
                                @foreach($problems as $problem)
                                    @if($problem->id === $dt->classification_id)
                                        <tr>
                                            <td>{{$dt->stn_name}}</td>
                                            @if(!empty($dt->parameter_read))
                                                <td>{{$dt->parameter_read ." - ". $dt->source}}</td>
                                            @else
                                                <td>{{$dt->source}}</td>
                                            @endif
                                            <td>{{$dt->criticality}}</td>
                                            <td>{{$problem->problem_description}}</td>
                                            <td>{{$dt->status}}</td>
                                            <td>{{$dt->created_at}}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </table>
                    </div>
                </div>
                
            </div> <!-- End panel-body -->
        </div><!-- End panel -->
    </div><!-- end col -->
</div><!-- End row -->


@endsection