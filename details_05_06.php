<?php $seoId=23;
include('includes/application.php');

	
	$strProperty=dbQuery("SELECT  * FROM property where property_id='".base64_decode($_GET["proid"])."'");
	$num=dbNumRows($strProperty);
	if($num>0){
	$resultProperty=dbFetchArray($strProperty);
        //print_r($resultProperty);
	}else{
	redirect(hrefLink("show-property.php","source=".$_GET["source"]));
	}

	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php echo $rsultSeo;?>
<?php echo $seoTitle;?>

<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/tabcontent.js" type="text/javascript"></script>
<!--<script src="http://www.dynamicdrive.com/dynamicindex17/tabcontent/tabcontent.js" type="text/javascript"></script>-->


<!--<link href="css/silder.css" rel="stylesheet" type="text/css" />-->

<script>
$(document).ready(function() { 
$('.bxslider').bxSlider({
  mode: 'fade',
  captions: true,auto: true,
  autoControls: true
});
});
document.cookie = 'flowertabs=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
</script>
</head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">


  <div id="left-panel">
    <h1 style="font-weight: bold;color: #000000;padding-bottom: 2px;"><?php echo $resultProperty["property_bedrooms"];?> bedroom semi-detached house for sale</h1>
      <p style="font-size: 14px;margin-bottom: 15px;"><?php echo $resultProperty["property_address"];?></p>
      <strong><?php echo showLocality($resultProperty["city_id"])?></strong>


<div id="flowertabs" class="modernbricksmenu2">
				 <ul>
				 <li><a class="selected" href="#" rel="tcontent1">Property details</a></li>
				 <li><a class="" href="#" rel="tcontent2">Map &amp; nearby</a></li>
				 <li><a class="" href="#" rel="tcontent3">Street view</a></li>
				<!-- <li><a class="" href="#" rel="tcontent4">Area stats</a></li>-->
				 <li><a class="" href="#" rel="tcontent5">Local info</a></li>
		</ul>

<div class="clear"></div>
    </div>
<?php 
		
            $images=dbQuery("select * from  property_images where property_file_type='image' and property_id='".$resultProperty["property_id"]."'");
			$count=dbNumRows($images);
			
			?>	
<div id="tcontent1"  class="silder-start" style="display:none;">
<?php
if($count>0){
echo '<ul class="bxslider">';
while($imagesInfo=dbFetchArray($images))
{
echo '<li><img width="100%" src="images/property_images/'.$imagesInfo["property_images"].'" /></li>';
}
echo '</ul>';

}
?>
<div class="clear"></div>
</div>

<div id="tcontent2" class="silder-start" style="display:none;">
<div id="tab-details">
<p>Perform a local search on the map below:</p>
<ul>
<li><input type="radio" name="details" id="rail" value="1" /> Transport</li>
<li><input type="radio" name="details" id="school" value="1" /> Schools</li>
<li><input type="radio" name="details" id="health" value="1" /> Healthcare</li>
<li><input type="radio" name="details" id="food" value="1" /> Food shops</li>
<li><input type="radio" name="details" id="restaurant" value="1" /> Restaurants, pubs and bars</li>
<li><input type="radio" name="details" id="worship" value="1" /> Places of worship</li>

</ul>
<div class="clear"></div>
</div>

<div id="map"></div>
<div class="client-details">
<img src="images/agent-logo.jpg" alt="" />   <p>For more information about this property, please call
<strong>01373 316021</strong> (local rate) or email agent. </p>
<div class="clear"></div>
</div>
</div>

<div id="tcontent3" class="silder-start" style="display:none;">


<div id="smap"></div>
<div class="client-details">
<img src="images/agent-logo.jpg" alt="" />   <p>For more information about this property, please call
<strong>01373 316021</strong> (local rate) or email agent. </p>
<div class="clear"></div>
</div>

</div>

<div id="tcontent4" class="area-stats" style="display:none;">

</div>

<div id="tcontent5" style="display:;">



</div>

<script type="text/javascript">

var myflowers=new ddtabcontent("flowertabs")
myflowers.setpersist(true)
myflowers.setselectedClassTarget("link") //"link" or "linkparent"
myflowers.init()
</script>
  </div>
  <div id="right-panel">
  <div style=" float:right; overflow:scroll; height:200px; padding:5px; margin:10px;">
        <div id="searchwell" ></div>
      </div>
    <?php include('includes/right-panel.php');?>
  </div>

  <div class="clear"></div>
</div><!--Middle End-->

<!--Fotter Start-->
<?php include('includes/footer.php');?>
<!--Fotter End-->
<link rel="stylesheet" href="/js/jquery.bxslider.css" type="text/css" />
<script> $113 = jQuery.noConflict();</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="/js/jquery.bxslider.min.js"></script>
<style>
     #map{
        height: 500px;
        margin: 0px;
        padding: 0px
      }  #smap{
        height: 500px;
        margin: 0px;
        padding: 0px
      }
    </style>




