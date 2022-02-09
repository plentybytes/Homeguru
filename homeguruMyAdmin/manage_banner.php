<?php
	require("../includes/application.php");
	require("../includes/admin_application.php");
	$action=isset($_GET["action"]) ? $_GET["action"] : "";
	if($action == "insert"){
	
		$code=$_POST['banner_code'];
		$banner=$_POST['banner_order'];
		$bannerLocation=$_POST['banner_location'];
		$sqlDataArray=array("banner_location"=>$bannerLocation,"banner_code"=>$code,"banner_order"=>$banner,"banner_created"=>"NOW()");
		$shortcaricatureFile=new fileUpload("banner_image");
		$shortcaricatureFile->setDestination("../images/banner/");
		$shortcaricatureFile->setCategory("banner");
		if($shortcaricatureFile->fileParse() && $shortcaricatureFile->fileSave()) {
			$sqlDataArray["banner_image"]=dbPrepareInput($shortcaricatureFile->fileName);
			}
			
			
			dbPerform("banner", $sqlDataArray);
			redirect(hrefLink(APP_ADMIN_DIR."manage_banner.php", "type=manage"));
			}
	if($action=="update"){
	
		$banid=$_POST['banner_id'];
		$code=$_POST['banner_code'];	
		$banner=$_POST['banner_order'];
		$bannerLocation=$_POST['banner_location'];
		$sqlDataArray=array("banner_location"=>$bannerLocation,"banner_code"=>$code,"banner_order"=>$banner,"banner_modified"=>"NOW()");
		$shortcaricatureFile=new fileUpload("banner_image");
		$shortcaricatureFile->setDestination("../images/banner/");
		$shortcaricatureFile->setCategory("banner");
		if($shortcaricatureFile->fileParse() && $shortcaricatureFile->fileSave()) {
			$sqlDataArray["banner_image"]=dbPrepareInput($shortcaricatureFile->fileName);
			}
		dbPerform("banner", $sqlDataArray, "update", "banner_id=".(int)$banid);
		redirect(hrefLink(APP_ADMIN_DIR."manage_banner.php", "type=manage"));		
	}
	
		
	$rowsPerPage=(isset($_GET["row"])) ? (int)$_GET["row"] : 20;
	$strPages="SELECT * FROM  banner order by banner_id DESC";
	$pagesQuery=dbQuery(getPagingQuery($strPages, $rowsPerPage)); 
	$pagingLink=getPagingLink($strPages, $rowsPerPage, getAllGetParams(array("page")));
	
	if($action=="status") {
	$data=$_GET['type'];
	$where1="banner_id";
	$whereid=$_GET['id'];
	$tb="banner";
	$fild="banner_status";

ChangeStatus($tb,$fild,$data,$where1,$whereid);


	redirect(hrefLink(APP_ADMIN_DIR."manage_banner.php", "type=manage")); 

	}
	if($action=="delete") {

		if(isset($_GET["banner_id"])){

			$pageId=dbPrepareInput($_GET["banner_id"]);

			dbQuery("DELETE FROM banner WHERE banner_id=".(int)$pageId);

		}

		redirect(hrefLink(APP_ADMIN_DIR."manage_banner.php", "type=manage")); 

	}
 
	
	
	
	require("header.php");
?>
     <?php if($_GET['type']=='manage'){ ?>   <h2>Banner</h2>
     <form id="formCms" name="formCms" method="post" enctype="multipart/form-data">
				<table width="403" id="rounded-corner" summary="cms">
          <thead>
            <tr>
     		<th scope="col" width="25%"  class="rounded-company">Banner Image</th>
			<th scope="col" width="15"  class="rounded">Banner Url</th>
			<th scope="col" width="15"  class="rounded">Location</th>
            	 <th scope="col" width="20%" class="rounded">Status</th>
              <th scope="col" width="15%" class="rounded-q4">Action</th>
            </tr>
          </thead>
					<tfoot>
            <tr>
              <td colspan="5" class="rounded-foot-left">&nbsp;</td>
            
            </tr>
          </tfoot>
          <tbody>
<?php 
	while($pages = dbFetchArray($pagesQuery)) { 
?>
            <tr>
       	
	
		
			<td><img src="../images/banner/<?php echo $pages["banner_image"];?>" width="119" height="61" /></td> 	
				<td> <?php  echo $pages["banner_code"]?></td>
				<td> <?php  echo $pages["banner_location"]?></td>
              <td>

			  <?php if($pages["banner_status"]=='Yes'){?>

<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_banner.php","action=status&type=No&id=".$pages["banner_id"]."");?>" onclick="tipsstatus()" class="bt_green"><span class="bt_green_lft"></span><strong>Active </strong><span class="bt_green_r"></span></a>

<?php }else{ ?>

<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_banner.php","action=status&type=Yes&id=".$pages["banner_id"]."");?>" class="bt_red">
<span class="bt_red_lft"></span><strong>Deactive </strong><span class="bt_red_r"></span></a>



</a><?php }?>


			  </td>
              <td><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_banner.php","action=edit&banid=".$pages["banner_id"]);?>"><img src="images/user_edit.png" alt="user edit" title="Edit" border="0" /></a>
			    &nbsp;&nbsp;<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_banner.php", getAllGetParams(array("action", "proid"))."action=delete&banner_id=".$pages["banner_id"]);?>" class="ask"><img src="images/trash.png" alt="trash" title="trash" border="0" /></a><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_banner.php","action=delete&banner_id=".$pages["banner_id"]);?>"></a></td>
            </tr>
<?php } ?>
          </tbody>
        </table>
	 </form>
       <a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_banner.php", "action=add");?>" class="bt_green"><span class="bt_green_lft"></span><strong>Add new Image</strong><span class="bt_green_r"></span></a> 
	   
        <div class="pagination"><?php echo $pagingLink;?></div>
		<?php } elseif($_GET['action']=='add') {
		include("action/add_banner.php"); }
		elseif($_GET['action']=='edit'){
		include("action/edit_banner.php"); 
		}
	?>
		
		<?php
	require("action/footer.php");
?>  		