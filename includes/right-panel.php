<?php









?>
<?php

if(isset($_GET['type'])=='sale'){
$strProperty=dbQuery("SELECT  COUNT(property_category_id) AS Aparment  FROM property where property_transaction_type = 'sell' and property_category_id='1' and property_status='Active'");
$resultProperty=dbFetchArray($strProperty);


$strProperty2=dbQuery("SELECT  COUNT(property_category_id) AS Independent  FROM property where property_transaction_type = 'sell' and property_category_id='2' and property_status='Active'");
$resultProperty2=dbFetchArray($strProperty2);


$strProperty3=dbQuery("SELECT  COUNT(property_category_id) AS Builder  FROM property where property_transaction_type = 'sell' and property_category_id='3' and property_status='Active'");
$resultProperty3=dbFetchArray($strProperty3);


$strProperty4=dbQuery("SELECT  COUNT(property_category_id) AS Land  FROM property where property_transaction_type = 'sell' and property_category_id='10' and property_status='Active'");
$resultProperty4=dbFetchArray($strProperty4);


$strProperty5=dbQuery("SELECT  COUNT(property_category_id) AS Farm  FROM property where property_transaction_type = 'sell' and property_category_id='11' and property_status='Active'");
$resultProperty5=dbFetchArray($strProperty5);


$strProperty6=dbQuery("SELECT  COUNT(property_category_id) AS Service  FROM property where property_transaction_type = 'sell' and property_category_id='12' and property_status='Active'");
$resultProperty6=dbFetchArray($strProperty6);

$strProperty7=dbQuery("SELECT  COUNT(property_category_id) AS Other  FROM property where property_transaction_type = 'sell' and property_category_id='18' and property_status='Active'");
$resultProperty7=dbFetchArray($strProperty7);

$strProperty8=dbQuery("SELECT  COUNT(*) AS RESIDENTIAL  FROM property WHERE property_transaction_type = 'sell' and property_status='Active'");
$resultProperty8=dbFetchArray($strProperty8);

$strProperty9=dbQuery("SELECT  COUNT(property_category_id) AS Bunglow  FROM property where property_transaction_type = 'sell' and property_category_id='30' and property_status='Active'");
$resultProperty9=dbFetchArray($strProperty9);
}else /*if(isset($_GET['type'])=='rent')*/{
	
$strProperty=dbQuery("SELECT  COUNT(property_category_id) AS Aparment  FROM property where property_transaction_type = 'rent' and property_category_id='1' and property_status='Active'");
$resultProperty=dbFetchArray($strProperty);


$strProperty2=dbQuery("SELECT  COUNT(property_category_id) AS Independent  FROM property where property_transaction_type = 'rent' and property_category_id='2' and property_status='Active'");
$resultProperty2=dbFetchArray($strProperty2);


$strProperty3=dbQuery("SELECT  COUNT(property_category_id) AS Builder  FROM property where property_transaction_type = 'rent' and property_category_id='3'and property_status='Active'");
$resultProperty3=dbFetchArray($strProperty3);


$strProperty4=dbQuery("SELECT  COUNT(property_category_id) AS Land  FROM property where property_transaction_type = 'rent' and property_category_id='10' and property_status='Active'");
$resultProperty4=dbFetchArray($strProperty4);


$strProperty5=dbQuery("SELECT  COUNT(property_category_id) AS Farm  FROM property where property_transaction_type = 'rent' and property_category_id='11' and property_status='Active'");
$resultProperty5=dbFetchArray($strProperty5);


$strProperty6=dbQuery("SELECT  COUNT(property_category_id) AS Service  FROM property where property_transaction_type = 'rent' and property_category_id='12' and property_status='Active'");
$resultProperty6=dbFetchArray($strProperty6);

$strProperty7=dbQuery("SELECT  COUNT(property_category_id) AS Other  FROM property where property_transaction_type = 'rent' and property_category_id='18' and property_status='Active'");
$resultProperty7=dbFetchArray($strProperty7);

$strProperty8=dbQuery("SELECT  COUNT(*) AS RESIDENTIAL  FROM property WHERE property_transaction_type = 'rent' and property_status='Active'");
$resultProperty8=dbFetchArray($strProperty8);

$strProperty9=dbQuery("SELECT  COUNT(property_category_id) AS Bunglow  FROM property where property_transaction_type = 'rent' and property_category_id='30' and property_status='Active'");
$resultProperty9=dbFetchArray($strProperty9);	
}

