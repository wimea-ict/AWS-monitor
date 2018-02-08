<!DOCTYPE html>
<html>
<head>
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
                <div class="page-title"> 
                    <h3 class="title">Welcome to the AWS Monitor !</h3> 
                </div>

                @section('layouts.dynamiccontent')


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