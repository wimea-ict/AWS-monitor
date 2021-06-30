<!--page_specific_css_files  page_specific_script_files-->

@extends('main')
@section('page_specific_css_files')
<style>
#map {
 height:500px;
margin:0;
padding:0;
}
</style>
@endsection

@section('content')
<!--<div class="row">-->
<!--<table align="left" border="1" cellpadding=" " cellspacing="2" class="table">-->


<div class="dropdown">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Select AWS Statistics
  <span class="caret"></span></button>

  <ul class="dropdown-menu">
  <?php
    foreach($stations as $station) {
    ?>
    <div>
        <li class="active"><a class=".btn-primary " href="{{URL::to('selected_aws/'.$station['station_id']) }}"> 
            <?php
                echo $station['Location'];
            ?>
        </a></li>
    </div>
  <?php 
  }
  ?>
  </ul>  
</div>



<head>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
            <div class="panel panel-default">
<!--                 <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-9">
                            <h3 class="panel-title">Station's Performance Chart</h3>
                        </div>
                        <div class="col-md-3">
                            <select name="year" class="form-control" id="period">
                                <option value="" disabled selected>Select period</option>
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                                <option value="year">This Year</option>
                                <option value="sinceD">Since Deployment</option>
                            </select>
                        </div>
                    </div>
                </div> -->
<body onload="loadChart('sinceD');">
  <div id="line-chart"></div>
</body>


@endsection
@section('page_specific_script_files')
<script>
// var innerContainer = document.querySelector('[data-num="0"'),
//     plotEl = innerContainer.querySelector('.plot'),
//     countrySelector = innerContainer.querySelector('.countrydata');

    

    function loadChart() {
      title_name=loadChart.value;

      if((title_name)==="sinceD") {
        this.title_name ="Station's Performance Since Deployment"
        var Xaxis =<?php echo json_encode($x_axix); ?>;
        var Yaxis =<?php echo json_encode($y_axis); ?>;
        Chart(Xaxis,Yaxis,this.title_name);
        //alert(title_name);
      }


      // body...y_axis4week
    }


  
  function Chart(Xaxis,Yaxis,title_name){

  // alert(Yaxis);
  // alert(Xaxis);
  // alert(title_name);
  var lineDiv = document.getElementById('line-chart');
   
  var traceA = {
    x: Xaxis,
    y: Yaxis,
    type: 'scatter',
    
  };
   
  var data = [traceA];
   
  var layout = {
    title:title_name,
    
  };
  Plotly.plot( lineDiv, data, layout );
  }

  period.addEventListener('change', loadChart, false);
 
</script>

@endsection