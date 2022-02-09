<?php 
$seoId=8;
include('includes/application.php');
require("includes/user_application.php");

if($_SESSION["source1"]!=base64_decode($_GET["source"])){
redirect(hrefLink("property_step_one.php"));

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?>


<title> <?php echo $userInfo["user_first_name"]."'s ".$rsultSe["seo_title"];?></title>

<link href="css/style.css" rel="stylesheet" type="text/css" />
<style>
#map {

width:905px; background-color:#999; height:500px;
margin-top: 1em;
}
</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>

<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/custom.js" type="text/javascript"></script>
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
	


function getMapLocation(map) {		
		var strURL="findmap.php?county="+map;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('mapView').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}


</script>
<script language="javascript">
    row_no1=0;
    function addRow(tbl,row){
    //row count
    row_no1++;
    var tick = String(row_no1);
    if (row_no1<10){
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
    if (row_n<10){
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

<body  onLoad="initialize()">
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">
<div id="register">
<div class="step2">Step 1: List Property </div>
<div class="step">Step 2: Optional Property Details </div>
<div id="tcontent1" style="display:;">
<form action="files/application_file1.php?action=property_step_two" method="post" enctype="multipart/form-data" name="step_two" id="step_two">

<label>Total Floors in Building :</label><select name="property_total_floor_number" class="select">
<option value="" selected="">-- Total Floors in Building --</option>

<?php for($i=1;$i<41;$i++){ ?>
<option value="<?php echo $i?>"><?php echo $i?></option>
<?php } ?>
<option value="41">More than 40</option></select><br />
 
<label>Age of Construction : </label> <select name="property_construction" class="select">
					<option value="">-- Age of Construction --</option>
					<option value="Under Construction">Under Construction</option>
					<option value="Ready to move">New - Ready to move-in</option>
					<option value="2 years">0 - 2 Years old</option>
					<option value="5 years">2 - 5 Years old</option>
					<option value="10 years">5 - 10 Years old</option>
					<option value="15 years">10 - 15 Years old</option>
					<option value="20 years">15 - 20 Years old</option>
					<option value="21 years">More than 20 Years old</option>
					</select><br />
 
<label>Furnished :</label> <select name="property_furnishing" class="select">
<option value="">-- Select furnishing --</option>
					<option value="Unfurnished">Unfurnished</option>
					<option value="Semi-Furnished">Semi-furnished</option>
					<option value="Furnished">Furnished</option></select><br />
					
<label>Facing :</label> <select  name="property_directional_facing" class="select">
<option value="">-- Select direction --</option>
<?php 
$face=showDirectionalFacing();
foreach($face as $key => $value){?>
					<option value="<?php echo $key; ?>"><?php echo $value;?></option>
					<?php } ?>
					</select><br />

<label>Ownership Type :</label> <select name="property_ownership_type" class="select">
<option value="">-- Select Ownership Type --</option>
<?php 
$Ownership=showOwnership();
foreach($Ownership as $key => $value){?>
					<option value="<?php echo $key; ?>"><?php echo $value;?></option>
					<?php } ?>
					


</select><br />

<label style="color:#163967;">Additional Features : </label>
<div class="clear"></div>
<label style="text-align:center;">Amenities</label>
<div class="clear">&nbsp;</div>
<table border="0" cellpadding="0" cellspacing="0" width="70%" align="center">
						<tr class="columnhead" style="font-size:12px;">
							<td width="28%"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="1" type="checkbox">
							Power Backup</td>
							<td class="paddingleft10" width="20%"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="2" type="checkbox">
							Lift</td>
							<td class="paddingleft10" width="36%"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="3" type="checkbox">
							Rain Water Harvesting</td>
							<td class="paddingleft10" width="16%"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="4" type="checkbox">
							Club</td>
						</tr>
						<tr><td colspan="4" class="lineheight" height="10">&nbsp;</td></tr>
						<tr class="columnhead" style="font-size:12px;">
							<td width="28%"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="5" type="checkbox">
							Swimming Pool</td>
							<td class="paddingleft10" width="20%"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="6" type="checkbox">
							Security</td>
							<td class="paddingleft10"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="7" type="checkbox">
							Reserved Parking</td>
							<td class="paddingleft10"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="8" type="checkbox">
							Gym</td>
						</tr>
						<tr><td colspan="4" class="lineheight" height="10">&nbsp;</td></tr>
						<tr class="columnhead" style="font-size:12px;">
							<td><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="9" type="checkbox">
							Servant Quarters</td>
							<td class="paddingleft10"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="10" type="checkbox">
							Park</td>
							<td class="paddingleft10"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="11" type="checkbox">
							Vaastu Compliant </td>
							<td>&nbsp;</td>
						</tr>
		</table>
<div class="clear">&nbsp;</div>
<!--<label>Proximity Landmarks</label>
<div class="clear"></div>
<table border="0" cellpadding="0" cellspacing="0" width="70%" align="center">
						<tr class="columnhead" style="font-size:12px;">
							<td width="31%"><strong>Shopping Mall</strong> <select  id="shopping" name="shopping"  class="select2" title="landmarks"><option value="" selected="">Select</option><option value="0.5 Kms">0.5 Kms</option><option value="1 Km">1 Km</option><option value="2 Kms">2 Kms</option><option value="3 Kms">3 Kms</option><option value="4 Kms">4 Kms</option><option value="5 Kms">5 Kms</option><option value="6 Kms">6 Kms</option><option value="7 Kms">7 Kms</option><option value="8 Kms">8 Kms</option><option value="9 Kms">9 Kms</option><option value="10 Kms">10 Kms</option></select></td>
							<td width="23%"><strong>School</strong> <select id="school" name="school" class="select2" title="landmarks"><option value="" selected="">Select</option><option value="0.5 Kms">0.5 Kms</option><option value="1 Km">1 Km</option><option value="2 Kms">2 Kms</option><option value="3 Kms">3 Kms</option><option value="4 Kms">4 Kms</option><option value="5 Kms">5 Kms</option><option value="6 Kms">6 Kms</option><option value="7 Kms">7 Kms</option><option value="8 Kms">8 Kms</option><option value="9 Kms">9 Kms</option><option value="10 Kms">10 Kms</option></select></td>
							<td width="25%"><strong>Hospital</strong> <select id="hospital" name="hospital"  class="select2" title="landmarks"><option value="" selected="">Select</option><option value="0.5 Kms">0.5 Kms</option><option value="1 Km">1 Km</option><option value="2 Kms">2 Kms</option><option value="3 Kms">3 Kms</option><option value="4 Kms">4 Kms</option><option value="5 Kms">5 Kms</option><option value="6 Kms">6 Kms</option><option value="7 Kms">7 Kms</option><option value="8 Kms">8 Kms</option><option value="9 Kms">9 Kms</option><option value="10 Kms">10 Kms</option></select></td>
							<td width="22%"><strong>ATM</strong> <select id="atm" name="atm"   class="select2" title="landmarks"><option value="" selected="">Select</option><option value="0.5 Kms">0.5 Kms</option><option value="1 Km">1 Km</option><option value="2 Kms">2 Kms</option><option value="3 Kms">3 Kms</option><option value="4 Kms">4 Kms</option><option value="5 Kms">5 Kms</option><option value="6 Kms">6 Kms</option><option value="7 Kms">7 Kms</option><option value="8 Kms">8 Kms</option><option value="9 Kms">9 Kms</option><option value="10 Kms">10 Kms</option></select></td>
						</tr>
		</table>-->
<div class="clear">&nbsp;</div>

<label>Upload property image<br />
<span> (Min. dimension 350 x 350) </span></label> <input  type="file" name="property_images[]" class="input" style="float:left; margin-top:15px;" size="35" /> <div><img src="images/property.jpg" alt="" /></div> <a href="javascript:void(0)" onClick="addRow('TableMaina','rowe1')" style="text-decoration:none;"><strong>+ Add More</strong></a> <br />
<label>  &nbsp;</label>&nbsp;<table width="42%" border="0" style="" cellspacing="0" cellpadding="0" id="TableMaina">
    <!--Headers-->
  
    <tr id="rowe1">
    </tr>
    </table>
<div class="clear">&nbsp;</div>
<label>Upload property video<br />
<span> (Min. dimension 350 x 350<br>Note - Home Video can take some time to upload depending on your connection speed.) </span></label> <input  type="file" name="property_video[]" style="float:left; margin-top:15px;" class="input" size="35" /> <div><br /><a href="javascript:void(0)" onClick="addRowa('TableMain','rowe')" style="text-decoration:none;"><strong>+ Add More</strong></a></div> 
 <br />
<div class="clear">&nbsp;</div>
<label>Youtube video url<br />
<span></span></label> <input  type="text" name="yourtube" class="input" size="35" /> 
 <br />
<label>  &nbsp;</label>&nbsp;<table width="42%" border="0" style="" cellspacing="0" cellpadding="0" id="TableMain">
    <!--Headers-->
  
    <tr id="rowe">
    </tr>
    </table>
<div class="clear">&nbsp;</div>
<!--<label>Write your property location:</label> <div class="profile">
<input type="text" name="location12"  id="location12"  />--><input type="hidden" name="location12"  id="location12"  /><input type="hidden" name="location13"  id="location13"  /> <input type="hidden" name="lat"  id="lat"  /><input type="hidden" name="lag"  id="lag"  /><!--</div>-->
<div class="clear">&nbsp;</div>
<label>Your property on Map  </label> <div id="map"></div>


<script type="text/javascript">

$(document).ready(function() {
	

var geocoder, map, address;

function codeAddress(address) {
	
    geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        'address': address
    }, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var myOptions = {
                zoom: 8,
                 center: results[0].geometry.location,
				//center: {lat: -34.397, lng: 150.644},
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById("map"), myOptions);

            var marker = new google.maps.Marker({
                map: map,
                position: results[0].geometry.location
            });
marker.setPosition(results[0].geometry.location);
infowindow = new google.maps.InfoWindow();
infowindow.setContent(results[0].formatted_address);



infowindow.open(map, marker);
document.getElementById('location13').value=results[0].formatted_address;
document.getElementById('lat').value=results[0].geometry.location.lat();

document.getElementById('lag').value=results[0].geometry.location.lng();
        }
    });
}

codeAddress("<?php echo $_SESSION['postcode'];?>");
});
//  stephin nadar

</script>


		<div class="clear">&nbsp;</div>			
<label>&nbsp;</label><input type="hidden" name="addId" value="<?php echo $_GET["addId"];?>" /><input type="hidden" name="source" value="<?php echo $_GET["source"];?>" /> <input type="hidden" name="_method" value="Add Step Two" /><input type="submit" name="" class="submit" value="Submit" />

</form>


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
