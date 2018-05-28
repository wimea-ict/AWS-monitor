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

                    <div id="vin_vmcu_gnd" style="height: 300px;"  class="text-center"></div>

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

                    <div id="precipitation" style="height: 300px;"  class="text-center"></div>

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

                    <div id="soil_templature" style="height: 300px;"  class="text-center"></div>

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

                    <div id="soil_moisture" style="height: 300px;"  class="text-center"></div>

                </div>
            </div>
        </div> <!-- /Portlet -->
    </div> <!-- col -->

</div>
@endsection

@section('page_specific_script_files')
    //<script src="assets/morris/nodegndcharts.js"></script>
    <script>

    $( "#station_id" ).change(function() {
          $("#report_form").submit()
    });

        $(function() {

          var vin_vmcu="<?=$vin_vmcu?>";
            if(vin_vmcu==""){
                $("#vin_vmcu_gnd").html("<h4>No V_IN or V_MCU data Found</h4>");

            }else{
              new Dygraph(document.getElementById("vin_vmcu_gnd"),
                vin_vmcu,
                {
                    labels: [ "x", "V_MCU", "V_IN" ]
                });
            }

            var precipitation="<?=$precipitation?>";
            if(precipitation==""){
              $("#precipitation").html("<h4>No Precipitation data Found</h4>");

            }else{
              new Dygraph(document.getElementById("precipitation"),
              precipitation,
              {
                  labels: [ "x", "Precipitation"]
              });
            }

            var soil_templature="<?=$soil_templature?>";

              if(soil_templature==""){
                $("#soil_templature").html("<h4>No Soil Templature data Found</h4>");

              }else{
                new Dygraph(document.getElementById("soil_templature"),
                soil_templature,
                {
                    labels: [ "x", "soil_templature"]
                });
              }

              var soil_moisture="<?=$soil_moisture?>";
              if(soil_moisture==""){

                $("#soil_moisture").html("<h4>No Soil Moisture data Found</h4>");

              }else{
                  new Dygraph(document.getElementById("soil_moisture"),
                  soil_moisture,
                  {
                      labels: [ "x", "soil_moisture"]
                  });
              }


            $('#station_id').find('option[selected="selected"]').each(function(){
                $(this).prop('selected', true);
            });

        });//end out function

    </script>
@endsection
