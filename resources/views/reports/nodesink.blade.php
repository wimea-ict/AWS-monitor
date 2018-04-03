<!--page_specific_css_files  page_specific_script_files-->

@extends('main')


@section('page_specific_css_files')
   
@endsection

@section('content')
<div class="row">
    
    @include("reports.select_station_section")

    <div class="col-sm-12">
        
        <div class="portlet"><!-- /primary heading -->             
            <div class="portlet-heading">
                <h3 class="portlet-title text-dark">Line gragh  for V_IN and V_MCU against datetime </h3>
                <div class="portlet-widgets">
                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                    <span class="divider"></span>
                    <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default"><i class="ion-minus-round"></i></a>
                    <span class="divider"></span>
                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="bg-default" class="panel-collapse collapse in">
                <div class="portlet-body">
            
                    <div id="vin_vmcu_sink" style="height: 300px;"></div>
            
                </div>
            </div>
        </div> <!-- /Portlet -->
    </div> <!-- col -->

    <div class="col-sm-12">
        <div class="portlet"><!-- /primary heading -->             
            <div class="portlet-heading">
                <h3 class="portlet-title text-dark">Line gragh  for Pressure sensor read against datetime</h3>
                <div class="portlet-widgets">
                    <a href="javascript:;" data-toggle="reload"><i class="ion-refresh"></i></a>
                    <span class="divider"></span>
                    <a data-toggle="collapse" data-parent="#accordion1" href="#bg-default"><i class="ion-minus-round"></i></a>
                    <span class="divider"></span>
                    <a href="#" data-toggle="remove"><i class="ion-close-round"></i></a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div id="bg-default" class="panel-collapse collapse in">
                <div class="portlet-body">
            
                    <div id="pressure" style="height: 300px;"></div>
            
                </div>
            </div>
        </div> <!-- /Portlet -->
    </div> <!-- col -->

   
    

</div>
@endsection

@section('page_specific_script_files')
    {{--  <script src="assets/morris/nodesinkcharts.js"></script>  --}}
    <script>
        $(function() {

            var vin_vmcu_sink1 = Morris.Line({
            element: "vin_vmcu_sink",
            data: <?=json_encode($vin_vmcu_sink)?>,
            xkey: "y",
            ykeys: ["V_MCU", "V_IN"],
            labels: ["V_MCU", "V_IN"],
            parseTime: false,
            resize: true,
            lineColors: ["#3bc0c3", "#1a2942"]});

         //creating bar chart
         var pressure1 = Morris.Line({
            element: "pressure",
            data: <?=json_encode($pressure)?>,
            xkey: "y",
            ykeys: ["pressure"],
            labels: ["pressure"],
            parseTime: false,
            resize: true,
            lineColors: ["#dcdcdc"]});

        
        });//end out function
    </script>
@endsection
