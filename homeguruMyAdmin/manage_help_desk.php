<?php
	require("../includes/application.php");
	require("../includes/admin_application.php");
	$action=isset($_GET["action"]) ? $_GET["action"] : "";
	if($action=="send"){
		$visiter=$_POST["email"];
		$subject=$_POST["Subject"];
		$mailMessage=$_POST["content"];
		$formcontent="  hello Sir, \n $mailMessage \n \n \n \n \n Thanks you \n mytravler.com";
$recipient = "$visiter";
$subject = "$subject";
$mailheader = "From: mytravel <info@mytravel.com> \nReturn-Path: <info@mytravel.com>\n";
mail($recipient, $subject, $formcontent, $mailheader);
$messageStack->addMessageSession("Feedback send to Visiter mail address.", "success");
		redirect(hrefLink(APP_ADMIN_DIR."manage_help_desk.php", "type=manage"));		
	}
	if($action=="delete") {
		if(isset($_GET["queryId"])){
			$queryId=$_GET["queryId"];
			removeContactUs($queryId);
		
		}
		$messageStack->addMessageSession("query successfully deleted.", "success");
		redirect(hrefLink(APP_ADMIN_DIR."manage_help_desk.php", "type=manage")); 
	}
		
	$rowsPerPage=(isset($_GET["row"])) ? (int)$_GET["row"] : 20;
	$strPages="SELECT * FROM  help_desk_query ORDER BY created DESC";
	$helpDeskQueryQuery=dbQuery(getPagingQuery($strPages, $rowsPerPage)); 
	$pagingLink=getPagingLink($strPages, $rowsPerPage, getAllGetParams(array("page")));
	require("header.php");
?>
     <?php if($_GET['type']=='manage'){ ?>   <h2>Help Desk Query</h2>
        <form id="formCms" name="formCms" method="post">
				<table width="403" id="rounded-corner" summary="cms">
          <thead>
            <tr>
              
              <th width="34%"  class="rounded-company" scope="col">Visiter name</th>
							<th scope="col" width="26%" class="rounded">Visiter mail</th>
							<th scope="col" width="19%" class="rounded">Created</th>
              <th scope="col" width="19%" class="rounded">Status</th>
              <th scope="col" width="21%" class="rounded-q4">Action</th>
            </tr>
          </thead>
					<tfoot>
            <tr>
              <td colspan="5" class="rounded-foot-left">&nbsp;</td>
            
            </tr>
          </tfoot>
          <tbody>
<?php 
	while($helpDeskQuery = dbFetchArray($helpDeskQueryQuery)) { 
?>
            <tr>
							
             <td><?php echo $helpDeskQuery["tourist_name"];?></td>
			<td><?php echo $helpDeskQuery["email_address"];?></td>
			<td><?php echo $helpDeskQuery["created"];?></td>
              <td><?php if($helpDeskQuery["is_active"]==1){?><a href="javascript:void(0);" class="status active" title="Active"></a><a href="javascript:void(0);" class="status" title="Set Inactive"></a><?php }else{ ?><a href="javascript:void(0);" class="status" title="Set Active"></a><a href="javascript:void(0);" class="status inactive" title="Inactive"></a><?php }?></td>
              <td><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_help_desk.php","action=view&queryId=".$helpDeskQuery["help_desk_query_id"]);?>"><img src="images/images.jpeg" alt="user edit" width="16" height="16" border="0" title="user edit" /></a>&nbsp;&nbsp;<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_help_desk.php","action=mail&queryId=".$helpDeskQuery["help_desk_query_id"]);?>"><img src="images/reply.jpeg" alt="Reply" title="Reply" border="0" /></a>&nbsp;&nbsp;<a class="ask" href="<?php echo hrefLink(APP_ADMIN_DIR."manage_help_desk.php","action=delete&queryId=".$helpDeskQuery["help_desk_query_id"]);?>"><img src="images/cross.gif" alt="user edit" width="14" height="16" border="0" title="Query Delete" /></a></td>
            </tr>
<?php } ?>
          </tbody>
        </table>
	 </form>
        
        <div class="pagination"><?php echo $pagingLink;?></div>
		<?php } 
		elseif($_GET['action']=='mail'){
		include("action/send-mail.php"); 
		}
		elseif($_GET['action']=='view'){
	$queryId=(isset($_GET["queryId"]) ? $_GET["queryId"] : "");	
		$pageQuery=dbQuery("SELECT * FROM help_desk_query WHERE help_desk_query_id =".$queryId);
		$pageInfo=dbFetchArray($pageQuery);
		$categoryListQuery=dbQuery("SELECT * FROM traveler_tour_category_list WHERE help_desk_query_id='".$pageInfo["help_desk_query_id"]."'");
		$count1=dbNumRows($categoryListQuery);
		
		$listQuery=dbQuery("SELECT * FROM traveler_interest_place_list WHERE help_desk_query_id='".$pageInfo["help_desk_query_id"]."'");
		$count=dbNumRows($listQuery);
		?>
		   <h2>View Query details</h2>
      
				<table width="300" id="rounded-corner" summary="cms">
          <tbody>
       

            <tr> <td>Tourist Name</td>   <td><?php echo $pageInfo["tourist_name"];?></td></tr> 	
			<tr> <td>Email address</td>   <td><?php echo $pageInfo["email_address"];?></td></tr>
			<tr> <td>Telephone number</td>   <td><?php echo $pageInfo["telephone_number"];?></td></tr>  	
			<tr> <td>People</td>   <td>Adult:<?php echo $pageInfo["adult"];?>,children:<?php echo $pageInfo["children"];?></td></tr>
			<tr> <td>Date of travel </td>   <td><?php echo $pageInfo["year"];?>,<?php echo $pageInfo["month"];?>,<?php echo $pageInfo["duration"];?></td></tr> 	
				
			<tr> <td>Country</td>   <td><?php echo $pageInfo["country"];?></td></tr>
			<tr> <td>Interested City</td>   <td><?php echo $pageInfo["interested_city"];?></td></tr>
			<tr> <td>Tours list tourist interest</td>   <td>
			<?php
				
				 while($categoryListInfo=dbFetchArray($categoryListQuery)){
					$categoryQuery=dbQuery("SELECT * FROM tour_category WHERE tour_category_id='".$categoryListInfo["tour_category_id"]."'");
					$categoryInfo=dbFetchArray($categoryQuery);
					echo $categoryInfo["tour_category_name"];
					if($count1>0){ echo ",";}else{ echo ".";} 
					$count1--;
				}
				?></td></tr>
			<tr> <td>Places of tourist interest</td>
			<td>
			<?php
				 $count;
				while($listInfo=dbFetchArray($listQuery)){
				$stateQuery=dbQuery("SELECT * FROM states WHERE ID='".$listInfo["help_state_id"]."'");
				$statesInfo=dbFetchArray($stateQuery);
					echo $statesInfo["state_name"];
					if($count>0){ echo ",";}else{ echo ".";} 
					$count--;
				}
				?></td></tr>
				<tr> <td>Other Requirements </td>   <td><?php echo $pageInfo["feedback"];?></td></tr>
			<tr> <td>Created </td>   <td><?php echo $pageInfo["created"];?></td></tr>
			

          </tbody>
        </table>
	 <input type="button" name="cancel" id="cancel" value="Back To Help Desk" onclick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."manage_help_desk.php", "type=manage");?>');" />
		<?php }?>
		
		<?php
	require("action/footer.php");
?>  		