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
            
                    <div id="vin_vmcu_2m" style="height: 300px;"></div>
                    
                </div>
                
            </div>
        </div> <!-- /Portlet -->
    </div> <!-- col -->

    

    <div class="col-sm-12">
        <div class="portlet"><!-- /primary heading -->             
            <div class="portlet-heading">
                <h3 class="portlet-title text-dark">Line gragh Relative humidity sensor read against datetime</h3>
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
            
                    <div id="humidity" style="height: 300px;"></div>
            
                </div>
            </div>
        </div> <!-- /Portlet -->
    </div> <!-- col -->

   
    <div class="col-sm-12">
        <div class="portlet"><!-- /primary heading -->             
            <div class="portlet-heading">
                <h3 class="portlet-title text-dark">Gragh for Temperature Sensor readings </h3>
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
            
                    <div id="templature" style="height: 300px;"></div>
            
                </div>
            </div>
        </div> <!-- /Portlet -->
    </div> <!-- col -->

    

</div>
@endsection

@section('page_specific_script_files')
    {{--  <script src="assets/morris/node2mcharts.js"></script>  --}}
    <script>

        $(function() {

             new Dygraph(document.getElementById("vin_vmcu_2m"),
              <?=json_encode($vin_vmcu_2m)?>,
              {
                  labels: [ "x", "V_MCU", "V_IN" ]
              });

              new Dygraph(document.getElementById("humidity"),
              <?=json_encode($humidity)?>,
              {
                  labels: [ "x", "humidity"]
              });

              new Dygraph(document.getElementById("templature"),
              <?=json_encode($templature)?>,
              {
                  labels: [ "x", "templature"]
              });

             $('#station_id').find('option[selected="selected"]').each(function(){
                $(this).prop('selected', true);
            });
            
        });//end out function
    </script>
@endsection
