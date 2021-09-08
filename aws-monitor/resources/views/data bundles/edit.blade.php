@extends('main')

@section('header')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
@endsection
@section('content')


    <!-- Wizard with Validation -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add Data Bundle</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" id="wizard-validation-form" method="post"
                        action="/data_bundle/{{ $data->id }}" style="margin-bottom: 30px;">
                        <div>
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <h3>Simcard Attributes</h3>
                            <section style="padding-bottom:30px;">
                                <div class="form-group clearfix">

                                </div>

                                <div class="form-group{{ $errors->has('month') ? ' has-error' : '' }}">
                                    <label for="password" class="col-md-4 control-label">Months</label>

                                    <div class="col-md-6">
                                        <input id="month" type="number" min="0" class="form-control" name="month"
                                            placeholder="add months" required>

                                        @if ($errors->has('month'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('month') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                        </div>
                </div>
                </form>
            </div> <!-- End panel-body -->
        </div> <!-- End panel -->

    </div> <!-- end col -->

    </div> <!-- End row -->

@endsection

@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
@endsection