?>

<div id="about">
<script type="text/javascript">
$(document).ready(function() {  

	// Icon Click Focus
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
					$("ul#result").html(html);
				}
			});
		}return false;    
	}

	$("input#searching1").live("keyup", function(e) {
		// Set Timeout
		clearTimeout($.data(this, 'timer'));

		// Set Search String
		var search_string = $(this).val();

		// Do Search
		if (search_string == '') {
			$("ul#result").fadeOut();
			$('h4#results-text').fadeOut();
		}else{
			$("ul#result").fadeIn();
			$('h4#result-text').fadeIn();
			$(this).data('timer', setTimeout(search, 1));
		};
	});

});
</script>
<h2> Refine your search </h2>
<?php //echo $seoId; ?>
<?php// if($seoId=='21'){?>
<?php if($seoId=='28'){?>
 <form method="post" action="search-property.php?type=sale">
<label>Location</label>
<input type="text" class="input" id="searching1" name="location" autocomplete="off"/><input type="hidden" class="input" name="locationId" id="searchid1" autocomplete="off"><br />

  <!--<h4 id="result-text">Showing results for: <b id="search-string"></b></h4>-->
 <div class="clear"></div>       
	   <div id="off1">
		<ul id="result">
        </ul>
		</div>
<br />
<label>Radius</label>  <select name="radius" class="text">
        <option value="0">This area only</option>
        <option value="0.25">Within  &frac14; mile</option>
        <option value="0.5">Within &frac12; mile</option>
        <option value="1">Within 1 mile</option>
        <option value="3">Within 3 miles</option>
        <option value="5">Within 5 miles</option>
        <option value="10">Within 10 miles</option>
        <option value="15">Within 15 miles</option>
        <option value="20">Within 20 miles</option>
        <option value="30">Within 30 miles</option>
        <option value="40">Within 40 miles</option>
    </select><br />
<label>Type</label> <select name="property_type"  class="text">
        <option value="" selected="selected">Show all</option>
        <?php

$strParentProperty=dbQuery("select * from property_category where property_category_parent_id=0") ;
while($rsPro=dbFetchArray($strParentProperty)){
?>
            <optgroup label="<?php echo $rsPro["property_category_name"]?>" style="background-color:#ccff6a;"></optgroup>
            <?php

$strProperty=dbQuery("select * from property_category where property_category_parent_id='".$rsPro['property_category_id']."'") ;
while($rsProperty=dbFetchArray($strProperty)){
?>
            <option <?php if($row["property_category_id"]==$rsProperty["property_category_id"]){ ?> selected="selected" <?php } ?> value="<?php echo $rsProperty["property_category_id"]?>"><?php echo $rsProperty["property_category_name"]?></option>
            <?php } } ?> 
    </select><br />
<label>Beds</label> <select class="notext" name="beds_min">
            <option value="" selected="selected">No min</option>
            <option value="0">Studio+</option>
            <option value="1"  >1+</option>
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
<select name="beds_max" id="beds_max"class="notext">
    <option value="" selected="selected">No min</option>
    <option value="0">Studio</option>
    <option value="1">1</option>
    <option value="2"  >2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
</select>
 <br />
<label>Price</label> <select class="notext" name="minimum_price">
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
            <option value="15000000"><?php echo "&pound; 15,000,000"?>
            <option>
          </select><select class="notext" name="maximum_price">
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
          </select> <br />
<label>Added</label> <select class="text" name="posting">
            <option value="">Anytime</option>
            <option value="1">Last 24 hours</option>
            <option value="3">Last 3 days</option>
            <option value="7">Last 7 days</option>
            <option value="14">Last 14 days</option>
            <option value="30">Last 30 days</option>
          </select><br />
<label>Keywords</label>
<input type="text" name="keywords" placeholder="e.g. 'garden' or 'wood floors'" class="input" />
<br />

<div class="clear"></div>
<label>&nbsp;</label> <input type="submit" class="submit" name="" value="Refine Search" />

</form>
<?php } elseif($seoId=='21'){ ?>
<?php //} elseif($seoId=='32'){ ?>
<form method="post" action="search-property.php?type=rent">
<label>Location</label>
<input type="text" class="input" id="searching1" name="location" /><input type="hidden" class="input" name="locationId" id="searchid1" autocomplete="off"><br />
  <!--<h4 id="result-text">Showing results for: <b id="search-string"></b></h4>-->
        <div class="clear"></div>       
	   <div id="off1">
		<ul id="result">
        </ul>
		</div>
<br />
<label>Radius</label>  <select name="radius" class="text">
        <option value="0">This area only</option>
        <option value="0.25">Within  &frac14; mile</option>
        <option value="0.5">Within &frac12; mile</option>
        <option value="1">Within 1 mile</option>
        <option value="3">Within 3 miles</option>
        <option value="5">Within 5 miles</option>
        <option value="10">Within 10 miles</option>
        <option value="15">Within 15 miles</option>
        <option value="20">Within 20 miles</option>
        <option value="30">Within 30 miles</option>
        <option value="40">Within 40 miles</option>
    </select><br />
<label>Type</label> <select name="property_type"  class="text">
        <option value="" selected="selected">Show all</option>
        <?php

$strParentProperty=dbQuery("select * from property_category where property_category_parent_id=0") ;
while($rsPro=dbFetchArray($strParentProperty)){
?>
            <optgroup label="<?php echo $rsPro["property_category_name"]?>" style="background-color:#ccff6a;"></optgroup>
            <?php

$strProperty=dbQuery("select * from property_category where property_category_parent_id='".$rsPro['property_category_id']."'") ;
while($rsProperty=dbFetchArray($strProperty)){
?>
            <option <?php if($row["property_category_id"]==$rsProperty["property_category_id"]){ ?> selected="selected" <?php } ?> value="<?php echo $rsProperty["property_category_id"]?>"><?php echo $rsProperty["property_category_name"]?></option>
            <?php } } ?> 
    </select><br />
<label>Beds</label> <select class="notext" name="beds_min">
            <option value="" selected="selected">No min</option>
            <option value="0">Studio+</option>
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
<select name="beds_max" id="beds_max"class="notext">
    <option value="" selected="selected">No min</option>
    <option value="0">Studio</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
</select>
 <br />
<label>Price</label> <select class="notext" name="minimum_price">
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
            <option value="15000000"><?php echo "&pound; 15,000,000"?>
            <option>
          </select><select class="notext" name="maximum_price">
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
          </select> <br />
<label>Added</label> <select class="text" name="posting">
            <option value="">Anytime</option>
            <option value="1">Last 24 hours</option>
            <option value="3">Last 3 days</option>
            <option value="7">Last 7 days</option>
            <option value="14">Last 14 days</option>
            <option value="30">Last 30 days</option>
          </select><br />
<label>Keywords</label>
<input type="text" name="keywords" placeholder="e.g. 'garden' or 'wood floors'" class="input" />
<br />

<div class="clear"></div>
<label>&nbsp;</label> <input type="submit" class="submit" name="" value="Refine Search" />

</form>
<?php } ?>
</div>

