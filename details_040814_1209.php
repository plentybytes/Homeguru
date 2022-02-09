<?php $seoId=23;
include('includes/application.php');

	//echo $_GET["proid"];
	$strProperty=dbQuery("SELECT  * FROM property where property_id='".base64_decode($_GET["proid"])."'");
	$num=dbNumRows($strProperty);
	if($num>0){
	$resultProperty=dbFetchArray($strProperty);
    $strProperty1=dbQuery("SELECT  * FROM user where user_id='".$resultProperty['user_id']."'");
    $resultProperty1=dbFetchArray($strProperty1);
        //print_r($resultProperty1);
	}else{
	redirect(hrefLink("show-property.php","source=".$_GET["source"]));
	}
     $Address = urlencode($resultProperty[house_no].'+'.$resultProperty[property_address].'+'.$resultProperty[property_postal_code]);
    $request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$Address."&sensor=true";
    $xml = simplexml_load_file($request_url) or die("url not loading");
    $status = $xml->status;
    if ($status=="OK") {
        $Lat = $xml->result->geometry->location->lat;
        $Lon = $xml->result->geometry->location->lng;
       $LatLng = "$Lat,$Lon";
    }
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php echo $rsultSeo;?>
<?php echo $seoTitle;?>


<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
<link href="css/css.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/tabcontent.js" type="text/javascript"></script>
<!--<script src="http://www.dynamicdrive.com/dynamicindex17/tabcontent/tabcontent.js" type="text/javascript"></script>-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<!--<link href="css/silder.css" rel="stylesheet" type="text/css" />-->

<script>
$(document).ready(function() { 
$('.bxslider').bxSlider({
  mode: 'fade',
  captions: true,auto: true,
  autoControls: true
});

document.cookie = 'flowertabs=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
 $("#addnote").click(function(){
    if($('#hiddenDiv').css('display') == 'none')
	  $('#hiddenDiv').css('display','block');
	 else
	  $('#hiddenDiv').css('display','none'); 
	
  });
}); 

</script>
</head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">


  <div id="left-panel">
    <h1 style="font-weight: bold;color: #000000;padding-bottom: 2px;font-size: 22px;"><?php echo $resultProperty["property_bedrooms"];?> bedroom semi-detached house for sale</h1>
      <p style="font-size: 14px;margin-bottom: 15px;"><?php echo $resultProperty["property_address"];?><!--,-->,<?php echo $resultProperty["property_postal_code"];?></p>
      <strong><?php echo showLocality($resultProperty["city_id"])?></strong>


<div class="modernbricksmenu2">
				 <ul>
                     <li><a class="selected" href="#" rel="tcontent1" id="prop_details">Property details</a></li>
                     <li><a class="" href="#" rel="tcontent2" id="nearby">Map &amp; nearby</a></li>
                     <li><a class="" href="#" rel="tcontent3" id="street_view">Street view</a></li>
                     <!-- <li><a class="" href="#" rel="tcontent4">Area stats</a></li>-->
                     <li><a class="" href="#" rel="tcontent5" id="local_info">Local info</a></li>
		</ul>

<div class="clear"></div>
    </div>
<?php 
		
            $images=dbQuery("select * from  property_images where property_file_type='image' and property_id='".$resultProperty["property_id"]."'");
			$count=dbNumRows($images);
			
			?>	
<div id="tcontent1"  class="silder-start" >
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
    <div class="bottom-plus-half">

        <h3 style="color: #000000;">Property description</h3>



        <div class="top" itemprop="description">

            <p style="text-align: justify;"><?php echo $resultProperty['property_description'];?></p>

        </div>


    </div>
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
<?php 

$json="https://maps.googleapis.com/maps/api/place/search/json?location=".$LatLng."&radius=8000.0000&types=train_station|airport|bus_station&name=&sensor=true&key=AIzaSyD_iNxxxoS4Yg_FRg2r_KkXYVFaO2SDHUY";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $json);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_ENCODING, "");
$curlData = curl_exec($curl);
curl_close($curl);
$data = json_decode($curlData,true);
/*echo "<pre>";
print_r($data);
echo "</pre>";
exit;*/



