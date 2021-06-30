@extends('main')

@section('content')

<div class="row">
    <div class="tile">

<span class="mr-2" style="font-size: 20px;">
           <b> Symbol Key: </b>
        </span>
    <!--labelling to indicate when the station is operating well and when it having issues -->
        <span class="mr-2" style="font-size: 20px;">
            <i class="ion-ios7-circle-filled" style="color:#c92926"></i> Station off
            <!-- a94442 old red -->
        </span>
        <span class="mr-2" style="font-size: 20px;">
            <i class="ion-ios7-circle-filled" style="color:#008000"></i> Station fully operational
            <!-- #2b542c old green -->
        </span>
            <span class="mr-2" style="font-size: 20px;">
            <i class="ion-ios7-circle-filled" style="color:#FFA500"></i> Station Partially operational
        </span>
    </div>
</div>

<div class="row grid status-grid" style= "margin-top:10px;margin-bottom: 15px;">

	<!-----------------------pushing ids from arrays passed from the controller ---------------------------------------->
     <?php
     //======================================== ARRAY OF STATIONS WITH PROBLEMS=============================================
          $station_ids = array();
    			//$probms = array();
    			

                foreach($problems_identified as $s){
                  //since we have problems with the isolation sensor let it not be a big problem to cause a station be orange.
                  if($s['Value']!='Isolation'){
                  array_push($station_ids, $s['stationID']);

                  }


                    }

                $stoff_ids =array();
                foreach ($stations_off as $stf) {
                	  array_push($stoff_ids,$stf['stationID']);
                	# code...
                }
               $report_status = array();//report staus array
               $report_status=""; 
      ?>


    @foreach($stations as $station)

<!--getting lastcommunication from any of the nodes-->
        <?php
$lastcom="";
$date="";
$time="";
$date_time="";
       foreach($TwoM[$station['station_id']] as $tw){
                              //echo($TwoM[0]);
          if($tw['stationID']==$station['station_id']){
             $date = $tw['DATE'];
             $time = $tw['TIME'];
             $date_time = $date.' '.$time;
                               break;                 
                                   }
        }
		$date_tenm = "";
		$time_tenm = "";
		$date_time_tenm = "";
         foreach($TenM[$station['station_id']] as $tn){
                                    if($tn['stationID']==$station['station_id']){
                                     $date_tenm = $tn['DATE'];
             $time_tenm = $tn['TIME'];
             $date_time_tenm = $date_tenm.' '.$time_tenm;
                   break;                 
                                   }                 
                              }        
        $date_sinkn = "";
        $time_sinkn = "";
        $date_time_sinkn = "";

         foreach($SinkN[$station['station_id']] as $sk){
               if($sk['stationID']==$station['station_id']){
                    $date_sinkn = $sk['DATE'];
               $time_sinkn = $sk['TIME'];
               $date_time_sinkn = $date_sinkn.' '.$time_sinkn;
               break;                 
                                   }                 
                              }
               $date_grdn = "";
               $time_grdn = "";
               $date_time_grdn = "";
         
        foreach($GroundN[$station['station_id']] as $gd){
                                   if($gd['stationID']==$station['station_id']){
               $date_grdn = $gd['DATE'];
               $time_grdn = $gd['TIME'];
               $date_time_grdn = $date_grdn.' '.$time_grdn;
                                       break;                 
                                   }                 
                              }

$maxtime=max((int)strtotime($date_time),(int)strtotime($date_time_tenm),(int)strtotime($date_time_sinkn),(int)strtotime($date_time_grdn));
        
        ?>
       <div class="tile">
            <a href="{{URL::to('selectedStationStatus/'.$station['station_id'])}}">
                <div class="h5 text-purple">{{$station['Location']}}({{$station['StationName']}})<span style="float: right;">{{$station['StationRegion']}}</span></div>
                <span style="font-size: 20px;">
                  
                  <?php
               
          //if the station id is in id reported with problems [WHEN THE STATION IS OFF]
          //==============================================================================================        
          if((in_array($station['station_id'], $stoff_ids))){       
        ?>
            <span class="mr-2" style="font-size: 20px;">
                <i class="ion-ios7-circle-filled" style="color:#c92926"></i>
            </span>
            
            <div><span style="font-size:12px;color:black">Report status:{{$station['']}}
                <?php 
              		foreach ($problems_identified as $pr) {
                        # code...
                        if(($pr['stationID']==$station['station_id'])){
                            $report_status = $pr['status'];// break;                 
                        }else{
                            $report_status = '  ';// break;                 

                        }
                    }
                               
                 
                 ?> {{$report_status}} <?php
    //break;
                 
                 ?>  </span></div> <?php


                 }
                 //if station id is not in array of station on and stations off [ORANGE COLOR]
                 if((in_array($station['station_id'], $station_ids)) && !(in_array($station['station_id'], $stoff_ids))){
                 	// echo($pr['Value']);

                     ?>

                        <span class="mr-2" style="font-size: 20px;">
                          <i class="ion-ios7-circle-filled" style="color:#FFA500"></i>
                    </span>
                       <div><span style="font-size:12px;color:black">Report status:{{$station['']}}
                             <?php 
                  
                              foreach ($problems_identified as $pr) {
                              	# code...
                              	 if(($pr['stationID']==$station['station_id'])){
                                     $report_status = $pr['status'];// break;                 
                                  }
                              }
                              
               ?> 
                    {{$report_status}}
                           </span>
                      </div>   
        <?php
          }          
         ?>
    
    			<?php 
        
                  if(!(in_array($station['station_id'], $station_ids))&& !(in_array($station['station_id'], $stoff_ids))){//when everything is fine
                                       
                ?>
           
                      <span class="mr-2" style="font-size: 20px;">
            <i class="ion-ios7-circle-filled" style="color:#008000"></i> 
        </span>
   
                    <?php 
 							
                } ?> 
                 


                </span>
              <span style="font-size:12px;color:black"> Last communicated on:<!--{{$date_time}}-->
        

             </span>
               
        <?php
    if(!(empty($maxtime))){
echo date("Y-m-d h:i:sa", $maxtime);
}else{
  echo("Yet to communicate");
}


?>

            </a>
        </div>
    @endforeach
</div>



@endsection