<div class="clear"></div>
<!-- code by Akash to show filter result -->
<div id="akcategorylist">
<h2> Filter your results </h2>
<hr />
<ul>
<?php if(isset($_GET['type'])=='sale'){ ?>
<li><strong><a href="http://homesguru.co.uk/search-property.php?type=sale1&property_type=1&form=uksale">ALL RESIDENTIAL(<?php echo $resultProperty8['RESIDENTIAL'] ?>)</strong><br />
<ul>
<li><a href="http://homesguru.co.uk/search-property.php?type=sale1&property_type=1&shorting=highest_price">Apartment(<?php echo $resultProperty['Aparment'] ?>)</a></li>
<li><a href="http://homesguru.co.uk/search-property.php?type=sale1&property_type=2&shorting=highest_price">Independent House/Villa(<?php echo $resultProperty2['Independent'] ?>)</a></li>
<li><a href="http://homesguru.co.uk/search-property.php?type=sale1&property_type=3&shorting=highest_price">Independent/Builder Floor(<?php echo $resultProperty3['Builder'] ?>)</a></li>
<li><a href="http://homesguru.co.uk/search-property.php?type=sale1&property_type=10&shorting=highest_price">Plot/Land(<?php echo $resultProperty4['Land'] ?>)</a></li>
<li><a href="http://homesguru.co.uk/search-property.php?type=sale1&property_type=11&shorting=highest_price">Farm House(<?php echo $resultProperty5['Farm'] ?>)</a></li>
<li><a href="http://homesguru.co.uk/search-property.php?type=sale1&property_type=12&shorting=highest_price">Service/Studio Apartment(<?php echo $resultProperty6['Service'] ?>)</a></li>
<li><a href="http://homesguru.co.uk/search-property.php?type=sale1&property_type=18&shorting=highest_price">Other Residential(<?php echo $resultProperty7['Other'] ?>)</a></li>
<li><a href="http://homesguru.co.uk/search-property.php?type=sale1&property_type=30&shorting=highest_price">Bunglow(<?php echo $resultProperty9['Bunglow'] ?>)</a></li>


<?php } else {?>


<li><strong><a href="http://homesguru.co.uk/search-property.php?type=rent1&property_type=1&form=uksale">ALL RESIDENTIAL(<?php echo $resultProperty8['RESIDENTIAL'] ?>)</strong><br />
<ul>
<li><a href="http://homesguru.co.uk/search-property.php?type=rent1&property_type=1&shorting=highest_price">Apartment(<?php echo $resultProperty['Aparment'] ?>)</a></li>
<li><a href="http://homesguru.co.uk/search-property.php?type=rent1&property_type=2&shorting=highest_price">Independent House/Villa(<?php echo $resultProperty2['Independent'] ?>)</a></li>
<li><a href="http://homesguru.co.uk/search-property.php?type=rent1&property_type=3&shorting=highest_price">Independent/Builder Floor(<?php echo $resultProperty3['Builder'] ?>)</a></li>
<li><a href="http://homesguru.co.uk/search-property.php?type=rent1&property_type=10&shorting=highest_price">Plot/Land(<?php echo $resultProperty4['Land'] ?>)</a></li>
<li><a href="http://homesguru.co.uk/search-property.php?type=rent1&property_type=11&shorting=highest_price">Farm House(<?php echo $resultProperty5['Farm'] ?>)</a></li>
<li><a href="http://homesguru.co.uk/search-property.php?type=rent1&property_type=12&shorting=highest_price">Service/Studio Apartment(<?php echo $resultProperty6['Service'] ?>)</a></li>
<li><a href="http://homesguru.co.uk/search-property.php?type=rent1&property_type=18&shorting=highest_price">Other Residential(<?php echo $resultProperty7['Other'] ?>)</a></li>
<li><a href="http://homesguru.co.uk/search-property.php?type=rent1&property_type=30&shorting=highest_price">Bunglow(<?php echo $resultProperty9['Bunglow'] ?>)</a></li>

<?php } ?>


