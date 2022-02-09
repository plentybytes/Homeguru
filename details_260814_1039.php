<?php 
error_reporting(0);
$seoId=23;

include('includes/application.php');
   
   $source=base64_decode($_GET['source']);
   $proid=base64_decode($_GET['proid']);
	//echo $_GET["proid"];
	$strProperty=dbQuery("SELECT  * FROM property where property_id='".base64_decode($_GET["proid"])."'");
	$num=dbNumRows($strProperty);
	if($num>0){
	$resultProperty=dbFetchArray($strProperty);
    $addtonote_user_id=$resultProperty['user_id'];
    $property_total_price=$resultProperty['property_total_price'];
    $property_created_date=$resultProperty['property_created_date'];
    
    
    $strProperty1=dbQuery("SELECT  * FROM user where user_id='".$resultProperty['user_id']."'");
    $resultProperty1=dbFetchArray($strProperty1);
        //print_r($resultProperty1);
	}else{
	redirect(hrefLink("show-property.php","source=".$_GET["source"]));
	}
    
    $property_postal_code=$resultProperty[property_postal_code];
    //$Address = urlencode($resultProperty[house_no].'+'.$resultProperty[property_address].'+'.$resultProperty[property_postal_code]);
    $Address = urlencode($resultProperty[property_address]);
    
    $request_url = "http://maps.googleapis.com/maps/api/geocode/xml?address=".$Address."&sensor=true";
    $xml = simplexml_load_file($request_url) or die("url not loading");
    $status = $xml->status;
    if ($status=="OK") {
        $Lat = $xml->result->geometry->location->lat;
        $Lon = $xml->result->geometry->location->lng;
       $LatLng = "$Lat,$Lon";
    }


/*$json="https://maps.googleapis.com/maps/api/place/search/json?location=".$LatLng."&radius=1609.344&types=train_station&name=&sensor=true&key=AIzaSyD_iNxxxoS4Yg_FRg2r_KkXYVFaO2SDHUY";
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

$json="https://maps.googleapis.com/maps/api/place/search/json?location=".$LatLng."&radius=1609.344&types=train_station&name=&sensor=true&key=AIzaSyD_iNxxxoS4Yg_FRg2r_KkXYVFaO2SDHUY";
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




$strPageViewProperty=dbQuery("SELECT  * FROM tbl_pageview where property_id=".$addtonote_property_id." and IP='".$_SERVER['REMOTE_ADDR']."'");

$pageviewcounterstatusrows=dbNumRows($strPageViewProperty);
if($pageviewcounterstatusrows==0){
  $pageviewarray=array('date_id'=>date('Y-m-d'),'property_id'=>$addtonote_property_id,'IP'=>$_SERVER['REMOTE_ADDR']);
  dbPerform("tbl_pageview",$pageviewarray); 
  
}
else{
  $pageviewarray=array('date_id'=>date('Y-m-d'),'property_id'=>$addtonote_property_id,'IP'=>$_SERVER['REMOTE_ADDR']);
  dbPerform("tbl_pageview",$pageviewarray,"update","property_id=".$addtonote_property_id." and IP='".$_SERVER['REMOTE_ADDR']."'");
  
}

//echo "select * from tbl_pageview where property_id=".$addtonote_property_id. " and current_time>=".date('Y-m-d', strtotime('-30 days'));
//exit;
$pageViewSql=dbQuery("select * from tbl_pageview where property_id=".$addtonote_property_id. " and current_time>=".date('Y-m-d', strtotime('-30 days')));
$pageViewsCount=dbNumRows($pageViewSql);	
//exit;


/*$strPageViewProperty=dbQuery("SELECT  * FROM tbl_datetime_pageview_counter_status where property_id=".$addtonote_property_id.
" and user_id=".$addtonote_user_id." and date_id=".date('Y-m-d'));

$pageviewcounterstatusrows=dbFetchArray($strPageViewProperty);
if($pageviewcounterstatusrows['status']==0){
  $pageviewarray=array('property_id'=>$addtonote_property_id,'user_id'=>$addtonote_user_id,'month'=>date('m'),'year'=>date('Y'),'views_count'=>1);
  dbPerform("tbl_pageview",$pageviewarray);
  $pageViewCount=1;
  $sqlDataArray=array('status'=>1);
  dbPerform("tbl_datetime_pageview_counter_status",$sqlDataArray,"update","property_id=".$addtonote_property_id.
" and user_id=".$addtonote_user_id." and date_id=".date('Y-m-d'));
}
else{
$strPageView=dbQuery("SELECT  * FROM tbl_pageview where property_id=".$addtonote_property_id." and user_id=".$addtonote_user_id.
" and month=".date('m')." and year=".date('Y'));	
$pageviewresultarray=dbFetchArray($strPageView);
$pageViewCount=$pageviewresultarray['view_count']+1;
$sqlDataArray=array('views_count'=>$pageViewCount);
dbPerform("tbl_pageview",$sqlDataArray,"update","property_id=".$addtonote_property_id.
" and user_id=".$addtonote_user_id." and month=date('m') and year=date('Y')");	
	
	
}*/	



 if($_GET['mode']=="delete"){
		     $id=$_GET['id'];		
			 $source=base64_decode($_GET['source']);
			 $proid=base64_decode($_GET['proid']);
			 $tot_property_query=dbQuery("delete from tbl_property_note where id=".$id);
			 $header_location="details.php?source=".base64_encode($source)."&proid=".base64_encode($proid);
             header('location:'.$header_location);	   	
			} 
			


if(isset($_POST['addeditproperty']) && empty($_POST['mode'])){
    $straddeditproperty=dbQuery("SELECT  * FROM tbl_property_note where property_id='".base64_decode($_GET["proid"])."' and user_id=".$_SESSION['user']['id']);
	$addeditpropertynum=dbNumRows($straddeditproperty);   
if($addeditpropertynum==0){     
  
 if(!empty($_POST['addeditproperty'])){ 
  $property_note=$_POST['txtproperty'];
  $sqlDataArray=array('property_id'=>$addtonote_property_id,'user_id'=>$_SESSION['user']['id'],'property_note'=>$property_note);
  dbPerform("tbl_property_note",$sqlDataArray);
  }
 else{ 
  echo "please filled up property";
  
 }	
}
}
if(isset($_POST['addeditproperty']) && $_POST['mode']=="edit"){
  if(!empty($_POST['addeditproperty'])){ 
     $id=$_POST['id'];
     $property_note=$_POST['txtproperty'];
     $sqlDataArray=array('property_note'=>$property_note);
     dbPerform("tbl_property_note",$sqlDataArray,"update","id=".$id);
     $header_location="details.php?source=".base64_encode($_POST['source'])."&proid=".base64_encode($_POST['proid']);
     header('location:'.$header_location);	
   }
  else{
	 echo "please filled up property";  
	  
	}   

}


	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php echo $rsultSeo;?>
