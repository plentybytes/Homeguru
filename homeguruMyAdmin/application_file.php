<?php require("../includes/application.php");
	$action=isset($_GET["action"]) ? $_GET["action"] : "";
	$currentPage=basename($PHP_SELF);
$from=SITE_OWNER_EMAIL_ADDRESS;
	$siteName=SITE_NAME;
	
				if($action=="property_step_one"){
				if(isset($_POST["_method"]) && ($_POST["_method"]=="Add Property")){
					
					$userId=0;
					$ownerType='Admin';
					$propertyCategoryId=dbPrepareInput($_POST["property_category_id"]);
					$propertyTransactionType=dbPrepareInput($_POST["property_transaction_type"]);
					$propertyType=dbPrepareInput($_POST["property_type"]);
					$stateId=dbPrepareInput($_POST["state_id"]);
					$cityId=dbPrepareInput($_POST["city_id"]);
					$propertyTotalPrice=dbPrepareInput($_POST["property_total_price"]);
					$propertyBedrooms=dbPrepareInput($_POST["property_bedrooms"]);
					$propertyBathrooms=dbPrepareInput($_POST["property_bathrooms"]);
					$propertyFloorNumber=dbPrepareInput($_POST["property_floor_number"]);
					$propertyDescription=$_POST["property_description"];
					$verifyCode=md5(uniqid(rand()));
					$sqlDataArray=array("user_id" => $userId, "property_owner_type" => $ownerType, "property_category_id" => $propertyCategoryId, "property_transaction_type" => $propertyTransactionType, "property_type" => $propertyType, "state_id" => $stateId,  "city_id" => $cityId, "property_total_price" => $propertyTotalPrice, "property_bedrooms" => $propertyBedrooms, "property_bathrooms" => $propertyBathrooms, "property_floor_number" => $propertyFloorNumber, "property_description" => $propertyDescription,  "property_created_date" => "NOW()");
					dbPerform("property", $sqlDataArray);
					$sourceq=dbInsertId();
					//$_SESSION["source1"]=$sourceq;
					//$source=base64_encode($sourceq);
					redirect(hrefLink(APP_ADMIN_DIR."manage_property.php","action=addTwo&source=$sourceq&step=two&addId=$verifyCode"));
				}else{
					$messageStack->addMessageSession("Unauthorized action.", "error");
					redirect(hrefLink(APP_ADMIN_DIR."manage_property.php","action=add"));
					}
					
				}
				elseif($action=="edit_step_one"){
					$propertyId=dbPrepareInput($_POST["property_id"]);
					if(isset($_POST["_method"]) && ($_POST["_method"]=="Add Property")){
					
					$propertyCategoryId=dbPrepareInput($_POST["property_category_id"]);
					$propertyTransactionType=dbPrepareInput($_POST["property_transaction_type"]);
					$propertyType=dbPrepareInput($_POST["property_type"]);
					$stateId=dbPrepareInput($_POST["state_id"]);
					$cityId=dbPrepareInput($_POST["city_id"]);
					$propertyTotalPrice=dbPrepareInput($_POST["property_total_price"]);
					$propertyBedrooms=dbPrepareInput($_POST["property_bedrooms"]);
					$propertyBathrooms=dbPrepareInput($_POST["property_bathrooms"]);
					$propertyArea=dbPrepareInput($_POST["property_area"]." ".$_POST["unit"]);
					$propertyFloorNumber=dbPrepareInput($_POST["property_floor_number"]);
					$propertyDescription=$_POST["property_description"];
					$verifyCode=md5(uniqid(rand()));
					$sqlDataArray=array("property_owner_type" => $ownerType, "property_area" => $propertyArea, "property_category_id" => $propertyCategoryId, "property_transaction_type" => $propertyTransactionType, "property_type" => $propertyType, "state_id" => $stateId, "city_id" => $cityId, "property_total_price" => $propertyTotalPrice, "property_bedrooms" => $propertyBedrooms, "property_bathrooms" => $propertyBathrooms, "property_floor_number" => $propertyFloorNumber, "property_description" => $propertyDescription, "property_created_date" => "NOW()");
					dbPerform("property", $sqlDataArray, "update", "property_id =".(int)$propertyId);

				redirect(hrefLink(APP_ADMIN_DIR."manage_property.php","action=edit2&source=$propertyId&step=two&addId=$verifyCode"));
				}else{
				$messageStack->addMessageSession("Unauthorized action.", "error");
				redirect(hrefLink(APP_ADMIN_DIR."manage_property.php","action=edit1&source=$source&step=two&addId=$verifyCode"));
				}

				}
				elseif($action=="edit_step_two"){
			$propertyId=dbPrepareInput($_POST["property_id"]);
				if(isset($_POST["_method"]) && ($_POST["_method"]=="Add Step Two")){
					if($_POST["amenities"]!=''){
					$propertyAmenties=dbPrepareInput(implode(",",$_POST["amenities"]));
					}
					$landmarks=dbPrepareInput($_POST["shopping"].",".$_POST["school"].",".$_POST["hospital"].",".$_POST["atm"]);
					$propertyTotalFloorNumber=dbPrepareInput($_POST["property_total_floor_number"]);
					$propertyConstruction=dbPrepareInput($_POST["property_construction"]);
					$propertyFurnishing=dbPrepareInput($_POST["property_furnishing"]);
					$propertyDirectionalFacing=dbPrepareInput($_POST["property_directional_facing"]);
					$propertyOwnershipType=dbPrepareInput($_POST["property_ownership_type"]);
					$verifyCode=dbPrepareInput($_POST["addId"]);
					$sqlDataArray=array("property_total_floor_number" => $propertyTotalFloorNumber, "property_construction" => $propertyConstruction, "property_furnishing" => $propertyFurnishing, "property_directional_facing" => $propertyDirectionalFacing,  "property_ownership_type" => $propertyOwnershipType, "	property_amenties" => $propertyAmenties, "property_landmarks" => $landmarks);			
					dbPerform("property", $sqlDataArray, "update", "property_id =".(int)$propertyId);
					$proImage=count($_FILES["property_images"]["name"]);
					for($j=0;$j<$proImage;$j++)
					{ 
						$actual_filename = basename($_FILES['property_images']['name'][$j]);
						if($actual_filename!=''){
						$filename=time().$actual_filename;
						dbQuery("insert into property_images set property_id='".$propertyId."',property_images='".$filename."',property_file_type='image'");
						if (move_uploaded_file($_FILES['property_images']['tmp_name'][$j], "../images/property_images/$filename")) {
					   // ...
						}	
						}
					}
					$proImage=count($_FILES["property_video"]["name"]);
					for($j=0;$j<$proImage;$j++)
					{ 
						$actual_filename = basename($_FILES['property_video']['name'][$j]);
						if($actual_filename!=''){
						$filename=time().$actual_filename;
						dbQuery("insert into property_images set property_id='".$propertyId."',property_images='".$filename."',property_file_type='video'");
						if (move_uploaded_file($_FILES['property_video']['tmp_name'][$j], "../images/property_video/$filename")) {
					   // ...
						}	
						}
					}	
						
						redirect(hrefLink(APP_ADMIN_DIR."manage_property.php","type=manage&owner=admin"));
			
				
				}else{
					$messageStack->addMessageSession("Unauthorized action.", "error");
					redirect(hrefLink(APP_ADMIN_DIR."manage_property.php","action=edit2&source=$propertyId"));
					}
					
				}
				elseif($action=="property_step_two"){
				if(isset($_POST["_method"]) && ($_POST["_method"]=="Add Step Two")){
					
					
					$source=$_POST["source"];
					$propertyAmenties=dbPrepareInput(implode(",",$_POST["amenities"]));
					$landmarks=dbPrepareInput($_POST["shopping"].",".$_POST["school"].",".$_POST["hospital"].",".$_POST["atm"]);
					$propertyTotalFloorNumber=dbPrepareInput($_POST["property_total_floor_number"]);
					$propertyConstruction=dbPrepareInput($_POST["property_construction"]);
					$propertyFurnishing=dbPrepareInput($_POST["property_furnishing"]);
					$propertyDirectionalFacing=dbPrepareInput($_POST["property_directional_facing"]);
					$propertyOwnershipType=dbPrepareInput($_POST["property_ownership_type"]);
					$verifyCode=dbPrepareInput($_POST["addId"]);
					$sqlDataArray=array("property_total_floor_number" => $propertyTotalFloorNumber, "property_construction" => $propertyConstruction, "property_furnishing" => $propertyFurnishing, "property_directional_facing" => $propertyDirectionalFacing,  "property_ownership_type" => $propertyOwnershipType, "	property_amenties" => $propertyAmenties, "property_landmarks" => $landmarks,"property_status" => 'Active');			
					dbPerform("property", $sqlDataArray, "update", "property_id =".(int)$source);
					$proImage=count($_FILES["property_images"]["name"]);
					for($j=0;$j<$proImage;$j++)
					{ 
						$actual_filename = basename($_FILES['property_images']['name'][$j]);
						$filename=time().$actual_filename;
						dbQuery("insert into property_images set property_id='".$source."',property_file_type='image', property_images='".$filename."'");
						if (move_uploaded_file($_FILES['property_images']['tmp_name'][$j], "../images/property_images/$filename")) {
					   // ...
						}	
					}
						
						redirect(hrefLink(APP_ADMIN_DIR."manage_property.php","type=manage&owner=admin"));
			
				
				}else{
					$messageStack->addMessageSession("Unauthorized action.", "error");
					redirect(hrefLink(APP_ADMIN_DIR."property_step_two.php","source=$source&step=addTwo&addId=$verifyCode"));
					}
					
				}
				else{
					$messageStack->addMessageSession("Unauthorized action.", "error");
					redirect(hrefLink(APP_ADMIN_DIR."index.php"));
					}
					
		
?>