echo "<strong>Nearby transport:</strong><p>"; 
$trainStation=array();
$train_count=0;
foreach ($data['results'] as $key=>$value) {
     
     
    if($value['types'][0]=="train_station"){
      
      if($train_count<=2){ 
       $trainStation[$train_count]=$value['name'];            
      
    }
}
    $dest_lat=$value['geometry']['location']['lat'];
    $dest_lan=$value['geometry']['location']['lng'];
    $dist_url="http://maps.googleapis.com/maps/api/distancematrix/json?origins=$LatLng&destinations=$dest_lat,$dest_lan"; 
    $curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $dist_url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_ENCODING, "");
	$curlDestData = curl_exec($curl);
	curl_close($curl);
	$dest_data = json_decode($curlDestData,true);
	
	
	$distance=$dest_data['rows'][0]['elements'][0]['distance']['text'];
	$distance_in_miles=round($distance*0.62137119,1);
		 
     
    echo $value['name']."(".$distance_in_miles." miles)<br>";
    if($value['types'][0]=="train_station"){
      if($train_count<=2){
		$trainStation[$train_count].= "(".$distance_in_miles." miles)"; 
		$train_count++; 
    }
   } 
 
	  
}

$json="https://maps.googleapis.com/maps/api/place/search/json?location=".$LatLng."&radius=1000.0000&types=school&name=&sensor=true&key=AIzaSyD_iNxxxoS4Yg_FRg2r_KkXYVFaO2SDHUY";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $json);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_ENCODING, "");
$curlData = curl_exec($curl);
curl_close($curl);
$data = json_decode($curlData,true);
//echo "<pre>";
//print_r($data);
//echo "</pre>";
//exit;



echo "<p></p><p></p></p><strong>Nearby Schools:</strong><p>"; 

foreach ($data['results'] as $key=>$value) {
    $dest_lat=$value['geometry']['location']['lat'];
    $dest_lan=$value['geometry']['location']['lng'];
    $dist_url="http://maps.googleapis.com/maps/api/distancematrix/json?origins=$LatLng&destinations=$dest_lat,$dest_lan"; 
    $curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $dist_url);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_ENCODING, "");
	$curlDestData = curl_exec($curl);
	curl_close($curl);
	$dest_data = json_decode($curlDestData,true);
	
	
	$distance=$dest_data['rows'][0]['elements'][0]['distance']['text'];
	$distance_in_miles=round($distance*0.62137119,1);
		 
     
    echo $value['name']."(".$distance_in_miles." miles)<br>";
    
  //echo $value['name']."<br>";
	  
}



?>


</div>

<script type="text/javascript">

