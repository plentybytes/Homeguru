<?php 
$seoId=19;
include('includes/application.php');
require("includes/user_application.php");

$strProperty=dbQuery("SELECT * FROM property where user_id='".$_SESSION['user']['id']."' and property_id='".base64_decode($_GET["source"])."'");
$strPropertyImage=dbQuery("SELECT * FROM property_images where property_file_type='image'and property_id='".base64_decode($_GET["source"])."'");
$strPropertyVideo=dbQuery("SELECT * FROM property_images where property_file_type='video' and property_id='".base64_decode($_GET["source"])."'");
	$numVideo=dbNumRows($strPropertyVideo);
	$numImage=dbNumRows($strPropertyImage);
	$leftImage=9-($numImage);
	$leftVideo=9-($numVideo);
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
<?php echo $rsultSeo;?>


<title> <?php echo $userInfo["user_first_name"]."'s ".$rsultSe["seo_title"];?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>

<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/custom.js" type="text/javascript"></script>
<script language="javascript">
    row_no1=0;
    function addRow(tbl,row){
    //row count
    row_no1++;
    var tick = String(row_no1);
    if (row_no1< <?php echo $leftImage?> ){
    //Declaring text boxes
    var textbox ='<input type="file" size="35" style="float:left; margin-top:15px;" class="input" name="property_images[]"  />';
   
    //delete button
    var stop = '<a href="javascript:void(0)" style="float:left;text-decoration:none; " onclick="deleteRow(this)"><strong>- Delete</strong></a>';
    //Inserting textboxes into table cells
    var tbl = document.getElementById(tbl);
    var rowIndex = document.getElementById(row).value;
    var newRow = tbl.insertRow(row_no1);
   
	  var newCell = newRow.insertCell(0);
      newCell.innerHTML = textbox;
    //delete button within cell
    var newCell = newRow.insertCell(1);
    newCell.innerHTML = stop;
    }
	else{
	alert("You Only Add 10 images");
	}
    }
    //Delete Function
    function deleteRow(r)
    {
    var i=r.parentNode.parentNode.rowIndex;
    document.getElementById('TableMain').deleteRow(i);
    }
	row_n=0;
    function addRowa(tbl,row){
    //row count
    row_n++;
    var tick = String(row_n);
    if (row_n< <?php echo $leftVideo?>){
    //Declaring text boxes
    var textbox ='<input type="file" size="35" style="float:left; margin-top:15px;" class="input" name="property_video[]" />';
   
    //delete button
    var stop = '<a href="javascript:void(0)" style="float:left;text-decoration:none; " onclick="deleteeRow(this)"><strong>- Delete</strong></a>';
    //Inserting textboxes into table cells
    var tbl = document.getElementById(tbl);
    var rowIndex = document.getElementById(row).value;
    var newRow = tbl.insertRow(row_n);
   
	  var newCell = newRow.insertCell(0);
      newCell.innerHTML = textbox;
    //delete button within cell
    var newCell = newRow.insertCell(1);
    newCell.innerHTML = stop;
    }
	else{
	alert("You Only Add 10 video");
	}
    }
    //Delete Function
    function deleteeRow(r)
    {
    var i=r.parentNode.parentNode.rowIndex;
    document.getElementById('TableMaina').deleteRow(i);
    }
    </script>
 </head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">
<div id="register">
<div class="step2">Step 1: Edit List Property </div>
<div class="step">Step 2: Edit Optional Property Details </div>
<div id="tcontent1" style="display:;">
<form action="files/application_file.php?action=edit_step_two" method="post" enctype="multipart/form-data" name="step_two" id="step_two">

<label>Total Floors in Building :</label>
<br />
 
