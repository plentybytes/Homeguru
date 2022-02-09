<?php 
$seoId=12;
include('includes/application.php');
require("includes/user_application.php");


foreach($_POST[pid] as $pageId) {

$duplicateImageQuery=dbQuery("SELECT * FROM property_images WHERE property_id=".(int)$pageId); 

while( $duplicateImage=dbFetchArray($duplicateImageQuery))
{
if($duplicateImage["property_file_type"]!='video')
{
if(file_exists("images/property_images/".$duplicateImage["property_images"]))
{
@unlink("images/property_images/".$duplicateImage["property_images"]);
}
}
else{
		 if(file_exists("images/property_video/".$duplicateImage["property_images"])){
		
        @unlink("images/property_video/".$duplicateImage["property_images"]);
		}
		
		}
}
dbQuery("DELETE FROM property_images WHERE property_image_id=".(int)$duplicateImage["property_image_id"]);	
dbQuery("DELETE FROM property WHERE property_id=".(int)$pageId);
}
$messageStack->addMessageSession("Delete Property successfully.", "success");
redirect(hrefLink("property_list.php")); 
?>