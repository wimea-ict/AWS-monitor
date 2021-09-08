@extends('main')
@section('header')
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css"
        rel="stylesheet" />
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-lg-10">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">DataBundles History for {{ $station->StationName }} </h3>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addDataBundle">
                            Add
                        </button>

                        <!-- Modal -->
                        <form action="{{ url('data_bundle/' . $id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal fade" id="addDataBundle" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Data Bundle</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <label class="col-lg-2 control-label " for="start">Start</label>
                                            <div class="input-group">
                                                <input id="start" name="start" type="text" class="form-control datepicker" required
                                                    min='0'>
                                                <span class="input-group-addon"><i class="ion-ios7-calendar"></i> </span>
                                            </div>
                                            <label class="col-lg-2 control-label " for="end">End</label>
                                            <div class="input-group">
                                                <input id="end" name="end" type="text" class="form-control datepicker" required
                                                    min='0'>
                                                <span class="input-group-addon"><i class="ion-ios7-calendar"></i> </span>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                                                            <th>Start Date</th>
                                                            <th>Expiry Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($data as $mobile_no)
                                                            <tr>
                                                                <td> {{ $mobile_no->load_date }}</td>
                                                                <td> {{ $mobile_no->end_date }}</td>
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
@section('script')
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js">
    </script>
    <script type="text/javascript">
        $(function() {
            $('.datepicker').datepicker();
        })
    </script>
@endsection
@endsection
