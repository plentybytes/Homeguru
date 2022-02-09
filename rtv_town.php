<?php
/**************************************
/	 Code by: Neeraj Krishna Maurya   /
/       Date: 25/05/2013              /
/    For Map Manipulation             /
/*************************************/
include('includes/application.php');


// Start XML file, create parent node        /*
/*$doc = domxml_new_doc("1.0");              <<<  These are valid only in PHP 4 and less than ...>>>>>>
$node = $doc->create_element("markers");     <<<   
$parnode = $doc->append_child($node);        <<<                                                        */


$doc = new DOMDocument('1.0');
$node = $doc->createElement("markers");
$parnode = $doc->appendChild($node);

// Select all the rows in the markers table
$inArray=$_GET['city'];

$SUB_QUERY = "";
if($inArray)
	$SUB_QUERY = " where property_id in($inArray)";

//print_r($_GET);
$query = "select property_id,city_id,property_longitude,property_latitude,property_address,property_landmarks,property_bedrooms,property_total_price from property $SUB_QUERY";
$result = dbQuery($query);
header("Content-type: text/xml");

// Iterate through the rows, adding XML nodes for each
while ($row = dbFetchArray($result)){
  // ADD TO XML DOCUMENT NODE
  $node = $doc->createElement("marker");
  $newnode = $parnode->appendChild($node);
  
  $rsImage=  dbQuery("select property_images from property_images where property_id=".$row['property_id']." ");
   while($image=dbFetchArray($rsImage))
   {
    $newnode->setAttribute("image", $image['property_images']);
   
   }
   
   $rsTown=dbQuery("select town,postcode from uk_town where town_id=".$row['city_id']." ");
 while($town=dbFetchArray($rsTown))
   {
    $newnode->setAttribute("town", $town['town']);
	$newnode->setAttribute("post_code", $town['postcode']);
   
   }
     $newnode->setAttribute("price", $row['property_total_price']);
     $newnode->setAttribute("bed", $row['property_bedrooms']);
     $newnode->setAttribute("landmark", $row['property_landmarks']);
     $newnode->setAttribute("address", $row['property_address']);
     $newnode->setAttribute("lat", $row['property_latitude']);
     $newnode->setAttribute("lng", $row['property_longitude']);
 // $newnode->set_attribute("type", $row['type']);
}

$xmlfile = $doc->saveXML();
echo $xmlfile;

?>