<?php echo $seoTitle;?>


<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
<link href="css/css.css" rel="stylesheet" type="text/css">
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="css/common.css" rel="stylesheet" type="text/css" />

<!--<script src="css/js/jquery.min.js" type="text/javascript"></script>
<script src="css/js/tabcontent.js" type="text/javascript"></script>-->
<!--<script src="http://www.dynamicdrive.com/dynamicindex17/tabcontent/tabcontent.js" type="text/javascript"></script>-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


<!--<link href="css/silder.css" rel="stylesheet" type="text/css" />-->

<script>
$(document).ready(function() { 
/*$('.bxslider').bxSlider({
  mode: 'fade',
  captions: true,auto: true,
  autoControls: true
});*/

//document.cookie = 'flowertabs=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
 $("#addnotebutton").click(function(){
    
    $.ajax({
        type: "POST",
		url: "http://homesguru.co.uk/session_check.php",
		success: function(result){
                        
                         
                         if(result == "yes") {
                              location.href='http://homesguru.co.uk/member-login.php?redirect2='+$(location).attr('href')
 
                         }else {
                             if($('#hiddenDiv').css('display') == 'none'){
								 
								  $('#hiddenDiv').css('display','block');
							  }
								 else{
								  $('#hiddenDiv').css('display','none'); }
                         }
                  
         }
    });
   
	
  });
  
 
  
  
  
 $("#cancelbutton").click(function(){
    if($('#hiddenDiv').css('display') == 'none')
	  $('#hiddenDiv').css('display','block');
	 else
	  $('#hiddenDiv').css('display','none'); 
	
  });
 
 $("#cancelbutton").attr('disabled','disabled');
 $("#addeditproperty").attr('disabled','disabled');
 
     $('input[type="text"]').change(function() {
        if($(this).val() != '') {
           $("#addeditproperty").removeAttr('disabled');
           $("#cancelbutton").removeAttr('disabled');
           
        }else{
         $("#addeditproperty").attr('disabled','disabled');
         $("#cancelbutton").attr('disabled','disabled');
        
        
	    }
     });
  
});

</script>


</head>
<?php 

if(isSessionRegistered('user')){

$straddtonote=dbQuery("SELECT  * FROM tbl_property_note where property_id=".$addtonote_property_id." and user_id=".$_SESSION['user']['id']);
$straddtonotenum=dbNumRows($straddtonote);
	if($straddtonotenum>0){
        	
echo "<script type='text/javascript'> 
   	 $(document).ready(function() { 
	  $('#hiddenDiv').css('display','block');
	  $('#addnotebutton').attr('value', 'Note Added');
	 });
   	  
   	</script>";





}


}




if(isSessionRegistered('user')){

$straddtofavorites=dbQuery("SELECT  * FROM tbl_savetofavorites where property_id=".$addtonote_property_id." and user_id=".$_SESSION['user']['id']);
$num=dbNumRows($straddtofavorites);
	if($num>0){
      	
   	
   	echo '<script type="text/javascript"> 
   	 $(document).ready(function() { 
	  $("#savetofavorites").val("Remove Property");	 
	 });
   	  
   	</script>';
}}
if(isset($_POST['savetofavorites'])){
    
   if(isSessionRegistered('user')){
    
    $straddtofavorites=dbQuery("SELECT  * FROM tbl_savetofavorites where property_id=".$addtonote_property_id." and user_id=".$_SESSION['user']['id']);
	$num=dbNumRows($straddtofavorites);
	if($num==0){
      $sqlDataArray=array('property_id'=>$addtonote_property_id,'user_id'=>$_SESSION['user']['id']);
	  dbPerform("tbl_savetofavorites",$sqlDataArray);	
   	
   	 echo '<script type="text/javascript"> 
   	 $(document).ready(function() { 
	  $("#savetofavorites").val("Remove Property");	  
	 });
   	  
   	</script>';
   }else{
    dbQuery("delete from tbl_savetofavorites where property_id=".$addtonote_property_id." and user_id=".$_SESSION['user']['id']);
    
     echo '<script type="text/javascript"> 
   	 $(document).ready(function() { 
	  $("#savetofavorites").val("Save to favorites");	 
	 });
   	  
   	</script>';
  
}




}
else{
      echo "<script>location.href='http://homesguru.co.uk/member-login.php';</script>";
   }

} 

 ?>
 
<!--hide property --> 
<?php if(isSessionRegistered('user')){ 
 $strhideproperty=dbQuery("SELECT  * FROM tbl_propertyhideunhide where property_id=".$addtonote_property_id." and user_id=".$_SESSION['user']['id']);
$num=dbNumRows($strhideproperty);
	if($num>0){
      	
   	
   	echo '<script type="text/javascript"> 
   	 $(document).ready(function() { 
	  $("#hideproperty").val("Unhide Property");	 
	 });
   	  
   	</script>';
}}

if(isset($_POST['hideproperty'])){
    
   if(isSessionRegistered('user')){
    
    $strhideproperty=dbQuery("SELECT  * FROM tbl_propertyhideunhide where property_id=".$addtonote_property_id." and user_id=".$_SESSION['user']['id']);
	$num=dbNumRows($strhideproperty);
	if($num==0){
      $sqlDataArray=array('property_id'=>$addtonote_property_id,'user_id'=>$_SESSION['user']['id']);
	  dbPerform("tbl_propertyhideunhide",$sqlDataArray);	
   	
   	 echo '<script type="text/javascript"> 
   	 $(document).ready(function() { 
	  $("#hideproperty").val("Unhide Property");	  
	 });
   	  
   	</script>';
   }else{
    dbQuery("delete from tbl_propertyhideunhide where property_id=".$addtonote_property_id." and user_id".$_SESSION['user']['id']);
    
     echo '<script type="text/javascript"> 
   	 $(document).ready(function() { 
	  $("#hideproperty").val("Hide Property");	 
	 });
   	  
   	</script>';
  
}




}
else
 echo "<script>location.href='http://homesguru.co.uk/member-login.php';</script>";
} 

 ?> 
 
 
 
 
 
 
 
 
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
                     <li><a class="" href="#" rel="tcontent1" id="prop_details">Property details</a></li>
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
        <div class="clear"></div>



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

