<aside class="left-panel">

            <!-- brand -->
            <div class="logo">
                <a href="index.html" class="logo-expanded">

                    <span class="nav-label">AWS MONITOR</span>
                </a>
            </div>
            <!-- / brand -->

            <!-- Navbar Start -->
            <nav class="navigation">
                <ul class="list-unstyled">
                    <li class="has-submenu"><a href="<?php echo e(URL::to('viewStationStatus')); ?>"><i class="ion-home"></i> <span class="nav-label">DashBoard</span></a></li>
                    <li class="has-submenu"><a href="#"><i class="ion-android-settings"></i> <span class="nav-label">Station Configurations</span></a>
                        <ul class="list-unstyled">
                            <li class=""><a href="<?php echo e(URL::to('addstation')); ?>">Add Station</a></li>
                            <li><a href="<?php echo e(URL::to('configurestation ')); ?>">Configure Station</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu"><a href="#"><i class="ion-settings"></i> <span class="nav-label">Node Configurations</span></a>
                        <ul class="list-unstyled">
                            <!--<li><a href="<?php echo e(URL::to('addnode')); ?>">Add Node</a></li>-->

                            <li><a href="<?php echo e(URL::to('configure10mnode')); ?>">Configure 10m Node</a></li>
                            <li><a href="<?php echo e(URL::to('configure2mnode')); ?>">Configure 2m Node</a></li>
                            <li><a href="<?php echo e(URL::to('configuresinknode')); ?>">Configure sink Node</a></li>
                            <li><a href="<?php echo e(URL::to('configuregroundnode')); ?>">Configure Ground Node</a></li>

                        </ul>
                    </li>

                    <li class="has-submenu"><a href="<?php echo e(URL::to('editProblemConfigurations')); ?>"><i class="ion-clipboard"></i> <span class="nav-label">Report Configurations</span></a>
                    
                    </li>
                    
                    
                    
                    <li class="has-submenu"><a href="<?php echo e(URL::to('probTbData')); ?>"><i class="ion-alert-circled"></i> <span class="nav-label">Problems Identified</span></a></li>


                    <li class="has-submenu"><a href="<?php echo e(URL::to('general_reports')); ?>"><i class="ion-stats-bars"></i> <span class="nav-label">Reports</span></a>

                    </li>
                    




                </ul>
            </nav>

        </aside>
