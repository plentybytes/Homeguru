<?php
	require("../includes/application.php");
	require("../includes/admin_application.php");
	$action=isset($_GET["action"]) ? $_GET["action"] : "";
		
	
	if($action=="delete") {
		if(isset($_GET["proid"])){
			$pageId=dbPrepareInput($_GET["proid"]);
			 $duplicateImageQuery=dbQuery("SELECT * FROM property_images WHERE property_id=".(int)$pageId); 
   while( $duplicateImage=dbFetchArray($duplicateImageQuery)){
		
	     if(file_exists("../images/property_images/".$duplicateImage["property_images"])){
		
        @unlink("../images/property_images/".$duplicateImage["property_images"]);
		 
      }dbQuery("DELETE FROM property_images WHERE property_image_id=".(int)$duplicateImage["property_image_id"]);
	  }
 dbQuery("DELETE FROM property WHERE property_id=".(int)$pageId);

		}
		$messageStack->addMessageSession("Delete project successfully.", "success");
		redirect(hrefLink(APP_ADMIN_DIR."manage_property.php", "type=".$_GET["type"]."&owner=".$_GET["owner"]."")); 
	}
	elseif($action=="status") {
	$data=$_GET['type'];
	$where1="property_id";
	$whereid=$_GET['id'];
	$tb="property";
	$fild="property_status";

ChangeStatus($tb,$fild,$data,$where1,$whereid);


	redirect(hrefLink(APP_ADMIN_DIR."manage_property.php", "type=manage&owner=".$_GET['owner'])); 

	}	
	$rowsPerPage=(isset($_GET["row"])) ? (int)$_GET["row"] : 20;
	
	require("header.php");
