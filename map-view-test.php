



  <div id="map"></div>



<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="js/animatedcollapse.js"></script>
<script src="js/tabcontent.js" type="text/javascript"></script>
<script type="text/javascript">
    //<![CDATA[

    var customIcons = {
      property: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      }
    
    };

    function load(city) {
		alert('hi');
	
     	 var map = new google.maps.Map(document.getElementById("map"), {
		     zoom:15,
             mapTypeId: "roadmap",
			 
		mapTypeControl: false

      });
	  
      var infoWindow = new google.maps.InfoWindow;
	  var bounds = new google.maps.LatLngBounds();
           var url = "rtv_town.php";
			
			//alert (url);
			//var url = "rtv_town.php?city=Shad Thames";
        
      // Change this depending on the name of your PHP file
	 // map.markers = map.markers || []
      downloadUrl(url, function(data) {
        var xml = data.responseXML;
		
		console.log(xml);
		
        var markers = xml.documentElement.getElementsByTagName("marker");
		 // var bounds = new google.maps.LatLngBounds(parseFloat(markers[0]),parseFloat(markers[0]));
        var i;
		
		console.log(markers);
		//amountOfNodes = markers.length;
		
		//alert(amountOfNodes);
		//alert (markers.length);
		
		for (i = 0; i < markers.length; i++) {
		
          var price = markers[i].getAttribute("price");
		  var bed = markers[i].getAttribute("bed");
          var address = markers[i].getAttribute("address");
		  var landmark = markers[i].getAttribute("landmark");
		  var town = markers[i].getAttribute("town");
		  var post_code = markers[i].getAttribute("post_code");
		  var images = markers[i].getAttribute("image");
		   
		 
          var type = "property";
		  
		   
		
          var point = new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")),parseFloat(markers[i].getAttribute("lng")));
			//bounds.extend(point);  
			//console.log(point);
          var html = "<img src=images/property_images/"+images +"   width='150' height='150'>&nbsp;<span style='float:right; width:217px;'><h5>"+bed+" bedroom flat</h5><h5 style='color:#FF0000;'>&pound;"+price+"</h5></br><b>Locality:</b> " + town + "<br/><b>Address: </b>" + address + "<br/><b>Landmark:</b> "+ landmark + "<br/><b>Postal Code:</b> "+post_code+"</span>";
		  //console.log(html);
          var icon = customIcons[type];
          var marker = new google.maps.Marker({
            map: map,
            position: point,
            icon: icon.icon,
            shadow: icon.shadow,
			html:html
          });
		//  map.markers.push(marker);
		  bounds.extend(marker.position);  
          bindInfoWindow(marker, map, infoWindow, html);
       
  
	    }
		google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
  if (this.getZoom() > 15) {
    this.setZoom(14);
	
  }
});
     
		 map.fitBounds(bounds);
	// map.panToBounds(bounds);
      });
	
    }

    function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', (function(html) {
	  return function() {
	 
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
		}
      })(html));
    }
 
    function downloadUrl(url, callback) {
      var request = window.ActiveXObject ?
          new ActiveXObject('Microsoft.XMLHTTP') :
          new XMLHttpRequest;

      request.onreadystatechange = function() {
        if (request.readyState == 4) {
         // request.onreadystatechange = doNothing;
          callback(request, request.status);
        }
      };

      request.open('GET', url, true);
      request.send(null);
    }

    function doNothing() {}

    //]]>

  </script>
  
