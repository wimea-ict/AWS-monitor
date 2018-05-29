<!--page_specific_css_files  page_specific_script_files-->




<?php $__env->startSection('page_specific_css_files'); ?>
   
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    
    <?php echo $__env->make("reports.select_station_section", array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page_specific_script_files'); ?>
    
    <script>
        $(function() {

            new Dygraph(document.getElementById("vin_vmcu_sink"),
              <?=json_encode($vin_vmcu_sink)?>,
              {
                  labels: [ "x", "V_MCU", "V_IN" ]
              });

              new Dygraph(document.getElementById("pressure"),
              <?=json_encode($pressure)?>,
              {
                  labels: [ "x", "pressure" ]
              });
           
        });//end out function
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>