</ul>
</li>


</div>






  <script type="text/javascript">
    var auto_refreshm = setInterval(
    function(){
       // $('#refresh3').load('right-banner.php?location=right&_=' +Math.random()).fadeIn("slow");
    }, 10000); // refresh every 10000 milliseconds
</script>

    <div  id="refresh3" class="banner">
	<img src="images/banner.jpg" alt="" /> 
  <?php /*
$banner=dbFetchArray(dbQuery("SELECT * FROM banner where banner_location='right' and banner_status='Yes' order by rand()"));

if($banner["google_code"]!=''){  echo $banner['google_code']; } elseif($banner["banner_image"]!=''){*/?><!--
<a href="<?php /*echo $banner['banner_code']*/?>" accesskey="<?php /*echo $banner['banner_code']*/?>" target="_blank"><img width="300px" height="250px" src="images/banner/<?php /*echo $banner['banner_image']*/?>" /></a>

--><?php /*} */?>
<a href="http://www.tkqlhce.com/click-7622882-11764854?url=http%3A%2F%2Fwww.homebase.co.uk%2F%3Fcm_mmc%3DAffiliate-_-Cojun-_-%25zn-_-%25zp" target="_top">
<img src="http://www.lduhtrp.net/image-7622882-11764854" width="300" height="250" alt="" border="0" style="margin-bottom: 10px;"/></a>
<a href="http://www.dpbolvw.net/click-7622882-11765983" target="_top">
<img src="http://www.tqlkg.com/image-7622882-11765983" width="300" height="250" alt="" border="0" style="margin-bottom: 10px;"/></a>
<a href="http://www.kqzyfj.com/click-7622882-11765985" target="_top">
 <img src="http://www.tqlkg.com/image-7622882-11765985" width="300" height="250" alt="" border="0" style="margin-bottom: 10px;"/></a>
