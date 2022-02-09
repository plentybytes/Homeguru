<?php $seoId=23;
include('includes/application.php');
$strProperty=dbQuery("SELECT * FROM property where  property_id='".base64_decode($_GET["proid"])."'");
	$num=dbNumRows($strProperty);
	if($num==0){
	$messageStack->addMessageSession("Source id not found try again.", "error");
	redirect(hrefLink("property_list.php"));
	
	}else{
	$row=dbFetchArray($strProperty);
	}
	

	
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?>
<?php echo $seoTitle;?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/tabcontent.js" type="text/javascript"></script>
<script type="text/javascript" src="js/compressed.js"></script>
<link href="css/silder.css" rel="stylesheet" type="text/css" />
</head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">
<div id="register">


<div id="view-property">
<h1>View  Of Sold <strong>Property</strong></h1>


<label>Property Type :</label> <div class="view-content"><?php echo showCategory($row["property_category_id"])?></div>
 <div class="clear"></div>  

<label>Transaction Type :</label>  <div class="view-content"><?php echo $row["property_transaction_type"]?></div>
<div class="clear"></div>   
<label>New/Resale Property :</label>  <div class="view-content"><?php echo $row["property_type"]?> </div>

<div class="clear"></div> 
<label>Locality :</label> <div class="view-content"><?php echo showLocality($row["state_id"])?></div>
<div class="clear"></div> 
 
<label>Listing Price :</label> <div class="view-content"><?php echo $row["property_total_price"]?></div>
<div class="clear"></div> 
<label>Bedrooms :</label> <div class="view-content"><?php echo $row["property_bedrooms"]?></div>
<div class="clear"></div> 
<label>Floor Number :</label> <div class="view-content"><?php echo $row["property_floor_number"]."floors";?></div>
<div class="clear"></div> 
						
				
<label>Property Description :</label> <div class="view-content"><?php echo $row["property_description"]?> </div>
<div class="clear"></div> 		


<label>Total Floors in Building :</label> <div class="view-content"><?php echo $row["property_total_floor_number"]?></div>

 <div class="clear"></div> 
<label>Furnished :</label> <div class="view-content"><?php echo $row["property_furnishing"]?></div>
 <div class="clear"></div> 					
<label>Facing :</label> <div class="view-content"><?php echo $row["property_furnishing"]?></div>
 <div class="clear"></div> 	
<label>Ownership Type :</label> <div class="view-content"><?php $Ownership=showOwnership($row["property_ownership_type"]);?> .</div>
 <div class="clear">&nbsp;</div>
 
<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>

		
			<div class="clear"></div>




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
