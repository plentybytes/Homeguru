<?php $seoId=23;
include('includes/application.php');
   
   $source=base64_decode($_GET['source']);
   $proid=base64_decode($_GET['proid']);
	//echo $_GET["proid"];
	$strProperty=dbQuery("SELECT  * FROM property where property_id='".base64_decode($_GET["proid"])."'");
	$num=dbNumRows($strProperty);
	if($num>0){
	$resultProperty=dbFetchArray($strProperty);
    $addtonote_user_id=$resultProperty['user_id'];
    $strProperty1=dbQuery("SELECT  * FROM user where user_id='".$resultProperty['user_id']."'");
    $resultProperty1=dbFetchArray($strProperty1);
        //print_r($resultProperty1);
	}else{
	redirect(hrefLink("show-property.php","source=".$_GET["source"]));
	}
    
    $property_postal_code=$resultProperty[property_postal_code];
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


$pageViewSql=dbQuery("select * from tbl_pageview where current_time>=".date('Y-m-d', strtotime('-30 days')));
$pageViewsCount=dbNumRows($pageViewSql);	



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
  
 if(!empty($_POST['addeditproperty'])){ 
  $property_note=addslashes($_POST['txtproperty']);
  $sqlDataArray=array('property_id'=>$addtonote_property_id,'user_id'=>$addtonote_user_id,'property_note'=>$property_note);
  dbPerform("tbl_property_note",$sqlDataArray);
  }
 else{ 
  echo "please filled up property";
  
 }	
}

