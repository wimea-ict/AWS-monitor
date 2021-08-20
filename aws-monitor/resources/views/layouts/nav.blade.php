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
            @can('dashboard')
                <li class="has-submenu"><a href="{{ URL::to('') }}"><i class="ion-home"></i> <span
                            class="nav-label">DashBoard</span></a></li>
            @endcan
            @can('google-maps')
                <li class="has-submenu"><a href="#"><i class="ion-settings"></i> <span class="nav-label">Stations</span></a>
                    <ul class="list-unstyled">
                        @can('stations.create')

                            <li class=""><a href="{{ URL::to('addstation') }}">Add Station</a></li>
                        @endcan
                        @can('stations.view')
                            <li><a href="{{ URL::to('configurestation ') }}">Format Station</a></li>
                        @endcan

                    </ul>
                </li>
                <li class="has-submenu"><a href="{{ URL::to('livedata') }}"><i class="ion-radio-waves"></i> <span
                            class="nav-label">Live Data</span></a></li>
            @endcan
            @can('google-maps')
                <li class="has-submenu">
                    <a href="{{ URL::to('data_list') }}"><i class="ion-ios7-upload"></i> <span class="nav-label">Import
                            Data</span></a>
                </li>
            @endcan
            @can('google-maps')
                <li class="has-submenu">
                    <a href="{{ URL::to('googlemaps') }}"><i class="ion-ios7-location"></i> <span class="nav-label">Google
                            Maps</span></a>
                </li>
            @endcan
            @can('maillist')
                <li class="has-submenu">
                    <a href="{{ URL::to('maillisttable') }}"><i class="ion-email"></i> <span class="nav-label">Mail
                            List</span></a>
                </li>
            @endcan
            @can('manage')
                <li class="has-submenu">
                    <a href="{{ URL::to('display_users') }}"><i class="ion-person"></i> <span class="nav-label">Manage
                            Users</span></a>
                    <ul class="list-unstyled">
                        @can('user.view')
                            <li class=""><a href="{{ URL::to('display_users') }}">Users</a></li>
                        @endcan
                        @can('role.view')
                            <li class=""><a href="{{ URL::to('manage') }}">Roles</a></li>
                        @endcan

                    </ul>
                </li>
            @endcan
            @can('problem-archive')
                <li class="has-submenu">
                    <a href="{{ URL::to('analyser') }}"><i class="ion-android-archive"></i> <span
                            class="nav-label">Problems
                            Archive</span></a>
                </li>
                </li>

            @endcan
            @can('analytics')

                <li class="has-submenu">
                    <a href="{{ URL::to('analytic') }}"><i class="ion-ios7-analytics"></i> <span
                            class="nav-label">Analytics</span></a>
                </li>
            @endcan
            @can('node-data')
                <li class="has-submenu"><a href="#"><i class="ion-clipboard"></i> <span class="nav-label">Node
                            Data</span></a>
                    <ul class="list-unstyled">
                        @can('two-meter')
                            <li><a href="{{ URL::to('nodeData1') }}">Two Meter Data</a></li>
                        @endcan
                        @can('ten-meter')
                            <li><a href="{{ URL::to('nodeData2') }}">Ten Meter Data</a></li>
                        @endcan
                        @can('ground-node')
                            <li><a href="{{ URL::to('nodeData3') }}">Ground Data</a></li>
                        @endcan
                        {{-- @can('logs') --}}
                        <li><a href="{{ URL::to('nodeData4') }}">Observationslip Data</a></li>
                        {{-- @endcan --}}
                    </ul>
                </li>
            @endcan
            @can('logs')
                <li class="has-submenu">
                    <a href="{{ URL::to('logs') }}"><i class="ion-document-text"></i> <span
                            class="nav-label">Logs</span></a>
                </li>
            @endcan
            @can('downloads')
                <li class="has-submenu"><a href="{{ URL::to('downloads') }}"><i class="ion-android-download"></i> <span
                            class="nav-label">Downloads</span></a></li>
            @endcan
        </ul>


    </nav>
</aside>
