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
            
                    <div id="vin_vmcu_gnd" style="height: 300px;"></div>
            
                </div>
            </div>
        </div> <!-- /Portlet -->
    </div> <!-- col -->

    <div class="col-sm-12">
        <div class="portlet"><!-- /primary heading -->             
            <div class="portlet-heading">
                <h3 class="portlet-title text-dark">Line gragh  for Precipitation read against datetime</h3>
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
            
                    <div id="precipitation" style="height: 300px;"></div>
            
                </div>
            </div>
        </div> <!-- /Portlet -->
    </div> <!-- col -->

   
    <div class="col-sm-12">
        <div class="portlet"><!-- /primary heading -->             
            <div class="portlet-heading">
                <h3 class="portlet-title text-dark">Gragh for Soil temperature readings </h3>
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
            
                    <div id="soil_templature" style="height: 300px;"></div>
            
                </div>
            </div>
        </div> <!-- /Portlet -->
    </div> <!-- col -->
  
    <div class="col-sm-12">
        <div class="portlet"><!-- /primary heading -->             
            <div class="portlet-heading">
                <h3 class="portlet-title text-dark">Gragh for Soil moisture sensor readings</h3>
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
            
                    <div id="soil_moisture" style="height: 300px;"></div>
            
                </div>
            </div>
        </div> <!-- /Portlet -->
    </div> <!-- col -->

</div>
@endsection

@section('page_specific_script_files')
    //<script src="assets/morris/nodegndcharts.js"></script>
    <script>
        $(function() {

            var vmcu_chart = Morris.Line({
            element: "vin_vmcu_gnd",
            data: <?=json_encode($vin_vmcu)?>,
            xkey: "y",
            ykeys: ["V_MCU", "V_IN"],
            labels: ["V_MCU", "V_IN"],
            parseTime: false,
            resize: true,
            lineColors: ["#3bc0c3", "#1a2942"]});

         //creating bar chart
         var precipitation = Morris.Line({
            element: "precipitation",
            data: <?=json_encode($precipitation)?>,
            xkey: "y",
            ykeys: ["Precipitation"],
            labels: ["Precipitation"],
            parseTime: false,
            resize: true,
            lineColors: ["#dcdcdc"]});

        
            var soil_templature = Morris.Line({
            element: "soil_templature",
            data: <?=json_encode($soil_templature)?>,
            xkey: "y",
            ykeys: ["soil_templature"],
            labels: ["soil_templature"],
            parseTime: false,
            resize: true,
            lineColors: ["#dcdcdc"]});
  
            var soil_moisture = Morris.Line({
            element: "soil_moisture",
            data: <?=json_encode($soil_moisture)?>,
            xkey: "y",
            ykeys: ["soil_moisture"],
            labels: ["soil_moisture"],
            parseTime: false,
            resize: true,
            lineColors: ["#dcdcdc"]});

           //var $precipitation = [{ y: "2009", a: 100, b: 90, c: 40 }, { y: "2010", a: 75, b: 65, c: 20 }, { y: "2011", a: 50, b: 40, c: 50 }, { y: "2012", a: 75, b: 65, c: 95 }, { y: "2013", a: 50, b: 40, c: 22 }, { y: "2014", a: 75, b: 65, c: 56 }, { y: "2015", a: 100, b: 90, c: 60 }];
           // this.createLineChart("precipitation", $precipitation, "y", ["a"], ["Precipitation"], ["#3bc0c3", "#1a2942", "#dcdcdc"]);


        });//end out function

    </script>
@endsection
