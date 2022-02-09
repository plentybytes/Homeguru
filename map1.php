<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Street View containers</title>
    <style>
      html, body, #map-canvas {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
    </style>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
function hmm() {
  var bryantPark = new google.maps.LatLng(37.869260, -122.254811);
alert(bryantPark);
  var panoramaOptions = {
    position: bryantPark,
  
    zoom: 1
  };
  var myPano = new google.maps.StreetViewPanorama(
      document.getElementById('map-canvas'),
      panoramaOptions);
  myPano.setVisible(true);
}

google.maps.event.addDomListener(window, 'load',hmm);

    </script>
  </head>
  <body>
    <div id="map-canvas"></div>
  </body>
</html>