var myflowers=new ddtabcontent("flowertabs")
myflowers.setpersist(true)
myflowers.setselectedClassTarget("link") //"link" or "linkparent"
myflowers.init()
</script>
  </div>
    <div id="right-panel">
        <div class="well clearfix">
            <h4 class="wel-heading">Marketed by</h4>
            <img src="images/<?php echo $resultProperty1['logo']?>" class="img-responsive" />
            <p><a href="#"><?php echo $resultProperty1['comp_name']?> </a> <br /><?php echo $resultProperty1['user_address']?> </p>
            <!--<img src="images/agent-logo.jpg" class="img-responsive" />
            <p><a href="#">Evans & Co Property Services (view all property for sale)</a> <br />55 The Broadway, Greenford, UB6 9PN</p>-->
            <h4>Call 020 7768 0828</h4>
            <a href="request.php?proid=<?php echo $_GET['proid']?>" class="btn btn-danger btn-lg">Request Details</a>
            <hr />
            <h5>Listing history</h5>
            <p> <strong>First listed</strong><br />
                £349,950            on   29th May 2014 </p>
            <p> <strong>Page views</strong><br />
                Last 30 days: <strong>334</strong>  |        Since listed: <strong>334</strong><br />
                Figures updated once daily </p>
        </div>

        <button type="button" class="btn btn-default btn-block"><span class="glyphicon glyphicon-star"></span> Save to favourites</button>
        <button type="button" class="btn btn-default btn-block"><span class="glyphicon glyphicon-bell"></span> Create email alert</button>
        <button type="button" class="btn btn-default btn-block" id="print"><span class="glyphicon glyphicon-print"></span>&nbsp;Print this page</button>
        <a href="email.php?proid=<?php echo $_GET['proid']?>" style="text-decoration: none;"><button type="button" class="btn btn-default btn-block"><span class="glyphicon glyphicon-envelope"></span> Email a friend</button></a>
        <a href="report.php?proid=<?php echo $_GET['proid']?>" style="text-decoration: none;"><button type="button" class="btn btn-default btn-block"><span class="glyphicon glyphicon-list-alt"></span> Report listing content</button></a>
        <button type="button" class="btn btn-default btn-block"><span class="glyphicon glyphicon-ban-circle"></span> Hide property</button>
        <div id="addnote"><button type="button" class="btn btn-default btn-block"><span class="glyphicon glyphicon-file"></span> Add a note</button></div>
        <div id="hiddenDiv" style="height:200px;display:none;"></div>
        
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s); js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=240720766086965&version=v2.0";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <div class="well">
            <div>
                <h4 class="wel-heading">Share this property</h4>
               <div class="fb-share-button" data-href="http://homesguru.co.uk/details.php?source=MA==&amp;proid=Nzk=#" data-type="button"></div>
                <div class="social_share">
                    <!--<a href="#"><img src="images/fb-share.jpg"  alt="fb" /></a>
                    <a href="#"><img src="images/tweet-share.jpg" alt="Tw" /></a>
                    <a href="#"><img src="images/print-share.jpg"  alt="pt" /></a>-->

                  <a href="https://twitter.com/share" class="twitter-share-button" data-related="jasoncosta" data-lang="en" data-size="large" data-count="none">Tweet</a>

                    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                    <a href="//www.pinterest.com/pin/create/button/?url=http%3A%2F%2Fhomesguru.co.uk%2Fdetails.php%3Fsource%3DMA%3D%3D%26proid%3DNzk%3D%23&media=http%3A%2F%2Ffarm8.staticflickr.com%2F7027%2F6851755809_df5b2051c9_z.jpg&description=Next%20stop%3A%20Pinterest" data-pin-do="buttonPin" data-pin-config="none" data-pin-height="28"><img src="//assets.pinterest.com/images/pidgets/pinit_fg_en_rect_gray_28.png" /></a>
                    <!-- Please call pinit.js only once per page -->
                   <script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
                </div>
            </div>
        </div>
        <div class="well">
            <div>
                <h4 class="wel-heading">Nearby stations</h4>
                <div>
                    <ul>
                       <?php foreach($trainStation as $tkey=>$tval){?> 
                        
                        <li> <span class="glyphicon glyphicon-transfer" style="color: #CA3C38;"></span><?php echo $tval?> </li>
                       
                       <?php }?> 
                        
                        <!--<li> <span class="glyphicon glyphicon-map-marker" style="color: #10386D;"></span>Hanwell (1.3 miles) </li>
                        <li> <span class="glyphicon glyphicon-transfer" style="color: #CA3C38;"></span>Castle Bar Park(1.7 miles) </li>-->
                    </ul>
                </div>
            </div>


        </div>
        <div class="well">
            <h4 class="wel-heading">Mortgage Payment Calculator</h4>
            <form>
                <table width="100%">
                    <tr>
                        <td width="49%"><strong>Property price:</strong></td>
                        <td width="6%"><strong>£</strong></td>
                        <td width="45%"><input type="text" value="<?php echo $resultProperty["property_total_price"];?>" class="form-control" id="price"/></td>
                    </tr>
                    <tr>
                        <td><strong>Deposit:</strong></td>
                        <td><strong>£</strong></td>
                        <td><input type="text" value="" class="form-control" id="deposit"/></td>
                    </tr>
                    <tr>
                        <td><strong>Mortgage Amount:</strong></td>
                        <td><strong>£</strong></td>
                        <td><input type="text" value="" class="form-control" id="howmuch" readonly="readonly"/></td>
                    </tr>
                    <tr>
                        <td><strong>Annual interest:</strong></td>
                        <td><strong>%</strong></td>
                        <td><input type="text" value="" class="form-control" id="interest"/></td>
                    </tr>
                    <tr>
                        <td><strong>Mortgage Term:</strong></td>
                        <td>&nbsp;</td>
                        <td>
                            <select class="half-size" name="" class="pull-right" class="form-control" id="term" >
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option selected="selected" value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">

                            <span class="badge" id="result"><strong>£ per month</strong></span>
                        </td>
                        <td><input type="button" value="Calculate" class="btn btn-success btn-sm" id="calculate"/></td>
                    </tr>
                    <tr>
                        <td colspan="3"></td>
                    </tr>
                </table>
            </form>
        </div>
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
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAE-lIaliGLeqYO04SSji3uOZf3w6AkOWA&sensor=false&libraries=places"></script>
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
var iconBase;
var google_place = [
    ['<?php echo $resultProperty["property_address"];?><?php echo ','.$resultProperty["property_postal_code"];?>', <?php echo $LatLng;?>, '', ''],
    ['London', 51.5072, -0.1275, 'rail', ''],
    ['location1', 51.5172, -0.1375, 'school', ''],
    ['location1', 51.5172, -0.1775, 'school', ''],
    ['location2', 51.5272, -0.1475, 'health', ''],
    ['location3', 51.5372, -0.1575, 'food', ''],
    ['location4', 51.5472, -0.1675, 'restaurant', ''],
    ['Seccaucus', 51.5572, -0.1775, 'worship', ''],


];
var pyrmont = new google.maps.LatLng(<?php echo $LatLng;?>);
var store = {
    location: pyrmont,
    radius: 500,
    types: ['bus_station']
};
var school = {
    location: pyrmont,
    radius: 500,
    types: ['school']
};
var hospital = {
    location: pyrmont,
    radius:2500,
    types: ['hospital']
};
var worship = {
    location: pyrmont,
    radius: 500,
    types: ['place_of_worship']
};
var bar = {
    location: pyrmont,
    radius: 2500,
    types: ['restaurant','bar','night_club']
};
var food = {
    location: pyrmont,
    radius: 2500,
    types: ['food']
};

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
var panorama;
//var astorPlace = new google.maps.LatLng(40.729884, -73.990988);

