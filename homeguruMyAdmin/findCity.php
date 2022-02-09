<?php
require("../includes/application.php");
?>
<?php 
$county=$_GET['county'];
if($county!=''){

?>
<select name="city_id" id="city_id" class="select">
<option>Select Cities</option>
<?php

$cityQuery=dbQuery("SELECT * FROM cities where state_id='".$county."' ORDER BY name");
					while($cityInfo=dbFetchArray($cityQuery)){?>
				 <option value="<?php echo $cityInfo['ID'];?>"><?php echo $cityInfo['name'];?></option>
				 <?php } ?>
</select>
<?php }?>