<?php 
$seoId=13;
include('includes/application.php');
require("includes/user_application.php");
unset($_SESSION["source1"]);

?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?>


<title> <?php echo $userInfo["user_first_name"]."'s ".$rsultSe["seo_title"];?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>


<!--Jqte cdn import-->

<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.png" rel="" type="image/x-icon" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.js" type="text/javascript" ></script>
<script src="http://code.jquery.com/jquery.min.js" type="text/javascript" ></script>



<!--Jqte cdn import End-->
<script src="js/jquery.validate.min.js" type="text/javascript"></script>

<script type="text/javascript" src="jte/jquery-te-1.4.0.min.js"></script>
<link href="jte/jquery-te-1.4.0.css" rel="stylesheet" type="text/css" />

<script src="js/custom.js" type="text/javascript"></script>
 <script language="javascript" type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	


function getregion(countryId) {		
		var strURL="region.php?country="+countryId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('region').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	function gettown(regionId) {		
		var strURL="region.php?region="+regionId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('city').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		} 
				
	}

function getAtribute(countryId) {		
		var strURL="getProperty.php?cid="+countryId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('pro').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}
	function hide(str){
	if(str=='rent'){
	document.getElementById('rent').style.display='none';
	document.getElementById("type").checked=true;
	
	}else{
		document.getElementById("type1").checked=true;
	 document.getElementById('rent').style.display='block';
	}
	}
</script>
<script>
$( document ).ready(function() {
$("#postal_id").keyup(function(){
query=$("#postal_id").val();
//alert(query);
if(  (query.length==7&&query.charAt(3)==' ') || (query.length==6&&query.charAt(3)!=' ') )
{

$.ajax(
{
	url: '/ajax.php?query=' + query,
	dataType: 'json', 
	type: 'GET',
	success: (function(data){
if(data==0)
{
	
//$('#addr_manual').html('<textarea class="textarea" name="full_addr"></textarea>');
//$('#addr').remove();
//$('#addr1').html('');
$('#addr1').html('<label>House no:</label><input name="house_no" class="input" type="text"><br><label>Street address:</label><input name="new_addr[]" class="input" type="text"><br><label>City:</label><input name="new_addr[]" class="input" type="text"><br><label>County:</label><input name="new_addr[]" class="input" type="text"><br>');
}
else
{
var toAppend = '';

           $.each(data,function(i,o){
           toAppend += '<option value="'+o.id+'">'+o.addr+'</option>';
          });
         $('#addr').html(toAppend);

}
  })});

}
});

});

</script>
<script type="text/javascript">
$(document).ready(function() {
$("textarea").jqte();
$(".jqte").css("width","400px");
$(".jqte").css("margin-left","auto");
$(".jqte").css("margin-right","24%");
});
</script>
<script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
<!-- script added by akash to show the text area with html editor-->
 <script>//tinymce.init({
	// selector:'textarea'
	// });</script>
 </head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">
<div id="register">
<div class="step">Step 1: List Property </div>

<div id="tcontent1" style="display:;">
<form action="files/application_file.php?action=property_step_one" method="post" name="step_one" id="step_one" >


<label>Property Type :</label><select class="select" name="property_category_id" onchange="getAtribute(this.value)" >
<?php

$strParentProperty=dbQuery("select * from property_category where property_category_parent_id=0") ;
while($rsPro=dbFetchArray($strParentProperty)){
?>

<optgroup label="<?php echo $rsPro["property_category_name"]?>" style="background-color:#ccff6a;"></optgroup>
<?php

$strProperty=dbQuery("select * from property_category where property_category_parent_id='".$rsPro['property_category_id']."'") ;
while($rsProperty=dbFetchArray($strProperty)){
?>
<option value="<?php echo $rsProperty["property_category_id"]?>"><?php echo $rsProperty["property_category_name"]?></option>
<?php } } ?>


</select><br />
 

<label>Transaction Type  : </label> <div class="profile"><br /> <input type="radio" onclick="hide(this.value)" name="property_transaction_type" checked="checked"  value="sell"/> Sell <input type="radio"  value="rent" name="property_transaction_type" onclick="hide(this.value)" /> Rent <input type="hidden" name="_method"  value="Add Property"/></div>
<div class="clear"></div>   
<div id="rent">
<label>New/Resale Property : </label> <div class="profile"><br />  <input checked="checked" type="radio"  id="type1" name="property_type" value="New" /> New Property <input type="radio" name="property_type" value="Resale" /> Resale Property </div>
<div class="clear"></div>   </div><input  type="radio" id="type" style="display:none" name="property_type" value="none" />

<label>Postal code:</label><input maxlength="7" type="text" name="postal_id" id="postal_id" class="input" /><br />
<!--<label>country :</label> <select class="select" name="state_id" onchange="getregion(this.value)">
<option selected="selected" value="">Select country</option>
<?php

$strCountry=dbQuery("select * from  uk_country order by country_name") ;
while($country=dbFetchArray($strCountry)){
?>
 
<option value="<?php echo $country["country_id"]?>"><?php echo $country["country_name"]?></option>
<?php } ?> </select><br />
<label>Region :</label> <div id="region"><select name="region_id" class="select" >
<option value="">Select Country First</option>
</select></div><br />
<label>Locality :</label> <div id="city"><select name="city_id" class="select" >
<option value="">Select Region First</option>
</select></div><br />-->
<label>Area :</label> <input type="text" name="property_area"  style="width:145px;" class="input" />
<select  class="select" style="width:130px;"  name="unit" >
<option value="Sq-ft">Sq-ft</option><option value="Sq-yrd">Sq-yrd</option><option value="Sq-m">Sq-m</option>
</select>
<br />
<label>Listing Price :</label> <input type="text" name="property_total_price" class="input" /><br />
<div id="pro">
<label>Bedrooms </label><select class="select"  name="property_bedrooms">
<option value="">-- Number of Bedroom --</option><option value="Studio">Studio</option>
<?php for($i=1;$i<11;$i++){ ?>
<option value="<?php echo $i?>"><?php echo $i?></option>
<?php } ?>
<option value="11">10+</option></select><!--<br />

<label>Bathrooms </label><select name="property_bathrooms" class="select">
<option value="">-- Number of Bathrooms --</option>
<?php //for($j=1;$j<11;$j++){ ?>
<option value="<?php //echo $j?>"><?php //echo $j?></option>
<?php //} ?>
<option value="11">10+</option></select>--><br />

<label>Floor Number  </label><select class="select" name="property_floor_number">

<option value=""  selected="">-- Floor Number --</option>
						<option value="Under Construction">Under Construction</option>
						<option value="Basement">Basement</option>
						<option value="Ground Floor">Ground Floor</option>
						<option value="Mezzanine Floor">Mezzanine Floor</option>
						<?php for($i=1;$i<41;$i++){ ?>
						<option value="<?php echo $i?>"><?php echo $i?></option>
						<?php } ?>
						<option value="41">More than 40</option></select>
		</div>
						<br />
						
<label>Property Description <span>(Min 200 chars)</span>  </label> <textarea  name="property_description" class="textarea"></textarea> <br />
<!-- Commented by akash to hide new home check box -->
<!--<label>New Home</label><input type="checkbox" name="newhome" value="new" style="margin-top:13px;"><br>-->
<label>&nbsp;</label> <input type="submit" name="" class="submit" value="Submit" />

</form>

<div class="step2">Step 2: Optional Property Details </div>
<div class="step2">Step 3: Contact Details </div>

</div>


</div>
</div>
<!--Middle End-->

<!--Fotter Start-->
<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