<div id="tcontent5" style="display:none;">

<div style="width:645px;">
<!--<h3>What  users think of N17</h3>
<div class="clear"></div>
<div class="clearfix" id="rate-local-area">
    <div class="split2l">
        <p class="neither"><strong style="float:left;">Overall rating:</strong></p>
        <div class="clear"></div>
        <div class="clearfix top-half rate-local-area rated-local-area">
            <div class="clearfix bottom star-rating-wrap">
                <span class="inline-rating">
                    <ul class="star-rating">
                        <li class="current-rating" style="width:70%">currently 3.5 stars</li>
                    </ul>
                </span>
                <span class="star-rating-msg">
                    Good - 69%
                        (90 ratings)
                </span>
            </div>
        </div>
        <p class="top"><strong style="float:left;">Ratings breakdown:</strong></p>
        <div id="rate-local-area-breakdown" class="clearfix rate-local-area rated-local-area">
                <div class="clearfix bottom star-rating-wrap">
                    <div class="star-rating-padding">
                        <span class="inline-rating">
                            <ul class="star-rating">
                                <li class="current-rating" style="width:70%">currently  stars</li>
                            </ul>
                        </span>
                        <span class="rate-local-area-category">Community &amp; safety</span>
                    </div>
                </div>
                <div class="clearfix bottom star-rating-wrap">
                    <div class="star-rating-padding">
                        <span class="inline-rating">
                            <ul class="star-rating">
                                <li class="current-rating" style="width:60%">currently  stars</li>
                            </ul>
                        </span>
                        <span class="rate-local-area-category">Entertainment &amp; nightlife</span>
                    </div>
                </div>
                <div class="clearfix bottom star-rating-wrap">
                    <div class="star-rating-padding">
                        <span class="inline-rating">
                            <ul class="star-rating">
                                <li class="current-rating" style="width:80%">currently  stars</li>
                            </ul>
                        </span>
                        <span class="rate-local-area-category">Parks &amp; recreation</span>
                    </div>
                </div>
                <div class="clearfix bottom star-rating-wrap">
                    <div class="star-rating-padding">
                        <span class="inline-rating">
                            <ul class="star-rating">
                                <li class="current-rating" style="width:70%">currently  stars</li>
                            </ul>
                        </span>
                        <span class="rate-local-area-category">Restaurants &amp; shopping</span>
                    </div>
                </div>
                <div class="clearfix bottom star-rating-wrap">
                    <div class="star-rating-padding">
                        <span class="inline-rating">
                            <ul class="star-rating">
                                <li class="current-rating" style="width:70%">currently  stars</li>
                            </ul>
                        </span>
                        <span class="rate-local-area-category">Schools &amp; public services</span>
                    </div>
                </div>
                <div class="clearfix bottom star-rating-wrap">
                    <div class="star-rating-padding">
                        <span class="inline-rating">
                            <ul class="star-rating">
                                <li class="current-rating" style="width:80%">currently  stars</li>
                            </ul>
                        </span>
                        <span class="rate-local-area-category" >Transport &amp; travel</span>
                    </div>
                </div>
        </div>
    </div>
    <div class="split2r">
        <p class="bottom-half"><strong style="float:left; text-align:left;">Rate N17:</strong></p>
        <div class="clear"></div>
        <div id="rate-local-area-tip">
            <p class="bottom terms">
            <span>Tell us what you think of this area by rating these categories.</span>
            <br>Please note your vote will only be counted once.</p>
        </div>
        <div id="rate-local-area-rate" class="clearfix rate-local-area">
                <div id="rate-local-area-actual" class="clearfix bottom star-rating-wrap" data-rating-id="outcode=N17" data-category="community_and_safety" data-rating-current="">
                    <input id="rating-outcode" value="N17" type="hidden">
                    <input id="rating-incode" value="6UW" type="hidden">
                    <input id="rating-area_id" value="17836" type="hidden">
                    <input id="rating-post_town_id" value="853" type="hidden">
                    <input id="rating-county_area_id" value="57" type="hidden">
                    <span class="rate-local-area-category">Community &amp; safety</span>
                    <span class="inline-rating">
                        <ul class="star-rating">
                            <li class="current-rating" style="width:0%">currently  stars</li>
                            <li class="rating" data-rating-stars="1" data-rating-msg="Poor"><a href="#" class="one-star" data-ga-category="Local area rating" data-ga-action="community_and_safety" data-ga-label="/tracking/for-sale/details/">1</a></li>
                            <li class="rating" data-rating-stars="2" data-rating-msg="Average"><a href="#" class="two-stars" data-ga-category="Local area rating" data-ga-action="community_and_safety" data-ga-label="/tracking/for-sale/details/">2</a></li>
                            <li class="rating" data-rating-stars="3" data-rating-msg="Good"><a href="#" class="three-stars" data-ga-category="Local area rating" data-ga-action="community_and_safety" data-ga-label="/tracking/for-sale/details/">3</a></li>
                            <li class="rating" data-rating-stars="4" data-rating-msg="Very good"><a href="#" class="four-stars" data-ga-category="Local area rating" data-ga-action="community_and_safety" data-ga-label="/tracking/for-sale/details/">4</a></li>
                            <li class="rating" data-rating-stars="5" data-rating-msg="Excellent"><a href="#" class="five-stars" data-ga-category="Local area rating" data-ga-action="community_and_safety" data-ga-label="/tracking/for-sale/details/">5</a></li>
                        </ul>
                    </span>
                    <span class="star-rating-msg"></span>
               </div>
                <div id="rate-local-area-actual" class="clearfix bottom star-rating-wrap" data-rating-id="outcode=N17" data-category="entertainment_and_nightlife" data-rating-current="">
                    <input id="rating-outcode" value="N17" type="hidden">
                    <input id="rating-incode" value="6UW" type="hidden">
                    <input id="rating-area_id" value="17836" type="hidden">
                    <input id="rating-post_town_id" value="853" type="hidden">
                    <input id="rating-county_area_id" value="57" type="hidden">
                    <span class="rate-local-area-category">Entertainment &amp; nightlife</span>
                    <span class="inline-rating">
                        <ul class="star-rating">
                            <li class="current-rating" style="width:0%">currently  stars</li>
                            <li class="rating" data-rating-stars="1" data-rating-msg="Poor"><a href="#" class="one-star" data-ga-category="Local area rating" data-ga-action="entertainment_and_nightlife" data-ga-label="/tracking/for-sale/details/">1</a></li>
                            <li class="rating" data-rating-stars="2" data-rating-msg="Average"><a href="#" class="two-stars" data-ga-category="Local area rating" data-ga-action="entertainment_and_nightlife" data-ga-label="/tracking/for-sale/details/">2</a></li>
                            <li class="rating" data-rating-stars="3" data-rating-msg="Good"><a href="#" class="three-stars" data-ga-category="Local area rating" data-ga-action="entertainment_and_nightlife" data-ga-label="/tracking/for-sale/details/">3</a></li>
                            <li class="rating" data-rating-stars="4" data-rating-msg="Very good"><a href="#" class="four-stars" data-ga-category="Local area rating" data-ga-action="entertainment_and_nightlife" data-ga-label="/tracking/for-sale/details/">4</a></li>
                            <li class="rating" data-rating-stars="5" data-rating-msg="Excellent"><a href="#" class="five-stars" data-ga-category="Local area rating" data-ga-action="entertainment_and_nightlife" data-ga-label="/tracking/for-sale/details/">5</a></li>
                        </ul>
                    </span>
                    <span class="star-rating-msg"></span>
                </div>
                <div id="rate-local-area-actual" class="clearfix bottom star-rating-wrap" data-rating-id="outcode=N17" data-category="parks_and_recreation" data-rating-current="">
                    <input id="rating-outcode" value="N17" type="hidden">
                    <input id="rating-incode" value="6UW" type="hidden">
                    <input id="rating-area_id" value="17836" type="hidden">
                    <input id="rating-post_town_id" value="853" type="hidden">
                    <input id="rating-county_area_id" value="57" type="hidden">
                    <span class="rate-local-area-category">Parks &amp; recreation</span>
                    <span class="inline-rating">
                        <ul class="star-rating">
                            <li class="current-rating" style="width:0%">currently  stars</li>
                            <li class="rating" data-rating-stars="1" data-rating-msg="Poor"><a href="#" class="one-star" data-ga-category="Local area rating" data-ga-action="parks_and_recreation" data-ga-label="/tracking/for-sale/details/">1</a></li>
                            <li class="rating" data-rating-stars="2" data-rating-msg="Average"><a href="#" class="two-stars" data-ga-category="Local area rating" data-ga-action="parks_and_recreation" data-ga-label="/tracking/for-sale/details/">2</a></li>
                            <li class="rating" data-rating-stars="3" data-rating-msg="Good"><a href="#" class="three-stars" data-ga-category="Local area rating" data-ga-action="parks_and_recreation" data-ga-label="/tracking/for-sale/details/">3</a></li>
                            <li class="rating" data-rating-stars="4" data-rating-msg="Very good"><a href="#" class="four-stars" data-ga-category="Local area rating" data-ga-action="parks_and_recreation" data-ga-label="/tracking/for-sale/details/">4</a></li>
                            <li class="rating" data-rating-stars="5" data-rating-msg="Excellent"><a href="#" class="five-stars" data-ga-category="Local area rating" data-ga-action="parks_and_recreation" data-ga-label="/tracking/for-sale/details/">5</a></li>
                        </ul>
                    </span>
                    <span class="star-rating-msg"></span>
                </div>
                <div id="rate-local-area-actual" class="clearfix bottom star-rating-wrap" data-rating-id="outcode=N17" data-category="restaurants_and_shopping" data-rating-current="">
                    <input id="rating-outcode" value="N17" type="hidden">
                    <input id="rating-incode" value="6UW" type="hidden">
                    <input id="rating-area_id" value="17836" type="hidden">
                    <input id="rating-post_town_id" value="853" type="hidden">
                    <input id="rating-county_area_id" value="57" type="hidden">
                    <span class="rate-local-area-category">Restaurants &amp; shopping</span>
                    <span class="inline-rating">
                        <ul class="star-rating">
                            <li class="current-rating" style="width:0%">currently  stars</li>
                            <li class="rating" data-rating-stars="1" data-rating-msg="Poor"><a href="#" class="one-star" data-ga-category="Local area rating" data-ga-action="restaurants_and_shopping" data-ga-label="/tracking/for-sale/details/">1</a></li>
                            <li class="rating" data-rating-stars="2" data-rating-msg="Average"><a href="#" class="two-stars" data-ga-category="Local area rating" data-ga-action="restaurants_and_shopping" data-ga-label="/tracking/for-sale/details/">2</a></li>
                            <li class="rating" data-rating-stars="3" data-rating-msg="Good"><a href="#" class="three-stars" data-ga-category="Local area rating" data-ga-action="restaurants_and_shopping" data-ga-label="/tracking/for-sale/details/">3</a></li>
                            <li class="rating" data-rating-stars="4" data-rating-msg="Very good"><a href="#" class="four-stars" data-ga-category="Local area rating" data-ga-action="restaurants_and_shopping" data-ga-label="/tracking/for-sale/details/">4</a></li>
                            <li class="rating" data-rating-stars="5" data-rating-msg="Excellent"><a href="#" class="five-stars" data-ga-category="Local area rating" data-ga-action="restaurants_and_shopping" data-ga-label="/tracking/for-sale/details/">5</a></li>
                        </ul>
                    </span>
                    <span class="star-rating-msg"></span>
                </div>
                <div id="rate-local-area-actual" class="clearfix bottom star-rating-wrap" data-rating-id="outcode=N17" data-category="schools_and_public_services" data-rating-current="">
                    <input id="rating-outcode" value="N17" type="hidden">
                    <input id="rating-incode" value="6UW" type="hidden">
                    <input id="rating-area_id" value="17836" type="hidden">
                    <input id="rating-post_town_id" value="853" type="hidden">
                    <input id="rating-county_area_id" value="57" type="hidden">
                    <span class="rate-local-area-category">Schools &amp; public services</span>
                    <span class="inline-rating">
                        <ul class="star-rating">
                            <li class="current-rating" style="width:0%">currently  stars</li>
                            <li class="rating" data-rating-stars="1" data-rating-msg="Poor"><a href="#" class="one-star" data-ga-category="Local area rating" data-ga-action="schools_and_public_services" data-ga-label="/tracking/for-sale/details/">1</a></li>
                            <li class="rating" data-rating-stars="2" data-rating-msg="Average"><a href="#" class="two-stars" data-ga-category="Local area rating" data-ga-action="schools_and_public_services" data-ga-label="/tracking/for-sale/details/">2</a></li>
                            <li class="rating" data-rating-stars="3" data-rating-msg="Good"><a href="#" class="three-stars" data-ga-category="Local area rating" data-ga-action="schools_and_public_services" data-ga-label="/tracking/for-sale/details/">3</a></li>
                            <li class="rating" data-rating-stars="4" data-rating-msg="Very good"><a href="#" class="four-stars" data-ga-category="Local area rating" data-ga-action="schools_and_public_services" data-ga-label="/tracking/for-sale/details/">4</a></li>
                            <li class="rating" data-rating-stars="5" data-rating-msg="Excellent"><a href="#" class="five-stars" data-ga-category="Local area rating" data-ga-action="schools_and_public_services" data-ga-label="/tracking/for-sale/details/">5</a></li>
                        </ul>
                    </span>
                    <span class="star-rating-msg"></span>
                </div>
                <div id="rate-local-area-actual" class="clearfix bottom star-rating-wrap" data-rating-id="outcode=N17" data-category="transport_and_travel" data-rating-current="">
                    <input id="rating-outcode" value="N17" type="hidden">
                    <input id="rating-incode" value="6UW" type="hidden">
                    <input id="rating-area_id" value="17836" type="hidden">
                    <input id="rating-post_town_id" value="853" type="hidden">
                    <input id="rating-county_area_id" value="57" type="hidden">
                    <span class="rate-local-area-category">Transport &amp; travel</span>
                    <span class="inline-rating">
                        <ul class="star-rating">
                            <li class="current-rating" style="width:0%">currently  stars</li>
                            <li class="rating" data-rating-stars="1" data-rating-msg="Poor"><a href="#" class="one-star" data-ga-category="Local area rating" data-ga-action="transport_and_travel" data-ga-label="/tracking/for-sale/details/">1</a></li>
                            <li class="rating" data-rating-stars="2" data-rating-msg="Average"><a href="#" class="two-stars" data-ga-category="Local area rating" data-ga-action="transport_and_travel" data-ga-label="/tracking/for-sale/details/">2</a></li>
                            <li class="rating" data-rating-stars="3" data-rating-msg="Good"><a href="#" class="three-stars" data-ga-category="Local area rating" data-ga-action="transport_and_travel" data-ga-label="/tracking/for-sale/details/">3</a></li>
                            <li class="rating" data-rating-stars="4" data-rating-msg="Very good"><a href="#" class="four-stars" data-ga-category="Local area rating" data-ga-action="transport_and_travel" data-ga-label="/tracking/for-sale/details/">4</a></li>
                            <li class="rating" data-rating-stars="5" data-rating-msg="Excellent"><a href="#" class="five-stars" data-ga-category="Local area rating" data-ga-action="transport_and_travel" data-ga-label="/tracking/for-sale/details/">5</a></li>
                        </ul>
                    </span>
                    <span class="star-rating-msg"></span>
                </div>
        </div>
    </div>
