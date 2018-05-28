<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <?php echo $__env->make('layouts.links', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
       
</head>
<body>

        <!-- Aside Start-->
        <?php echo $__env->make('layouts.nav', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <!-- Aside Ends-->


        <!--Main Content Start -->
        <section class="content">
            
            <!-- Header -->
            <?php echo $__env->make('layouts.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- Header Ends -->


            <!-- Page Content Start -->
            <!-- ================== -->
     
            <div class="wraper container-fluid">
                

                <?php echo $__env->yieldContent('content'); ?>


            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            <?php echo $__env->make('layouts.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
        


        <!-- js placed at the end of the document so the pages load faster -->
        <?php echo $__env->make('layouts.scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        
    

    </body>
</html>