///////////////////////////////////////////////////////////////
function codeAddress() {
    var address = document.getElementById("address").value;
    geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
        } else {
            alert("Geocode was not successful for the following reason: " + status);
        }
    });
}

///////////////////////////////////////////////////////////
//var astorPlace = new google.maps.LatLng(51.5072, -0.1275);
var astorPlace = new google.maps.LatLng(<?php echo $LatLng;?>);
/////////////////////////////////////////////////////////////////////////
var myLatlng = new google.maps.LatLng(<?php echo $LatLng;?>); <?php // echo $resultProperty['property_latitude'].', '. $resultProperty['property_longitude'];?>
//var myLatlng = new google.maps.LatLng(51.5072, -0.1275);
var mapOptions = {
    center: myLatlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    zoom: 16
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
    iconBase = 'http://homesguru.co.uk/images/icon_image/01.png';
   var service = new google.maps.places.PlacesService(map);
    service.nearbySearch(store, callback);

 //   exit;
  // var getval = this.value;
    //var getId = this.getAttribute('id');
   // var get_data_type = getId;
   // google_place_counter = 0;

   // for (var i = 0; i < google_place.length; i++) {

      //  if(getId == google_place[i][3]){

         //   addMarkerShowHide(true);


       // }else{
          //  addMarkerShowHide(false);
       // }

   // }
}
function getschoolshow(){

    iconBase = 'http://homesguru.co.uk/images/icon_image/02.png';
    var service = new google.maps.places.PlacesService(map);
    service.nearbySearch(school, callback);

}
function gethospitalshow(){

    iconBase = 'http://homesguru.co.uk/images/icon_image/03.png';
    var service = new google.maps.places.PlacesService(map);
   service.nearbySearch(hospital, callback);

}
function getworshipshow(){

    iconBase = 'http://homesguru.co.uk/images/icon_image/04.png';
    var service = new google.maps.places.PlacesService(map);
    service.nearbySearch(worship, callback);

}
function getbarshow(){

    iconBase = 'http://homesguru.co.uk/images/icon_image/05.png';
    var service = new google.maps.places.PlacesService(map);
    service.nearbySearch(bar, callback);

}
function getfoodshow(){
    iconBase = 'http://homesguru.co.uk/images/icon_image/06.png';

    var service = new google.maps.places.PlacesService(map);
    service.nearbySearch(food, callback);

}
function callback(results, status) {
  //  alert(status);
  //  exit;
    if (status == google.maps.places.PlacesServiceStatus.OK) {
        for (var i = 0; i < results.length; i++) {
            createMarker(results[i]);
        }
    }
}
function createMarker(place) {
    var placeLoc = place.geometry.location;

    //var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/library_maps.png';
    var contentString = place.name;

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });

    var marker = new google.maps.Marker({
        map: map,
        icon: iconBase ,
        title: place.name,
        position: place.geometry.location
    });
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map,marker);
    });

}
function addMarkerShowHide(getvalm){
    all_marker[google_place_counter].setVisible(getvalm);
    google_place_counter++;
}




