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
            <li class="has-submenu"><a href="{{ URL::to('viewStationStatus') }}"><i class="ion-home"></i> <span
                        class="nav-label">DashBoard</span></a></li>
            <li class="has-submenu"><a href="#"><i class="ion-settings"></i> <span class="nav-label">Stations</span></a>
                <ul class="list-unstyled">
                    <li class=""><a href="{{ URL::to('addstation') }}">Add Station</a></li>
                    <li><a href="{{ URL::to('configurestation ') }}">Format Station</a></li>

                </ul>
            </li>
            <li class="has-submenu"><a href="{{ URL::to('livedata') }}"><i class="ion-radio-waves"></i> <span
                        class="nav-label">Live Data</span></a></li>

            {{-- <li class="has-submenu"><a href="{{ URL::to('users') }}"><i class="fa fa-list"></i> <span
                        class="nav-label">List of users</span></a></li> --}}



            <li class="has-submenu">
                <a href="{{ URL::to('data_list') }}"><i class="ion-ios7-upload"></i> <span class="nav-label">Import
                        data</span></a>
            </li>

            <li class="has-submenu">
                <a href="{{ URL::to('googlemaps') }}"><i class="ion-ios7-location"></i> <span class="nav-label">Google
                        Maps</span></a>
            </li>

            <li class="has-submenu">
                <a href="{{ URL::to('maillisttable') }}"><i class="ion-email"></i> <span class="nav-label">mail
                        list</span></a>
            </li>

            <li class="has-submenu">
                <a href="{{ URL::to('display_users') }}"><i class="ion-person"></i> <span class="nav-label">Manage
                        Users</span></a>
                <ul class="list-unstyled">
                    <li class=""><a href="{{ URL::to('display_users') }}">Users</a></li>
                    <li class=""><a href="{{ URL::to('manage') }}">Roles</a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="{{ URL::to('analyser') }}"><i class="ion-android-archive"></i> <span
                        class="nav-label">Problems
                        Archive</span></a>
            </li>
            </li>



            <li class="has-submenu">
                <a href="{{ URL::to('analytic') }}"><i class="ion-ios7-analytics"></i> <span
                        class="nav-label">Analytics</span></a>
            </li>
            <li class="has-submenu"><a href="#"><i class="ion-clipboard"></i> <span class="nav-label">Node
                        Data</span></a>
                <ul class="list-unstyled">
                    <li><a href="{{ URL::to('nodeData1') }}">Two Meter Data</a></li>
                    <li><a href="{{ URL::to('nodeData2') }}">Ten Meter Data</a></li>
                    <li><a href="{{ URL::to('nodeData3') }}">Ground Data</a></li>
                    <li><a href="{{ URL::to('nodeData4') }}">Observationslip Data</a></li>
                </ul>
            </li>

            <li class="has-submenu">
                <a href="{{ URL::to('logs') }}"><i class="ion-document-text"></i> <span
                        class="nav-label">Logs</span></a>
            </li>

            <li class="has-submenu"><a href="{{ URL::to('downloads') }}"><i class="ion-android-download"></i> <span
                        class="nav-label">Downloads</span></a></li>
        </ul>


    </nav>
</aside>