<!--<a href="http://www.dpbolvw.net/click-7622882-11905380" target="_top">
<img src="http://www.lduhtrp.net/image-7622882-11905380" width="300" height="250" alt="" border="0" style="margin-bottom: 10px;"/></a>
<a href="http://www.dpbolvw.net/click-7622882-11912195" target="_top">
<img src="http://www.awltovhc.com/image-7622882-11912195" width="300" height="250" alt="" border="0" style="margin-bottom: 10px;"/></a>
 <a href="http://www.tkqlhce.com/click-7622882-11912130" target="_top">
 <img src="http://www.awltovhc.com/image-7622882-11912130" width="300" height="250" alt="" border="0" style="margin-bottom: 10px;"/></a>
<a href="http://www.dpbolvw.net/click-7622882-11912203" target="_top">
<img src="http://www.ftjcfx.com/image-7622882-11912203" width="300" height="250" alt="" border="0" style="margin-bottom: 10px;"/></a>
<a href="http://www.dpbolvw.net/click-7622882-11912144" target="_top">
<img src="http://www.awltovhc.com/image-7622882-11912144" width="300" height="250" alt="" border="0" style="margin-bottom: 10px;"/></a>
<a href="http://www.anrdoezrs.net/click-7622882-11912199" target="_top">
<img src="http://www.lduhtrp.net/image-7622882-11912199" width="300" height="250" alt="" border="0" style="margin-bottom: 10px;"/></a>
<a href="http://www.anrdoezrs.net/click-7622882-11912118?url=http%3A%2F%2Fwww.homebase.co.uk%2Fen%2Fhomebaseuk%2Ffurniture%3Fcm_mmc%3DAffiliate-_-Cojun-_-%25zn-_-%25zp" target="_top">
<img src="http://www.tqlkg.com/image-7622882-11912118" width="300" height="250" alt="" border="0" style="margin-bottom: 10px;"/></a>-->
<!--<a href="http://www.dpbolvw.net/click-7622882-11828919" target="_top">
<img src="http://www.ftjcfx.com/image-7622882-11828919" width="300" height="250" alt="" border="0" style="margin-bottom: 10px;"//></a>-->
<a href="http://www.dpbolvw.net/click-7622882-11912136" target="_top">
<img src="http://www.tqlkg.com/image-7622882-11912136" width="300" height="250" alt="" border="0" style="margin-bottom: 10px;"//></a>
</div>
