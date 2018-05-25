@extends('main')

@section('content')
{{-- source, source_id, criticality, classification_id, track_counter, status --}}
<!-- Wizard with Validation -->
<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Problems</h3> 
                            </div> 
                            <div class="panel-body"> 
                                <table class="table">
                                    <thead>
                                        <td>source</td>
                                        <td>source_id</td>
                                        <td>criticality</td>
                                        <td>classification_id</td>
                                        <td>track_counter</td>
                                        <td>status</td>
                                    </thead>
                                    @foreach($data as $dt)
                                        @foreach($problems as $problem)
                                            @if($problem->id === $dt->classification_id)
                                                <tr>
                                                    <td>{{$dt->source}}</td>
                                                    <td>{{$dt->source_id}}</td>
                                                    <td>{{$dt->criticality}}</td>
                                                    <td>{{$problem->problem_description}}</td>
                                                    <td>{{$dt->track_counter}}</td>
                                                    <td>{{$dt->status}}</td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </table>
                            </div> <!-- End panel-body -->
                        </div><!-- End panel -->
                    </div><!-- end col -->
</div><!-- End row -->


@endsection