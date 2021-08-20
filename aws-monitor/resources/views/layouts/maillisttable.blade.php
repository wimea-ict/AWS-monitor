@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Mailing List - List of Mail Recipients. </h3>
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
                                                            <th>Station</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Location</th>
                                                        </tr>
                                                    </thead>


                                                    <tbody>


                                                        @foreach ($stations as $station)
                                                            @if (!empty($station->user))
                                                                <tr>
                                                                    <td>{{ $station['StationName'] }}</td>
                                                                    <td>{{ $station->user->name }}</td>
                                                                    <td>{{ $station->user->email }}</td>
                                                                    <td>{{ $station['Location'] }}</td>
                                                                </tr>
                                                            @endif
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
