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

@if (Auth::user()->station == NULL)
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
@else
<button type="button"><a class=".btn-primary " href="{{URL::to('selected_aws/'.Auth::user()->station) }}"> View Statistics
 
  </button>
@endif


<head>
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
</head>
<!-- <div class="panel panel-default">
 -->
@if (Auth::user()->station == NULL)

<!-- AWS STATISTICS -->
 <div class="row"> 
        <div class="col-lg-12">
            <div class="panel-group" id="accordion-test-2">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                            {{ " AWSs performances (Availabilty) "}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne-2" class="panel-collapse collapse in">
                        <div class="panelbody">
                         <div id="aws" style="height:500px;"></div>
                        </div>
                    </div>
                </div>
    </div> <!-- End row -->
</div>
</div>
@endif



 <!-- SENSOR STATISTICS -->
 <div class="row"> 
        <div class="col-lg-12">
            <div class="panel-group" id="accordion-test-2">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                            {{ " Sensor performances "}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne-2" class="panel-collapse collapse in">
                        <div class="panelbody">
                         <div id="sensor" style="height:500px;"></div>
                        </div>
                    </div>
                </div>
    </div> <!-- End row -->
</div>
</div>

 <div class="row"> 
        <div class="col-lg-12">
            <div class="panel-group" id="accordion-test-2">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                            {{ "AWSs problems"}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne-2" class="panel-collapse collapse in">
                        <div class="panelbody">
                         <div id="nodes" style="height:500px;"></div>
                        </div>
                    </div>
                </div>
    </div> <!-- End row -->
</div>
</div>


<!-- <div id="myDiv"></div>
 --><!-- </div>   -->
@endsection
@section('page_specific_script_files')

<script>

var stns =<?php echo json_encode($x_axix); ?>;
var xVal =<?php echo json_encode($xValues); ?>;

var xns =<?php echo json_encode($y4Sensor); ?>;

var occurences =<?php echo json_encode($x4Sensor); ?>;
//x4Sensor
//x_awsProblems
var x_awsProblms =<?php echo json_encode($x_awsProblems); ?>;
//y_AwsPrbmOccurence
var y_awsProblms =<?php echo json_encode($y_AwsPrbmOccurence); ?>;

  //AWS STATISTICS=============================
@if (Auth::user()->station == NULL)
var trace1 = {
  x: stns,
  y: xVal,
  name: 'SF Zoo',
  type: 'bar'
};


var data = [trace1];

var layout = {barmode: 'stack',
  title: {
    text:'Station\'s DownTime vs Station',
    font: {
      family: 'Courier New, monospace',
      size: 24
    },
    xref: 'paper',
    x: 0.05,
  },
  xaxis: {
    title: 'Stations',
    gridwidth: 2
     },
  yaxis: {
    title: 'DownTimes (Hrs)',
    showline: true
  }


};

Plotly.newPlot('aws', data, layout);
@endif
  //SENSOR STATISTICS=============================

var trace1 = {
  x: xns,
  y: occurences,
  name: 'SF Zoo',
  type: 'bar'
};



var data = [trace1];

var layout = {barmode: 'stack',
  title: {
    text:'Number of issues Vs type of Sensor',
    font: {
      family: 'Courier New, monospace',
      size: 24
    },
    xref: 'paper',
    x: 0.05,
  },

  xaxis: {
    title: 'Sensors',
    gridwidth: 2
     },
  yaxis: {
    title: 'Frequency',
    showline: true
  }

};

Plotly.newPlot('sensor', data, layout);


  //===========================PROBLEM STATISTICS=============================

var data = [{
  type: "pie",
  values: y_awsProblms,
  labels: x_awsProblms,
 // textinfo: "label+percent",
  textposition: "inside",
  automargin: true
}]

var layout = {

    title: {
    text:'Apie chart showing problems facing AWSs',
    font: {
      family: 'Courier New, monospace',
      size: 24
    },
    xref: 'paper',
    x: 0.05,
  }

  // height: 400,
  // width: 400,
  // margin: {"t": 0, "b": 0, "l": 0, "r": 0},
  // showlegend: false
  };

Plotly.newPlot('nodes', data, layout)

 
</script>

@endsection