<label>Age of Construction : </label> <select name="property_construction" class="select">
					<option value="">-- Age of Construction --</option>
					<option  <?php if($row["property_construction"]=='Under Construction'){ ?> selected="selected" <?php } ?> value="Under Construction">Under Construction</option>
					<option  <?php if($row["property_construction"]=='Ready to move'){ ?> selected="selected" <?php } ?> value="Ready to move">New - Ready to move-in</option>
					<option <?php if($row["property_construction"]=='2 years'){ ?> selected="selected" <?php } ?>  value="2 years">0 - 2 Years old</option>
					<option  <?php if($row["property_construction"]=='5 years'){ ?> selected="selected" <?php } ?> value="5 years">2 - 5 Years old</option>
					<option  <?php if($row["property_construction"]=='10 years'){ ?> selected="selected" <?php } ?> value="10 years">5 - 10 Years old</option>
					<option  <?php if($row["property_construction"]=='15 years'){ ?> selected="selected" <?php } ?> value="15 years">10 - 15 Years old</option>
					<option  <?php if($row["property_construction"]=='20 years'){ ?> selected="selected" <?php } ?> value="20 years">15 - 20 Years old</option>
					<option  <?php if($row["property_construction"]=='21 years'){ ?> selected="selected" <?php } ?> value="21 years">More than 20 Years old</option>
					</select>
<select name="property_total_floor_number" class="select">
  <option value="" selected="">-- Total Floors in Building --</option>
  <?php for($i=1;$i<41;$i++){ ?>
  <option value="<?php echo $i?>" <?php if($row["property_total_floor_number"]==$i){ ?> selected="selected" <?php } ?>><?php echo $i?></option>
  <?php } ?>
  <option value="41" <?php if($row["property_total_floor_number"]==41){ ?> selected="selected" <?php } ?>>More than 40</option>
</select>
<br />
  <label>Address :</label><textarea name="property_address" > </textarea><br />
<label>Furnished :</label> <select name="property_furnishing" class="select">
<option value="">-- Select furnishing --</option>
					<option <?php if($row["property_furnishing"]=='Unfurnished'){ ?> selected="selected" <?php } ?>value="Unfurnished">Unfurnished</option>
					<option <?php if($row["property_furnishing"]=='Semi-Furnished'){ ?> selected="selected" <?php } ?>value="Semi-Furnished">Semi-furnished</option>
					<option <?php if($row["property_furnishing"]=='Furnished'){ ?> selected="selected" <?php } ?> value="Furnished">Furnished</option></select><br />
					
<label>Facing :</label> <select  name="property_directional_facing" class="select">
<option value="">-- Select direction --</option>
<?php 
$face=showDirectionalFacing();
foreach($face as $key => $value){?>
					<option <?php if($row["property_directional_facing"]==$key){ ?> selected="selected" <?php } ?> value="<?php echo $key; ?>"><?php echo $value;?></option>
					<?php } ?>
					</select><br />

<label>Ownership Type :</label> <select name="property_ownership_type" class="select">
<option value="">-- Select Ownership Type --</option>
<?php 
$Ownership=showOwnership();
foreach($Ownership as $key => $value){?>
					<option <?php if($row["property_ownership_type"]==$key){ ?> selected="selected" <?php } ?>  value="<?php echo $key; ?>"><?php echo $value;?></option>
					<?php } ?>
					


</select><br />

