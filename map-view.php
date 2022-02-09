<?php 
/**************************************
/	 Code by: Neeraj Krishna Maurya   /
/       Date: 29/05/2013              /
/        For Map Display              /
/*************************************/
$seoId=24;
include('includes/application.php');
	$rowsPerPage=(isset($_GET["row"])) ? (int)$_GET["row"] : 20;
	
	//echo "SELECT  * FROM property where city_id='".base64_decode($_GET["source"])."' and property_status='Active' and property_transaction_type='sell'";die;
	$strProperty="SELECT  * FROM property where city_id='".base64_decode($_GET["c"])."' and property_status='Active' and property_transaction_type='sell'";
	$rsProperty=dbQuery(getPagingQueries($strProperty, $rowsPerPage)); 
	$pagingLink1=getPaging($strProperty, $rowsPerPage, getAllGetParams(array("page")));
	 
	if($_REQUEST['neo']=="neeraj" and $_REQUEST['q']=="search") 
	{
		
	if($_REQUEST["property_type"]!=='0' and $_REQUEST["property_type"]!==''){
	$propertyType=$_REQUEST["property_type"];
	$where.="property_category_id='$propertyType'";
	}

	

	
	if($_REQUEST["minimum_price"]!=='' && $_REQUEST["maximum_price"]!=''){
	$minimum=round($_REQUEST["minimum_price"],2);
	$maximum=round($_REQUEST["maximum_price"],2);
	$where.="or property_total_price between  '$minimum' and '$maximum'  ";

}
if($_REQUEST["beds_min"]!='' && $_REQUEST["beds_max"]!=''){
	
	$where.="or property_bedrooms between  '".$_REQUEST["beds_min"]."' and '".$_REQUEST["beds_max"]."'";

}
if($_REQUEST["posting"]!==''){
	$date= date("Y-m-d,g:i:s");
	$dateOneMonthAdded = strtotime(date("Y-m-d,g:i:s", strtotime($date)) . " -".$_REQUEST["posting"]." day");
	$nextDate = strtotime(date("Y-m-d", strtotime($dateOneMonthAdded)) . " -".$_REQUEST["posting"]." day");
	$end_date=date("Y-m-d",$dateOneMonthAdded);
	//echo $end_date;
	$where.=" or property_created_date < '$end_date'";  
}

    if(($_REQUEST["property_type"]=='0') and ($_REQUEST["minimum_price"]=='No Min') and ($_REQUEST["maximum_price"]='No Max') and ($_REQUEST["beds_min"]=='') and ($_REQUEST["beds_max"]=='') and ($_REQUEST["posting"]==''))
	{
		
	$strQuery="SELECT  * FROM property where city_id='".$_REQUEST["locationId"]."'  and property_status='Active' limit 0,30 ";
	}
	else{
	$strQuery="SELECT  * FROM property where city_id='".$_REQUEST["locationId"]."'  and property_status='Active'  and (".$where.") limit 0,30 ";
	}
	
	$searchQuery=getPropertyID($strQuery);
	$searchArr=base64_encode($searchQuery);
	$source=$_REQUEST['source'];
	echo("<script>location.href = 'map-view.php?en=$searchArr&source=$source';</script>");
	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?>
<?php echo $seoTitle;?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<style type="text/css">
            body { font: normal 14px Verdana; }
            h1 { font-size: 24px; }
            h2 { font-size: 18px; }
            #sidebar { float: right; width: 30%; }
            #main { padding-right: 15px; }
            .infoWindow { width: 220px; }
        </style>
		<!---  AIzaSyBd5UBDhiQ4Z2plvB1lcj3DGfPM1H5MWfM ---------->
     <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
	 
	 <!--<script src="http://maps.google.com/maps?file=api&amp;v=1.0&amp;key=ABQIAAAAjU0EJWnWPMv7oQ-jjS7dYxQ82LsCgTSsdpNEnBsExtoeJv4cdBSUkiLH6ntmAr_5O4EfjDwOa0oZBQ"
            type="text/javascript"></script>-->
    <script type="text/javascript">
    //<![CDATA[

    var customIcons = {
      property: {
        icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
        shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      }
    
    };

    function load(city) {
	
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
		  var lat = markers[i].getAttribute("lat");
		  var lng = markers[i].getAttribute("lng");
		 
          var type = "property";
		  
		   
		  // commented by akash 13 sept 2015
          //var point = new google.maps.LatLng(parseFloat(markers[i].getAttribute("lat")),parseFloat(markers[i].getAttribute("lng")));
          var point = new google.maps.LatLng(lat,lng);
			//bounds.extend(point);  
			console.log(point);
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
		//map.panToBounds(bounds);
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
  
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript" src="js/animatedcollapse.js"></script>
<script src="js/tabcontent.js" type="text/javascript"></script>

<script type="text/javascript">


animatedcollapse.addDiv('jason', 'fade=1,height=80px')
animatedcollapse.addDiv('kelly', 'fade=1,height=100px')
animatedcollapse.addDiv('michael', 'fade=1,height=120px')

animatedcollapse.addDiv('cat', 'fade=0,speed=400,group=pets')
animatedcollapse.addDiv('dog', 'fade=0,speed=400,group=pets,persist=1,hide=1')
animatedcollapse.addDiv('rabbit', 'fade=0,speed=400,group=pets,hide=1')

animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
	//$: Access to jQuery
	//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
	//state: "block" or "none", depending on state
}

animatedcollapse.init()

</script>
  

<script type="text/javascript">
$(document).ready(function() { 
$('div.icon').click(function(){
		$('input#searching1').focus();
	});

	// Live Search
	// On Search Submit and Get Results
	function search() {
		var query_value = $('input#searching1').val();
		$('b#search-string1').html(query_value);
		$("#off1").css("display", "block");
		if(query_value !== ''){
			$.ajax({
				type: "POST",
				url: "search.php?action=header1",
				data: { query: query_value },
				cache: false,
				success: function(html){
					$("ul#results1").html(html);
				}
			});
		}return false;    
	}

	$("input#searching1").live("keyup", function(e) {
		// Set Timeout
		clearTimeout($.data(this, 'timer'));
//document.getElementById("off").style.display="block",
		// Set Search String
		var search_string = $(this).val();

		// Do Search
		if (search_string == '') {
			$("ul#results1").fadeOut();
			$('h4#results-text1').fadeOut();
		}else{
			$("ul#results1").fadeIn();
			$('h4#results-text1').fadeIn();
			$(this).data('timer', setTimeout(search, 1));
		};
	});

});
</script>
</head>

<body onload="load('<?php if(isset($_GET["en"])) { echo base64_decode($_GET["en"]); } ?>')">
    

<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle2">
<div class="view">
<ul>
<li><a href="http://homesguru.co.uk/search-property.php?type=sale1&property_type=1&form=uksale"><span>List view</span></a></li>
<li><a class="select" href="#"><span>Map view</span></a></li>
</ul>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div id="map-left">
  

<h2> Refine your search </h2>
<form action="map-view.php?q=search" method="post">
<label>Location</label> <input type="text" class="input" name="location" id="searching1" autocomplete="off" required> <input type="hidden" class="input" name="locationId" id="searchid1" autocomplete="off">
        <div class="clear"></div>
		<div id="off1">
        <ul id="results1"> 
        </ul>
		</div>
<!--<label>Radius</label>  <select name="radius" class="text">
        <option value="0">This area only</option>
        <option value="0.25">Within ¼ mile</option>
        <option value="0.5">Within ½ mile</option>
        <option value="1">Within 1 mile</option>
        <option value="3">Within 3 miles</option>
        <option value="5">Within 5 miles</option>
        <option value="10">Within 10 miles</option>
        <option value="15">Within 15 miles</option>
        <option value="20">Within 20 miles</option>
        <option value="30">Within 30 miles</option>
        <option value="40">Within 40 miles</option>
    </select><br />-->
	<input type="hidden" name="source" value="<?php echo $_GET["source"]?>" />
	<input type="hidden" name="neo" value="neeraj" />
<label>Type</label> <select name="property_type"  class="text" required="required" >
         <option value="" selected="selected">Select Property Type</option>
        <option value="0">Show all</option>
        <option value="2">Houses</option>
            <option value="1">Flats</option>
            <option value="5">Commercial</option> 
            <option value="4">Land</option> 
    </select><br />

 
<label>Price</label> <select name="minimum_price">
            <option>No Min</option>
            <?php 
		$i=10000;
		while($num<250000){
		 $num=$num+$i; ?>
            <option value="<?php echo $num?>"><?php echo "&pound; ".number_format($num)?></option>
            <?php } 
		$num1=275000;
		while($num1<=500000){
	
		?>
            <option value="<?php echo $num1?>"><?php echo "&pound; ".number_format($num1)?></option>
            <?php 	$num1=$num1+25000;  } 
		$num2=550000;
		while($num2<=1000000){
		
		?>
            <option value="<?php echo $num2?>"><?php echo "&pound; ".number_format($num2)?></option>
            <?php $num2=$num2+50000;} 
		  $num3=1000000;
		while($num3<=2500000){
		
		?>
            <option value="<?php echo $num3?>"><?php echo "&pound; ".number_format($num3)?></option>
            <?php $num3=$num3+100000;}
		   $num4=2750000;
		while($num4<=5000000){
		
		?>
            <option value="<?php echo $num4?>"><?php echo "&pound; ".number_format($num4)?></option>
            <?php $num4=$num4+25000;} 
		  $num5=5500000;
		while($num5<=10000000){
		
		?>
            <option value="<?php echo $num5?>"><?php echo "&pound; ".number_format($num5)?></option>
            <?php $num5=$num5+500000;} ?>
            <option value="12500000"><?php echo "&pound; 12,500,000"?></option>
            <option value="15000000"><?php echo "&pound; 15,000,000"?></option>
          </select>
       
          <select name="maximum_price">
            <option>No Max</option>
            <?php 
		$i=10000;
		while($num<250000){
		 $num=$num+$i; ?>
            <option value="<?php echo $num?>"><?php echo "&pound; ".number_format($num)?></option>
            <?php } 
		$num1=275000;
		while($num1<=500000){
	
		?>
            <option value="<?php echo $num1?>"><?php echo "&pound; ".number_format($num1)?></option>
            <?php 	$num1=$num1+25000;  } 
		$num2=550000;
		while($num2<=1000000){
		
		?>
            <option value="<?php echo $num2?>"><?php echo "&pound; ".number_format($num2)?></option>
            <?php $num2=$num2+50000;} 
		  $num3=1000000;
		while($num3<=2500000){
		
		?>
            <option value="<?php echo $num3?>"><?php echo "&pound; ".number_format($num3)?></option>
            <?php $num3=$num3+100000;}
		   $num4=2750000;
		while($num4<=5000000){
		
		?>
            <option value="<?php echo $num4?>"><?php echo "&pound; ".number_format($num4)?></option>
            <?php $num4=$num4+25000;} 
		  $num5=5500000;
		while($num5<=10000000){
		
		?>
            <option value="<?php echo $num5?>"><?php echo "&pound; ".number_format($num5)?></option>
            <?php $num5=$num5+500000;} ?>
            <option value="12500000"><?php echo "&pound; 12,500,000"?></option>
            <option value="15000000"><?php echo "&pound; 15,000,000"?></option>
          </select> <br /><br />
		  <label>Beds</label>  <select name="beds_min" >
    <option value="" selected="selected">No min</option>
            <option value="0">Studio</option>
            <option value="1">1+</option>
            <option value="2">2+</option>
            <option value="3">3+</option>
            <option value="4">4+</option>
            <option value="5">5+</option>
            <option value="6">6+</option>
            <option value="7">7+</option>
            <option value="8">8+</option>
            <option value="9">9+</option>
            <option value="10">10+</option>
</select> <select name="beds_max" >
    <option value="" selected="selected">No max</option>
            <option value="0">Studio</option>
            <option value="1">1+</option>
            <option value="2">2+</option>
            <option value="3">3+</option>
            <option value="4">4+</option>
            <option value="5">5+</option>
            <option value="6">6+</option>
            <option value="7">7+</option>
            <option value="8">8+</option>
            <option value="9">9+</option>
            <option value="10">10+</option>
</select> 
<br /><br />
<label>Added</label> <select class="select2" name="posting">
            <option value="">Anytime</option>
            <option value="1">Last 24 hours</option>
            <option value="3">Last 3 days</option>
            <option value="7">Last 7 days</option>
            <option value="14">Last 14 days</option>
            <option value="30">Last 30 days</option>
          </select><br /><br />
<label>Keywords</label>  <input type="text" name="keywords" placeholder="e.g. 'garden' or 'wood floors'"class="input2" /><br />
<!--<label>Include</label> <div class="include"> <input type="checkbox" name="" /> New homes<br />
<input type="checkbox" name="" value="" /> Shared ownership homes<br />
<input type="checkbox" name="" /> Retirement homes<br />
<input type="checkbox" name="" />Under offer or sold STC</div>-->
<div class="clear"></div>
<label>&nbsp;</label> <input type="submit" class="submit" name="" value="Refine Search" />

</form>

  
    <div class="banner">
  <img src="images/banner.jpg" alt="" />  </div>
  
  <div class="clearfix"></div>
<?php include('includes/popup.html');?>
<div class="clearfix"></div>
  
</div>

  <div id="map-right" >
 
  <section id="sidebar">
            <div id="directions_panel"></div>
        </section>
         
        <section id="main">
            <div id="map" style="width:100%; height:670px;"></div>
        </section>

	
</div>
  

  <div class="clear"></div>
</div><!--Middle End-->

<!--Fotter Start-->
<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
