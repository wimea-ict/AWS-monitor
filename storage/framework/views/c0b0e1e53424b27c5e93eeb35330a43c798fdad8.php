        <script src="main.js"></script>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/modernizr.min.js"></script>
        <script src="js/pace.min.js"></script>
        <script src="js/wow.min.js"></script>
        <script src="js/jquery.scrollTo.min.js"></script>
        <script src="js/jquery.nicescroll.js" type="text/javascript"></script>
        <script src="assets/chat/moment-2.2.1.js"></script>

        <!-- Counter-up -->
        <script src="js/waypoints.min.js" type="text/javascript"></script>
        <script src="js/jquery.counterup.min.js" type="text/javascript"></script>

        <!-- EASY PIE CHART JS -->
        <script src="assets/easypie-chart/easypiechart.min.js"></script>
        <script src="assets/easypie-chart/jquery.easypiechart.min.js"></script>
        <script src="assets/easypie-chart/example.js"></script>


        <!--C3 Chart-->
        <script src="assets/c3-chart/d3.v3.min.js"></script>
        <script src="assets/c3-chart/c3.js"></script>

        <!--Morris Chart-->
        <script src="assets/morris/morris.min.js"></script>
        <script src="assets/morris/raphael.min.js"></script>

        <!-- sparkline --> 
        <script src="assets/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="assets/sparkline-chart/chart-sparkline.js" type="text/javascript"></script> 

        <!-- sweet alerts -->
        <script src="assets/sweet-alert/sweet-alert.min.js"></script>
        <script src="assets/sweet-alert/sweet-alert.init.js"></script>

        <script src="js/jquery.app.js"></script>
        <!-- Chat -->
        <script src="js/jquery.chat.js"></script>
        <!-- Dashboard -->
        <script src="js/jquery.dashboard.js"></script>

        <!-- Todo -->
        <script src="js/jquery.todo.js"></script>

        <!--Form Wizard-->
        <script src="assets/form-wizard/jquery.steps.min.js" type="text/javascript"></script>
        <script type="text/javascript" src="assets/jquery.validate/jquery.validate.min.js"></script>

        <!--wizard initialization-->
        <script src="assets/form-wizard/wizard-init.js" type="text/javascript"></script>

         <script src="assets/timepicker/bootstrap-datepicker.js"></script>

        <script src="assets/datatables/jquery.dataTables.min.js"></script>
        <script src="assets/datatables/dataTables.bootstrap.js"></script>

         <!-- Modal-Effect -->
         <script src="assets/modal-effect/js/classie.js"></script>
        <script src="assets/modal-effect/js/modalEffects.js"></script>



        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
            } );
            
            

            $('#full-width-modal').on('show.bs.modal', function(e) {
                var station = e.relatedTarget.id;
                var obj = jQuery.parseJSON(station);
                //$('#wizard-validation-form').attr('action', "/updatestation");
                $('#station_number').val(obj["station_id"]);
                $('#station_name').val(obj["station_name"]);
                $('#snumber').val(obj["station_number"]);
                $('#slocation').val(obj["station_location"]);
                $('#latitude').val(obj["latitude"]);
                $('#longitude').val(obj["longitude"]);
                $('#city').val(obj["city"]);
                $('#code').val(obj["code"]);
                $('#region').val(obj["region"]);
                $('#date_opened').val(obj["date_opened"]);
                $('#date_closed').val(obj["date_closed"]);
                $('#station_type').val(obj["station_type"]);

                
            });
            $('#full-width-modal2').on('show.bs.modal', function(e) {
                var tenMeterNode = e.relatedTarget.id;
                var obj = jQuery.parseJSON(tenMeterNode);
                
                //$('#wizard-validation-form').attr('action', "/updatestation");
                $('#10txt_key').val(obj["txt_10m"]);
                $('#10vin_label').val(obj["v_in_10m"]);
                $('#10mac_add').val(obj["e64_10m"]);
                $('#10v_in_min_value').val(obj["v_in_min_value"]);
                $('#10v_in_max_value').val(obj["v_in_max_value"]);
                $('#10v_mcu_label').val(obj["v_mcu_10m"]);
                $('#10gwlat').val(obj["gw_lat_10m"]);
                $('#10gwlong').val(obj["gw_long_10m"]);
                $('#10v_mcu_max_value').val(obj["v_mcu_max_value"]);
                $('#10v_mcu_min_value').val(obj["v_mcu_min_value"]);
                $('#10rssi').val(obj["rssi_10m"]);
                $('#10lqi').val(obj["lqi_10m"]);
                $('#10drp').val(obj["drp_10m"]);
                $('#10ps').val(obj["ps_10m"]);
                $('#10ut').val(obj["ut_10m"]);
                $('#10ttl').val(obj["ttl_10m"]);
                $('#10date').val(obj["date_10m"]);
                $('#10time').val(obj["time_10m"]);
                $('#10txt_value').val(obj["txt_value_10m"]);
                $('#10parameter_read').val(obj["txt_value_10m"]);
                $('#10identifier_used').val(obj["v_a1_10m"]);
                $('#10max_value').val(obj["txt_value_10m"]);
                $('#10min_value').val(obj["txt_value_10m"]);
                $('#wsparameter_read').val(obj["txt_value_10m"]);
                $('#wsidentifier_used').val(obj["v_a2_10m"]);
                $('#wsmax_value').val(obj["txt_value_10m"]);
                $('#wsmin_value').val(obj["txt_value_10m"]);
                $('#wdparameter_read').val(obj["txt_value_10m"]);
                $('#wdidentifier_used').val(obj["v_a3_10m"]);
                $('#wdmax_value').val(obj["txt_value_10m"]);
                $('#wdmin_value').val(obj["txt_value_10m"]);
            
            });

            $('#full-width-modal3').on('show.bs.modal', function(e) {
                var twoMeterNode = e.relatedTarget.id;
                var obj = jQuery.parseJSON(twoMeterNode);
                
                //$('#wizard-validation-form').attr('action', "/updatestation");
                $('#2txt_key').val(obj["txt_2m"]);
                $('#2mvin_label').val(obj["v_in_2m"]);
                $('#2mac_add').val(obj["e64_2m"]);
                $('#2mv_in_min_value').val(obj["v_in_min_value"]);
                $('#2mv_in_max_value').val(obj["v_in_max_value"]);
                $('#2mv_mcu_label').val(obj["v_mcu_2m"]);
                $('#2gwlat').val(obj["gw_lat_2m"]);
                $('#2gwlong').val(obj["gw_long_2m"]);
                $('#2mv_mcu_max_value').val(obj["v_mcu_max_value"]);
                $('#2mv_mcu_min_value').val(obj["v_mcu_min_value"]);
                $('#2rssi').val(obj["rssi_2m"]);
                $('#2lqi').val(obj["lqi_2m"]);
                $('#2drp').val(obj["drp_2m"]);
                $('#2ps').val(obj["ps_2m"]);
                $('#2ut').val(obj["ut_2m"]);
                $('#2ttl').val(obj["ttl_2m"]);
                $('#2date').val(obj["date_2m"]);
                $('#2time').val(obj["time_2m"]);
                $('#2txt_value').val(obj["txt_value_2m"]);
                $('#rhparameter_read').val(obj["txt_value_2m"]);
                $('#rhidentifier_used').val(obj["rh_sh2x_2m"]);
                $('#rhmax_value').val(obj["txt_value_2m"]);
                $('#rhmin_value').val(obj["txt_value_2m"]);
                $('#tsparameter_read').val(obj["txt_value_2m"]);
                $('#tsidentifier_used').val(obj["t_sht2x_2m"]);
                $('#tsmax_value').val(obj["txt_value_2m"]);
                $('#tsmin_value').val(obj["txt_value_2m"]);
            
            });
            
            $('#full-width-modal4').on('show.bs.modal', function(e) {
                var groundNode = e.relatedTarget.id;
                var obj = jQuery.parseJSON(groundNode);
                
                $('#gndtxt_key').val(obj["txt_gnd"]);
                $('#gndvin_label').val(obj["v_in_gnd"]);
                $('#gndmac_add').val(obj["e64_gnd"]);
                $('#gndv_in_min_value').val(obj["v_in_min_value"]);
                $('#gdv_in_max_value').val(obj["v_in_max_value"]);
                $('#gdv_mcu_label').val(obj["v_mcu_gnd"]);
                $('#gndgwlat').val(obj["gw_lat_gnd"]);
                $('#gndgwlong').val(obj["gw_long_gnd"]);
                $('#gdv_mcu_max_value').val(obj["v_mcu_max_value"]);
                $('#gdv_mcu_min_value').val(obj["v_mcu_min_value"]);
                $('#gndrssi').val(obj["rssi_gnd"]);
                $('#gndlqi').val(obj["lqi_gnd"]);
                $('#gnddrp').val(obj["drp_gnd"]);
                $('#gndps').val(obj["ps_gnd"]);
                $('#gndut').val(obj["ut_gnd"]);
                $('#gndttl').val(obj["ttl_gnd"]);
                $('#gnddate').val(obj["date_gnd"]);
                $('#grndtime').val(obj["time_gnd"]);
                $('#groundps').val(obj["ps_gnd"]);
                $('#groundpo').val(obj["po_lst60_gnd"]);
                $('#groundup').val(obj["up_gnd"]);
                $('#groundrain_pulses').val(obj["ps_gnd"]);
                $('#gndtxt_value').val(obj["txt_value_gnd"]);
                $('#ppparameter_read').val(obj["txt_value_gnd"]);
                $('#ppidentifier_used').val(obj["po_lst60_gnd"]);
                $('#ppmax_value').val(obj["txt_value_gnd"]);
                $('#ppmin_value').val(obj["txt_value_gnd"]);
                $('#stparameter_read').val(obj["txt_value_gnd"]);
                $('#stidentifier_used').val(obj["v_a1_gnd"]);
                $('#stmax_value').val(obj["txt_value_gnd"]);
                $('#stmin_value').val(obj["txt_value_gnd"]);
                $('#smparameter_read').val(obj["txt_value_gnd"]);
                $('#smidentifier_used').val(obj["v_a2_gnd"]);
                $('#smmax_value').val(obj["txt_value_gnd"]);
                $('#smmin_value').val(obj["txt_value_gnd"]);
            
            });

            $('#full-width-modal5').on('show.bs.modal', function(e) {
                var sinkNode = e.relatedTarget.id;
                var obj = jQuery.parseJSON(sinkNode);
                
                $('#sinktxt_key').val(obj["txt_sink"]);
                $('#sinkvin_label').val(obj["v_in_sink"]);
                $('#sinkmac_add').val(obj["e64_sink"]);
                $('#sinkv_in_min_value').val(obj["v_in_min_value"]);
                $('#sinkv_in_max_value').val(obj["v_in_max_value"]);
                $('#sinkv_mcu_label').val(obj["v_mcu_sink"]);
                $('#sinkgwlat').val(obj["gw_lat_sink"]);
                $('#sinkgwlong').val(obj["gw_long_sink"]);
                $('#sinkv_mcu_max_value').val(obj["v_mcu_max_value"]);
                $('#sinkv_mcu_min_value').val(obj["v_mcu_min_value"]);
                $('#sinkrssi').val(obj["rssi_sink"]);
                $('#sinklqi').val(obj["lqi_sink"]);
                $('#sinkdrp').val(obj["drp_sink"]);
                $('#sinkps').val(obj["ps_sink"]);
                $('#sinkut').val(obj["ut_sink"]);
                $('#sinkttl').val(obj["ttl_sink"]);
                $('#sinkdate').val(obj["date_sink"]);
                $('#sinktime').val(obj["time_sink"]);
                $('#sinkps').val(obj["ps_sink"]);
                $('#sinkup').val(obj["up_sink"]);
                $('#sinktxt_value').val(obj["txt_value_sink"]);
                $('#psparameter_read').val(obj["txt_value_sink"]);
                $('#psidentifier_used').val(obj["p_ms5611_sink"]);
                $('#psmax_value').val(obj["txt_value_sink"]);
                $('#psmin_value').val(obj["txt_value_sink"]);
                
            });

            
        </script>