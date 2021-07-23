@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">DataBundles- and Expiry dates. </h3>
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
                                                            <th>Simcard Number</th>
                                                            <th>Expiry date</th>
                                                            <th>Options</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        @foreach ($data as $mobile_no)

                                                            <tr>
                                                                <td> {{ $mobile_no->mobile_number }}</td>
                                                                <td> {{ $mobile_no->end_date }}</td>
                                                                <td><a href="{{ URL::to('data_bundle/' . $mobile_no->id) . '/edit' }}"
                                                                        class="btn btn-warning">Edit</a>
                                                                    <form action="/data_bundle/{{ $mobile_no->id }}" method="POST" style="display: inline">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('DELETE') }}
                                                                        <button class="btn btn-danger">Delete</button>
                                                                    </form>
                                                                </td>

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
