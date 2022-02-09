<?php
	require("../includes/application.php");
	require("../includes/admin_application.php");
	/*$from=SITE_OWNER_EMAIL_ADDRESS;*/
	$from="info@homesguru.co.uk";
	
	$siteName=SITE_NAME;
	$action=isset($_GET["action"]) ? $_GET["action"] : "";
		$type=isset($_GET["type"]) ? $_GET["type"] : "";
	if($type=='manage'){   
	$teb="manage";
	}elseif($type=='block' ){
	$teb="block";
	}	elseif($type=='wait'){
	$teb="wait";
	}	
		
	if($action=="send"){
		$userEmail=$_POST["user_email"];
		$userName=$_POST["userName"];
		$subject=$_POST["Subject"];
		$mailMessage=$_POST["content"];
		sendMail($userName, $userEmail, $subject, $mailMessage, SITE_OWNER, SITE_OWNER_EMAIL_ADDRESS);
$messageStack->addMessageSession("Mail sent to mail address.", "success");
		redirect(hrefLink(APP_ADMIN_DIR."manage_user.php", "type=manage"));		
	}
	if($action=="delete") {
		if(isset($_GET["userid"])){
			$pageId=dbPrepareInput($_GET["userid"]);
			removeUser($pageId);
		}
		$messageStack->addMessageSession("Delete user successfully.", "success");
		redirect(hrefLink(APP_ADMIN_DIR."manage_user.php", "type=manage")); 
	}
	elseif($action=="status") {
	$data=$_GET['type'];
	$where1="user_id";
	$whereid=$_GET['id'];
	$tb="user";
	$fild="user_status";

ChangeStatus($tb,$fild,$data,$where1,$whereid);


	redirect(hrefLink(APP_ADMIN_DIR."manage_user.php", "type=manage")); 

	}
	elseif($action=="approval"){
	$passkey=$_GET["id"];
	
		$checkUserStr=dbQuery("SELECT * from  user WHERE user_id ='".$passkey."'  AND user_status ='Wait'");
		if(dbNumRows($checkUserStr) == 1){
		$user=dbFetchArray($checkUserStr);
		$userEmail=$user["user_email"];
		$userName=$user["user_first_name"];
	dbQuery("update user set user_status ='Active' where user_id='".$user["user_id"]."'");
	$subjects=" Approved by admin department your account";
						$messages="<html>
									<head>
									<title> Approved by admin department your account</title>
									</head>
										<body>
											<table width='100%' cellpadding='2' cellspacing='4' border='0' style='border:1px dashed #009966;'>
											<tr>
													<td style='font-family: Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; padding-bottom:10px;'>Dear  $userName,</td>
												  </tr>
												  <tr>
													<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'> Approved by admin department your account</td>
												  </tr>
												  <tr>
													<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'><strong>User name </strong> :- $userName </td>
												  </tr>
												  <tr>
													<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'><strong> Email address </strong>:- $userEmail</td>
												  </tr>
												 
									  <tr>
										<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;'>Thanks & regared <br />HomeGuru.com</td>
									  </tr>
											</table>
										</body>
									</html>";
						
						$header = "From:  Approved by admin department  <$from>\n";
						$header .= "MIME-Version: 1.0\n";
						$header .= "Return-Path: $siteName<$from>\n";
						$header .= "Content-Type: text/html;\n";
						$header .= "X-Mailer: PHP/" . phpversion();
						mail($userEmail,$subjects,$messages,$header);
						$messageStack->addMessageSession("Thanks for user approved.", "success");
							redirect(hrefLink(APP_ADMIN_DIR."manage_user.php", "type=manage")); 
	}
	}
	$rowsPerPage=(isset($_GET["row"])) ? (int)$_GET["row"] : 20;
	
	require("header.php");
?>
<div style="background-color:;">
<div class="<?php if($teb=='wait'){ echo "select";}else{ echo "icon_bar";}?>" style="width:190px;" ><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php","type=wait");?>" title="Wait  for Approval"><h3 style="text-align:center;width:150px; height:65px;">Wait  for Approval </h3></a>(<?php echo waiting();?>)</div>
<div class="<?php if($teb=='manage'){ echo "select";}else{ echo "icon_bar";}?>"><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php","type=manage");?>" title=" Manage block users "><h3 style="text-align:center;width:100px; height:65px;">Active User</h3></a></div>
<div class="<?php if($teb=='block'){ echo "select";}else{ echo "icon_bar";}?>"><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php","type=block");?>" title=" Manage block users "><h3 style=" text-align:center;width:100px; height:65px;">Block User</h3></a></div>

<div class="clear">&nbsp;</div>

