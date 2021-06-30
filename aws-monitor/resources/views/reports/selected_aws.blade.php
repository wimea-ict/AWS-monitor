<!--page_specific_css_files  page_specific_script_files-->

@extends('main')


@section('page_specific_css_files')

@endsection

@section('content')

    <!-- Accordions -->
<div class="row">
        <div class="col-lg-12">
            <div class="panel-group" id="accordion-test-2">
               			<div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                            {{ " ".$stationTaken['Location']." Nodes performances each part of the day"}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne-2" class="panel-collapse collapse in">
                        <div class="panelbody">
                         <div id="tester" style="height:500px;"></div>
                        </div>
                    </div>
                </div>
    </div> <!-- End row -->
</div>
</div>



 <!-- SENSOR STATISTICS -->
 <div class="row"> 
        <div class="col-lg-12">
            <div class="panel-group" id="accordion-test-2">
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseOne-2" aria-expanded="false" class="collapsed">
                            {{ " Nodes' DownTime "}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapseOne-2" class="panel-collapse collapse in">
                        <div class="panelbody">
                         <div id="timeoff" style="height:500px;"></div>
                        </div>
                    </div>
                </div>
    </div> <!-- End row -->
</div>
</div>

 <?php
//=============================CALCULATING PACKET RECEPTION RATE============================================================
// //START
// //creating an array of the 4 Nodes
// 		 $Nodes=array('GroundNode','SinkNode','TwoMeterNode','TenMeterNode');
// 		 $array_of_min =array("1");
// //--------------------------GETTING THE NUMBER OF EXPECTED PACKECTS FROM ALL NODES----------------------------------------
// 		 foreach($Reporting_intervals as $interval){
// 			 for($i=0; $i<4; $i++){
// 				 if($interval['Node']==$Nodes[$i]){
// 					 $result=json_encode($interval['cluster']);
// 					 $inter=(($time_now*60))/((int)$result[3]);
// 					  array_push($array_of_min,$inter);
//             //echo "<br>";
// 				 }
// 			 }
// 		 }
//      //echo ($time_now);
// 	 $total_no_expected_in_24hrs= array_sum($array_of_min);
// //=========================TOTAL PACKETS ACTUALLY REPORTED=================================================
// 	$total_packets_recieved = $packets_recieved_GND + $packets_recieved_SNK+$packets_recieved_TWN+$packets_recieved_TWN;
// 	$packet_reception_rate= ($total_packets_recieved*100)/$total_no_expected_in_24hrs;
// //END OF CALCULATION
 ?>
<!-- 
    <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Statistics</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="datatable" class="table table-striped table-bordered">
 
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --> <!-- End Row -->


@endsection

@section('page_specific_script_files')

 <script src="assets/plotly/plotly-latest.min.js"></script> 
<script>
$(function() {
//====================================================================================================
TESTER = document.getElementById('tester');
//'yaxis4twoM','yaxis4tenM','yaxis4sink','yaxis4grd'
var ytwo =<?php echo json_encode($yaxis4twoM); ?>;
var yten =<?php echo json_encode($yaxis4tenM); ?>;
var ysink =<?php echo json_encode($yaxis4sink); ?>;
var ygrd =<?php echo json_encode($yaxis4grd); ?>;
// var grd_occr = [];
// var counts = [];
//'var4TwoM','var4TenM','ids','var4SinkN','var4GrdN
var ytwo_2 =<?php echo json_encode($var4TwoM); ?>;
var yten_2 =<?php echo json_encode($var4TenM); ?>;
var ysink_2 =<?php echo json_encode($var4SinkN); ?>;
var ygrd_2 =<?php echo json_encode($var4GrdN); ?>;


//____________________________________________________________________________________________________
	var trace1 = {
		  ////fill: 'tonexty',
  type: 'bar',
  x:  ['Morning(5am-11:59am)', 'Afternoon(12pm-4:59pm)', 'Evening(5pm-8:59pm)', 'Night(9pm-4:59am)'],
  y: ygrd, //These are the y values
  mode: 'none',
  name: 'GroundNode',
  marker: {color: 'rgb(139,69,19)'},
  line: {
  width: 2
  }
};
  var trace2 = {
      //fill: 'tonexty',
  type: 'bar',
  x:  ['Morning(5am-11:59am)', 'Afternoon(12pm-4:59pm)', 'Evening(5pm-8:59pm)', 'Night(9pm-4:59am)'],
  y: yten, //These are the y values
  mode: 'none',
  name: 'TenMeterNode',
  marker: {color: 'rgb(0,128,0)'},
  line: {
  width: 2
  }
};
  var trace3 = {
      //fill: 'tonexty',
  type: 'bar',
  
  x:  ['Morning(5am-11:59am)', 'Afternoon(12pm-4:59pm)', 'Evening(5pm-8:59pm)', 'Night(9pm-4:59am)'],
  y: ytwo, //These are the y values
  mode: 'none',
  name: 'TwoMeterNode',
  marker: {color: 'rgb(255, 64, 0)'},
  line: {
  width: 2
  }
};

  var trace4 = {
      //fill: 'tonexty',
  type: 'bar',
  x:  ['Morning(5am-11:59am)', 'Afternoon(12pm-4:59pm)', 'Evening(5pm-8:59pm)', 'Night(9pm-4:59am)'],
  y: ysink, //These are the y values
  mode: 'none',
  name: 'SinkNode',
  marker: {color: 'rgb(0,0,255)'},
  line: {
  width: 2
  }
};

var layout = {
  title: {
    text:'Frequency(DownTime) Vs parts of the day',
    font: {
      family: 'Courier New, monospace',
      size: 24
    },
    xref: 'paper',
    x: 0.05,
  },
  xaxis: {
    title: 'Part of Day',
    gridwidth: 2
     },
  yaxis: {
    title: 'Frequency (downtimes)',
    showline: true
  }

};
	var data = [trace1,trace2,trace3,trace4]
	Plotly.plot( TESTER, data,layout );


  //fixing STATISTICS=============================

var trace1 = {
  x: ['TwoMeterNode', 'TenMeterNode', 'SinkNode','GroundNode'],
  y: [ytwo_2, yten_2, ysink_2,ygrd_2],
  name: 'Nodes',
  type: 'bar'
};

// var trace2 = {
//   x: ['TwoMeterNode', 'TenMeterNode', 'SinkNode','GroundNode'],
//   y: [12, 18, 29,25],
//   name: 'LA Zoo',
//   type: 'bar'
// };

var data = [trace1];

var layout = {barmode: 'stack',
  title: {
    text:'DownTime Vs Node type',
    font: {
      family: 'Courier New, monospace',
      size: 24
    },
    xref: 'paper',
    x: 0.05,
  },
  xaxis: {
    title: 'Nodes',
    gridwidth: 2
     },
  yaxis: {
    title: 'DownTime (minutes)',
    showline: true
  }
};

Plotly.newPlot('timeoff', data, layout);



});








</script>

@endsection