<label style="color:#163967;">Additional Features : </label>
<div class="clear"></div>
<label style="text-align:center;">Amenities</label>
<div class="clear">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" width="70%" align="center">
						<tr class="columnhead" style="font-size:12px;"> 	<?php   $amentie=explode(",",$row["property_amenties"]);?>
							<td width="28%"><input title="amenities" name="amenities[]"  <?php if(in_array('1',$amentie)){ ?> checked="checked" <?php } ?> class="textcontrol" id="amenities" value="1" type="checkbox">
							Power Backup</td>
							<td class="paddingleft10" width="20%"><input title="amenities"<?php if(in_array('2',$amentie)){ ?> checked="checked" <?php } ?>  name="amenities[]" class="textcontrol" id="amenities" value="2" type="checkbox">
							Lift</td>
							<td class="paddingleft10" width="36%"><input title="amenities"<?php if(in_array('3',$amentie)){ ?> checked="checked" <?php } ?>  name="amenities[]" class="textcontrol" id="amenities" value="3" type="checkbox">
							Rain Water Harvesting</td>
							<td class="paddingleft10" width="16%"><input title="amenities"<?php if(in_array('4',$amentie)){ ?> checked="checked" <?php } ?>  name="amenities[]" class="textcontrol" id="amenities" value="4" type="checkbox">
							Club</td>
						</tr>
						<tr><td colspan="4" class="lineheight" height="10">&nbsp;</td></tr>
						<tr class="columnhead" style="font-size:12px;">
							<td width="28%"><input title="amenities" name="amenities[]" <?php if(in_array('5',$amentie)){ ?> checked="checked" <?php } ?> class="textcontrol" id="amenities" value="5" type="checkbox">
							Swimming Pool</td>
							<td class="paddingleft10" width="20%"><input title="amenities"<?php if(in_array('6',$amentie)){ ?> checked="checked" <?php } ?>  name="amenities[]" class="textcontrol" id="amenities" value="6" type="checkbox">
							Security</td>
							<td class="paddingleft10"><input title="amenities" name="amenities[]"<?php if(in_array('7',$amentie)){ ?> checked="checked" <?php } ?> class="textcontrol" id="amenities" value="7" type="checkbox">
							Reserved Parking</td>
							<td class="paddingleft10"><input title="amenities" name="amenities[]"<?php if(in_array('8',$amentie)){ ?> checked="checked" <?php } ?> class="textcontrol" id="amenities" value="8" type="checkbox">
							Gym</td>
						</tr>
						<tr><td colspan="4" class="lineheight" height="10">&nbsp;</td></tr>
						<tr class="columnhead" style="font-size:12px;">
							<td><input title="amenities" name="amenities[]" class="textcontrol" <?php if(in_array('9',$amentie)){ ?> checked="checked"<?php } ?> id="amenities" value="9" type="checkbox">
							Servant Quarters</td>
							<td class="paddingleft10"><input title="amenities" name="amenities[]" <?php if(in_array('10',$amentie)){ ?> checked="checked" <?php } ?>class="textcontrol" id="amenities" value="10" type="checkbox">
							Park</td>
							<td class="paddingleft10"><input title="amenities" name="amenities[]" <?php if(in_array('11',$amentie)){ ?> checked="checked" <?php } ?> class="textcontrol" id="amenities" value="11" type="checkbox">
							Vaastu Compliant </td>
							<td>&nbsp;</td>
						</tr>
		</table>
<div class="clear">&nbsp;</div>
<!-- code commented By Akash to hide the Proximity Landmarks section from the edit property page -->
<!--<label>Proximity Landmarks</label>
<div class="clear"></div>
<table border="0" cellpadding="0" cellspacing="0" width="70%" align="center">
						<tr class="columnhead" style="font-size:12px;">
							<td width="31%"><strong>Shopping Mall</strong> <?php   $landmarks=explode(",",$row["property_landmarks"]); ?>
							<select  id="shopping" name="shopping"  class="select2" title="landmarks">
							<option value="" selected="">Select</option>
							<option value="0.5 Kms" <?php if($landmarks[0]=='0.5 Kms'){ ?> selected="selected" <?php } ?> >0.5 Kms</option>
							<?php for($k=1;$k<11;$k++){
							$val=$k." Kms";
							?>
							<option value="<?php echo $val ?>" <?php if($landmarks[0]==$val){ ?> selected="selected" <?php } ?>><?php echo $val ?></option>
							<?php } ?>
	</select></td>
							<td width="23%"><strong>School</strong> <select id="school" name="school" class="select2" title="landmarks"><option value="" selected="">Select</option><option value="0.5 Kms" <?php if($landmarks[1]=='0.5 Kms'){ ?> selected="selected" <?php } ?> >0.5 Kms</option>
							<?php for($k=1;$k<11;$k++){
							$val=$k." Kms";
							?>
							<option value="<?php echo $val ?>" <?php if($landmarks[1]==$val){ ?> selected="selected" <?php } ?>><?php echo $val ?></option>
							<?php } ?></select></td>
							<td width="25%"><strong>Hospital</strong> <select id="hospital" name="hospital"  class="select2" title="landmarks"><option value="" selected="">Select</option><option value="0.5 Kms" <?php if($landmarks[2]=='0.5 Kms'){ ?> selected="selected" <?php } ?> >0.5 Kms</option>
							<?php for($k=1;$k<11;$k++){
							$val=$k." Kms";
							?>
							<option value="<?php echo $val ?>" <?php if($landmarks[2]==$val){ ?> selected="selected" <?php } ?>><?php echo $val ?></option>
							<?php } ?></select></td>
							<td width="22%"><strong>ATM</strong> <select id="atm" name="atm"   class="select2" title="landmarks"><option value="" selected="">Select</option><option value="0.5 Kms" <?php if($landmarks[3]=='0.5 Kms'){ ?> selected="selected" <?php } ?> >0.5 Kms</option>
							<?php for($k=1;$k<11;$k++){
							$val=$k." Kms";
							?>
							<option value="<?php echo $val ?>" <?php if($landmarks[3]==$val){ ?> selected="selected" <?php } ?>><?php echo $val ?></option>
							<?php } ?></select><input type="hidden" value="<?php echo $_GET["source"];?>" name="source" /></td>
						</tr>
		</table>-->
