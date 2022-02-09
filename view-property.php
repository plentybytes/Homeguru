<?php 
$seoId=14;
	require("includes/application.php");
	require("includes/user_application.php");
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
<?php echo $rsultSeo;?>


<title> <?php echo $userInfo["user_first_name"]."'s ".$rsultSe["seo_title"];?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="jwplayer/jwplayer.js" type="text/javascript"></script>

</head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">
<div id="register">


<div id="view-property">
<h1>My <strong>Property</strong></h1>


<label>Property Type :</label> <div class="view-content"><?php echo showCategory($row["property_category_id"])?></div>
 <div class="clear"></div>  

<label>Transaction Type :</label>  <div class="view-content"><?php echo $row["property_transaction_type"]?></div>
<div class="clear"></div>   
<label>New/Resale Property :</label>  <div class="view-content"><?php echo $row["property_type"]?> </div>
<div class="clear"></div>   
<label>County :</label> <div class="view-content"><?php echo showCounty($row["state_id"])?></div>
<div class="clear"></div> 
<label>Locality :</label> <div class="view-content"><?php echo showLocality($row["state_id"])?></div>
<div class="clear"></div> 
<label>Area :</label> <div class="view-content"><?php echo $row["property_area"]?> </div>
<div class="clear"></div> 
<label>Listing Price :</label> <div class="view-content"><?php echo $row["property_total_price"]?></div>
<div class="clear"></div> 
<label>Bedrooms :</label> <div class="view-content"><?php echo $row["property_bedrooms"]?></div>
<div class="clear"></div> 
<label>Floor Number :</label> <div class="view-content"><?php echo $row["property_floor_number"]?></div>
<div class="clear"></div> 
						
				
<label>Property Description :</label> <div class="view-content"><?php echo $row["property_description"]?> </div>
<div class="clear"></div> 		

				
<label>Property Address :</label> <div class="view-content"><?php echo $row["property_address"]?> <?php echo strtoupper($row["property_postal_code"]);?></div>
<div class="clear"></div> 	


<label>Total Floors in Building :</label> <div class="view-content"><?php echo $row["property_total_floor_number"]?></div>
 <div class="clear"></div> 
<label>Age of Construction :</label> <div class="view-content"><?php echo $row["property_construction"]?>  </div>
 <div class="clear"></div> 
<label>Furnished :</label> <div class="view-content"><?php echo $row["property_furnishing"]?></div>
 <div class="clear"></div> 					
<label>Facing :</label> <div class="view-content"><?php echo $row["property_furnishing"]?></div>
 <div class="clear"></div> 	
<label>Ownership Type :</label> <div class="view-content"><?php $Ownership=showOwnership($row["property_ownership_type"]);?> .</div>
 <div class="clear">&nbsp;</div>
 <label style="color:#163967;">Additional Features : </label>
<div class="clear">&nbsp;</div>
<label>Amenities</label> <div class="view-content">
<?php   $amenties=explode(",",$row["property_amenties"]);
			
			foreach($amenties as $key => $value){
			if($key>0){ echo ", ";}echo showAmenties($value);
			}
			?></div>
<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>
<!-- commented by akash to hide the proximity landmarks -->
<!--<h2>Proximity Landmarks</h2> 
<?php   //$landmarks=explode(",",$row["property_landmarks"]);?>
			
			<label><strong>Shopping mall: </strong></label> <div class="view-content"><?php  //echo $landmarks[0];?></div>
			 <div class="clear">&nbsp;</div>
			 <label>School:</label> <div class="view-content"> <?php  //echo $landmarks[1];?></div>
			 <div class="clear">&nbsp;</div> <label>Hospital:</label> <div class="view-content"> <?php  //echo $landmarks[2];?></div>
			  <div class="clear">&nbsp;</div>
			  <label>ATM:</label> <div class="view-content"><?php  //echo $landmarks[3];?></div>-->
		
			<div class="clear"></div>

<div class="clear">&nbsp;</div>

 <label> Property images</label> <div class="view-content">
<?php $strPropertyImage=dbQuery("SELECT * FROM property_images where property_file_type='image' and property_id='".$row["property_id"]."'");
		while($rows=dbFetchArray($strPropertyImage)){
		
?>
<img src="images/property_images/<?php echo $rows["property_images"]?>" height="250px" width="250px" />
<?php } ?></div>

		<div class="clear">&nbsp;</div>			

<label>Property Video</label> <div class="view-content">
<?php $strPropertyImage=dbQuery("SELECT * FROM property_images where property_file_type='video' and property_id='".$row["property_id"]."'");
		$i=1;
		while($rows1=dbFetchArray($strPropertyImage)){
		
?>

	




 <div id="container<?php echo $i?>"><div style="margin-top:140px;margin-left:250px"><img src="images/loading.gif"><div style="margin-left:-25px; margin-top:10px">Loading Player<span style="text-decoration:blink;">...</span></div></div></div>  
	<script type="text/javascript"> 
		jwplayer("container<?php echo $i?>").setup({ 
			flashplayer: "jwplayer/player.swf", 
			file: "<?php echo"images/property_video/1365238085o.mp4";?>", 
			height: 250, 
			frontcolor: 'cccccc',
		    lightcolor: '66cc00',
		    skin: 'jwplayer/stylish.swf',
			stretching: 'fill',
    		controlbar: 'bottom',
			fullscreen: 'true',
			author: 'HomeGuru',
			date: '<?=date('d/M/Y',strtotime($row['property_created_date']))?>',
			volume: '50',
			width: 350 
		}); 
	</script>
	<div class="clear">&nbsp;</div>			
	<?php $i++; } ?>
	</div>
		<div class="clear">&nbsp;</div>			


</div>
</div>
  <div class="clear"></div>
</div><!--Middle End-->

<!--Fotter Start-->
<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
