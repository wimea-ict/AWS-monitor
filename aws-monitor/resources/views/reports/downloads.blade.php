<!--page_specific_css_files  page_specific_script_files-->

@extends('main')


@section('page_specific_css_files')

@endsection

@section('content')
<div>
  <table class="table table-stripped" id="datatable">
    <thead class="thead-dark">
    <tr>
      <th scope="col">FILE DOWNLOADS (RAW DATA)</th>
    </tr>
    </thead>

    <tbody>
    @foreach($files as $f)
    <tr>
    <td><a href= "{{ $f }}">{{$f}}</td>
    </tr>
    @endforeach
    </tbody>

  </table>


</div>
<br><br>
@endsection