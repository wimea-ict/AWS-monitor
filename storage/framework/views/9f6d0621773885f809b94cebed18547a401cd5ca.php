<?php $__env->startSection('content'); ?>
                <div class=""> 
                    <h3 class="title">Automatic weather Station Statuses</h3> 
                </div>

               

                    
                <div class="row text-center">
                    <?php $__currentLoopData = $stations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $station): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    
                    <?php $counter=0 ?>
                    <?php $flag=0 ?>
                    <?php $__currentLoopData = $stations_with_problems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $problem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($problem['id']== $station['station_id']): ?>
                            <?php if($problem['category']=="critical"): ?>
                            <?php $flag=1 ?>
                            <?php endif; ?>
                            <?php if($problem['category']=="non-critical"): ?>
                                <?php print $flag=2 ?>
                            <?php endif; ?>
                            <?php print $counter++ ?>
                        <?php endif; ?>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-sm-5 col-md-2">
                        <div class="panel">
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
                              <i class="ion-ios7-circle-filled" style="font-size:30px; color:#8a6d3b"></i>
                            </div>
                            <?php endif; ?>
                            
                            </a>
                    </div>
                          
                    

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                

               

<?php $__env->stopSection(); ?>
<?php echo $__env->make('main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>