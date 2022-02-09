<?php
require("../includes/application.php");
	require("../includes/admin_application.php");
		$action=isset($_GET["action"]) ? $_GET["action"] : "";
	if($action=="update"){
		$userId=$_POST['user_id'];
		$firstname=$_POST['firstname'];
		$lastname=$_POST['lastname'];
		$email=$_POST['email'];
		$username=$_POST['username'];
		$sqlDataArray=array("firstname" => $firstname, "lastname" => $lastname, "email" => $email, "username" => $username,);
		dbPerform("admin_user", $sqlDataArray, "update", "user_id=".(int)$userId);
		$messageStack->addMessageSession("Admin deatils has been updated successfully.", "success");	
		redirect(hrefLink(APP_ADMIN_DIR."account.php","type=manage"));
	}
	if($action=="change"){
		$oldPwd=$_POST['old_pwd'];
		$newPassword=$_POST['new_password'];
		$booksQuery=dbQuery("SELECT * FROM  admin_user WHERE user_id='".$_SESSION["admin"]["id"]."' And password='".$oldPwd."'" );
		$num=dbNumRows($booksQuery);
		if($num>0){
			$sqlDataArray=array("password" => $newPassword);
			dbPerform("admin_user", $sqlDataArray, "update", "user_id=".(int)$_SESSION["admin"]["id"]);
			$messageStack->addMessageSession("Admin Password has been updated successfully.", "success");	
			redirect(hrefLink(APP_ADMIN_DIR."account.php","type=manage"));
		}else{
			$messageStack->addMessageSession("Admin Old Password is wrong.", "error");	
			redirect(hrefLink(APP_ADMIN_DIR."account.php","type=manage"));
		}
}
	
	$rowsPerPage=(isset($_GET["row"])) ? (int)$_GET["row"] : 20;
	$strPages="SELECT * FROM admin_user";
	$pagesQuery=dbQuery(getPagingQuery($strPages, $rowsPerPage)); 
	$num=dbNumRows($pagesQuery);
	$pagingLink=getPagingLink($strPages, $rowsPerPage, getAllGetParams(array("page")));
include('header.php');?>
       
               
                
                
                	<?php if($_GET['type']=="manage"){ ?>
					 <h2> Admin Details</h2>
					 <form id="formCms" name="formCms" method="post">
				<table width="403" id="rounded-corner" summary="cms">
          <thead>
            <tr>
              
              <th width="21%"  class="rounded-company" scope="col"> Name</th>
			  <th scope="col" width="29%" >Email Address </th>
			   <th scope="col" width="16%" >Username</th>
			   <th scope="col" width="17%" >Status</th>
              <th scope="col" width="17%" class="rounded-q4">Action</th>
            </tr>
          </thead>
					<tfoot>
            <tr>
              <td colspan="5"  b class="rounded-foot-left"><strong><?php if($num=='0'){ echo "Pending Oders List is empty";} ?></strong></td>
            
            </tr>
          </tfoot>
          <tbody>
<?php 
 if($num>'0'){
	while($strUser = dbFetchArray($pagesQuery)) { 

?>
            <tr>
							
              <td><?php echo $strUser["firstname"];?>&nbsp;<?=$strUser["lastname"];?></td> 	
				<td><?php echo $strUser["email"];?></td>
				<td><?php echo $strUser["username"];?></td> 
              <td><?php if($strUser["is_active"]=='1'){?><a href="javascript:void(0);" class="status active" title="Active"></a><a href="javascript:void(0);" class="status" title="Set Inactive"></a><?php }else{ ?><a href="javascript:void(0);" class="status" title="Set Active"></a><a href="javascript:void(0);" class="status inactive" title="Inactive"></a><?php } ?> </td>
              <td><a href="<?php echo hrefLink(APP_ADMIN_DIR."account.php","action=edit");?>"><img src="images/user_edit.png" alt="update" border="0" /></a></td>
            </tr>
<?php } ?>
          </tbody>
        </table>
	 </form>
        
     <?php 
		}
		}
				if($_GET['action']=="edit"){ ?>
				 	
					<?php
				 	include('action/edit_account.php'); 
					}elseif($_GET['action']=="pwd"){ ?>
				 	
					<?php
				 	include('action/change_password.php'); 
					}?>
			
				 
                <!-- // #main -->
                
                <div class="clear"></div>
            
            <!-- // #container -->
    
        <!-- // #containerHolder -->
        
      <?php include('action/footer.php');?>   
