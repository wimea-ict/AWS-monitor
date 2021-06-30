@extends('main')

@section('content')


<!-- Wizard with Validation -->
<div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"> 
                                <h3 class="panel-title">Add Station</h3> 
                            </div> 
                            <div class="panel-body"> 
                                <form id="wizard-validation-form" method="post" action="{{url('addstation')}}" style="margin-bottom: 30px;">
                                    <div>
                                    {{csrf_field()}}
                                        <h3>Station Attributes</h3>
                                        <section style="padding-bottom:30px;">
                                            <div class="form-group clearfix">
                                                <div class="col-sm-12  control-label text-right">
                                                                                    <label class="switch">
                                                                                            <input type="checkbox" name="station_status" value="on" checked>
                                                                                            <span class="slider round"></span>
                                                                                    </label>
                                                </div>
                                            </div>    
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label" for="sname">Station name</label>
                                                <div class="col-lg-4">
                                                    <input class="form-control" id="sname" name="sname" type="text" required>
                                                </div>
                                                <label class="col-lg-2 control-label" for="snumber">Station number</label>
                                                <div class="col-lg-4">
                                                    <input class="form-control" id="snumber" name="snumber" type="text" >
                                                </div>
                                            </div>
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="slocation">Station location</label>
                                                <div class="col-lg-4">
                                                    <input id="slocation" name="slocation" type="text" class="form-control" required>

                                                </div>
                                                <label class="col-lg-2 control-label " for="region">Region</label>
                                                <div class="col-lg-4">
                                                    <input id="region" name="region" type="text" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="longitude">Longitude</label>
                                                <div class="col-lg-4">
                                                    <input id="longitude" name="longitude" type="number" class="form-control" required>
                                                </div>
                                                <label class="col-lg-2 control-label " for="latitude">Latitude</label>
                                                <div class="col-lg-4">
                                                    <input id="latitude" name="latitude" type="number" class="form-control" required>
                                                </div>
                                            </div>
                                            {{--  <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="code">Code</label>
                                                <div class="col-lg-4">
                                                    <input id="code" name="code" type="text" class="form-control" required>
                                                </div>
                                                <label class="col-lg-2 control-label " for="city" >City</label>
                                                <div class="col-lg-4">
                                                    <input id="city" name="city" type="text" class="form-control" required>

                                                </div>
                                            </div>  --}}
                                            
                                            {{--<div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="dateopened">Date opened</label>
                                                <div class="col-lg-4">
                                                    <div class="input-group">
                                                        <input type="date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker" name="date_opened" required>
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                </div>
                                                <label class="col-lg-2 control-label " for="dateclosed">Date closed</label>
                                                <div class="col-lg-4">
                                                <div class="input-group">
                                                        <input type="date" class="form-control" placeholder="mm/dd/yyyy" id="datepicker" name="date_closed" required>
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                    </div>
                                                </div>
                                            </div>--}}
                                            <div class="form-group clearfix">
                                                <label class="col-lg-2 control-label " for="station_type">station Type</label>
                                                <div class="col-lg-4">
                                                   <select class="form-control"         name="station_type">
                                               
                                                    <option value="synoptic">Synoptic</option>
                                                    <option value="Agrometrological">Agrometrological</option>
                                                    <option value="Hydrometrological">Hydrometrological</option>
                                                    <option value="Rainfall">Rainfall</option>
                                                    <option value="Climatorogical">Climatorogical</option>
                                                    </select>
                                                </div>

                                                 
                                            
                                                <label class="col-lg-2 control-label " for="station_type">Country</label>
                                                <div class="col-lg-4">
                                                    <input id="country" name="country" type="text" class="form-control" required>
                                                </div>

                                                
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
                            </div>  <!-- End panel-body -->
                        </div> <!-- End panel -->

                    </div> <!-- end col -->

</div> <!-- End row -->
 
@endsection