</div>-->
        

        <h3>Nearby transport</h3>
        <div class="clear"></div>
			<div class="nearby_stations_schools clearfix split-one-third" style="text-align:left;">
				<ul>
        
        <?php
         


/*$nearByTrainStation=array();
$nTrainCount=0;
$nUnderGroundCount=0;
foreach ($data['results'] as $key=>$value) {
  if(strpos($value['name'],'Underground') == true ){
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
	$distance_in_miles=round($distance*0.62137119,1);
    $underGroundTrainStationName.= "(".$distance_in_miles." miles)"; 
    $nUnderGroundCount++;
    break;
   } 
   

}  
 foreach ($data['results'] as $key=>$value) { 
  if($nTrainCount<=8){
    if(strpos($value['name'],'Underground') == false ){
    
    $nearByTrainStation[$nTrainCount]=$value['name'];
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
    $nearByTrainStation[$nTrainCount].= "(".$distance_in_miles." miles)"; 
    $nTrainCount++;
  } 
}

}

if($nUnderGroundCount==1){
  $nearByTrainStation[$nTrainCount]=$underGroundTrainStationName;	
   	
}*/	


/* near by station */



$trainStation=array();
$train_count=0;
$railway_count=1;
$airport_count=1;
$busstation_count=1;


foreach ($data['results'] as $key=>$value) {
     //echo $value['name']."<br>";
     
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
	?>	 
    
   
   <?php if($value['types'][0]=="train_station"){
			  if($train_count<=2){
				$trainStation[$train_count].= "(".$distance_in_miles." miles)"; 
				$train_count++; 
			}
   
		   if($value['types'][0]=="train_station"){
			   if($railway_count<=3){
			   
			   
			   ?>
	  
	  
	  <li class="clearfix">
                        <span class="interface nearby_stations_schools_national_rail_station" title="Bruce Grove"></span>
            <span class="nearby_stations_schools_name" title="Bruce Grove"><?php echo $value['name']."(".$distance_in_miles." miles)"?></span>
           
        </li> 
	   
	<?php $railway_count++;}   
  	if($railway_count==4){?>  
  	</ul><ul>  
  	<?php   
  	 }}}
  	 if($value['types'][0]=="airport"){
	   if($airport_count<=3){
	   
	   ?>
	  
	  
	  <li class="clearfix">
                    <span class="interface nearby_stations_schools_uk_airport"></span>
            <span class="nearby_stations_schools_name"><?php echo $value['name']."(".$distance_in_miles." miles)"?></span>
            
        </li>
	   
	<?php $airport_count++;}   
  	if($airport_count==4){?>  
  	</ul><ul>  
  	<?php   
  	 }}
  	if($value['types'][0]=="bus_station"){
	   if($busstation_count<=3){
	   
	   ?>
	     
  	  <li class="clearfix">
                    <span class="interface nearby_stations_schools_uk_ferry_port"></span>
            <span class="nearby_stations_schools_name"><?php echo $value['name']."(".$distance_in_miles." miles)"?></span>
            
        </li>
  	  <?php $busstation_count++;}   
  	if($busstation_count==4){?>  
  	</ul>  
  	<?php  
  }
  	  
  	  
  	   
    
   
	  
}

}
        
    ?>
    
 <?php
         
