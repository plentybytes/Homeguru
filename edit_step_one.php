<?php 
$seoId=4;
include('includes/application.php');
require("includes/user_application.php");
unset($_SESSION["source1"]);
$strProperty=dbQuery("SELECT * FROM property where user_id='".$_SESSION['user']['id']."' and property_id='".base64_decode($_GET["source"])."'");
	$num=dbNumRows($strProperty);
	if($num==0){
	$messageStack->addMessageSession("Source id not found try again.", "error");
	redirect(hrefLink("property_list.php"));
	
	}else{
	$row=dbFetchArray($strProperty);
	}
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<!-- script added by akash to show the text area with html editor-->

<?php echo $rsultSeo;?>


<title> <?php echo $userInfo["user_first_name"]."'s ".$rsultSe["seo_title"];?></title>
 
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.css" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.png" rel="" type="image/x-icon" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-te/1.4.0/jquery-te.js" type="text/javascript" ></script>
<script src="http://code.jquery.com/jquery.min.js" type="text/javascript" ></script>

<script src="js/jquery.validate.min.js" type="text/javascript"></script>
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
	


function getcity(countryId) {		
		var strURL="findCity.php?county="+countryId;
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
<script type="text/javascript">
$(document).ready(function() {
$("textarea").jqte();
$(".jqte").css("width","400px");
$(".jqte").css("margin-left","auto");
$(".jqte").css("margin-right","24%");
});
</script>
 </head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">
<div id="register">
<div class="step">Step 1: Edit List Property </div>

<div id="tcontent1" style="display:;">
<form action="files/application_file.php?action=edit_step_one" method="post" name="step_one" id="step_one" >


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
<option <?php if($row["property_category_id"]==$rsProperty["property_category_id"]){ ?> selected="selected" <?php } ?> value="<?php echo $rsProperty["property_category_id"]?>"><?php echo $rsProperty["property_category_name"]?></option>
<?php } } ?>


</select><br />
 

<label>Transaction Type  : </label> <div class="profile"><br /> 
<input type="radio"  <?php if($row["property_transaction_type"]=='sell'){ ?> checked="checked" <?php } ?>  name="property_transaction_type"   value="sell"/> Sell 
<input <?php if($row["property_transaction_type"]=='rent'){ ?> checked="checked" <?php } ?> type="radio"  value="rent" name="property_transaction_type" /> Rent 

<input type="hidden" name="_method"  value="Add Property"/></div>
<div class="clear"></div>   
<label>New/Resale Property : </label> <div class="profile"><br /> <input <?php if($row["property_type"]=='New'){ ?> checked="checked" <?php } ?> type="radio" name="property_type" value="New" /> New Property <input type="radio" name="property_type"  <?php if($row["property_type"]=='Resale'){ ?> checked="checked" <?php } ?> value="Resale" /> Resale Property </div>
<div class="clear"></div>   
<label>County :</label> <select class="select" name="state_id" onchange="getcity(this.value)">
<option value="">Select Counties</option>
<?php

$strStates=dbQuery("select * from  states where country_id=222 order by state_name") ;
while($rsState=dbFetchArray($strStates)){
?>
 
<option  <?php if($row["state_id"]==$rsState["state_id"]){ ?> selected="selected" <?php } ?>  value="<?php echo $rsState["state_id"]?>"><?php echo $rsState["state_name"]?></option>
<?php } ?> </select><br />
<label>Locality :</label> <div id="city"><select name="city_id" class="select" >
<option>Select Cities</option>
<?php

$cityQuery=dbQuery("SELECT * FROM cities where state_id='".$row["state_id"]."' ORDER BY name");
					while($cityInfo=dbFetchArray($cityQuery)){?>
				 <option <?php if($row["city_id"]==$cityInfo["ID"]){ ?> selected="selected" <?php } ?>  value="<?php echo $cityInfo['ID'];?>"><?php echo $cityInfo['name'];?></option>
				 <?php } ?>
</select></div><br />
<label>Area :</label> <?php $area=explode(" ",$row["property_area"]);?><input type="text" name="property_area"  value="<?php echo $area[0];?>" style="width:145px;" class="input" />
<select  class="select" style="width:130px;"  name="unit" >
<option  <?php if($area[1]=='Sq-ft'){ ?> selected="selected" <?php } ?> value="Sq-ft">Sq-ft</option>
<option  <?php if($area[1]=='Sq-yrd'){ ?> selected="selected" <?php } ?> value="Sq-yrd">Sq-yrd</option>
<option  <?php if($area[1]=='Sq-m'){ ?> selected="selected" <?php } ?> value="Sq-m">Sq-m</option>
</select>
<br />
<label>Listing Price :</label> <input type="hidden" value="<?php echo $_GET["source"];?>" name="source" /><input type="text" value="<?php echo $row["property_total_price"]?>" name="property_total_price" class="input" /><br />
<div id="pro">
<label>Bedrooms </label><select class="select"  name="property_bedrooms">
<option value="">-- Number of Bedroom --</option>
<?php for($i=1;$i<11;$i++){ ?>
<option <?php if($row["property_bedrooms"]==$i){ ?> selected="selected" <?php } ?>  value="<?php echo $i?>"><?php echo $i?></option>
<?php } ?>
<option value="11" <?php if($row["property_bedrooms"]==11){ ?> selected="selected" <?php } ?> >10+</option></select><br />

<label>Floor Number  </label><select class="select" name="property_floor_number">

<option value=""  selected="">-- Floor Number --</option>
						<option <?php if($row["property_floor_number"]=='Under Construction'){ ?> selected="selected" <?php } ?> value="Under Construction">Under Construction</option>
						<option <?php if($row["property_floor_number"]=='Basement'){ ?> selected="selected" <?php } ?> value="Basement">Basement</option>
						<option <?php if($row["property_floor_number"]=='Ground Floor'){ ?> selected="selected" <?php } ?> value="Ground Floor">Ground Floor</option>
						<option <?php if($row["property_floor_number"]=='Mezzanine Floor'){ ?> selected="selected" <?php } ?> value="Mezzanine Floor">Mezzanine Floor</option>
						<?php for($i=1;$i<41;$i++){ ?>
						<option <?php if($row["property_floor_number"]==$i){ ?> selected="selected" <?php } ?> value="<?php echo $i?>"><?php echo $i?></option>
						<?php } ?>
						<option <?php if($row["property_floor_number"]=='41'){ ?> selected="selected" <?php } ?> value="41">More than 40</option></select>
		</div>
						<br />
						
<label>Property Description <span>(Min 200 chars)</span>  </label> <textarea name="property_description" class="textarea"><?php echo $row["property_description"]?></textarea> <br />
<label>New Home</label><input type="checkbox" name="newhome" value="new" <?php echo ($row['new_home_status']=="new" ? 'checked' : '');?> style="margin-top:13px;"><br>
<label>&nbsp;</label> <input type="submit" name="" class="Change submit" value="Submit" />

</form>

<div class="step2">Step 2: Edit Optional Property Details </div>
<div class="step2">Step 3: Edit Contact Details </div>

</div>


</div>
</div>
<!--Middle End-->

<!--Fotter Start-->
<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
