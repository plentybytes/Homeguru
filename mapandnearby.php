<?php 
error_reporting(0);
$seoId=23;

include('includes/application.php');
   
   $source=base64_decode($_GET['source']);
   $proid=base64_decode($_GET['proid']);
	//echo $_GET["proid"];
	$strProperty=dbQuery("SELECT  * FROM property where property_id='".base64_decode($_GET["proid"])."'");
	$num=dbNumRows($strProperty);
	
	
	$property_postal_code=$resultProperty[property_postal_code];
    $Address = urlencode($resultProperty[house_no].'+'.$resultProperty[property_address].'+'.$resultProperty[property_postal_code]);
    //$Address = urlencode($resultProperty[property_address]);
    
    $request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$Address."&sensor=true";
    $xml = simplexml_load_file($request_url) or die("url not loading");
    $status = $xml->status;
    if ($status=="OK") {
        $Lat = $xml->result->geometry->location->lat;
        $Lon = $xml->result->geometry->location->lng;
       $LatLng = "$Lat,$Lon";
    }

/*echo $LatLng;
$json="https://maps.googleapis.com/maps/api/place/search/json?location=".$LatLng."&radius=28000.0000&types=train_station&name=&sensor=true&key=AIzaSyD_iNxxxoS4Yg_FRg2r_KkXYVFaO2SDHUY";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $json);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_ENCODING, "");
$curlData = curl_exec($curl);
curl_close($curl);
$data = json_decode($curlData,true);
echo "<pre>";
print_r($data);
echo "</pre>";
exit;*/

$json="https://maps.googleapis.com/maps/api/place/search/json?location=".$LatLng."&radius=3057.7500&types=train_station&name=&sensor=true&key=AIzaSyD_iNxxxoS4Yg_FRg2r_KkXYVFaO2SDHUY";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $json);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_ENCODING, "");
$curlData = curl_exec($curl);
curl_close($curl);
$data = json_decode($curlData,true);

/* for nearby station right panel*/


dbQuery("DELETE FROM tbl_nearbystation");

foreach ($data['results'] as $key=>$value) {
	$underGroundTrainStationName=$value['name'];
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
	$distance_in_miles_float=round($distance*0.62137119,5);
	$distance_in_miles=round($distance*0.62137119,1);
    $underGroundTrainStationName.= "(".$distance_in_miles." miles)"; 
    if (in_array("subway_station", $value['types']))
      $station_type="subway_station";
     else
      $station_type=""; 
    
    $pageviewarray=array('station_name'=>$underGroundTrainStationName,'type'=>$station_type,'distance'=>$distance_in_miles_float);
    dbPerform("tbl_nearbystation",$pageviewarray); 
    
}









$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$addtonote_property_id=base64_decode($_GET["proid"]);


?>
<html>
<body>

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



</body>
</html>