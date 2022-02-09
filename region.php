<?php
require("includes/application.php");
?>
<?php 
if(isset($_GET['country']))
{
$country=$_GET['country'];
if($country!=''){

?>
<select name="region_id" id="region_id" class="select" onchange="gettown(this.value)">
<option selected="selected">Select Region</option>
<?php

$rsRegion=dbQuery("SELECT * FROM  uk_region where country_id='".$country."' ORDER BY region_name");
					while($region=dbFetchArray($rsRegion)){?>
				 <option value="<?php echo $region['region_id'];?>"><?php echo $region['region_name'];?></option>
				 <?php } ?>
</select>
<?php }} else { 

$regionID=$_GET['region'];
if($regionID!=''){

?>
<select name="region_id" id="region_id" class="select" >
<option selected="selected">Select Locality</option>
<?php

$rsTown=dbQuery("SELECT * FROM   uk_town where region_id='".$regionID."' ORDER BY town");
					while($town=dbFetchArray($rsTown)){?>
				 <option value="<?php echo $town['town_id'];?>"><?php echo "[".$town['postcode']."]".$town['town'];?></option>
				 <?php } ?>
</select>
<?php } } ?>