$json="https://maps.googleapis.com/maps/api/place/search/json?location=".$LatLng."&radius=8000.0000&types=airport&name=&sensor=true&key=AIzaSyD_iNxxxoS4Yg_FRg2r_KkXYVFaO2SDHUY";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $json);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_ENCODING, "");
$curlData = curl_exec($curl);
curl_close($curl);
$data = json_decode($curlData,true);





$airport_count=1;
$busstation_count=1;


foreach ($data['results'] as $key=>$value) {
     //echo $value['name']."<br>";
     
    
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
	?>	 
    
   
   <?php if($value['types'][0]=="train_station"){
			  if($train_count<=2){
				$trainStation[$train_count].= "(".$distance_in_miles." miles)"; 
				$train_count++; 
			}
   
		   if($value['types'][0]=="train_station"){
			   if($railway_count<=3){
			   
			   
			   ?>
	  
	  
	  <li class="clearfix">
                        <span class="interface nearby_stations_schools_national_rail_station" title="Bruce Grove"></span>
            <span class="nearby_stations_schools_name" title="Bruce Grove"><?php echo $value['name']."(".$distance_in_miles." miles)"?></span>
           
        </li> 
	   
	<?php $railway_count++;}   
  	if($railway_count==4){?>  
  	</ul><ul>  
  	<?php   
  	 }}}
  	 if($value['types'][0]=="airport"){
	   if($airport_count<=3){
	   
	   ?>
	  
	  
	  <li class="clearfix">
                    <span class="interface nearby_stations_schools_uk_airport"></span>
            <span class="nearby_stations_schools_name"><?php echo $value['name']."(".$distance_in_miles." miles)"?></span>
            
        </li>
	   
	<?php $airport_count++;}   
  	if($airport_count==4){?>  
  	</ul><ul>  
  	<?php   
  	 }}
  	if($value['types'][0]=="bus_station"){
	   if($busstation_count<=3){
	   
	   ?>
	     
  	  <li class="clearfix">
                    <span class="interface nearby_stations_schools_uk_ferry_port"></span>
            <span class="nearby_stations_schools_name"><?php echo $value['name']."(".$distance_in_miles." miles)"?></span>
            
        </li>
  	  <?php $busstation_count++;}   
  	if($busstation_count==4){?>  
  	</ul>  
  	<?php  
  }
  	  
  	  
  	   
    
   
	  
}

}
        
    ?>   
    
    
 <?php
         
