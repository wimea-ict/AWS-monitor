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

    $( "#station_id" ).change(function() {
          $("#report_form").submit()
    });

    $(function() {

          /*
            new Dygraph(document.getElementById("test"),
              "2009/07/12 12:34:56,100,200\n"+
              2009/08/12 13:30:20,150,201\n",
              { labels: [ "Date", "Series1", "Series2" ] });
          */



            new Dygraph(document.getElementById("vin_vmcu_sink"),
              "<?=$vin_vmcu_sink?>",
              {
                  labels: [ "x", "V_MCU", "V_IN" ]
              });


              new Dygraph(document.getElementById("pressure"),
              "<?=$pressure?>",
              {
                  labels: [ "x", "pressure" ]
              });

           $('#station_id').find('option[selected="selected"]').each(function(){
                $(this).prop('selected', true);
            });
        });//end out function
    </script>
@endsection
