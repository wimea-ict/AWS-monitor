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
                    <li class="has-submenu"><a href="#"><i class="ion-home"></i> <span class="nav-label">Stations</span></a>
                        <ul class="list-unstyled">
                            <li class=""><a href="<?php echo e(URL::to('addstation')); ?>">Add Station</a></li>
                            <li><a href="<?php echo e(URL::to('configurestation ')); ?>">Configure Station</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu"><a href="#"><i class="ion-flask"></i> <span class="nav-label">Node Configurations</span></a>
                        <ul class="list-unstyled">
                            <!--<li><a href="<?php echo e(URL::to('addnode')); ?>">Add Node</a></li>-->

                            <li><a href="<?php echo e(URL::to('configure10mnode')); ?>">Configure 10m Node</a></li>
                            <li><a href="<?php echo e(URL::to('configure2mnode')); ?>">Configure 2m Node</a></li>
                            <li><a href="<?php echo e(URL::to('configuresinknode')); ?>">Configure sink Node</a></li>
                            <li><a href="<?php echo e(URL::to('configuregroundnode')); ?>">Configure Ground Node</a></li>

                        </ul>
                    </li>

                    <li class="has-submenu"><a href="#"><i class="ion-close"></i> <span class="nav-label">Configure problems</span></a>
                        <ul class="list-unstyled">
                            <!--<li><a href="<?php echo e(URL::to('addnode')); ?>">Add Node</a></li>-->
                            <li><a href="<?php echo e(URL::to('configureproblem')); ?>">Configure problems</a></li>
                            <li><a href="<?php echo e(URL::to('editProblemConfigurations')); ?>">Edit configurations</a></li>

                        </ul>
                    </li>
                    
                    <li class="has-submenu"><a href="<?php echo e(URL::to('viewStationStatus')); ?>"><i class="ion-calendar"></i> <span class="nav-label">Station Status</span></a></li>
                    <li class="has-submenu"><a href="<?php echo e(route('register')); ?>"><i class="ion-calendar"></i> <span class="nav-label">Register Users</span></a></li>
                    <li class="has-submenu"><a href="<?php echo e(URL::to('probTbData')); ?>"><i class="ion-close"></i> <span class="nav-label">Problems Identified</span></a></li>


                    <li class="has-submenu"><a href="#"><i class="ion-flask"></i> <span class="nav-label">Reports</span></a>
                        <ul class="list-unstyled">
                            <li><a href="<?php echo e(URL::to('general_reports')); ?>">General Station Reports</a></li>
                            <!-- <li><a href="<?php echo e(URL::to('node10m_report')); ?>">10m Node</a></li>
                            <li><a href="<?php echo e(URL::to('node2m_report')); ?>">2m Node</a></li>
                            <li><a href="<?php echo e(URL::to('nodegnd_report')); ?>">Ground Node</a></li>
                            <li><a href="<?php echo e(URL::to('nodesink_report')); ?>">Sink Node</a></li> -->

                        </ul>
                    </li>




                </ul>
            </nav>

        </aside>
