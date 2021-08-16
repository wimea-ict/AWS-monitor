@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            Role
            <form action="{{ url('manage') }}" method="post">
                {{ csrf_field() }}
                <input type="text" name="name">
                <button type="submit">submit</button>
            </form>
        </div>
    </div>
@endsection
