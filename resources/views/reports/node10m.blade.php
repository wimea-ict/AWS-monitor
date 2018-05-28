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

                    <div id="vin_vmcu_10m" style="height: 300px;"  class="text-center"></div>

                </div>
            </div>
        </div> <!-- /Portlet -->
    </div> <!-- col -->

    <div class="col-sm-12">
        <div class="portlet"><!-- /primary heading -->
            <div class="portlet-heading">
                <h3 class="portlet-title text-dark">Line gragh  for Insulation sensor read against datetime</h3>
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

                    <div id="insulation_sensor" style="height: 300px;"  class="text-center"></div>

                </div>
            </div>
        </div> <!-- /Portlet -->
    </div> <!-- col -->


    <div class="col-sm-12">
        <div class="portlet"><!-- /primary heading -->
            <div class="portlet-heading">
                <h3 class="portlet-title text-dark">Gragh for wind direction readings </h3>
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

                    <div id="wind_direction_sensor" style="height: 300px;"  class="text-center"></div>

                </div>
            </div>
        </div> <!-- /Portlet -->
    </div> <!-- col -->

    <div class="col-sm-12">
        <div class="portlet"><!-- /primary heading -->
            <div class="portlet-heading">
                <h3 class="portlet-title text-dark">Gragh for wind speed readings</h3>
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

                    <div id="windspeed_sensor" style="height: 300px;"  class="text-center"></div>

                </div>
            </div>
        </div> <!-- /Portlet -->
    </div> <!-- col -->

</div>
@endsection

@section('page_specific_script_files')
    {{--  <script src="assets/morris/node10mcharts.js"></script>  --}}
    <script>

        $( "#station_id" ).change(function() {
              $("#report_form").submit()
        });


        $(function() {

          var vin_vmcu_10m="<?=$vin_vmcu_10m?>";

            if(vin_vmcu_10m==""){
              $("#vin_vmcu_10m").html("<h4>No V_IV or V_MCU data Found</h4>");

            }else{
              new Dygraph(document.getElementById("vin_vmcu_10m"),
                vin_vmcu_10m,
                {
                    labels: [ "x", "V_MCU", "V_IN" ]
                });
            }

            var insulation_sensor="<?=$insulation_sensor?>";

            if(insulation_sensor==""){
              $("#insulation_sensor").html("<h4>No Insulation Sensor data Found</h4>");

            }else{
              new Dygraph(document.getElementById("insulation_sensor"),
                insulation_sensor,
                {
                    labels: [ "x", "insulation"]
                });
            }


            var windspeed_sens="<?=$windspeed_sensor?>";
            if(windspeed_sens==""){
              $("#windspeed_sensor").html("<h4>No Windspeed Sensor data Found</h4>");

            }else{
              new Dygraph(document.getElementById("windspeed_sensor"),
              windspeed_sens,
              {
                  labels: [ "x", "windspeed"]
              });
            }

            var wind_direction="<?=$wind_direction_sensor?>";

            if(wind_direction==""){
              $("#wind_direction_sensor").html("<h4>No Wind Direction Sensor data Found</h4>");

            }else{
              new Dygraph(document.getElementById("wind_direction_sensor"),
              wind_direction,
              {
                  labels: [ "x", "wind_direction"]
              });
            }



              $('#station_id').find('option[selected="selected"]').each(function(){
                $(this).prop('selected', true);
            });
        });//end out function

    </script>
@endsection
