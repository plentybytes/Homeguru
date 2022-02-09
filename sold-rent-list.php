<?php 
$seoId=12;
include('includes/application.php');
require("includes/user_application.php");
	$action=isset($_GET["action"]) ? $_GET["action"] : "";
if($action=="delete") {
		if(isset($_GET["source"])){
			$pageId=dbPrepareInput(base64_decode($_GET["source"]));
			 $duplicateImageQuery=dbQuery("SELECT * FROM property_images WHERE property_id=".(int)$pageId); 
   while( $duplicateImage=dbFetchArray($duplicateImageQuery)){
		if($duplicateImage["property_file_type"]!='video'){
	     if(file_exists("images/property_images/".$duplicateImage["property_images"])){
		
        @unlink("images/property_images/".$duplicateImage["property_images"]);
		}
		}else{
		 if(file_exists("images/property_video/".$duplicateImage["property_images"])){
		
        @unlink("images/property_video/".$duplicateImage["property_images"]);
		}
		
		}
		 dbQuery("DELETE FROM property_images WHERE property_image_id=".(int)$duplicateImage["property_image_id"]);
      }
	
 dbQuery("DELETE FROM property WHERE property_id=".(int)$pageId);

	
		$messageStack->addMessageSession("Delete Property successfully.", "success");
		redirect(hrefLink("property_list.php")); 
	}
	}
elseif($action=="sale"){
if(isset($_GET["source"])){
			$pageId=dbPrepareInput(base64_decode($_GET["source"]));
dbQuery("update property set property_change_status='Sold' where property_id=$pageId");
$messageStack->addMessageSession("Property Sold Successfully.", "success");
		redirect(hrefLink("property_list.php")); 
}
}
elseif($action=="rent"){
if(isset($_GET["source"])){
			$pageId=dbPrepareInput(base64_decode($_GET["source"]));
			dbQuery("update property set property_change_status='Rented' where property_id=$pageId");
			$messageStack->addMessageSession("Property Rented Successfully.", "success");
			redirect(hrefLink("property_list.php"));
}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?>


<title> <?php echo $userInfo["user_first_name"]."'s ".$rsultSe["seo_title"];?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />

 
 </head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">
<div id="register">
<div class="step">Property Listing </div>
<div class="mange-table2">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <th>Property Type </th>
    <th>Transaction Type </th>
    <th>Listing Price (&pound;)</th>
    <th>Post Date</th>
    <th>Status</th>
	<th>Action</th>
  </tr>
  <?php
  	$rowsPerPage=(isset($_GET["row"])) ? (int)$_GET["row"] : 20;
    $strProperty="SELECT * FROM property where user_id='".$_SESSION['user']['id']."' and property_status='Active' and property_change_status='Sold' or property_change_status='Rented' ORDER BY property_id DESC";
	$propertyQuery=dbQuery(getPagingQuery($strProperty, $rowsPerPage)); 
	$num=dbNumRows($propertyQuery);
	$pagingLink=getPagingLink($strProperty, $rowsPerPage, getAllGetParams(array("page")));
	if($num>0){
	while($rsProperty=dbFetchArray($propertyQuery)){
	?>
  <tr>
    <td align="center"><?php echo $rsProperty["property_type"]?></td>
    <td align="center"><?php echo $rsProperty["property_transaction_type"]?></td>
    <td align="center"><?php echo $rsProperty["property_total_price"]?></td>
    <td align="center"><?php echo $rsProperty["property_created_date"]?></td>
    <td align="center"><?php if($rsProperty["property_status"]=='Deactive'){ echo "<font color='#d84800' style='font-weight:bold;font-size:13px;'>Wait for approval </font>";}else{ echo "<font color='#007a29' style='font-weight:bold;font-size:13px;'>Approved </font>"; }?></td>
	<td align="center"><a href="view-property.php?source=<?php echo base64_encode($rsProperty["property_id"]); ?>" title="View Property">[view]</a> &nbsp; <a href="edit_step_one.php?source=<?php echo base64_encode($rsProperty["property_id"]); ?>" title="Edit Property">[edit]</a>&nbsp;<a href="property_list.php?source=<?php echo base64_encode($rsProperty["property_id"]); ?>&action=delete" title="Delete" onclick="if(!confirm('Are you sure you want to delete it')) return false;">[Delete]</a>
	&nbsp;<?php  if($rsProperty["property_status"]=='Active'){ if($rsProperty["property_change_status"]=='Unsold'){ 
	?><a href="property_list.php?source=<?php echo base64_encode($rsProperty["property_id"]); ?>&action=sale" title="Sold" onclick="if(!confirm('You want to sold this Property.')) return false;">[Sold]</a><?php 
	}else{ ?>
	<a href="property_list.php?source=<?php echo base64_encode($rsProperty["property_id"]); ?>&action=rent" title="Rented" onclick="if(!confirm('You Rented to this Property.')) return false;">[Rentable]</a><?php } }?></td>
  </tr>
  <?php }}else{ ?>
    <tr>
    <td colspan="6" align="center" style="color:#de7301; border:none; font-weight:bold; font-size:18px;">Empty Property Listing </td>
    
  </tr>
  <?php } ?>
  <tfoot>
   <tr>
    <td  colspan="6">&nbsp;</td>
    
  </tr>
  </tfoot>
</table>

</div>

</div>
</div>
<!--Middle End-->

<!--Fotter Start-->
<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
