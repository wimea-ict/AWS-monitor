<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    @include('layouts.links')
       
</head>
<body>

        <!-- Aside Start-->
        @include('layouts.nav')
        <!-- Aside Ends-->


        <!--Main Content Start -->
        <section class="content">
            
            <!-- Header -->
            @include('layouts.header')
            <!-- Header Ends -->


            <!-- Page Content Start -->
            <!-- ================== -->
     
            <div class="wraper container-fluid">
                

                @yield('content')


            </div>
            <!-- Page Content Ends -->
            <!-- ================== -->

            <!-- Footer Start -->
            @include('layouts.footer')
            <!-- Footer Ends -->



        </section>
        <!-- Main Content Ends -->
        


        <!-- js placed at the end of the document so the pages load faster -->
        @include('layouts.scripts')


        
    

    </body>
</html>