<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAE-lIaliGLeqYO04SSji3uOZf3w6AkOWA&sensor=false"></script>
<style type="text/css">

    html { height: 100% }
    body { height: 100%; margin: 0; padding: 0 }
    .control-data{float:left; height:100%; width:150px;}
    #map-canvas { height: 100%;}
    .infobox-wrapper {
        /*display:none;*/
    }
    .infobox {
        border:2px solid black;
        margin-top: 8px;
        background:#333;
        color:#FFF;
        font-family:Arial, Helvetica, sans-serif;
        font-size:12px;
        padding: .5em 1em;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        text-shadow:0 -1px #000000;
        -webkit-box-shadow: 0 0  8px #000;
        box-shadow: 0 0 8px #000;
    }
</style>
<!--<script language="javascript" src="js/smartinfowindow.js"></script>-->
<script type="text/javascript">
var google_place = [
    ['London', 51.5072, -0.1275, 'rail', ''],
    ['location1', 52.5072, -0.1275, 'school', ''],
    ['location2', 53.5072, -2.113770, 'health', ''],
    ['location3', 50.5072, -1.0154, 'food', ''],
    ['location4', 54.5072, -4.1726, 'restaurant', ''],
    ['Seccaucus', 57.5072, -5.0676, 'worship', ''],


];
var google_place_counter = 0;
var all_marker = new Array();
var infowindow_all = new Array();
var content_section = '';

var google_new_arr_counter = 0;
var google_new_arr_marker = new Array();
//for icon
icon = 'blue';
iconM = "http://maps.google.com/mapfiles/ms/icons/" + icon + ".png";

var map;
var myLatlng = new google.maps.LatLng(51.5072, -0.1275); <?php // echo $resultProperty['property_latitude'].', '. $resultProperty['property_longitude'];?>
var mapOptions = {
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    zoom: 10
};

var infowindow = new google.maps.InfoWindow({
    content: "<p>city name</p>",
});


function addMarkerForAll(i){
    google_place_counter = i;
    var beach = google_place[google_place_counter];
    var myLatLng = new google.maps.LatLng(beach[1], beach[2]);
    all_marker[google_place_counter] = new google.maps.Marker({
        position: myLatLng,
        title: beach[0],
        animation: google.maps.Animation.DROP,

    });

    if(beach[4] != ''){

        icon = beach[4];
        iconM = "http://maps.google.com/mapfiles/ms/icons/" + icon + ".png";
        all_marker[google_place_counter].setIcon(new google.maps.MarkerImage(iconM));
    }
    all_marker[google_place_counter].setMap(map);
    addInfoWindowNeed(i);



}

function addInfoWindowNeed(key){

    google.maps.event.addListener(all_marker[key], 'click', function () {
        content_section = "<div style='width:350px'><h3>"+google_place[key][0]+"</h3><p>Lat/Long for all in way: "+google_place[key][1]+ ", "+google_place[key][2]+"</p></div>";
        infowindow.setOptions({minWidth:400});
        infowindow.setContent(content_section);
        infowindow.open(map,all_marker[key]);

    });

}




function getcityshow(){
    var getval = this.value;
    var getId = this.getAttribute('id');
    var get_data_type = getId;
    google_place_counter = 0;

    for (var i = 0; i < google_place.length; i++) {

        if(getId == google_place[i][3]){

            addMarkerShowHide(true);

        }else{
            addMarkerShowHide(false);
        }

    }
}

function addMarkerShowHide(getvalm){
    all_marker[google_place_counter].setVisible(getvalm);
    google_place_counter++;
}




function initialize() {

    map = new google.maps.Map(document.getElementById("map"),
        mapOptions);




    var data_latlang = google_place;


    for (var i = 0; i < google_place.length; i++) {

        addMarkerForAll(i);

    }

    all_marker[0].setVisible(true);
    for (var i = 1; i < google_place.length; i++) {
        all_marker[i].setVisible(false);
    }


    google.maps.event.addDomListener(document.getElementById('rail'), 'click', getcityshow);
    google.maps.event.addDomListener(document.getElementById('school'), 'click', getcityshow);
    google.maps.event.addDomListener(document.getElementById('health'), 'click', getcityshow);
    google.maps.event.addDomListener(document.getElementById('food'), 'click', getcityshow);
    google.maps.event.addDomListener(document.getElementById('restaurant'), 'click', getcityshow);
    google.maps.event.addDomListener(document.getElementById('worship'), 'click', getcityshow);

}


google.maps.event.addDomListener(window, 'load', initialize);




</script>
</body>
</html>
