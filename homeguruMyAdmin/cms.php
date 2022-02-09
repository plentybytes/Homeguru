<?php
	require("../includes/application.php");
	require("../includes/admin_application.php");
	$action=isset($_GET["action"]) ? $_GET["action"] : "";
		if($action=="insert"){
		$pageName=dbPrepareInput($_POST["cms_name"]);
		$pageContent=$_POST["cms_content"];
		$sortOrder=dbPrepareInput($_POST["sort_order"]);
		$isActive=dbPrepareInput($_POST["is_active"]);
		
		$sqlDataArray=array("cms_name" => $pageName, "cms_content" => $pageContent, "is_active" => $isActive, "created" => "NOW()");
		dbPerform("cms", $sqlDataArray);
		//dbQuery("INSERT INTO cms (cms_name, cms_content, sort_order, is_active, created) VALUES('".$pageName."', '".$pageContent."', '".$sortOrder."', '".$isActive."', NOW())");
		$pageId=dbInsertId();
		redirect(hrefLink(APP_ADMIN_DIR."cms.php","type=manage"));

	}
	if($action=="update"){
		$pageId=dbPrepareInput($_POST["cms_id"]);
		$pageName=dbPrepareInput($_POST["cms_name"]);
		$pageContent=$_POST["cms_content"];
		$sortOrder=dbPrepareInput($_POST["sort_order"]);
		$isActive=dbPrepareInput($_POST["is_active"]);
		$sqlDataArray=array("cms_name" => $pageName, "cms_content" => $pageContent, "sort_order" => $sortOrder, "modified" => "NOW()", "is_active" => $isActive);
		dbPerform("cms", $sqlDataArray, "update", "cms_id=".(int)$pageId);
		//dbQuery("UPDATE cms SET cms_name='".$pageName."', cms_content='".$pageContent."', sort_order='".$sortOrder."', modified=NOW(), is_active='".$isActive."' WHERE cms_id=".(int)$pageId);
		redirect(hrefLink(APP_ADMIN_DIR."cms.php", "type=manage"));		
	}
	if($action=="delete") {
		if(isset($_GET["cmsid"])){
			$pageId=dbPrepareInput($_GET["cmsid"]);
			dbQuery("DELETE FROM cms WHERE cms_id=".(int)$pageId);
			dbQuery("DELETE FROM cms_blocks WHERE cms_id=".(int)$pageId);
		}
		redirect(hrefLink(APP_ADMIN_DIR."cms.php", getAllGetParams(array("action", "cmsid")))); 
	}
		
	$rowsPerPage=(isset($_GET["row"])) ? (int)$_GET["row"] : 20;
	$strPages="SELECT * FROM cms ORDER BY cms_id";
	$pagesQuery=dbQuery(getPagingQuery($strPages, $rowsPerPage)); 
	$pagingLink=getPagingLink($strPages, $rowsPerPage, getAllGetParams(array("page")));
	require("header.php");
?>

     <?php if($_GET['type']=='manage'){ ?>   <h2>CMS</h2>
        <form id="formCms" name="formCms" method="post">
				<table id="rounded-corner" summary="cms">
          <thead>
            <tr>
              <th scope="col" class="rounded-company"></th>
              <th scope="col" class="rounded">Name</th>
              <th scope="col" width="15%" class="rounded">Status</th>
              <th scope="col" width="15%" class="rounded-q4">Edit</th>
            </tr>
          </thead>
					<tfoot>
            <tr>
              <td colspan="4" class="rounded-foot-left">&nbsp;</td>
              
            </tr>
          </tfoot>
          <tbody>
<?php 
	while($pages = dbFetchArray($pagesQuery)) { 
?>
            <tr>
							<td>&nbsp;</td>
              <td><?php echo $pages["cms_name"];?></td>
							
              <td><?php if($pages["is_active"]==1){?><a href="javascript:void(0);" class="status active" title="Active"></a><a href="javascript:void(0);" class="status" title="Set Inactive"></a><?php }else{ ?><a href="javascript:void(0);" class="status" title="Set Active"></a><a href="javascript:void(0);" class="status inactive" title="Inactive"></a><?php }?></td>
              <td><a href="<?php echo hrefLink(APP_ADMIN_DIR."cms.php","action=edit&cmsid=".$pages["cms_id"]);?>"><img src="images/user_edit.png" alt="user edit" title="user edit" border="0" /></a></td>
            </tr>
<?php } ?>
          </tbody>
        </table>
				</form>
        <a href="<?php echo hrefLink(APP_ADMIN_DIR."cms.php","action=add");?>" class="bt_green"><span class="bt_green_lft"></span><strong>Add new page</strong><span class="bt_green_r"></span></a> 
        <div class="pagination"><?php echo $pagingLink;?></div>
		<?php } elseif($_GET['action']=='add') {
		include("action/new_cms.php"); }
		elseif($_GET['action']=='edit'){
		include("action/edit_cms.php"); 
		}?>
<?php
	require("action/footer.php");
?>  		