</div>
     <?php if($_GET['type']=='manage'){
	 $strPages="SELECT * FROM user where user_status='Active' ORDER BY user_id DESC";
	$pagesQuery=dbQuery(getPagingQuery($strPages, $rowsPerPage)); 
	$num=dbNumRows($pagesQuery);
	$pagingLink=getPagingLink($strPages, $rowsPerPage, getAllGetParams(array("page")));
	 ?>   <h2>All User Listing  </h2>
        <form id="formCms" name="formCms" method="post">
				<table width="359" id="rounded-corner" summary="cms">
          <thead>
            <tr>
              <th width="17%" class="rounded-company" scope="col"> S no.</th>
              <th width="15%" class="rounded" scope="col">User Name</th>
			   <th width="21%" class="rounded" scope="col">Email</th>
			
              <th scope="col" width="15%" class="rounded">Last Login</th>
			  <th scope="col" width="18%"  align="center" class="rounded">Status</th>
			  <th scope="col" width="14%" class="rounded-q4">Action</th>
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
	
?>
            <tr>
							<td><?=$i;?></td>
              <td><?php echo $pages["user_first_name"];?></td>
			  <td><?php echo $pages["user_email"];?></td>
			  <td><?php echo $pages["user_registration_date"];?></td>
              <td>  <?php if($pages["user_status"]=='Active'){?>

<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php","action=status&type=Block&id=".$pages["user_id"]."");?>" onclick="tipsstatus()" class="bt_green"><span class="bt_green_lft"></span><strong>Active </strong><span class="bt_green_r"></span></a>

<?php }else{ ?>

<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php","action=status&type=Active&id=".$pages["user_id"]."");?>" class="bt_red">
<span class="bt_red_lft"></span><strong>Block </strong><span class="bt_red_r"></span></a>



</a><?php }?></td>
			  <td><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php","action=view&userid=".$pages["user_id"]);?>"><img src="images/images.jpeg" alt="user edit" width="16" height="16" border="0" title="view" /></a>&nbsp;&nbsp;<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php","action=mail&userid=".$pages["user_id"]);?>"><img src="images/reply.jpeg" alt="Mail" width="16" height="16" border="0" title="Mail" /></a>
              </td>
			   
            </tr>
<?php $i++; } ?>
          </tbody>
        </table>
	 </form>
   
        <div class="pagination"><?php echo $pagingLink;?></div>
		<?php } 
		
	elseif($_GET['type']=='block'){
	 $strPages="SELECT * FROM user where user_status='Block' ORDER BY user_id DESC";
	$pagesQuery=dbQuery(getPagingQuery($strPages, $rowsPerPage)); 
	$num=dbNumRows($pagesQuery);
	$pagingLink=getPagingLink($strPages, $rowsPerPage, getAllGetParams(array("page")));
	 ?>   <h2>Block User listing  </h2>
	 <form id="formCms" name="formCms" method="post">
				<table width="359" id="rounded-corner" summary="cms">
          <thead>
            <tr>
              <th width="17%" class="rounded-company" scope="col"> S no.</th>
              <th width="15%" class="rounded" scope="col">User Name</th>
			   <th width="21%" class="rounded" scope="col">Email</th>
			
              <th scope="col" width="15%" class="rounded">Last Login</th>
			  <th scope="col" width="18%"  align="center" class="rounded">Status</th>
			  <th scope="col" width="14%" class="rounded-q4">Action</th>
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
	
?>
            <tr>
							<td><?=$i;?></td>
              <td><?php echo $pages["user_first_name"];?></td>
			  <td><?php echo $pages["user_email"];?></td>
			  <td><?php echo $pages["user_registration_date"];?></td>
              <td>  


<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php","action=status&type=Active&id=".$pages["user_id"]."");?>" class="bt_red">
<span class="bt_red_lft"></span><strong>Block </strong><span class="bt_red_r"></span></a>



</a></td>
			  <td><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php","action=view&userid=".$pages["user_id"]);?>"><img src="images/images.jpeg" alt="user edit" width="16" height="16" border="0" title="view" /></a>&nbsp;&nbsp;<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php","action=mail&userid=".$pages["user_id"]);?>"><img src="images/reply.jpeg" alt="Mail" width="16" height="16" border="0" title="Mail" /></a>
              </td>
			   
            </tr>
<?php $i++; } ?>
          </tbody>
        </table>
	 </form>
         <div class="pagination"><?php echo $pagingLink;?></div>
     <?php } 
		elseif($_GET['type']=='wait'){
	 $strPages="SELECT * FROM user where user_status='Wait' ORDER BY user_id DESC";
	$pagesQuery=dbQuery(getPagingQuery($strPages, $rowsPerPage)); 
	$num=dbNumRows($pagesQuery);
	$pagingLink=getPagingLink($strPages, $rowsPerPage, getAllGetParams(array("page")));
	 ?>   <h2> Wait for approval </h2>
	 <form id="formCms" name="formCms" method="post">
				<table width="359" id="rounded-corner" summary="cms">
          <thead>
            <tr>
              <th width="20%" class="rounded-company" scope="col"> S no.</th>
              <th width="18%" class="rounded" scope="col">User Name</th>
			   <th width="14%" class="rounded" scope="col">Email</th>
		
			  <th scope="col" width="35%"  align="center" class="rounded">Status</th>
			  <th scope="col" width="13%" class="rounded-q4">Action</th>
            </tr>
          </thead>
					<tfoot>
            <tr>
              <td colspan="4" class="rounded-foot-left">&nbsp;<?php if($num ==0){ echo"<font color='#FF0000'><strong>Empty list</strong> </font>";  }?></td>
             <td  class="rounded-foot-right">&nbsp;</td>
            </tr>
          </tfoot>
          <tbody>
<?php 
$i=1;
	while($pages = dbFetchArray($pagesQuery)) { 
	
?>
            <tr>
							<td><?=$i;?></td>
              <td><?php echo $pages["user_first_name"];?></td>
			  <td><?php echo $pages["user_email"];?></td>
			
              <td>  


<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php","action=approval&id=".$pages["user_id"]."");?>" class="bt_red">
<span class="bt_red_lft"></span><strong>Wait for approval </strong><span class="bt_red_r"></span></a>



</a></td>
			  <td><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php","action=view&userid=".$pages["user_id"]);?>"><img src="images/images.jpeg" alt="user edit" width="16" height="16" border="0" title="view" /></a>
              </td>
			   
            </tr>
<?php $i++; } ?>
          </tbody>
        </table>
	 </form>
         <div class="pagination"><?php echo $pagingLink;?></div>
     <?php } 
		elseif($_GET['action']=='add') {
		//include("action/new_category.php");
		 }
		elseif($_GET['action']=='mail'){
		include("action/send-mail-to-user.php"); 
		}
		
		elseif($_GET['action']=='view'){
		
		$cmsId=(isset($_GET["userid"]) ? $_GET["userid"] : "");	
		$pageInfo=dbFetchArray(dbQuery("SELECT * FROM user WHERE user_id=".$cmsId));
		$logsInfo=dbFetchArray(dbQuery("SELECT * FROM user_logs where user_id ='".$pageInfo["user_id"]."'"));  
		 ?>   
      <h2>View User Details  </h2>
				<table width="337" id="rounded-corner" summary="cms">
				<tfoot>
            <tr>
              <td  class="rounded-foot-left">&nbsp;</td>
             <td  class="rounded-foot-right">&nbsp;</td>
            </tr>
          </tfoot>
		  
          <tbody scope="col">
       
<tr> <td class="rounded-company" colspan="2"><strong>User Information</strong>  </td>   
            
            </tr>
          	<tr> <td > Name</td>   <td><?php echo $pageInfo["user_first_name"];?></td></tr>
			<tr> <td>Email Address</td>   <td><?php echo $pageInfo["user_email"];?></td></tr>
			<tr> <td>User Deal As </td>   <td><?php echo $pageInfo["user_type"];?></td></tr>
			<tr> <td>About User</td>   <td><?php echo $pageInfo["about_me"];?></td></tr>
			<tr> <td width="138">Mobile number  </td>   
            <td width="187"><?php echo $pageInfo["user_mobile_number"];?> </td>
            </tr>
			<tr> <td>Mails should Receive</td>   <td><?php echo $pageInfo["receive_mail"];?></td></tr>
			<tr> <td  colspan="2"><strong>Posting Detils Information</strong>  </td>   </tr>
            <tr> <td width="138">How many Projects Post   </td>   
            <td width="187"><strong>Live Property:</strong> <?php echo getPropertyList($userInfo["user_id"],'Active');?> <strong>Panding Property:</strong> <?php echo getPropertyList($userInfo["user_id"],'Deactive');?></td>
            </tr>
            </tr>
			<tr> <td width="138" colspan="2"><strong>Logs Information</strong>  </td>   
            
            </tr>
			
			<tr> <td width="138">Registertion Date   </td>   
            <td width="187"><?php echo $pageInfo["user_registertion_date"];?> </td>
            </tr>
			<tr> <td width="138">Number of logins   </td>   
            <td width="187"><?php echo $logsInfo["user_number_log"];?> </td>
            </tr>
			<tr> <td width="138">Last Login   </td>   
            <td width="187"><?php echo $logsInfo["user_last_login"];?> </td>
            </tr>
			<tr> <td width="138">Status  </td>   
            <td width="187"><?php echo $pageInfo["user_status"];?> </td>
            </tr>
			

          </tbody>
     </table>
	 <span style="float:right;"><a   onclick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php", "type=manage");?>');" href="javaScript:void(0)"  class="bt_green"><span class="bt_green_lft"></span><strong>Go Back</strong><span class="bt_green_r"></span></a></span><?php 
		
		}?>
<?php
	require("action/footer.php");
?>  		