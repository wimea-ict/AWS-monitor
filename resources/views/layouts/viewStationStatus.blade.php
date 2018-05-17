@extends('main')

@section('content')
    <div class="row">
    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3 class="panel-title">Node and sensor statuses</h3></div>
                            <div class="panel-body">
                            
                                <form class="form-horizontal" role="form">
                                    <div class="form-group clearfix">
                                        <label class="col-sm-2 col-sm-offset-3 control-label">Select Station</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" name="station_selected">
                                                @foreach($stations as $station)
                                                    <option value="{{$station['StationName']}}">{{$station['StationName']}}</option>
                                                @endforeach
                                                
                                            </select>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">10m Node</label>
                                                <div class="col-sm-6 control-label">
                                                    <div class="toggle toggle-success"></div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">Ground Node</label>
                                                <div class="col-sm-6 control-label">
                                                    <div class="toggle toggle-success"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">Sink Node</label>
                                                <div class="col-sm-6 control-label">
                                                    <div class="toggle toggle-success"></div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">2m Node</label>
                                                <div class="col-sm-6 control-label">
                                                    <div class="toggle toggle-success"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">Temperature Sensor</label>
                                                <div class="col-sm-6 control-label">
                                                    <div class="toggle toggle-success"></div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">Relative Humidity</label>
                                                <div class="col-sm-6 control-label">
                                                    <div class="toggle toggle-success"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">Preciptation Sensor</label>
                                                <div class="col-sm-6 control-label">
                                                    <div class="toggle toggle-success"></div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">Soil Temperature Sensor</label>
                                                <div class="col-sm-6 control-label">
                                                    <div class="toggle toggle-success"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">Soil Moisture Sensor</label>
                                                <div class="col-sm-6 control-label">
                                                    <div class="toggle toggle-success"></div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">Insulation Sensor</label>
                                                <div class="col-sm-6 control-label">
                                                    <div class="toggle toggle-success"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group clearfix" >
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">wind Speed Sensor</label>
                                                <div class="col-sm-6 control-label">
                                                    <div class="toggle toggle-success"></div>
                                                </div>
                                            </div>
                                        </div>

                                        
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-6 control-label">Wind Direction Sensor</label>
                                                <div class="col-sm-6 control-label">
                                                    <div class="toggle toggle-success"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                                                      
                                                
                                </form>
                            
                            </div> <!-- panel-body -->
                        </div> <!-- panel -->
                    </div>
    </div>
@endsection