$json="https://maps.googleapis.com/maps/api/place/search/json?location=".$LatLng."&radius=8000.0000&types=bus_station&name=&sensor=true&key=AIzaSyD_iNxxxoS4Yg_FRg2r_KkXYVFaO2SDHUY";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $json);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_ENCODING, "");
$curlData = curl_exec($curl);
curl_close($curl);
$data = json_decode($curlData,true);





$airport_count=1;
$busstation_count=1;


foreach ($data['results'] as $key=>$value) {
     //echo $value['name']."<br>";
     
    
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
	?>	 
    
   
   <?php if($value['types'][0]=="train_station"){
			  if($train_count<=2){
				$trainStation[$train_count].= "(".$distance_in_miles." miles)"; 
				$train_count++; 
			}
   
		   if($value['types'][0]=="train_station"){
			   if($railway_count<=3){
			   
			   
			   ?>
	  
	  
	  <li class="clearfix">
                        <span class="interface nearby_stations_schools_national_rail_station" title="Bruce Grove"></span>
            <span class="nearby_stations_schools_name" title="Bruce Grove"><?php echo $value['name']."(".$distance_in_miles." miles)"?></span>
           
        </li> 
	   
	<?php $railway_count++;}   
  	if($railway_count==4){?>  
  	</ul><ul>  
  	<?php   
  	 }}}
  	 if($value['types'][0]=="airport"){
	   if($airport_count<=3){
	   
	   ?>
	  
	  
	  <li class="clearfix">
                    <span class="interface nearby_stations_schools_uk_airport"></span>
            <span class="nearby_stations_schools_name"><?php echo $value['name']."(".$distance_in_miles." miles)"?></span>
            
        </li>
	   
	<?php $airport_count++;}   
  	if($airport_count==4){?>  
  	</ul><ul>  
  	<?php   
  	 }}
  	if($value['types'][0]=="bus_station"){
	   if($busstation_count<=2){
	   
	   ?>
	     
  	  <li class="clearfix">
                    <span class="interface nearby_stations_schools_uk_ferry_port"></span>
            <span class="nearby_stations_schools_name"><?php echo $value['name']."(".$distance_in_miles." miles)"?></span>
            
        </li>
  	  <?php $busstation_count++;}   
  	if($busstation_count==3){?>  
  	</ul>  
  	<?php  
  }
  	  
  	  
  	   
    
   
	  
}

}
        
    ?>     
 
<h3 style="padding:20px 0;clear:both;">Nearby schools</h3>
<div class="clear"></div>    
    <span style="display:block;position:relative;top:-36px;text-align:right;margin-bottom:-15px;"><a href="#"><span>.</span></a></span>
    <div style="width:645px; height:auto; margin:0 0 0 24px;">
    
    
<?php 
$tot_school_count=1;
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
?>

