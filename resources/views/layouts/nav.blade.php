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
                    <li class="has-submenu"><a href="{{URL::to('viewStationStatus')}}"><i class="ion-home"></i> <span class="nav-label">DashBoard</span></a></li>
                    <li class="has-submenu"><a href="#"><i class="ion-android-settings"></i> <span class="nav-label">Stations Configurations</span></a>
                        <ul class="list-unstyled">
                            <li class=""><a href="{{URL::to('addstation')}}">Add Station</a></li>
                            <li><a href="{{URL::to('configurestation ')}}">Configure Station</a></li>
                        </ul>
                    </li>
                    <li class="has-submenu"><a href="#"><i class="ion-settings"></i> <span class="nav-label">Node Configurations</span></a>
                        <ul class="list-unstyled">
                            <!--<li><a href="{{URL::to('addnode')}}">Add Node</a></li>-->

                            <li><a href="{{URL::to('configure10mnode')}}">Configure 10m Node</a></li>
                            <li><a href="{{URL::to('configure2mnode')}}">Configure 2m Node</a></li>
                            <li><a href="{{URL::to('configuresinknode')}}">Configure sink Node</a></li>
                            <li><a href="{{URL::to('configuregroundnode')}}">Configure Ground Node</a></li>

                        </ul>
                    </li>

                    <li class="has-submenu"><a href="#"><i class="ion-ios7-settings-strong"></i> <span class="nav-label">Configure problems</span></a>
                        <ul class="list-unstyled">
                            <!--<li><a href="{{URL::to('addnode')}}">Add Node</a></li>-->
                            {{-- <li><a href="{{URL::to('configureproblem')}}">Configure problems</a></li> --}}
                            <li><a href="{{URL::to('editProblemConfigurations')}}">Edit configurations</a></li>

                        </ul>
                    </li>
                    {{-- {{URL::to('viewStationStatus')}} --}}
                    
                    
                    <li class="has-submenu"><a href="{{ URL::to('probTbData') }}"><i class="ion-alert-circled"></i> <span class="nav-label">Problems Identified</span></a></li>


                    <li class="has-submenu"><a href="{{URL::to('general_reports')}}"><i class="ion-stats-bars"></i> <span class="nav-label">Reports</span></a>

                    </li>
                    




                </ul>
            </nav>

        </aside>
