@extends('layouts.app')

@section('header')
    <link href="{{ asset('css/transferList.css') }}" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <form method="POST" action="{{ url('assign_role/' . $user->id) }}" onsubmit="handleSubmit()">
                @csrf
                <input name="roles" hidden value="" id="roles">
                <div class="dual-list list-left col-md-5">
                    <div class="well text-right">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="input-group">
                                    <span class="input-group-addon glyphicon glyphicon-search"></span>
                                    <input type="text" name="SearchDualList" class="form-control" placeholder="search" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="btn-group">
                                    <a class="btn btn-default selector" title="select all"><i
                                            class="glyphicon glyphicon-unchecked"></i></a>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group" id="roles-list">
                            @foreach ($user->getRoleNames() as $role)
                                <li class="list-group-item">{{ $role }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="list-arrows col-md-1 text-center">
                    <button class="btn btn-default btn-sm move-left" type="button">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </button>

                    <button class="btn btn-default btn-sm move-right" type="button">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </button>
                </div>

                <div class="dual-list list-right col-md-5">
                    <div class="well">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="btn-group">
                                    <a class="btn btn-default selector" title="select all"><i
                                            class="glyphicon glyphicon-unchecked"></i></a>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="input-group">
                                    <input type="text" name="SearchDualList" class="form-control" placeholder="search" />
                                    <span class="input-group-addon glyphicon glyphicon-search"></span>
                                </div>
                            </div>
                        </div>
                        <ul class="list-group">
                            @foreach ($roles as $role)
                                <li class="list-group-item">{{ $role}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type='submit'>Save</button>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/transferList.js') }}"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@endsection