if(isset($_POST['addeditproperty']) && $_POST['mode']=="edit"){
  if(!empty($_POST['addeditproperty'])){ 
     $id=$_POST['id'];
     $property_note=addslashes($_POST['txtproperty']);
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

<script src="css/js/jquery.min.js" type="text/javascript"></script>
<script src="css/js/tabcontent.js" type="text/javascript"></script>
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
<?php $straddtofavorites=dbQuery("SELECT  * FROM tbl_savetofavorites where property_id=".$addtonote_property_id." and user_id=".$addtonote_user_id);
$num=dbNumRows($straddtofavorites);
	if($num>0){
      	
   	
   	echo '<script type="text/javascript"> 
   	 $(document).ready(function() { 
	  $("#savetofavorites").val("Remove Property");	 
	 });
   	  
   	</script>';
}
if(isset($_POST['savetofavorites'])){
    
   if(isSessionRegistered('user')){
    
    $straddtofavorites=dbQuery("SELECT  * FROM tbl_savetofavorites where property_id=".$addtonote_property_id." and user_id=".$addtonote_user_id);
	$num=dbNumRows($straddtofavorites);
	if($num==0){
      $sqlDataArray=array('property_id'=>$addtonote_property_id,'user_id'=>$addtonote_user_id);
	  dbPerform("tbl_savetofavorites",$sqlDataArray);	
   	
   	 echo '<script type="text/javascript"> 
   	 $(document).ready(function() { 
	  $("#savetofavorites").val("Remove Property");	  
	 });
   	  
   	</script>';
   }else{
    dbQuery("delete from tbl_savetofavorites where property_id=".$addtonote_property_id." and user_id".$user_id);
    
     echo '<script type="text/javascript"> 
   	 $(document).ready(function() { 
	  $("#savetofavorites").val("Save to favorites");	 
	 });
   	  
   	</script>';
  
}




}
else
 echo "<script>alert('Login first')</script>";
} 

 ?>
 
<!--hide property --> 
 
<?php $strhideproperty=dbQuery("SELECT  * FROM tbl_propertyhideunhide where property_id=".$addtonote_property_id." and user_id=".$addtonote_user_id);
$num=dbNumRows($strhideproperty);
	if($num>0){
      	
   	
   	echo '<script type="text/javascript"> 
   	 $(document).ready(function() { 
	  $("#hideproperty").val("Unhide Property");	 
	 });
   	  
   	</script>';
}
if(isset($_POST['hideproperty'])){
    
   if(isSessionRegistered('user')){
    
    $strhideproperty=dbQuery("SELECT  * FROM tbl_propertyhideunhide where property_id=".$addtonote_property_id." and user_id=".$addtonote_user_id);
	$num=dbNumRows($strhideproperty);
	if($num==0){
      $sqlDataArray=array('property_id'=>$addtonote_property_id,'user_id'=>$addtonote_user_id);
	  dbPerform("tbl_propertyhideunhide",$sqlDataArray);	
   	
   	 echo '<script type="text/javascript"> 
   	 $(document).ready(function() { 
	  $("#hideproperty").val("Unhide Property");	  
	 });
   	  
   	</script>';
   }else{
    dbQuery("delete from tbl_propertyhideunhide where property_id=".$addtonote_property_id." and user_id".$user_id);
    
     echo '<script type="text/javascript"> 
   	 $(document).ready(function() { 
	  $("#hideproperty").val("Hide Property");	 
	 });
   	  
   	</script>';
  
}




}
else
 echo "<script>alert('Login first')</script>";
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

<div id="tcontent5" style="display:;">

<div style="width:645px;">
<h3>What  users think of N17</h3>
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
</div>
        
        
        <h3>Nearby transport</h3>
        <div class="clear"></div>
			<div class="nearby_stations_schools clearfix split-one-third" style="text-align:left;">
				<ul>
        
        <?php
         
$json="https://maps.googleapis.com/maps/api/place/search/json?location=".$LatLng."&radius=8000.0000&types=train_station&name=&sensor=true&key=AIzaSyD_iNxxxoS4Yg_FRg2r_KkXYVFaO2SDHUY";
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $json);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_ENCODING, "");
$curlData = curl_exec($curl);
curl_close($curl);
$data = json_decode($curlData,true);




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
    <span style="display:block;position:relative;top:-36px;text-align:right;margin-bottom:-15px;"><a href="http://www.zoopla.co.uk/schools/primary/haringey"><span>View all schools in Haringey</span></a></span>
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
<h2>Local info for Haringey</h2>
<div class="clear"></div>
<div id="local-info-la-stats" class="tabs ui-tabs ui-tabs-widget ui-widget ui-widget-content ui-corner-all">
    <div class="fright noprint"><a href="http://www.zoopla.co.uk/property/compare-local-authority-stats/?postcode=N176UW" class="tabs-right-link" rel="nofollow">Compare to another area</a></div>
    <ul role="tablist" class="clearfix ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
    <li aria-selected="false" aria-labelledby="ui-id-11" aria-controls="ui-tabs-6" tabindex="-1" role="tab" class="ui-state-default ui-corner-top"><a id="ui-id-11" tabindex="-1" role="presentation" class="ui-tabs-anchor" data-ga-category="Local info - LA stats" data-ga-action="Schools" data-ga-label="/tracking/for-sale/details/" href="http://www.zoopla.co.uk/widgets/local-info/local-authority-stats-chart.html?outcode=N17&amp;incode=6UW&amp;category=education" data-category="education"><span>People</span></a></li>
        <li aria-selected="false" aria-labelledby="ui-id-12" aria-controls="ui-tabs-7" tabindex="-1" role="tab" class="ui-state-default ui-corner-top"><a id="ui-id-12" tabindex="-1" role="presentation" class="ui-tabs-anchor" data-ga-category="Local info - LA stats" data-ga-action="Crime" data-ga-label="/tracking/for-sale/details/" href="http://www.zoopla.co.uk/widgets/local-info/local-authority-stats-chart.html?outcode=N17&amp;incode=6UW&amp;category=crime" data-category="crime"><span>School</span></a></li>
        <li aria-selected="false" aria-labelledby="ui-id-13" aria-controls="ui-tabs-8" tabindex="-1" role="tab" class="ui-state-default ui-corner-top"><a id="ui-id-13" tabindex="-1" role="presentation" class="ui-tabs-anchor" data-ga-category="Local info - LA stats" data-ga-action="Tax" data-ga-label="/tracking/for-sale/details/" href="http://www.zoopla.co.uk/widgets/local-info/local-authority-stats-chart.html?outcode=N17&amp;incode=6UW&amp;category=counciltax" data-category="counciltax"><span>Crime</span></a></li>
              <li aria-selected="false" aria-labelledby="ui-id-14" aria-controls="ui-tabs-9" tabindex="-1" role="tab" class="ui-state-default ui-corner-top"><a id="ui-id-13" tabindex="-1" role="presentation" class="ui-tabs-anchor" data-ga-category="Local info - LA stats" data-ga-action="Tax" data-ga-label="/tracking/for-sale/details/" href="http://www.zoopla.co.uk/widgets/local-info/local-authority-stats-chart.html?outcode=N17&amp;incode=6UW&amp;category=counciltax" data-category="counciltax"><span>Tax</span></a></li>
    </ul>

    
<?php /* $curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, 'http://api.zoopla.co.uk/api/v1/local_info_graphs.js?area=N15&api_key=c9uvdbq6mu3q4jjz9nsvn835');
//curl_setopt($curl, CURLOPT_POSTFIELDS, $sendData);
//curl_setopt($curl, CURLOPT_POST, true);
//curl_setopt($curl, CURLOPT_HTTPGET, true);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$raw_json = curl_exec($curl);
curl_close($curl);

$graph_info = json_decode($raw_json, true);*/

    
?>    
    <div aria-hidden="true" aria-expanded="false" style="display:block;" role="tabpanel" aria-labelledby="ui-id-11" aria-live="polite" class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="ui-tabs-6"><img src="<?php echo $graph_info['people_graph_url']?>" width="400" height="300" alt=""></div>
    <div aria-hidden="true" aria-expanded="false" style="display: none;" role="tabpanel" aria-labelledby="ui-id-12" aria-live="polite" class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="ui-tabs-7"><img src="<?php echo $graph_info['education_graph_url']?>" width="400" height="300" alt=""></div>
    <div aria-hidden="true" aria-expanded="false" style="display: none;" role="tabpanel" aria-labelledby="ui-id-13" aria-live="polite" class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="ui-tabs-8"><img src="<?php echo $graph_info['crime_graph_url']?>" width="400" height="300" alt=""></div>
    <div aria-hidden="true" aria-expanded="false" style="display: none;" role="tabpanel" aria-labelledby="ui-id-13" aria-live="polite" class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="ui-tabs-9"><img src="<?php echo $graph_info['council_tax_graph_url']?>" width="400" height="300" alt=""></div>
    
</div>          
<h2>About the neighbours in N17</h2>
<div class="clear"></div>
<div id="local-info-neighbours" class="tabs ui-tabs ui-tabs-widget ui-widget ui-widget-content ui-corner-all">
    <div class="fright noprint"><a href="http://www.zoopla.co.uk/property/compare-neighbours/?postcode=N17%206UW" class="tabs-right-link" rel="nofollow">Compare to another area</a></div>
    <ul role="tablist" class="clearfix ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all">
        <li aria-selected="true" aria-labelledby="ui-id-14" aria-controls="neighbours-info-housing" tabindex="0" 
        role="tab" class="ui-state-default ui-corner-top ui-tabs-active ui-state-active">
        <a id="ui-id-14" tabindex="-1" role="presentation" data-ga-category="Local info - Neighbours" 
        data-ga-action="Housing" data-ga-label="/tracking/for-sale/details/" class="ui-tabs-active ui-tabs-anchor" 
        href="#neighbours-info-housing" data-category="housing"><span>Housing</span></a></li>
        <li aria-selected="false" aria-labelledby="ui-id-15" aria-controls="ui-tabs-9" tabindex="-1" role="tab" class="ui-state-default ui-corner-top"><a id="ui-id-15" tabindex="-1" role="presentation" class="ui-tabs-anchor" data-ga-category="Local info - Neighbours" data-ga-action="Employment" data-ga-label="/tracking/for-sale/details/" href="http://www.zoopla.co.uk/widgets/local-info/neighbours-chart.html?outcode=N17&amp;incode=6UW&amp;category=Employment" data-category="employment"><span>Employment</span></a></li>
        <li aria-selected="false" aria-labelledby="ui-id-16" aria-controls="ui-tabs-10" tabindex="-1" role="tab" class="ui-state-default ui-corner-top"><a id="ui-id-16" tabindex="-1" role="presentation" class="ui-tabs-anchor" data-ga-category="Local info - Neighbours" data-ga-action="Family" data-ga-label="/tracking/for-sale/details/" href="http://www.zoopla.co.uk/widgets/local-info/neighbours-chart.html?outcode=N17&amp;incode=6UW&amp;category=Family" data-category="family"><span>Family</span></a></li>
        <li aria-selected="false" aria-labelledby="ui-id-17" aria-controls="ui-tabs-11" tabindex="-1" role="tab" class="ui-state-default ui-corner-top"><a id="ui-id-17" tabindex="-1" role="presentation" class="ui-tabs-anchor" data-ga-category="Local info - Neighbours" data-ga-action="Interests" data-ga-label="/tracking/for-sale/details/" href="http://www.zoopla.co.uk/widgets/local-info/neighbours-chart.html?outcode=N17&amp;incode=6UW&amp;category=Interests" data-category="interests"><span>Interests</span></a></li>
        <li aria-selected="false" aria-labelledby="ui-id-18" aria-controls="ui-tabs-12" tabindex="-1" role="tab" class="ui-state-default ui-corner-top"><a id="ui-id-18" tabindex="-1" role="presentation" class="ui-tabs-anchor" data-ga-category="Local info - Neighbours" data-ga-action="Newspapers" data-ga-label="/tracking/for-sale/details/" href="http://www.zoopla.co.uk/widgets/local-info/neighbours-chart.html?outcode=N17&amp;incode=6UW&amp;category=Newspapers" data-category="newspapers"><span>Newspapers</span></a></li>

    </ul>
    <div aria-hidden="false" aria-expanded="true" role="tabpanel" aria-labelledby="ui-id-14" id="neighbours-info-housing" class="ui-tabs-panel ui-widget-content ui-corner-bottom">
        <div data-highcharts-chart="0" id="neighbours-housing"><div style="position: relative; overflow: hidden; width: 583px; height: 300px; text-align: left; line-height: normal; z-index: 0; font-family: sans-serif; font-size: 12px; left: 0px; top: 0px;" id="highcharts-0" class="highcharts-container"><svg height="300" width="583" xmlns="http://www.w3.org/2000/svg" style="font-family:sans-serif;font-size:12px;" version="1.1"><desc>Created with Highcharts 4.0.0</desc><defs><clipPath id="highcharts-1"><rect height="372" width="220" y="0" x="0"></rect></clipPath></defs><rect class=" highcharts-background" fill="rgba(255, 255, 255, 0)" strokeWidth="0" height="300" width="583" y="0" x="0"></rect><g zIndex="1" class="highcharts-grid"></g><g zIndex="1" class="highcharts-grid"><path opacity="1" zIndex="1" stroke-dasharray="NaN" stroke-width="1" stroke="#dedede" d="M 254.5 20 L 254.5 240" fill="none"></path><path opacity="1" zIndex="1" stroke-dasharray="NaN" stroke-width="1" stroke="#dedede" d="M 329.5 20 L 329.5 240" fill="none"></path><path opacity="1" zIndex="1" stroke-dasharray="NaN" stroke-width="1" stroke="#dedede" d="M 403.5 20 L 403.5 240" fill="none"></path><path opacity="1" zIndex="1" stroke-dasharray="NaN" stroke-width="1" stroke="#dedede" d="M 478.5 20 L 478.5 240" fill="none"></path><path opacity="1" zIndex="1" stroke-dasharray="NaN" stroke-width="1" stroke="#dedede" d="M 553.5 20 L 553.5 240" fill="none"></path><path opacity="1" zIndex="1" stroke-dasharray="NaN" stroke-width="1" stroke="#dedede" d="M 180.5 20 L 180.5 240" fill="none"></path></g><g zIndex="2" class="highcharts-axis"><path opacity="1" stroke-width="1" stroke="#C0D0E0" d="M 181 57.5 L 171 57.5" fill="none"></path><path opacity="1" stroke-width="1" stroke="#C0D0E0" d="M 181 93.5 L 171 93.5" fill="none"></path><path opacity="1" stroke-width="1" stroke="#C0D0E0" d="M 181 130.5 L 171 130.5" fill="none"></path><path opacity="1" stroke-width="1" stroke="#C0D0E0" d="M 181 167.5 L 171 167.5" fill="none"></path><path opacity="1" stroke-width="1" stroke="#C0D0E0" d="M 181 203.5 L 171 203.5" fill="none"></path><path opacity="1" stroke-width="1" stroke="#C0D0E0" d="M 181 240.5 L 171 240.5" fill="none"></path><path opacity="undefined" stroke-width="1" stroke="#C0D0E0" d="M 181 19.5 L 171 19.5" fill="none"></path><path visibility="visible" zIndex="7" stroke-width="1" stroke="#dedede" d="M 180.5 20 L 180.5 240" fill="none"></path></g><g zIndex="2" class="highcharts-axis"><text y="278" visibility="visible" style="color:#999999;fill:#999999;" class=" highcharts-yaxis-title" transform="translate(0,0)" text-anchor="middle" zIndex="7" x="367">Index</text></g><path zIndex="2" stroke-width="2" stroke="#FF0000" d="M 330 20 L 330 240" fill="none"></path><text visibility="visible" y="15" style="color:#999999;font-size:11px;fill:#999999;" transform="translate(0,0)" zIndex="2" text-anchor="middle" x="334"><tspan>UK Average</tspan></text><g zIndex="3" class="highcharts-series-group"><g clip-path="url(#highcharts-1)" height="220" width="372" style="" transform="translate(553,240) rotate(90) scale(-1,1) scale(1 1)" zIndex="0.1" visibility="visible" class="highcharts-series highcharts-tracker"><rect stroke-width="1" ry="0" rx="0" fill="#d64521" stroke="#FFFFFF" height="98" width="18" y="274.5" x="192.5"></rect><rect stroke-width="1" ry="0" rx="0" fill="#d64521" stroke="#FFFFFF" height="129" width="18" y="243.5" x="155.5"></rect><rect stroke-width="1" ry="0" rx="0" fill="#d64521" stroke="#FFFFFF" height="292" width="18" y="80.5" x="119.5"></rect><rect stroke-width="1" ry="0" rx="0" fill="#d64521" stroke="#FFFFFF" height="155" width="18" y="217.5" x="82.5"></rect><rect stroke-width="1" ry="0" rx="0" fill="#d64521" stroke="#FFFFFF" height="190" width="18" y="182.5" x="45.5"></rect><rect stroke-width="1" ry="0" rx="0" fill="#d64521" stroke="#FFFFFF" height="283" width="18" y="89.5" x="9.5"></rect></g><g clip-path="none" height="220" width="372" transform="translate(553,240) rotate(90) scale(-1,1) scale(1 1)" zIndex="0.1" visibility="visible" class="highcharts-markers"></g></g><g zIndex="7" class="highcharts-legend"><g zIndex="1"><g></g></g></g><g zIndex="7" class="highcharts-axis-labels highcharts-xaxis-labels"><text opacity="1" y="43.83333333333336" style="width:172px;color:#606060;cursor:default;font-size:11px;fill:#606060;" text-anchor="end" x="166"><tspan>Owned (no mortgage)</tspan></text><text opacity="1" y="80.50000000000001" style="width:172px;color:#606060;cursor:default;font-size:11px;fill:#606060;" text-anchor="end" x="166"><tspan>Owned (with mortgage)</tspan></text><text opacity="1" y="117.16666666666667" style="width:172px;color:#606060;cursor:default;font-size:11px;fill:#606060;" text-anchor="end" x="166"><tspan>Shared ownership</tspan></text><text opacity="1" y="153.8333333333333" style="width:172px;color:#606060;cursor:default;font-size:11px;fill:#606060;" text-anchor="end" x="166"><tspan>Local Authority rented</tspan></text><text opacity="1" y="190.49999999999997" style="width:172px;color:#606060;cursor:default;font-size:11px;fill:#606060;" text-anchor="end" x="166"><tspan>Housing Association rented</tspan></text><text opacity="1" y="227.16666666666666" style="width:172px;color:#606060;cursor:default;font-size:11px;fill:#606060;" text-anchor="end" x="166"><tspan>Private rented</tspan></text></g><g zIndex="7" class="highcharts-axis-labels highcharts-yaxis-labels"><text opacity="1" y="260" style="color:#606060;cursor:default;font-size:11px;fill:#606060;" text-anchor="middle" x="185.5">0</text><text opacity="1" y="260" style="color:#606060;cursor:default;font-size:11px;fill:#606060;" text-anchor="middle" x="255.4">50</text><text opacity="1" y="260" style="color:#606060;cursor:default;font-size:11px;fill:#606060;" text-anchor="middle" x="329.8">100</text><text opacity="1" y="260" style="color:#606060;cursor:default;font-size:11px;fill:#606060;" text-anchor="middle" x="404.2">150</text><text opacity="1" y="260" style="color:#606060;cursor:default;font-size:11px;fill:#606060;" text-anchor="middle" x="478.6">200</text><text opacity="1" y="260" style="color:#606060;cursor:default;font-size:11px;fill:#606060;" text-anchor="middle" x="542.5">250</text></g><g transform="translate(0,-9999)" style="cursor:default;padding:0;white-space:nowrap;" zIndex="8" class="highcharts-tooltip"><path stroke-width="1" d="M 3 0 L 13 0 C 16 0 16 0 16 3 L 16 13 C 16 16 16 16 13 16 L 3 16 C 0 16 0 16 0 13 L 0 3 C 0 0 0 0 3 0" fill="#eee"></path><text y="21" style="font-size:12px;color:#000;fill:#000;" zIndex="1" x="8"></text></g><text y="295" style="cursor:pointer;color:#cccccc;font-size:9px;fill:#cccccc;" zIndex="8" text-anchor="end" x="573"><tspan>Source: CACI Ltd.</tspan></text></svg></div></div>
<script>
</script>
    </div><div aria-hidden="true" aria-expanded="false" style="display: none;" role="tabpanel" aria-labelledby="ui-id-15" aria-live="polite" class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="ui-tabs-9"></div><div aria-hidden="true" aria-expanded="false" style="display: none;" role="tabpanel" aria-labelledby="ui-id-16" aria-live="polite" class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="ui-tabs-10"></div><div aria-hidden="true" aria-expanded="false" style="display: none;" role="tabpanel" aria-labelledby="ui-id-17" aria-live="polite" class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="ui-tabs-11"></div><div aria-hidden="true" aria-expanded="false" style="display: none;" role="tabpanel" aria-labelledby="ui-id-18" aria-live="polite" class="ui-tabs-panel ui-widget-content ui-corner-bottom" id="ui-tabs-12"></div>
</div>                   
<div class="js-find-my-nearest find-my-nearest bottom">
    <h2>Local tradesmen/services nearby</h2>
    <div class="clear"></div>
    <div class="top">
        <select class="js-find-my-nearest-select text" style="width: 260px; float:left;">
            <option selected="selected" value="_default">All services</option>
                <option value="domestic_appliances_servicing_repairs">Appliance Repairs</option>
                <option value="domestic_appliances_retailers">Appliance Retailer</option>
                <option value="architects">Architect</option>
                <option value="architectural_services">Architectural Service</option>
                <option value="bathroom_planners_installers">Bathroom Designer</option>
                <option value="bed_bedding_retailers">Bed &amp; Bedding Shop</option>
                <option value="bedroom_planners_furnishers">Bedroom Designer</option>
                <option value="boiler_servicing_repairs">Boiler Repair &amp; Servicer</option>
                <option value="bricklayers">Bricklayer</option>
                <option value="builders">Builder</option>
                <option value="building_surveyors">Building Surveyor</option>
                <option value="carpenters">Carpenter</option>
                <option value="joiners_carpenters">Carpenters &amp; Joiners</option>
                <option value="carpet_cleaners">Carpet &amp; Rugs Shop</option>
                <option value="carpet_fitting_services">Carpet Cleaner</option>
                <option value="carpet_rug_retailers">Carpet Fitter</option>
                <option value="curtain_suppliers">Curtain Supplier</option>
                <option value="damp_dry_rot_services">Damp &amp; Dry Rot Service</option>
                <option value="diy_shops">DIY Shop</option>
                <option value="double_glazing_installers">Double Glazing Installer</option>
                <option value="drainage_contractors">Drain &amp; Sewer Services</option>
                <option value="drain_sewer_services">Drainage Contractor</option>
                <option value="electrical_product_retailers">Electrician</option>
                <option value="electricians">Electronic Shop</option>
                <option value="flooring_services">Flooring Services</option>
                <option value="floorcovering_retailers">Flooring Store</option>
                <option value="furniture_designers">Furniture Designers</option>
                <option value="furniture_retailers">Furniture Stores</option>
                <option value="garden_centres">Garden Centres</option>
                <option value="gas_service_engineers">Gas Engineers</option>
                <option value="gas_installers">Gas Installers</option>
                <option value="interior_designers">Interior Designers</option>
                <option value="key_cutting_services">Key Cutting Services</option>
                <option value="kitchen_planners_installers">Kitchen Designers &amp; Installers</option>
                <option value="lighting_retailers">Lighting Stores</option>
                <option value="locksmiths">Locksmiths</option>
                <option value="loft_converters">Loft Converters</option>
                <option value="painters_and_decorators">Painters &amp; Decorators</option>
                <option value="paving_contractors">Paving Contractors</option>
                <option value="plasterers">Plasterers</option>
                <option value="plumbers">Plumbers</option>
                <option value="property_maintenance_services">Property Maintenance Services</option>
                <option value="removals_storage_services">Removals &amp; Storage Services</option>
                <option value="roofing_contractors">Roofing Contractors</option>
                <option value="burglar_alarm_systems">Security systems</option>
                <option value="glaziers">Window Replacement &amp; Glaziers</option>
        </select>
        near <input class="js-find-my-nearest-input text gt-inline-label" value="N17" title="N17" style="width: 260px;">
        <button class="js-find-my-nearest-action btn btn-primary" style="padding: .2em .4em;">Search</button>
    </div>
    <div class="js-find-my-nearest-results find-my-nearest-results">
        <ul class="find-my-nearest-results-ul">
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Lordship Windows Ltd</b><span class="small"> in Double Glazing Installer</span><br>
            <b style="font-size: 1.1em;">020 8885 3702</b><br>
            35-37 Lordship Lane, London N17 6RU</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.03 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">The Cheaper Removals</b><span class="small"> in Removals &amp; Storage Services</span><br>
            <b style="font-size: 1.1em;">07858 426945</b><br>
            35 Newlyn Road, London N17 6RX</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.06 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Sarch Studio</b><span class="small"> in Architectural Service</span><br>
            <b style="font-size: 1.1em;">07947 743207</b><br>
            56a Bruce Grove, London N17 6RN</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.12 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Mak Builders</b><span class="small"> in Builder</span><br>
            <b style="font-size: 1.1em;">07900 247384</b><br>
            89 Pembury Road, London N17 8LY</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.14 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Dial An Electrician Ltd</b><span class="small"> in Electronic Shop</span><br>
            <b style="font-size: 1.1em;">020 8801 9111</b><br>
            72 Bruce Grove, London N17 6UZ</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.14 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Ozgurcan Ltd</b><span class="small"> in Curtain Supplier</span><br>
            <b style="font-size: 1.1em;">020 8885 1467</b><br>
            634 High Road, London N17 9TP</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.18 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Ugur Guler Interior &amp; Exterior Design</b><span class="small"> in Interior Designers</span><br>
            <b style="font-size: 1.1em;">07914 138196</b><br>
            17 The Avenue, London N17 6TB</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.20 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Homeland Carpets</b><span class="small"> in Carpet Fitter</span><br>
            <b style="font-size: 1.1em;">020 8808 0088</b><br>
            545 High Road, London N17 6SB</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.22 miles</b> <span class="small">from this property</span></span>
        </li
        ><li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Ugur Guler Interior &amp; Exterior Design</b><span class="small"> in Interior Designers</span><br>
            <b style="font-size: 1.1em;">07914 138196</b><br>
            17 The Avenue, London N17 6TB</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.23 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Car Door Open</b><span class="small"> in Locksmiths</span><br>
            <b style="font-size: 1.1em;">020 3394 0711</b><br>
            Lansdowne Road, London N17 9XE</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.23 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Mr Locksmiths</b><span class="small"> in Locksmiths</span><br>
            <b style="font-size: 1.1em;">0844 411 7292</b><br>
            Lansdown Road, London N17 0LL</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.24 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Collins Carpets</b><span class="small"> in Carpet Fitter</span><br>
            <b style="font-size: 1.1em;">020 8493 0707</b><br>
            690 High Road, London N17 0AE</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.26 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Daniel Iliev</b><span class="small"> in Builder</span><br>
            <b style="font-size: 1.1em;">07931 351238</b><br>
            265 Mount Pleasant Road, London N17 6HD</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.30 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Mr Locksmiths</b><span class="small"> in Locksmiths</span><br>
            <b style="font-size: 1.1em;">0844 411 7292</b><br>
            Lansdown Road, London N17 0LL</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.31 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">North City Locksmith</b><span class="small"> in Locksmiths</span><br>
            <b style="font-size: 1.1em;">020 3553 4737</b><br>
            223 Mount Pleasant Road, London N17 6JH</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.32 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">K J Builders</b><span class="small"> in Builder</span><br>
            <b style="font-size: 1.1em;">020 8808 5309</b><br>
            40 Parkhurst Road, London N17 9RA</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.33 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Crsytal Heating &amp; Plumbing</b><span class="small"> in Plumbers</span><br>
            <b style="font-size: 1.1em;">020 3583 6224</b><br>
            Flat A, 54 Dowsett Road, London N17 9DD</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.33 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Cosy Home Bargains Ltd</b><span class="small"> in Bed &amp; Bedding Shop</span><br>
            <b style="font-size: 1.1em;">020 8880 9057</b><br>
            492 High Road, London N17 9JF</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.35 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">24 Hour Emergency Locksmith</b><span class="small"> in Locksmiths</span><br>
            <b style="font-size: 1.1em;">020 3384 8041</b><br>
            122 High Road, Totternham, London N17 9JF</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.35 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Safari Electrical</b><span class="small"> in Electronic Shop</span><br>
            <b style="font-size: 1.1em;">07957 268610</b><br>
            Flat 10 Rydal Lodge, Vicarage Road, London N17 0BJ</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.43 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Bird &amp; Wedge</b><span class="small"> in Roofing Contractors</span><br>
            <b style="font-size: 1.1em;">020 8808 2812</b><br>
            Wedge House, White Hart Lane, London N17 8HJ</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.46 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Greens Roofing</b><span class="small"> in Roofing Contractors</span><br>
            <b style="font-size: 1.1em;">07957 646086</b><br>
            59 Sutherland Road, London N17 0BN</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.46 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">K &amp; M Stores</b><span class="small"> in DIY Shop</span><br>
            <b style="font-size: 1.1em;">020 8885 5489</b><br>
            745 High Road, London N17 8AH</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.47 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">C C T V Securityland</b><span class="small"> in Security systems</span><br>
            <b style="font-size: 1.1em;">020 3092 9151</b><br>
            3 White Hart Terrace, White Hart Lane, London N17 8HN</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.51 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">K &amp; M Stores</b><span class="small"> in DIY Shop</span><br>
            <b style="font-size: 1.1em;">020 8885 5489</b><br>
            745 High Road, London N17 8AH</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.51 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Newmay Electrical Services</b><span class="small"> in Electronic Shop</span><br>
            <b style="font-size: 1.1em;">020 8808 0867</b><br>
            Unit 5 Carbery Enterprise Park, 36 White Hart Lane, London N17 8DP</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.53 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Tynan J Painter &amp; Decorator</b><span class="small"> in Painters &amp; Decorators</span><br>
            <b style="font-size: 1.1em;">020 8808 6118</b><br>
            137 Somerset Gardens, London N17 8JX</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.53 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Greens Roofing</b><span class="small"> in Roofing Contractors</span><br>
            <b style="font-size: 1.1em;">07957 646086</b><br>
            59 Sutherland Road, London N17 0BN</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.53 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">F I Scanlon &amp; Co</b><span class="small"> in Builder</span><br>
            <b style="font-size: 1.1em;">020 8801 6691</b><br>
            20 Mount Pleasant Road, London N17 6TN</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.55 miles</b> <span class="small">from this property</span></span>
        </li>
        <li class="find-my-nearest-results-li">
            <span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">Newmay Electrical Services Ltd</b><span class="small"> in Electronic Shop</span><br>
            <b style="font-size: 1.1em;">020 8801 1723</b><br>
            Unit 5 Carbery Enterprise Park, White Hart Lane, London N17 8DP</span>
            <span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">0.55 miles</b> <span class="small">from this property</span></span>
        </li>
        </ul>
    </div>
</div>
 </div>
        <script src="css/js/jquery.js"></script>
        <script src="css/js/main.js"></script>
        <script>

    $(function() {
        $('.ui-tabs').tabs({ spinner: '', cache: true });
        load_script('http://c.zoocdn.com/static/1401276535/www/_b/scripts/widgets/photos.js');
        load_script('http://c.zoocdn.com/static/1384343009/www/_b/scripts/widgets/rate-local-area.js');
        ZPG.util_textarea.init();
        $("#mlt ul").jcarousel({ wrap: 'circular', animation: 800 });
    if (typeof ZPG !== 'undefined') {
        ZPG.highchart.init({
            chartType: 'bar',
            creditsText: 'Source: CACI Ltd.',
            yAxisTitle: 'Index',
            title: null,
            showUkAverageLine: true,
            domId: 'neighbours-' + ( $('#local-info-neighbours li.ui-tabs-active a').attr('data-category') || 'housing'),
            categories: ["Owned (no mortgage)","Owned (with mortgage)","Shared ownership","Local Authority rented","Housing Association rented","Private rented"],
            series: [{
                showInLegend: false,
                data: [66,87,196,104,128,190]

            }]

        });

    }
var seriesArr = [
                    {
                        name: 'Haringey',
                        showInLegend: true,
                        data: [19.27,12.98,22.2,16.8,12.19,7.79,8.77]
                    },
                    {
                        name: 'National average (England and Wales)',
                        showInLegend: true,
                        data: [17.64,13.1,13.41,13.97,13.74,11.7,16.45]
                    },

                {}
            ];
seriesArr.pop();
if (typeof ZPG !== 'undefined') {
    ZPG.highchart.init({
        chartType: 'column',
        yAxisTitle: '%',
        creditsText: 'Source: UK Census Data',
        showUkAverageLine: false,
        title: 'Population breakdown in Haringey (2012)',
        domId: 'local-authority-stats-' + ( $('#local-info-la-stats li.ui-tabs-active a').attr('data-category') || 'demographic'),
        categories: ["0-14","15-24","25-34","35-44","45-54","55-64","65+"],
        series: seriesArr
    });
}
      
var prefilled_address = '';

$('#msg_body_postcode, #msg_body_address').parent().hide();
$('select[name=msg_body_about_me]').change(function(){
    if (  $(this).val() == 'property_to_sell' || $(this).val() == 'property_to_let' ) {
            
        $('#msg_body_postcode').parent().show();
        $('#msg_body_postcode').rules( "add", {
            required:true, 
            generalPostcode:true
        });
            
    } else {
            
        $('#msg_body_postcode, #msg_body_address').val('').parent().hide();
        $('#msg_body_postcode').rules( "remove" );
            
    }
}).trigger('change');

$('#msg_body_postcode').autocomplete({

    source: function(req, add) {

        $.getJSON('/ajax/postcode_lookup.js', req, function(data) {

            var suggestions = [];

            $.each(data, function(i, val) {

                suggestions.push(val.postcode);

            });

            add(suggestions);

        });
    },
    select: function( event, ui ) {
            
        contact_agent_postcode_lookup( ui.item.value, prefilled_address );
            
    }

}).blur(function() {
            
    if ( $(this).val() ) {
            
        contact_agent_postcode_lookup( $(this).val(), prefilled_address );
                
    } else {
                
        $('#msg_body_address').val('').parent().hide();
                
    }
           
});
        
if ( $('#msg_body_postcode').val() ) {
        
    contact_agent_postcode_lookup( $('#msg_body_postcode').val(), prefilled_address);
                  
} 


        

jQuery('.js-find-my-nearest').on('click', '.js-find-my-nearest-action', function(e) {

    var $this = jQuery(this),
        query = {
        'business_type': jQuery('.js-find-my-nearest-select option:selected').attr('value'),
        'outcode': jQuery('.js-find-my-nearest-input').attr('value')
        },
        template = [
            '<li class="find-my-nearest-results-li">',
                '<span style="margin-right: 100px; display: block;"><b style="font-size: 1.1em;">$business->{name}</b>$business->{poi_type}<br />',
                '<b style="font-size: 1.1em;">$business->{phone}</b><br />',
                '$business->{address} $business->{postcode}</span>',
                '<span class="find-my-nearest-results-dist"><b style="font-size: 1.1em; display: block;">$business->{dist} miles</b></span>',
            '</li>'
        ].join(' '),
        business_types = [{"seo_description":"Appliance Repairs","description":"Domestic Appliances Servicing/Repairs","poi_type":"domestic_appliances_servicing_repairs"},{"seo_description":"Appliance Retailer","description":"Domestic Appliances Retailer","poi_type":"domestic_appliances_retailers"},{"seo_description":"Architect","description":"Architect","poi_type":"architects"},{"seo_description":"Architectural Service","description":"Architectural Service","poi_type":"architectural_services"},{"seo_description":"Bathroom Designer","description":"Bathroom Planner/Installer","poi_type":"bathroom_planners_installers"},{"seo_description":"Bed & Bedding Shop","description":"Bed/Bedding Retailer","poi_type":"bed_bedding_retailers"},{"seo_description":"Bedroom Designer","description":"Bedroom Planner/Furnisher","poi_type":"bedroom_planners_furnishers"},{"seo_description":"Boiler Repair & Servicer","description":"Boiler Servicing/Repairs","poi_type":"boiler_servicing_repairs"},{"seo_description":"Bricklayer","description":"Bricklayer","poi_type":"bricklayers"},{"seo_description":"Builder","description":"Builder","poi_type":"builders"},{"seo_description":"Building Surveyor","description":"Building Surveyor","poi_type":"building_surveyors"},{"seo_description":"Carpenter","description":"Carpenter","poi_type":"carpenters"},{"seo_description":"Carpenters & Joiners","description":"Joiners/Carpenters","poi_type":"joiners_carpenters"},{"seo_description":"Carpet & Rugs Shop","description":"Carpet/Rug Retailer","poi_type":"carpet_cleaners"},{"seo_description":"Carpet Cleaner","description":"Carpet Cleaner","poi_type":"carpet_fitting_services"},{"seo_description":"Carpet Fitter","description":"Carpet Fitting Service","poi_type":"carpet_rug_retailers"},{"seo_description":"Curtain Supplier","description":"Curtain Supplier","poi_type":"curtain_suppliers"},{"seo_description":"Damp & Dry Rot Service","description":"Damp/Dry Rot Service","poi_type":"damp_dry_rot_services"},{"seo_description":"DIY Shop","description":"DIY Shop","poi_type":"diy_shops"},{"seo_description":"Double Glazing Installer","description":"Double Glazing Installers","poi_type":"double_glazing_installers"},{"seo_description":"Drain & Sewer Services","description":"Drain/Sewer Services","poi_type":"drainage_contractors"},{"seo_description":"Drainage Contractor","description":"Drainage Contractors","poi_type":"drain_sewer_services"},{"seo_description":"Electrician","description":"Electricians","poi_type":"electrical_product_retailers"},{"seo_description":"Electronic Shop","description":"Electrical Product Retailers","poi_type":"electricians"},{"seo_description":"Flooring Services","description":"Flooring Services","poi_type":"flooring_services"},{"seo_description":"Flooring Store","description":"Floorcovering Retailers","poi_type":"floorcovering_retailers"},{"seo_description":"Furniture Designers","description":"Furniture Designers","poi_type":"furniture_designers"},{"seo_description":"Furniture Stores","description":"Furniture Retailers","poi_type":"furniture_retailers"},{"seo_description":"Garden Centres","description":"Garden Centres","poi_type":"garden_centres"},{"seo_description":"Gas Engineers","description":"Gas Service Engineers","poi_type":"gas_service_engineers"},{"seo_description":"Gas Installers","description":"Gas Installers","poi_type":"gas_installers"},{"seo_description":"Interior Designers","description":"Interior Designers","poi_type":"interior_designers"},{"seo_description":"Key Cutting Services","description":"Key Cutting Services","poi_type":"key_cutting_services"},{"seo_description":"Kitchen Designers & Installers","description":"Kitchen Planners/Installers","poi_type":"kitchen_planners_installers"},{"seo_description":"Lighting Stores","description":"Lighting Retailers","poi_type":"lighting_retailers"},{"seo_description":"Locksmiths","description":"Locksmiths","poi_type":"locksmiths"},{"seo_description":"Loft Converters","description":"Loft Converters","poi_type":"loft_converters"},{"seo_description":"Painters & Decorators","description":"Painters and Decorators","poi_type":"painters_and_decorators"},{"seo_description":"Paving Contractors","description":"Paving Contractors","poi_type":"paving_contractors"},{"seo_description":"Plasterers","description":"Plasterers","poi_type":"plasterers"},{"seo_description":"Plumbers","description":"Plumbers","poi_type":"plumbers"},{"seo_description":"Property Maintenance Services","description":"Property Maintenance Services","poi_type":"property_maintenance_services"},{"seo_description":"Removals & Storage Services","description":"Removals/Storage Services","poi_type":"removals_storage_services"},{"seo_description":"Roofing Contractors","description":"Roofing Contractors","poi_type":"roofing_contractors"},{"seo_description":"Security systems","description":"Burglar Alarm Systems","poi_type":"burglar_alarm_systems"},{"seo_description":"Window Replacement & Glaziers","description":"Glaziers","poi_type":"glaziers"}];

    e.preventDefault();

    $this
        .attr('disabled', 'disabled')
        .html('Loading');

    $.ajax({
        url: '/ajax/local_info/find_my_nearest',
        data: query
    }).done(function( data ){

        var dataObj = jQuery.parseJSON(data),
            tempContent = '';

        if ( dataObj['areas'].length > 1 ) {

            tempContent = '<li class="find-my-nearest-results-li" style="padding: 1em; border: 0;">More than one location found. Which one were you after?<ul style="list-style: none;">';
            
            for ( obj in dataObj['areas'] ) {
                tempContent += '<li><a href="#" class="js-find-my-nearest-multiple">' + dataObj['areas'][obj].name + '</a></li>';
            }

            tempContent += '</ul></li>';

        }

        else {

            for ( obj in dataObj['pois'] ) {

                var business_type = '';

                if ( query.business_type === '_default' ) {
                    for ( bType in business_types ) {
                        if ( business_types[bType]['poi_type'] === dataObj['pois'][obj].poi_type ) {
                            business_type = business_types[bType]['seo_description'];
                        }
                    }

                    business_type = '<span class="small"> in ' + business_type + '</span>';
                }

                tempContent += template
                    .replace( '$business->{name}', dataObj['pois'][obj].name )
                    .replace( '$business->{poi_type}', business_type )
                    .replace( '$business->{phone}', dataObj['pois'][obj].phone )
                    .replace( '$business->{address}', dataObj['pois'][obj].address )
                    .replace( '$business->{postcode}', dataObj['pois'][obj].postcode )
                    .replace( '$business->{dist}', dataObj['pois'][obj].dist )
            }


            if ( tempContent.length === 0 ) {
                tempContent = '<li class="find-my-nearest-results-li" style="padding: 1em; border: 0;">Sorry, we could not find a place name matching \'' + jQuery('.js-find-my-nearest-input').attr('value') + '\'.</li>'
            }

        }

        jQuery('.js-find-my-nearest-results ul')
            .find('li').remove().end()
            .append(tempContent);

        $this
            .removeAttr('disabled')
            .html('Search');

        // EVENT TRACKING
        if (typeof _gaq !== 'undefined') {

            _gaq.push([

                '_trackEvent',
                'Find my nearest',
                jQuery('.js-find-my-nearest-select option:selected').attr('value'),
                '/tracking/for-sale'

            ]);

        }

    })

});

jQuery('.js-find-my-nearest').on('click', '.js-find-my-nearest-multiple', function(e) {

    e.preventDefault();

    jQuery('.js-find-my-nearest-input').attr( 'value', jQuery(this).text() );
    jQuery('.js-find-my-nearest-action').trigger('click');

});



        $('span.tool-tip').tooltip({
            position: {
                my: 'left top+12',
                at: 'left-8 bottom',
                collision: 'none',
                target: [36, 393]
            },
            tooltipClass: "bubble"
        });



    $('#msg_your_status').change(function() {
        var status = $(this).val();
        if (status == 'investor_hoping_to_invest' || status == 'curious_having_a_look') {
            $('#msg_looking_to_move').parent('li').hide();
        } else {
            $('#msg_looking_to_move').parent('li').show();
        }
    });

    
    $(".email_encrypted").on("focusin", function() {
        $(".email_encrypted").prop('disabled', true).hide();
        $(".email_edit").prop('disabled', false).show().focus();
    });

    $(".email_edit").on("focusout", function() {
        if (!$(".email_edit").val()) {
            $(".email_encrypted").prop('disabled', false).show();
            $(".email_edit").prop('disabled', true).hide();
        }
    });


    
    $(".phone_encrypted").on("focusin", function() {
        $(".phone_encrypted").prop('disabled', true).hide();
        $(".phone_edit").prop('disabled', false).show().focus();
    });

    $(".phone_edit").on("focusout", function() {
        if (!$(".phone_edit").val()) {
            $(".phone_encrypted").prop('disabled', false).show();
            $(".phone_edit").prop('disabled', true).hide();
        }
    });




    jQuery('.js-affordability-calc-form input').blur(function(){

        var $this = jQuery(this),
            num = $this.val().replace(/,/g, '');

        $this.val(num.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,"));

    });

    jQuery('.js-affordability-calc-button').on('click', function(e) {

        e.preventDefault();

        var $form = jQuery('.js-affordability-calc-form');

        if ( parseInt( $form.find('input[name="affordability-calc-monthly"]').val() ) != "NaN" && parseInt( $form.find('input[name="affordability-calc-monthly"]').val() ) > 0 ) {

            function pv(rate, per, nper, pmt, fv) {
                nper = parseFloat(nper);
                pmt = parseFloat(pmt);
                fv = parseFloat(fv);
                rate = eval((rate)/(per * 100));

                if (( pmt == 0 ) || ( nper == 0 ))
                    return(0);

                if ( rate == 0 ) {
                    pv_value = -(fv + (pmt * nper));
                } else {
                    x = Math.pow(1 + rate, -nper);
                    y = Math.pow(1 + rate, nper);
                    pv_value = - ( x * ( fv * rate - pmt + y * pmt )) / rate;
                }

                pv_value = conv_number(pv_value,2);

                return (pv_value);
            }

            function conv_number(expr, decplaces) {
                var str = "" + Math.round(eval(expr) * Math.pow(10,decplaces));
                while (str.length <= decplaces)
                    str = "0" + str;
                var decpoint = str.length - decplaces;
                return (str.substring(0,decpoint) + "." + str.substring(decpoint,str.length));
            }

            var monthlyPayment = stripFormatNumber( $form.find('input[name="affordability-calc-monthly"]').val() ),
                deposit = stripFormatNumber( $form.find('input[name="affordability-calc-deposit"]').val() ),
                interest = stripFormatNumber( $form.find('input[name="affordability-calc-interest"]').val() ),
                term = $form.find('select[name="affordability-calc-mortgageterm"] option:selected').val(),
                type = $form.find('select[name="affordability-calc-mortgagetype"] option:selected').val(),
                total = type === 'interest' ? ( ( ( monthlyPayment * 12 ) / interest ) * 100 ) + parseFloat( deposit ) : parseFloat( deposit ) + parseFloat( pv(interest, 12, 12 * term, -(monthlyPayment), 0) );

            jQuery('.affordability-calc-quote').html('You could afford up to £' + ZPG.util.formatNumber( Math.round( total / 100 ) * 100 ) ).removeClass('error').addClass('is-showing-quote');

        } else {

            jQuery('.affordability-calc-quote').html('Please enter a valid monthly payment.').removeClass('is-showing-quote').addClass('error');

        }

        if (typeof _gaq !== 'undefined') {

            _gaq.push([ '_trackEvent', 'Affordability calculator', 'Calculate_affordability', '/tracking/to-rent/details/' ]);

        }

    });


  });

</script>


<?php 


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
                Last 30 days: <strong><?php echo $pageViewsCount?></strong>  |        Since listed: <strong><?php echo $pageViewsCount?></strong><br />
                </p>
        </div>
		<form name="f2" method="post" action="">
        <input type="submit" id="savetofavorites" name="savetofavorites" value="Save to favourites" class="btn btn-default btn-block" style="padding:0 0 0 33px; height:36px;"><span class="glyphicon glyphicon-star" style="margin:-26px 0 0 17px; height:20px; float:left; "></span> 
        </form>
        <!--<button type="button" class="btn btn-default btn-block"><span class="glyphicon glyphicon-bell"></span> Create email alert</button>-->
        <button type="button" class="btn btn-default btn-block" id="print"><span class="glyphicon glyphicon-print"></span>&nbsp;Print this page</button>
        <a href="email.php?proid=<?php echo $_GET['proid']?>" style="text-decoration: none;"><button type="button" class="btn btn-default btn-block"><span class="glyphicon glyphicon-envelope"></span> Email a friend</button></a>
        <a href="report.php?proid=<?php echo $_GET['proid']?>" style="text-decoration: none;"><button type="button" class="btn btn-default btn-block"><span class="glyphicon glyphicon-list-alt"></span> Report listing content</button></a>
        
        <form name="f3" method="post" action="">
			<input type="submit" id="hideproperty" name="hideproperty" value="Hide Property" class="btn btn-default btn-block" style="padding:0 0 0 33px; height:36px;"><span class="glyphicon glyphicon-ban-circle" style="margin:-26px 0 0 17px; height:20px; float:left; "></span></button>
        </form>
        
        <div id="addnote"><button type="button" class="btn btn-default btn-block"><span class="glyphicon glyphicon-file"></span> Add a note</button></div>
        <div id="hiddenDiv" style="height:200px;display:none;">
         
         <?php 
            if(isSessionRegistered('user')){
         
               $tot_property_num=dbQuery("select * from tbl_property_note where property_id=".$addtonote_property_id. " and user_id=".$addtonote_user_id);
			   $property_rows=dbNumRows($tot_property_num);
				 if($_GET['mode']=="edit"){
				  $id=$_GET['id'];		
				  $tot_property_query=dbQuery("select * from tbl_property_note where id=".$id);
				  $tot_property_rows=dbFetchArray($tot_property_query);   	
				 }   
			  
				  if((empty($_GET['mode']) && $property_rows==0) || $_GET['mode']=="edit"){
				 ?>
					 <form name="f1" method="post">
					   <input type="text" id="txtproperty" name="txtproperty" value="<?php echo $tot_property_rows['property_note'];?>">
					   <input type="hidden" name="mode" value="<?php if($_GET['mode']=="edit"){echo "edit";}?>">
					   <input type="hidden" name="id" value="<?php if($_GET['mode']=="edit"){echo $id;}?>">
					   <input type="hidden" name="source" value="<?php echo base64_decode($_GET['source']) ?>">
					   <input type="hidden" name="proid" value="<?php echo base64_decode($_GET['proid']) ?>">
					   
					   <input type="button" id="cancelbutton" name="cancelbutton" value="Cancel"><input type="submit" id="addeditproperty" name="addeditproperty" value="Save">
					 </form>
					
					<?php }else{?>
         
         
					  <table >
					  
					 <?php while($property_rows=dbFetchArray($tot_property_num)){?>
					   <tr>   
					   <td><?php echo $property_rows['property_note'];?> </td>  
					   <td><a href="details.php?source=<?php echo base64_encode($source)?>&proid=<?php echo base64_encode($proid)?>&mode=edit&id=<?php echo $property_rows['id']?>">Edit</a></td>  
					   <td><a href="details.php?source=<?php echo base64_encode($source)?>&proid=<?php echo base64_encode($proid)?>&mode=delete&id=<?php echo $property_rows['id']?>">Delete</a></td>  
					   </tr>
					 <?php }?>   
					 </table>
				   
				   
					<?php }
					
				}else{	
				 	echo "Login first";
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