function initialize() {

    map = new google.maps.Map(document.getElementById("map"),
        mapOptions);
   // var service = new google.maps.places.PlacesService(map);
    smap = new google.maps.Map(document.getElementById("smap"),
        mapOptions);


    var data_latlang = google_place;


    for (var i = 0; i < google_place.length; i++) {

        addMarkerForAll(i);

    }

    all_marker[0].setVisible(true);

   // map.setCenter(all_marker[0].getPosition());
    for (var i = 1; i < google_place.length; i++) {
        all_marker[i].setVisible(false);
    }


    google.maps.event.addDomListener(document.getElementById('rail'), 'click', getcityshow);
    google.maps.event.addDomListener(document.getElementById('school'), 'click', getschoolshow);
    google.maps.event.addDomListener(document.getElementById('health'), 'click', gethospitalshow);
    google.maps.event.addDomListener(document.getElementById('food'), 'click', getfoodshow);
    google.maps.event.addDomListener(document.getElementById('restaurant'), 'click', getbarshow);
    google.maps.event.addDomListener(document.getElementById('worship'), 'click', getworshipshow);

    panorama = smap.getStreetView();
    panorama.setPosition(astorPlace);
    panorama.setPov(/** @type {google.maps.StreetViewPov} */({
        heading: 265,
        pitch: 0
    }));
    panorama.setVisible(true);
    $('#prop_details').click(function(){
        document.getElementById('tcontent1').style.display = 'block';
        document.getElementById('tcontent2').style.display = 'none';
        document.getElementById('tcontent3').style.display = 'none';
        document.getElementById('tcontent5').style.display = 'none';
        //google.maps.event.trigger(map, 'resize');
    });
    $('#nearby').click(function(){
        document.getElementById('tcontent1').style.display = 'none';
        document.getElementById('tcontent2').style.display = 'block';
        document.getElementById('tcontent3').style.display = 'none';
        document.getElementById('tcontent5').style.display = 'none';
        google.maps.event.trigger(map, 'resize');
        map.setCenter(new google.maps.LatLng(<?php echo $LatLng;?>));
    });
    $('#street_view').click(function(){
        document.getElementById('tcontent1').style.display = 'none';
        document.getElementById('tcontent2').style.display = 'none';
        document.getElementById('tcontent3').style.display = 'block';
        document.getElementById('tcontent5').style.display = 'none';
        google.maps.event.trigger(smap, 'resize');
    });
    $('#local_info').click(function(){
        document.getElementById('tcontent1').style.display = 'none';
        document.getElementById('tcontent2').style.display = 'none';
        document.getElementById('tcontent3').style.display = 'none';
        document.getElementById('tcontent5').style.display = 'block';
        //google.maps.event.trigger(map, 'resize');
    });

    $('#print').click(function(){
        //alert('biks');
        window.print();
        //google.maps.event.trigger(map, 'resize');
    });
    $('#deposit').change(function(){
        var price=$('#price').val();
        var deposit =$('#deposit').val();
        var howmuch1;
        howmuch1=price-deposit;
        $('#howmuch').val(howmuch1);
    });
    $('#calculate').click(function(){
        //exit;
        var howmuch=$('#howmuch').val();
        var interest=$('#interest').val();
        var term=$('#term').val();
       // var result= howmuch+interest+term;
        var monthly = interest / 12 / 100;
        var start = 1;
        var length = 1 + monthly;
        for (i=0; i<(term*12); i++)
        {        start = start * length
        }
        var payment =Number(howmuch * monthly / ( 1 - (1/start)))
        var payment2=Math.floor(payment);
        //0 per month
        var payment1='£'+payment2+ ' per month';
        //$('#result').text=payment;
       // alert(payment1);
        //$('#result').val(payment1);
        $('#result').html(payment1);
        //window.print();
        //google.maps.event.trigger(map, 'resize');
    });
}


google.maps.event.addDomListener(window, 'load', initialize);




</script>
</body>
</html>
