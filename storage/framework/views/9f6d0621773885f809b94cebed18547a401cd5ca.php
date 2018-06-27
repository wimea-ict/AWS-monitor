<?php $__env->startSection('content'); ?>
<div class="row">
                    <div class="col-md-2 col-md-offset-10 nopadding">
                        <div class="panel small">
                            
                            <div class="">
                                
                            
                                <div class="row icon-list ionicon-list">

                                    <div class="col-md-12 nopadding"><i class="ion-ios7-circle-filled" style="font-size:20px; color:#a94442"></i>Critical Issues
                                    </div>
            
                                    <div class="col-md-12 nopadding"><i class="ion-ios7-circle-filled" style="font-size:20px; color:#F7CA18"></i>Non Critical Issues
                                    </div>
                                    <div class="col-md-12 nopadding"><div>
                                    <i class="ion-ios7-circle-filled" style="font-size:20px; color:#2b542c"></i>No issues on Station
                                    </div>
                                    
                                    


                                </div> <!-- End row -->
                            </div> <!-- end panel-body -->
                        </div> <!-- Panel-default-->
                    </div> <!-- col-->
                </div>
              </div>

<div class="row" style= "margin-top:10px;">
<div class="row text-center">
                    <?php $__currentLoopData = $stations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $station): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php $counter=0 ?>
                    <?php $flag=0 ?>
                    <?php $__currentLoopData = $stations_with_problems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $problem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($problem['id']== $station['station_id']): ?>
                            <?php if($problem['category']=="Critical"): ?>
                            
                            <?php if($flag !=1): ?>
                            <?php $flag=1 ?>
                            <?php endif; ?>
                            <?php endif; ?>
                            <?php if($problem['category']=="Non Critical"): ?>
                                
                                <?php if($flag !=1): ?>
                                    <?php $flag=2 ?>
                                 <?php endif; ?>
                            <?php endif; ?>
                            <?php $counter++ ?>
                        <?php endif; ?>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-5 col-md-2">
                        <div class="panel" style="max-height:160px;">
                            <a href="<?php echo e(URL::to('selectedStationStatus/'.$station['station_id'])); ?>">
                            <div class="h4 text-purple"><?php echo e($station['StationName']); ?></div>
                            <span class="text-muted"><?php echo e($counter); ?></span>
                            <?php if($flag ==0): ?>
                            <div class="text-right">
                              <i class="ion-ios7-circle-filled" style="font-size:30px; color:#2b542c"></i>
                            </div>
                            <?php endif; ?>
                            <?php if($flag ==1): ?>
                            <div class="text-right">
                              <i class="ion-ios7-circle-filled" style="font-size:30px; color:#a94442"></i>
                            </div>
                            <?php endif; ?>
                            <?php if($flag==2): ?>
                            <div class="text-right">
                              <i class="ion-ios7-circle-filled" style="font-size:30px; color:#F7CA18"></i>
                            </div>
                            <?php endif; ?>
                            
                            </a>
                    </div>
                          
                    

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="row text-center">
                    <?php $__currentLoopData = $stationsOn; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $station): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <div class="col-sm-5 col-md-2">
                        <div class="panel" style="max-height:160px;">
                            <a href="<?php echo e(URL::to('selectedStationStatus/'.$station['station_id'])); ?>">
                            <div class="h4 text-purple"><?php echo e($station['StationName']); ?></div>
                            <span class="text-muted">0</span>
                           
                            <div class="text-right">
                              <i class="ion-ios7-circle-filled" style="font-size:30px; color:#2b542c"></i>
                            </div>
                            
                            
                            </a>
                    </div>
                          
                    

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                

               

               

               
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>