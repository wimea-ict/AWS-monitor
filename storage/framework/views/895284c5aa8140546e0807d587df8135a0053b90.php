<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading">
                    <h3 class="panel-title"><?php echo e($heading); ?></h3>
        </div>
        <div class="panel-body">
        <form action="<?php echo e($action); ?>" method="POST">
           <?php echo e(csrf_field()); ?>

            <div class="form-group col-md-5 nopadding">
                
                <select class="form-control" name="id" id="station_id">
                    <option>--select station--</option>
                    <?php $__currentLoopData = $stations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $station): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($station->station_id); ?>"><?php echo e($station->StationName); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-3">
                
                <input type="submit" class="btn btn-primary" value="Choose" />
            </div>

        </form>
        </div>
    </div><!--End panel-->
</div>