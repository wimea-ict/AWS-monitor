@extends('layouts.app')

@section('header')
    <link href="{{ asset('css/transferList.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet"
                id="bootstrap-css">
            <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
            <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
            <!------ Include the above in your HEAD tag ---------->

            <div class="container">
                <br />
                <div class="row">

                    <div class="dual-list list-left col-md-5">
                        <div class="well text-right">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="input-group">
                                        <span class="input-group-addon glyphicon glyphicon-search"></span>
                                        <input type="text" name="SearchDualList" class="form-control"
                                            placeholder="search" />
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="btn-group">
                                        <a class="btn btn-default selector" title="select all"><i
                                                class="glyphicon glyphicon-unchecked"></i></a>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">bootstrap-duallist <a
                                        href="https://github.com/bbilginn/bootstrap-duallist" target="_blank">github</a>
                                </li>
                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                <li class="list-group-item">Morbi leo risus</li>
                                <li class="list-group-item">Porta ac consectetur ac</li>
                                <li class="list-group-item">Vestibulum at eros</li>
                            </ul>
                        </div>
                    </div>

                    <div class="list-arrows col-md-1 text-center">
                        <button class="btn btn-default btn-sm move-left">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </button>

                        <button class="btn btn-default btn-sm move-right">
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
                                        <input type="text" name="SearchDualList" class="form-control"
                                            placeholder="search" />
                                        <span class="input-group-addon glyphicon glyphicon-search"></span>
                                    </div>
                                </div>
                            </div>
                            <ul class="list-group">
                                <li class="list-group-item">Cras justo odio</li>
                                <li class="list-group-item">Dapibus ac facilisis in</li>
                                <li class="list-group-item">Morbi leo risus</li>
                                <li class="list-group-item">Porta ac consectetur ac</li>
                                <li class="list-group-item">Vestibulum at eros</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/transferList.js') }}"></script>
@endsection