<?php
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
	?>	 
    
      <?php if($tot_school_count<=3){?>  
           
           <div style="width:187px; height:auto; float:left; margin:0 10px 0 0;"><span class="interface nearby_stations_schools_uk_primary_school"></span><?php echo $value['name']." (".$distance_in_miles." miles)"?></div>
       
       <?php $tot_school_count++;}?>
         <?php if($tot_school_count>3 && $tot_school_count<=6){?>  
	   
         <div style="width:187px; height:auto; float:left; margin:0 10px 0 0;"><span class="interface nearby_stations_schools_uk_primary_school"></span><?php echo $value['name']. " (".$distance_in_miles." miles)"?></div>
  
   <?php $tot_school_count++;}?>
  
       <?php if($tot_school_count>6 && $tot_school_count<=9){?>  
       <div style="width:187px; height:auto; float:left; margin:0 10px 0 0;"><span class="interface nearby_stations_schools_uk_primary_school"></span><?php echo $value['name']." (".$distance_in_miles." miles)"?></div>
  
  <?php $tot_school_count++;}?>
    
<?php     
}
 
?>


</div>
 

    <div style="clear:both;">
        <small>Note: Distances are straight line measurements</small>
    </div>
</div>   



<!--<h2>Local info for Haringey</h2>-->
<div class="clear"></div>          
<!-- it works the same with all jquery version from 1.x to 2.x -->
    <script type="text/javascript" src="css/js/jquery-1.9.1.min.js"></script>
    <!-- use jssor.slider.mini.js (39KB) or jssor.sliderc.mini.js (31KB, with caption, no slideshow) or jssor.sliders.mini.js (26KB, no caption, no slideshow) instead for release -->
    <!-- jssor.slider.mini.js = jssor.sliderc.mini.js = jssor.sliders.mini.js = (jssor.core.js + jssor.utils.js + jssor.slider.js) -->
    <script type="text/javascript" src="css/js/jssor.core.js"></script>
    <script type="text/javascript" src="css/js/jssor.utils.js"></script>
    <script type="text/javascript" src="css/js/jssor.slider.js"></script>
    <script>
        jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: false,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 4000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,   			            //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                //$SlideWidth: 600,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                //$SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 5, 					                //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always

                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $AutoCenter: 3,                             //[Optional] Auto center thumbnail items in the thumbnail navigator container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 3
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange thumbnails, default value is 1
                    $SpacingX: 0,                                   //[Optional] Horizontal space between each thumbnail in pixel, default value is 0
                    $SpacingY: 0,                                   //[Optional] Vertical space between each thumbnail in pixel, default value is 0
                    $DisplayPieces: 5,                              //[Optional] Number of pieces to display, default value is 1
                    $ParkingPosition: 0,                            //[Optional] The offset position to park thumbnail
                    $Orientation: 1,                                //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
                    $DisableDrag: true                              //[Optional] Disable drag or not, default value is false
                }
            };

            var jssor_slider2 = new $JssorSlider$("slider2_container", options);

            //responsive code begin
            //you can remove responsive code if you don't want the slider scales while window resizes
            function ScaleSlider() {
                var parentWidth = jssor_slider2.$Elmt.parentNode.clientWidth;
                if (parentWidth) {
                    var sliderWidth = parentWidth;

                    //keep the slider width no more than 602
                    sliderWidth = Math.min(sliderWidth, 602);

                    jssor_slider2.$SetScaleWidth(sliderWidth);
                }
                else
                    window.setTimeout(ScaleSlider, 30);
            }

            ScaleSlider();

            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', ScaleSlider);
            }


            //if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
            //    $(window).bind("orientationchange", ScaleSlider);
            //}
            //responsive code end
        });
    </script>
    <!-- Jssor Slider Begin -->
    <!-- You can move inline styles to css file or css block. -->
    <div id="slider2_container" style="position: relative; top: 0px; left: 0px; width: 602px; height: 331px; background: #fff; overflow: hidden;display: none; ">
        
        <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 29px; width: 600px; height: 300px; border: 1px solid gray; -webkit-filter: blur(0px); background-color: #fff; overflow: hidden;">
            <div>
                <div style="margin: 10px; overflow: hidden; color: #000;">Slide 1 content, place any html here.</div>
                <div u="thumb">People</div>
            </div>
            <div>
                <div style="margin: 10px; overflow: hidden; color: #000;">Slide 2 content, place any html here.</div>
                <div u="thumb">Schools</div>
            </div>
            <div>
                <div style="margin: 10px; overflow: hidden; color: #000;">Slide 3 content, place any html here.</div>
                <div u="thumb">Crime</div>
            </div>
            <div>
                <div style="margin: 10px; overflow: hidden; color: #000;">Slide 4 content, place any html here.</div>
                <div u="thumb">Tax</div>
            </div>
            <!--<div>
                <div style="margin: 10px; overflow: hidden; color: #000;">Slide 5 content, place any html here.</div>
                <div u="thumb">Carousel</div>
            </div>-->
        </div>

        <!-- ThumbnailNavigator Skin Begin -->
        <div u="thumbnavigator" class="jssort12" style="position: absolute; width: 500px; height: 30px; left:0px; top: 0px;">
            <!-- Thumbnail Item Skin Begin -->
            <style>
                /* jssor slider thumbnail navigator skin 12 css */
                /*
                .jssort12 .p            (normal)
                .jssort12 .p:hover      (normal mouseover)
                .jssort12 .pav          (active)
                .jssort12 .pav:hover    (active mouseover)
                .jssort12 .pdn          (mousedown)
                */
                .jssort12 .w, .jssort12 .phv .w
                {
                	cursor: pointer;
                	position: absolute;
                	WIDTH: 99px;
                	HEIGHT: 28px;
                	border: 1px solid gray;
                	top: 0px;
                	left: -1px;
                }
                .jssort12 .pav .w, .jssort12 .pdn .w
                {
                	border-bottom: 1px solid #fff;
                }
                .jssort12 .c
                {
                    color: #000;
                    font-size:13px;             	
                }
                .jssort12 .p .c, .jssort12 .pav:hover .c
                {
                	background-color:#eee;
                }
                .jssort12 .pav .c, .jssort12 .p:hover .c, .jssort12 .phv .c
                {
                	background-color:#fff;
                }
            </style>
            <div u="slides" style="cursor: move; top:0px; left:0px; border-left: 1px solid gray;">
                <div u="prototype" class="p" style="POSITION: absolute; WIDTH: 100px; HEIGHT: 30px; TOP: 0; LEFT: 0; padding:0px;">
                    <div class=w><ThumbnailTemplate class="c" style=" WIDTH: 100%; HEIGHT: 100%; position:absolute; TOP: 0; LEFT: 0; line-height:28px; text-align:center;"></ThumbnailTemplate></div>
                </div>
            </div>
            <!-- Thumbnail Item Skin End -->
        </div>
        <!-- ThumbnailNavigator Skin End -->
    </div>


