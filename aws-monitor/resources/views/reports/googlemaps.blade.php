<!--page_specific_css_files  page_specific_script_files-->

@extends('main')


@section('page_specific_css_files')
<style>
#map {
 height:500px;
margin:0;
padding:0;
}
</style>
@endsection

@section('content')
<div class="row">

    <!-- Accordions -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                    <div class="panel-heading">
                            <div id="map">

             


        </div>            
            </div>    
              </div>                   
        </div>

    </div> <!-- End row -->
</div>


@endsection
@section('page_specific_script_files')
<script type="text/javascript">



var map;
var Markers = {};
var infowindow;

//==================================OUR LOGIC=========================================================

    var locations_from_db = {!! json_encode($data->toArray())!!};
    var xpctDpacts = {!! json_encode($expectedpackets)!!};
    var Actualpckts = {!! json_encode($Actualpackets)!!};
    // var twoMetrs = {!! json_encode($Actualpackets)!!};
    // var twoMetrs = {!! json_encode($Actualpackets)!!};
    // var twoMetrs = {!! json_encode($Actualpackets)!!};
    var StationsOFF_obj = {!! json_encode($stations_off->toArray())!!};
    var labels = [];
    var locations=[];
    var StationsOFF =[];
//======================converting objects to number==========================================
for(let t=0; t<StationsOFF_obj.length; t++){
    StationsOFF.push(StationsOFF_obj[t].stationID);
    //alert(StationsOFF_obj[t].stationID);
}
//================================================================

//=======================Function to check if a number exists in an array=========================================
function contains(arr, element) {
    for (var i = 0; i < arr.length; i++) {
        //alert(arr[i] === element);
        if (arr[i] === element) {

            return true;
        }
    }
    return false;
}
//=================================================================================================================
        for(var i=0; i<locations_from_db.length; i++){
                if(contains(StationsOFF,locations_from_db[i].station_id)){

                    var dt=(Actualpckts[locations_from_db[i].station_id]/xpctDpacts[locations_from_db[i].station_id])*100;
                    
                    var UpTime = dt.toFixed(2);
                    var DownTime= (100-UpTime);
                    //alert(DownTime);
                labels.push(locations_from_db[i].Location);
                locations.push( [locations_from_db[i].Latitude,locations_from_db[i].Longitude,"red",
        '<strong>'+(locations_from_db[i].Location)+'</strong><p>Station OFF<br>DownTime: <strong style="color:red;">'+(DownTime)+'%</strong><br>UpTime: <strong style="color:green;">'+(UpTime)+'%</strong></p>',i]);
                }else{
                    var dt=(Actualpckts[locations_from_db[i].station_id]/xpctDpacts[locations_from_db[i].station_id])*100;
                    var UpTime = dt.toFixed(2);
                    var DownTime= (100-UpTime);
                labels.push(locations_from_db[i].Location);
                locations.push([locations_from_db[i].Latitude,locations_from_db[i].Longitude,"green",
        '<strong>'+(locations_from_db[i].Location)+'</strong><p>Station On<br>DownTime: <strong style="color:red;">'+(DownTime)+'%</strong><br>UpTime: <strong style="color:green;">'+(UpTime)+'%</strong></p>' ],i);
                }

        }
//====================================================================================================
//alert(labels[0]);
//var origin = new google.maps.LatLng(locations[0][2], locations[0][3]);
function initMap() {
  var mapOptions = {
    zoom: 7.1,
   // center: origin
    center: {lat: 1.5033, lng: 32.7000}
    // center: {lat: 1.373300, lng: 32.290300}
  };

//alert(locations[0][2]);
  map = new google.maps.Map(document.getElementById('map'), mapOptions);

    infowindow = new google.maps.InfoWindow();
    //alert(locations.length);
    for(i=0; i<locations.length; i++) {
        //alert(i);
        var position = new google.maps.LatLng(locations[i][0], locations[i][1]);
        var marker = new google.maps.Marker({
            position: position,
            map: map,
            label: locations[i][5],
            icon: { url: "http://maps.google.com/mapfiles/ms/icons/"+(locations[i][2])+"-dot.png"}
        });
        google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
            return function() {
                infowindow.setContent(locations[i][3]);
                infowindow.setOptions({maxWidth: 150});
                infowindow.open(map, marker);
            }
        }) (marker, i));
        Markers[locations[i][4]] = marker;
        //alert(i);
        //locate(i);
    }


}

function locate(marker_id) {
    var myMarker = Markers[marker_id];
    var markerPosition = myMarker.getPosition();
    map.setCenter(markerPosition);
    google.maps.event.trigger(myMarker, 'click');
}

google.maps.event.addDomListener(window, 'load', initMap);

  </script>

       <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
      </script>

    

     <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB0dy46oTvw9PivnuoTzy_aa5LDp_8FNIo&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
@endsection                
