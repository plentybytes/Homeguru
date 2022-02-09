<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="js/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">

var directionDisplay;
var directionsService = new google.maps.DirectionsService();
var map;

function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer();

    var mapOptions = {
    zoom: 5,
    mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById('map_canvas'),
                              mapOptions);
    directionsDisplay.setMap(map);


    //create an array of latitudes, longitudes, and city names
    var markers = [

    <?php

    //orgnize fans by city


    //pulls the city, state code from the database and stores it as a string in $address
    $address = urlencode('"' . 'laxmi nagar' . ", " . 'New delhi- 110002'  . '"');
    $googleApi = 'http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false';     

    $json = file_get_contents(sprintf($googleApi, $address));   
    $resultObject = json_decode($json);

    $location = $resultObject->results[0]->geometry->location;
$formattedAddress = $resultObject->results[0]->formatted_address;
//print_r($formattedAddress)."mukesh" ;die;
    $lat = $location->lat;
    $lng = $location->lng;

        print_r( "{ lat: ".$lat.", lng: ".$lng.", name: ".'"'.$formattedAddress.", ".$row['state'].'"'."},");
  

    ?>

    ];

    // Create the markers ad infowindows.
    for (index in markers) addMarker(markers[index]);
    function addMarker(data) {
        // Create the marker
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(data.lat, data.lng),
            map: map,
            title: data.name
        });

        // Create the infowindow with two DIV placeholders
        // One for a text string, the other for the StreetView panorama.
        var content = document.createElement("DIV");
        var title = document.createElement("DIV");
        title.innerHTML = data.name;
        content.appendChild(title);
        var streetview = document.createElement("DIV");
        streetview.style.width = "200px";
        streetview.style.height = "200px";
        content.appendChild(streetview);
        var infowindow = new google.maps.InfoWindow({
            content: content
        });

        // Open the infowindow on marker click
        google.maps.event.addListener(marker, "click", function() {
            infowindow.open(map, marker);
        });

        // Handle the DOM ready event to create the StreetView panorama
        // as it can only be created once the DIV inside the infowindow is loaded in the DOM.
        google.maps.event.addListenerOnce(infowindow, "domready", function() {
            var panorama = new google.maps.StreetViewPanorama(streetview, {
            navigationControl: false,
            enableCloseButton: false,
            addressControl: false,
            linksControl: false,
            visible: true,
            position: marker.getPosition()
            });
       });

    }

    // Try HTML5 geolocation
    if(navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = new google.maps.LatLng(position.coords.latitude,
            position.coords.longitude);

            var infowindow = new google.maps.InfoWindow({
            map: map,
            position: pos,
            content: 'Your Current City'
        });

            map.setCenter(pos);
        }, function() {
        handleNoGeolocation(true);
        });

    } else {
        // Browser doesn't support Geolocation
        handleNoGeolocation(false);
    }

}

function handleNoGeolocation(errorFlag) {
    if (errorFlag) {
        var content = 'Error: The Geolocation service failed.';
    } else {
        var content = 'Error: Your browser doesn\'t support geolocation.';
    }

    var options = {
    map: map,
    position: new google.maps.LatLng(60, 105),
    content: content
    };

    var infowindow = new google.maps.InfoWindow(options);
    map.setCenter(options.position);
}


function calcRoute() {
    var start = document.getElementById('start').value;
    var end = document.getElementById('end').value;
    var waypts = [];
    var checkboxArray = document.getElementById('waypoints');
    for (var i = 0; i < checkboxArray.length; i++) {
        if (checkboxArray.options[i].selected == true) {
            waypts.push({
                        location:checkboxArray[i].value,
                        stopover:true});
        }
    }

    var request = {
    origin: start,
    destination: end,
    waypoints: waypts,
    optimizeWaypoints: true,
    travelMode: google.maps.DirectionsTravelMode.DRIVING
    };
    directionsService.route(request, function(response, status) {
                            if (status == google.maps.DirectionsStatus.OK) {
                            directionsDisplay.setDirections(response);
                            var route = response.routes[0];
                            var summaryPanel = document.getElementById('directions_panel');
                            summaryPanel.innerHTML = '';
                            // For each route, display summary information.
                            for (var i = 0; i < route.legs.length; i++) {
                            var routeSegment = i + 1;
                            summaryPanel.innerHTML += '<b>Route Segment: ' + routeSegment + '</b><br>';
                            summaryPanel.innerHTML += route.legs[i].start_address + ' to ';
                            summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
                            summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
                            }
                            }
                            });
}

google.maps.event.addDomListener(window, 'load', initialize);


</script>
</head>

<body onload="initialize()">

<div id="map_canvas" style="width: 1100px; height: 450px;">map div</div>
</body>
</html>