<!-- Jssor Slider End -->

<?php 


?>


</div>
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
                £<?php echo $property_total_price?>            on  <?php echo date("j M Y", strtotime($property_created_date))?> </p>
            <p> <strong>Page views</strong><br />
                Last 30 days: <strong><?php echo $pageViewsCount?></strong>  |        Since listed: <strong><?php echo $pageViewsCount?></strong><br />
                </p>
        </div>
		<form name="f2" method="post" action="">
        <input type="submit" id="savetofavorites" name="savetofavorites" value="Save to favourites" class="btn btn-default btn-block" style="padding:0 0 0 33px; height:36px;"><span class="glyphicon glyphicon-star" style="margin:-26px 0 0 17px; height:20px; float:left; "></span> 
        </form>
        <!--<button type="button" class="btn btn-default btn-block"><span class="glyphicon glyphicon-bell"></span> Create email alert</button>-->
        <button type="button" class="btn btn-default btn-block" id="print"><span class="glyphicon glyphicon-print"></span>&nbsp;Print this page</button>
        <a href="email.php?&source=<?php echo base64_encode($source)?>&proid=<?php echo base64_encode($proid)?>" style="text-decoration: none;"><button type="button" class="btn btn-default btn-block"><span class="glyphicon glyphicon-envelope"></span> Email a friend</button></a>
        <a href="report.php?proid=<?php echo $_GET['proid']?>" style="text-decoration: none;"><button type="button" class="btn btn-default btn-block"><span class="glyphicon glyphicon-list-alt"></span> Report listing content</button></a>
        
        <form name="f3" method="post" action="">
			<input type="submit" id="hideproperty" name="hideproperty" value="Hide Property" class="btn btn-default btn-block" style="padding:0 0 0 33px; height:36px;"><span class="glyphicon glyphicon-ban-circle" style="margin:-26px 0 0 17px; height:20px; float:left; "></span></button>
        </form>
        
        <div id="addnote"><button id="addnotebutton" type="button" class="btn btn-default btn-block">
			<span class="glyphicon glyphicon-file"></span>
			<?php if(isSessionRegistered('user')){
         
               $tot_property_num=dbQuery("select * from tbl_property_note where property_id=".$addtonote_property_id. " and user_id=".$_SESSION['user']['id']);
			   $property_rows=dbNumRows($tot_property_num);
			   if($property_rows==0) 
			     echo "Add a note"; 
			    else
			     echo "Note Added";
			  }
			  else
			   echo "Add a Note";
			   
			  ?></button>
			  
			  
			  </div>
        <div id="hiddenDiv" class="hiddenDiv_addnote">
         
         <?php 
            if(isSessionRegistered('user')){
         
               $tot_property_num=dbQuery("select * from tbl_property_note where property_id=".$addtonote_property_id. " and user_id=".$_SESSION['user']['id']);
			   $property_rows=dbNumRows($tot_property_num);
				 if($_GET['mode']=="edit"){
				  $id=$_GET['id'];		
				  $tot_property_query=dbQuery("select * from tbl_property_note where id=".$id);
				  $tot_property_rows=dbFetchArray($tot_property_query);   	
				 }   
			  
				  if((empty($_GET['mode']) && $property_rows==0) || $_GET['mode']=="edit"){
				 ?>
					 <form name="f1" method="post">
					   <input type="text" id="txtproperty" name="txtproperty"  value="<?php echo stripslashes($tot_property_rows['property_note']);?>">
					   <input type="hidden" name="mode" value="<?php if($_GET['mode']=="edit"){echo "edit";}?>">
					   <input type="hidden" name="id" value="<?php if($_GET['mode']=="edit"){echo $id;}?>">
					   <input type="hidden" name="source" value="<?php echo base64_decode($_GET['source']) ?>">
					   <input type="hidden" name="proid" value="<?php echo base64_decode($_GET['proid']) ?>">
					   
					   <input type="button" id="cancelbutton" name="cancelbutton" value="Cancel"><input type="submit" id="addeditproperty" name="addeditproperty" value="Save">
					 </form>
					
					<?php }else{?>
         
         
					  <div class="editDelete">
					  
					 <?php while($property_rows=dbFetchArray($tot_property_num)){?>
					     
					   <div class="editDeleteTex"><?php echo stripslashes($property_rows['property_note']);?></div>  
                       <div class="editdeletButton">
					  <a href="details.php?source=<?php echo base64_encode($source)?>&proid=<?php echo base64_encode($proid)?>&mode=edit&id=<?php echo $property_rows['id']?>"><div>Edit</div></a>  
					  <a href="details.php?source=<?php echo base64_encode($source)?>&proid=<?php echo base64_encode($proid)?>&mode=delete&id=<?php echo $property_rows['id']?>"><div>Delete</div></a>  
                      </div>
					  <div><a href="notelistingdetails.php?proid=<?php echo $_GET['proid']?>">See all saved notes</a></div> 
					 <?php }?>   
					 </div>
				      
				   
					<?php }?>
					
					
				<?}else{	
				 	echo "<span>Login first</span>";
				}	
					
					?>
					
					
			</div>
					
				
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
                       <?php 
						$nearByRailStation=dbQuery("select * from  tbl_nearbystation order by distance limit 0,3");
						
						
                       
                       while($railwayStationInfo=dbFetchArray($nearByRailStation)){
                        if(strpos($railwayStationInfo['station_name'],'Underground') == true || $railwayStationInfo['type']=="subway_station" ){?>
                        <li><span class="custom_glyphicon1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><?php echo $railwayStationInfo['station_name'];?> </li>
                        <?}else{?>
                        <li><span class="custom_glyphicon2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span><?php echo $railwayStationInfo['station_name'];?> </li>
                       
                       <?php }}?> 
                        
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
