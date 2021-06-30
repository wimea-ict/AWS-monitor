@extends('main')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Add user to Mail list</h3> 
                </div>
                <div class="panel-body">
                    <div class=" col-md-12 col-sm-12 col-xs-12">
                        <form class="form-horizontal" method="POST" action="{{ route('maillistFormInsert') }}">
                            <br/>
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <select id="name" type="text" class="form-control" name="urname"  required autofocus>

                                    @foreach ($username as $un)        
                                    @echo ('<option name = "urname" value = {{ $un['id'] }}>{{ $un['name'] }}</option>');
                                    @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Location</label>

                                <div class="col-md-6">
                                    <select id="locate" type="text" class="form-control" name="locat"  required autofocus>

                                    @foreach ($stationsAttachedTo as $SAT)        
                                    @echo ('<option name = "locat" value = {{ $SAT['station_id'] }}>{{ $SAT['Location'] }}</option>');
                                    @endforeach

                                    </select>
                                </div>
                            </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
