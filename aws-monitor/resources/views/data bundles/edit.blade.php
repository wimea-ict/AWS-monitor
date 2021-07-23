@extends('main')

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
                                {{-- <div class="form-group{{ $errors->has('number') ? ' has-error' : '' }}">
                                    <label for="number" class="col-md-4 control-label">Phone Number</label>

                                    <div class="col-md-6">
                                        <input id="number" type="tel" minlength="10" maxlength="10" class="form-control"
                                            name="number" value="{{ $data->mobile_no }}" required>

                                        @if ($errors->has('number'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}

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

                                <!--<div class="form-group clearfix">
                                                    
                                                    <label class="col-lg-2 control-label " for="region">Months</label>
                                                    <div class="col-lg-4">
                                                        <input id="month" name="month" type="number" class="form-control"  placeholder="No of months..." >
                                                   
                                                    </div>
                                                   
                                                </div>
                                               
                                            -->




                        </div>
                        <!--
                                            </section>
                                             <div class="form-group clearfix">
                                                                                    <div class="col-lg-4 text-right">
                                                                                        <input type="submit" name="finish" class="btn btn-primary" value="Submit">
                                                                                    </div>
                                                                                    
                                                                                </div>  
                                            </section> -->
                </div>
                </form>
            </div> <!-- End panel-body -->
        </div> <!-- End panel -->

    </div> <!-- end col -->

    </div> <!-- End row -->

@endsection