?>
     <?php if($_GET['type']=='manage' && $_GET['owner']=='admin'){
	 $strPages="SELECT * FROM property where property_owner_type='Admin' ORDER BY property_id DESC";
	$pagesQuery=dbQuery(getPagingQuery($strPages, $rowsPerPage)); 
	$num=dbNumRows($pagesQuery);
	$pagingLink=getPagingLink($strPages, $rowsPerPage, getAllGetParams(array("page")));
	 ?>   <h2>Admin Property Listing  </h2>
        <form id="formCms" name="formCms" method="post">
				<table width="348" id="rounded-corner" summary="cms">
          <thead>
            <tr>
              <th width="11%" class="rounded-company" scope="col"> S no.</th>
              <th width="19%" class="rounded" scope="col">Project Name</th>
			   <th width="21%" class="rounded" scope="col">Category Type</th>
			
              <th scope="col" width="12%" class="rounded">Post date</th>
			  <th scope="col" width="20%" align="center" class="rounded">Status</th>
			  <th scope="col" width="17%" class="rounded-q4">Action</th>
            </tr>
          </thead>
					<tfoot>
            <tr>
              <td colspan="5" class="rounded-foot-left">&nbsp;<?php if($num ==0){ echo"<font color='#FF0000'><strong>Empty list</strong> </font>";  }?></td>
             <td  class="rounded-foot-right">&nbsp;</td>
            </tr>
          </tfoot>
          <tbody>
<?php 
$i=1;
	while($pages = dbFetchArray($pagesQuery)) { 
	$category=dbFetchArray(dbQuery("SELECT * FROM property_category where property_category_id='".$pages["property_category_id"]."'"));
?>
            <tr>
							<td><?=$i;?></td>
              <td align="center"><?php echo $pages["property_type"];?></td>
			  <td align="center"><?php echo $category["property_category_name"];?></td>
			  <td align="center"><?php echo $pages["property_created_date"];?></td>
              <td align="center"><?php if($pages["property_status"]=='Active'){?>

<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","action=status&type=Deactive&id=".$pages["property_id"]."&owner=admin");?>" onclick="tipsstatus()" class="bt_green"><span class="bt_green_lft"></span><strong>Active </strong><span class="bt_green_r"></span></a>

<?php }else{ ?>

<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","action=status&type=Active&id=".$pages["property_id"]."&owner=admin");?>" class="bt_red">
<span class="bt_red_lft"></span><strong>Deactive </strong><span class="bt_red_r"></span></a>



</a><?php }?></td>
			  <td><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","action=view&proid=".$pages["property_id"]);?>"><img src="images/images.jpeg" alt="user edit" width="16" height="16" border="0" title="view" /></a>&nbsp;&nbsp;<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","action=edit1&owner=admin&proid=".$pages["property_id"]);?>"><img src="images/user_edit.png" alt="Edit" title="Edit" border="0" /></a>
              &nbsp;&nbsp;<a class="ask" href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","type=manage&owner=admin&action=delete&proid=".$pages["property_id"]);?>"><img src="images/cross.gif" alt="Delete" title="Delete" border="0" /></a></td>
			   
            </tr>
<?php $i++; } ?>
          </tbody>
        </table>
	 </form>
   <a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","action=add");?>" class="bt_green"><span class="bt_green_lft"></span><strong>Add Property </strong><span class="bt_green_r"></span></a> 
        <div class="pagination"><?php echo $pagingLink;?></div>
		<?php } 
		elseif($_GET['type']=='manage' && $_GET['owner']=='user'){
	 $strPages="SELECT * FROM property where property_owner_type='User' and property_status!='Block'  ORDER BY property_id DESC";
	$pagesQuery=dbQuery(getPagingQuery($strPages, $rowsPerPage)); 
	$num=dbNumRows($pagesQuery);
	$pagingLink=getPagingLink($strPages, $rowsPerPage, getAllGetParams(array("page")));
	 ?>   <h2>User Property Listing  </h2>
        <form id="formCms" name="formCms" method="post">
				<table width="300" id="rounded-corner" summary="cms">
          <thead>
            <tr>
              <th width="8%" class="rounded-company" scope="col"> S no.</th>
              <th width="19%" class="rounded" scope="col">Project Name</th>
			   <th width="24%" class="rounded" scope="col">Category Type</th>
			
              <th scope="col" width="12%" class="rounded">Post date</th>
			  <th scope="col" width="20%" class="rounded">Status</th>
			  <th scope="col" width="17%" class="rounded-q4">Action</th>
            </tr>
          </thead>
					<tfoot>
            <tr>
              <td colspan="5" class="rounded-foot-left">&nbsp;<?php if($num ==0){ echo"<font color='#FF0000'><strong>Empty list</strong> </font>";  }?></td>
             <td  class="rounded-foot-right">&nbsp;</td>
            </tr>
          </tfoot>
          <tbody>
<?php 
$i=1;
	while($pages = dbFetchArray($pagesQuery)) { 
	$category=dbFetchArray(dbQuery("SELECT * FROM property_category where property_category_id='".$pages["property_category_id"]."'"));
?>
            <tr>
							<td><?=$i;?></td>
              <td><?php echo $pages["property_type"];?></td>
			  <td><?php echo $category["property_category_name"];?></td>
			  <td><?php echo $pages["property_created_date"];?></td>
              <td><?php if($pages["property_status"]=='Active'){?>

<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","action=status&type=Deactive&id=".$pages["property_id"]."&owner=".$_GET['owner']);?>" onclick="tipsstatus()" class="bt_green"><span class="bt_green_lft"></span><strong>Active </strong><span class="bt_green_r"></span></a>

<?php }else{ ?>

<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","action=status&type=Active&id=".$pages["property_id"]."&owner=".$_GET['owner']);?>" class="bt_red">
<span class="bt_red_lft"></span><strong>Deactive </strong><span class="bt_red_r"></span></a>



</a><?php }?></td>
			  <td><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","action=view&proid=".$pages["property_id"]);?>"><img src="images/images.jpeg" alt="user edit" width="16" height="16" border="0" title="view" /></a>
              &nbsp;&nbsp;<a class="ask" href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","type=manage&owner=user&action=delete&proid=".$pages["property_id"]);?>"><img src="images/cross.gif" alt="Delete" title="Delete" border="0" /></a></td>
			   
            </tr>
<?php $i++; } ?>
          </tbody>
        </table>
	 </form>
       
        <div class="pagination"><?php echo $pagingLink;?></div>
		<?php } 
		elseif($_GET['type']=='block'){
	 $strPages="SELECT * FROM property where property_status='Block' ORDER BY property_id DESC";
	$pagesQuery=dbQuery(getPagingQuery($strPages, $rowsPerPage)); 
	$num=dbNumRows($pagesQuery);
	$pagingLink=getPagingLink($strPages, $rowsPerPage, getAllGetParams(array("page")));
	 ?>   <h2>Block Property Listing  </h2>
        <form id="formCms" name="formCms" method="post">
				<table width="300" id="rounded-corner" summary="cms">
          <thead>
            <tr>
              <th width="8%" class="rounded-company" scope="col"> S no.</th>
              <th width="19%" class="rounded" scope="col">Project Name</th>
			   <th width="24%" class="rounded" scope="col">Category Type</th>
			
              <th scope="col" width="12%" class="rounded">Post date</th>
			  <th scope="col" width="20%" class="rounded">Status</th>
			  <th scope="col" width="17%" class="rounded-q4">Action</th>
            </tr>
          </thead>
					<tfoot>
            <tr>
              <td colspan="5" class="rounded-foot-left">&nbsp;<?php if($num ==0){ echo"<font color='#FF0000'><strong>Empty list</strong> </font>";  }?></td>
             <td  class="rounded-foot-right">&nbsp;</td>
            </tr>
          </tfoot>
          <tbody>
<?php 
$i=1;
	while($pages = dbFetchArray($pagesQuery)) { 
	$category=dbFetchArray(dbQuery("SELECT * FROM property_category where property_category_id='".$pages["project_id"]."'"));
?>
            <tr>
							<td><?=$i;?></td>
              <td><?php echo $pages["property_type"];?></td>
			  <td><?php echo $category["property_category_name"];?></td>
			  <td><?php echo $pages["post_project_date"];?></td>
              <td>

<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","action=status&owner=user&type=Active&id=".$pages["property_id"]."");?>" class="bt_red">
<span class="bt_red_lft"></span><strong>Block </strong><span class="bt_red_r"></span></a>



</a></td>
			  <td><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","action=view&proid=".$pages["property_id"]);?>"><img src="images/images.jpeg" alt="user edit" width="16" height="16" border="0" title="view" /></a>
              &nbsp;&nbsp;<a class="ask" href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","type=block&action=delete&proid=".$pages["property_id"]);?>"><img src="images/cross.gif" alt="Delete" title="Delete" border="0" /></a></td>
			   
            </tr>
<?php $i++; } ?>
          </tbody>
        </table>
	 </form>
       
        <div class="pagination"><?php echo $pagingLink;?></div>
		<?php }
		elseif($_GET['action']=='add') {
	include("action/new_property.php");
		 }
		 elseif($_GET['action']=='addTwo') {
	include("action/step_two_property.php");
		 }
		elseif($_GET['action']=='edit1'){
		include("action/edit_property.php"); 
		}
		elseif($_GET['action']=='edit2'){
		include("action/edit2_property.php"); 
		}
		elseif($_GET['action']=='view'){
		
		$cmsId=(isset($_GET["proid"]) ? $_GET["proid"] : "");	
		$pageQuery=dbQuery("SELECT * FROM  property WHERE property_id=".$cmsId);
		$pageInfo=dbFetchArray($pageQuery);
		
		$userInfo=dbFetchArray(dbQuery("SELECT * FROM user where user_id='".$pageInfo["user_id"]."'"));
		$stateInfo=dbFetchArray(dbQuery("SELECT * FROM states where state_id='".$pageInfo["state_id"]."'"));
		$cityInfo=dbFetchArray(dbQuery("SELECT * FROM cities where ID 	='".$pageInfo["city_id"]."'"));
		$strCategory=dbFetchArray(dbQuery("SELECT * FROM property_category where property_category_id ='".$pageInfo["property_category_id"]."'"));
		 ?>   
      <h2>View Prpperty Details </h2>
				<table width="423" id="rounded-corner" summary="cms">
				
		  
          <tbody scope="col">
       <tr> <td colspan="2" class="rounded-company"><strong>Posted By :</strong> <?php if($pageInfo["property_owner_type"]!='Admin'){?><span style="float:right;"><a  target="_blank" href="<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php", "action=view&userid=".$userInfo["user_id"]);?>"  class="bt_green"><span class="bt_green_lft"></span><strong>User Info. </strong><span class="bt_green_r"></span></a></span> <?php }else{ echo " ADMIN" ; }?></td>   
           
            </tr><?php if($pageInfo["property_owner_type"]!='Admin'){?>
			 <tr> <td width="138" class="rounded-company">User Name </td>   
            <td width="273"><?php echo $userInfo["user_name"];?></td>
            </tr>
		
			 <tr> <td width="138" class="rounded-company"> Name </td>   
            <td width="273"><?php echo $userInfo["user_first_name"];?></td>
            </tr>
			 <tr> <td width="138" class="rounded-company">Email Address</td>   
            <td width="273"><?php echo $userInfo["user_email"];?> </td>
            </tr>
			  <tr> <td width="138" height="48">How many Property Posted   </td>   
            <td width="273"><strong>Live Property:</strong> <?php echo getPropertyList($userInfo["user_id"],'Active');?> <strong>Panding Property:</strong> <?php echo getPropertyList($userInfo["user_id"],'Deactive');?></td>
            </tr>
			<?php } ?>
			 <tr> <td colspan="2" class=""><strong>Projects Details</strong></td>   
           
            </tr>
            <tr> <td width="138" class="">Category Name</td>   
            <td width="273"><?php echo $strCategory["property_category_name"];?></td>
            </tr>
			<tr> <td>Property Type</td>   <td><?php echo $pageInfo["property_type"];?></td></tr>
			<tr> <td>Transaction Type</td>   <td><?php echo $pageInfo["property_transaction_type"];?></td></tr>
			 <tr> <td width="138">Location </td>   
            <td width="273"><?php echo $cityInfo["name"];?> ,<?php echo $stateInfo["state_name"];?>  </td> 
            </tr>
			<tr> <td width="138">Amenties </td>   
            <td width="273"><?php   $amenties=explode(",",$pageInfo["property_amenties"]);
			
			foreach($amenties as $key => $value){
			echo showAmenties($value);
			}
			?>  </td>
            </tr>
			<tr> <td width="138">Directional Facing </td>   
            <td width="273"><?php 
			  echo showDirectionalFacing($pageInfo["property_directional_facing"]);
			
			?> </td>
            </tr>
			<tr> <td width="138">Property Ownership </td>   
            <td width="273"><?php echo showOwnership($pageInfo["property_directional_facing"]);?>  </td>
            </tr>
			<tr> <td width="138">Number of bathrooms/bedrooms 	 </td>   
              <td width="273"><strong>Bathrooms:</strong><?php echo $pageInfo["property_bathrooms"];?><strong> Bedrooms:</strong><?php echo $pageInfo["property_bedrooms"];?> </td>
            </tr>
			<tr> <td width="138" colspan="2"><?php $strPropertyImage=dbQuery("SELECT * FROM property_images where property_file_type='image' and property_id='".$pageInfo["property_id"]."'");
		while($rows=dbFetchArray($strPropertyImage)){
		
?>
<img src="../images/property_images/<?php echo $rows["property_images"]?>" height="150px" width="150px" />
<?php } ?></td></tr>
			
			<tr> <td width="138">Property Constructed  	 </td>   
            <td width="273"><?php echo $pageInfo["property_construction"];?>  </td>
            </tr>
			<tr> <td width="138">Proximity Landmarks  	 </td>   
            <td width="273"><?php   $landmarks=explode(",",$pageInfo["property_landmarks"]);?>
			<strong>Shopping mall: </strong><?php  echo $landmarks[0];?> <strong>School:</strong> <?php  echo $landmarks[1];?> <strong> Hospital:</strong> <?php  echo $landmarks[2];?> <strong>ATM:</strong> <?php  echo $landmarks[3];?> </td>
            </tr>
			<tr> <td width="138">Property Furnishing  Status	 </td>   
            <td width="273"><?php echo $pageInfo["property_furnishing"];?>  </td>
            </tr>
			<tr> <td width="138">Property Total Price </td>   
            <td width="273"><?php echo $pageInfo["property_total_price"];?>  </td>
            </tr>
			<tr> <td width="138">Floors </td>   
            <td width="273"><strong>Property Floors Number:</strong> <?php echo $pageInfo["property_floor_number"];?><strong> Total Number Of Floor :</strong><?php echo $pageInfo["property_total_floor_number"];?> </td>
            </tr>
			<tr> <td width="138">Description </td>   
            <td width="273"><?php echo $pageInfo["property_description"];?></td>
            </tr><tr> <td width="138">Address </td>   
            <td width="273"><?php echo $pageInfo["property_address"];?> <?php echo strtoupper($pageInfo["property_postal_code"]);?></td>
            </tr>
			<tr> <td width="138">Apple Store Link </td>   
            <td width="273"> <?php echo $pageInfo["property_created_date"];?> </td>
            </tr>
			
			
			<tr> <td>Status</td> <td><?php if($pageInfo["property_status"]=='Deactive'){ echo "<font color='#CC3333'><strong>Deactive</strong></font>";  } elseif($pageInfo["property_status"]=='Active'){ echo "<font color='#00CC33'><strong>Approved</strong> </font>";  } elseif($pageInfo["property_status"]=='Block'){ echo "<font color='#FF0000'><strong>Blocked</strong> </font>";  }?></td></tr>

          </tbody>
		  <tfoot>
            <tr>
              <td  class="rounded-foot-left">&nbsp;</td>
             <td  class="rounded-foot-right">&nbsp;</td>
            </tr>
          </tfoot>
     </table><?php if($pageInfo["property_owner_type"]=='Admin'){?>
	 <a  onclick="javascript:goBack('<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","type=manage&owner=admin");?>');" href="javascript:void(0)" class="bt_green"><span class="bt_green_lft"></span><strong>Back To Property </strong><span class="bt_green_r"></span></a><?php }else{?>
	 
 <a  onclick="javascript:goBack('<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","type=manage&owner=user");?>');" href="javascript:void(0)" class="bt_green"><span class="bt_green_lft"></span><strong>Back To Property </strong><span class="bt_green_r"></span></a>
		<?php 
		}
		}?>
<?php
	require("action/footer.php");
?>  		