<div class="clear">&nbsp;</div>
<?php if($numImage<10){?>
<label>Upload property image<br />
<span> (Min. dimension 350 x 350) </span></label> <input  type="file" name="property_images[]" class="input" style="float:left; margin-top:15px;" size="35" /> <div><img src="images/property.jpg" alt="" /></div> <a href="javascript:void(0)" onClick="addRow('TableMaina','rowe1')" style="text-decoration:none;"><strong>+ Add More</strong></a> <br />
<label>  &nbsp;</label>&nbsp;<table width="42%" border="0" style="" cellspacing="0" cellpadding="0" id="TableMaina">
    <!--Headers-->
  
    <tr id="rowe1">
    </tr>
    </table>
	<?php }else{ ?>
<label>  &nbsp;</label><div class="">You upload maximum property images </div>	
	<?php } ?>
<div class="clear">&nbsp;</div>
<?php if($numImage<10){?>
<label>Upload property video<br />
<span> (Min. dimension 350 x 350) </span></label> <input  type="file" name="property_video[]" style="float:left; margin-top:15px;" class="input" size="35" /> <div><br /><a href="javascript:void(0)" onClick="addRowa('TableMain','rowe')" style="text-decoration:none;"><strong>+ Add More</strong></a></div> 
 <br />
<label>  &nbsp;</label>&nbsp;<table width="42%" border="0" style="" cellspacing="0" cellpadding="0" id="TableMain">
    <!--Headers-->
  
    <tr id="rowe">
    </tr>
    </table>
	<?php }else{ ?>
<label>  &nbsp;</label><div class="">You upload maximum property video </div>	
	<?php } ?>
<div class="clear">&nbsp;</div>
<label>Locate your property on Map  </label> <div class="profile"><iframe width="500" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=United+Kingdom&amp;aq=3&amp;oq=u&amp;sll=30.066753,79.0193&amp;sspn=5.019055,10.821533&amp;ie=UTF8&amp;hq=&amp;hnear=United+Kingdom&amp;ll=55.378051,-3.435973&amp;spn=13.214095,43.286133&amp;t=m&amp;z=5&amp;output=embed"></iframe></div>

		<div class="clear">&nbsp;</div>			
<label>&nbsp;</label><input type="hidden" name="addId" value="<?php echo $_GET["addId"];?>" /><input type="hidden" name="source" value="<?php echo $_GET["source"];?>" /> <input type="hidden" name="_method" value="Add Step Two" /><input type="submit" name="" class="submit" value="Submit" />

</form>


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
