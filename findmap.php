
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">
  var infowindow;
  var map;
  var bounds;
  var markers = [];
  var markerIndex=0;
  function initialize() {
    var myLatlng = new google.maps.LatLng(40.7142, 74.0064);
    var myOptions = {
      zoom: 12,
      center: myLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

      markers = document.getElementsByTagName("marker");
      for (var i = 0; i < markers.length; i++) {
        var latlng = new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")),
                                    parseFloat(markers[i].getAttribute("lng")));
        var marker = createMarker(markers[i].getAttribute("formatedaddress"), markers[i].getAttribute("sitename"), latlng,markers[i].getAttribute("More"));
       }
    rebound(map);
  }

  function createMarker(formatedaddress, sitename, latlng) {
    var marker = new google.maps.Marker({position: latlng, map: map});

    var myHtml = "<table style='width:100%;'><tr><td><b>" + formatedaddress + "</b></td></tr><tr><td><b>" + sitename + "</b></td></tr></table>";

    google.maps.event.addListener(marker, "click", function() {
      if (infowindow) infowindow.close();
      infowindow = new google.maps.InfoWindow({content: myHtml});
      infowindow.open(map, marker);
    });
    return marker;
  }

  function rebound(mymap){
    bounds    = new google.maps.LatLngBounds();
    for (var i = 0; i < markers.length; i++) {
    bounds.extend(new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")),parseFloat(markers[i].getAttribute("lng"))));
    }
    mymap.fitBounds(bounds);
  }

  function showNextInfo()
  {
    if(markerIndex<markers.length-1)
          markerIndex++;
    else
          markerIndex = 0 ;
    alert(markers[markerIndex].getAttribute('name'));
    google.maps.event.trigger(markers[markerIndex],"click");
  }
  function showPrevInfo()
  {
    if(markerIndex>0)
          markerIndex--;
    else
          markerIndex = markers.length-1 ;
        google.maps.event.trigger(markers[markerIndex],'click');
  }
</script>
<markers>

<div id="map_canvas" style="width:905px; background-color:#999; height:500px"></div>
<?php
 	if($_GET['county']=="")
	{
		$locationAddress = str_replace(' ','+',"U k");			
	}
	else
	{
		$locationAddress = str_replace(' ','+',$_GET['county']);
	}
	
	
	echo 'http://maps.google.com/maps/api/geocode/json?address='.$locationAddress.'&sensor=false';die;
	
	$geocode= @file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$locationAddress.'&sensor=false');
	$output= json_decode($geocode);
	$latitude = $output->results[0]->geometry->location->lat;
	$longitude = $output->results[0]->geometry->location->lng;
	$formattedAddress = $output->results[0]->formatted_address;
?>
<marker formatedaddress='<?php echo $formattedAddress;?>' sitename='<span style="font-size:16px; font-weight:bold; color:#999999;">Location:</span><?php echo $_GET['location'];?><br /><br />
<ul class="tabs">
	
</ul>' lat='<?php echo $latitude;?>' lng='<?php echo $longitude;?>' height="100" width="100"/></marker>
 </markers>
