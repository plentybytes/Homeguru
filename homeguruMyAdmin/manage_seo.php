<?php
	require("../includes/application.php");
	require("../includes/admin_application.php");
	$action=isset($_GET["action"]) ? $_GET["action"] : "";
	
	if($action=="update"){
	
		$seoId=$_POST['seo_id'];
		$seoFileName=$_POST['seo_file_name'];	
		$seoTitle=$_POST['seo_title'];	
		$seoDescription=$_POST['seo_description'];	
		$seoMetaKeywords=$_POST['seo_meta_keywords'];
		$sqlDataArray=array("seo_file_name"=>$seoFileName,"seo_title"=>$seoTitle,"seo_description"=>$seoDescription,"seo_meta_keywords"=>$seoMetaKeywords,
		 "seo_modified_date"=>"NOW()");
		dbPerform("seo", $sqlDataArray, "update", "seo_id=".(int)$seoId);
		redirect(hrefLink(APP_ADMIN_DIR."manage_seo.php", "type=manage"));		
	}
	
		
	$rowsPerPage=(isset($_GET["row"])) ? (int)$_GET["row"] : 20;
	$strPages="SELECT * FROM  seo order by seo_modified_date DESC";
	$pagesQuery=dbQuery(getPagingQuery($strPages, $rowsPerPage)); 
	$pagingLink=getPagingLink($strPages, $rowsPerPage, getAllGetParams(array("page")));
	
	if($action=="status") {
	$data=$_GET['type'];
	$where1="seo_id";
	$whereid=$_GET['id'];
	$tb="seo";
	$fild="seo_status";

ChangeStatus($tb,$fild,$data,$where1,$whereid);


	redirect(hrefLink(APP_ADMIN_DIR."manage_seo.php", "type=manage")); 

	}
	
	require("header.php");
?>
     <?php if($_GET['type']=='manage'){ ?>   <h2>SEO Section</h2>
     <form id="formCms" name="formCms" method="post" enctype="multipart/form-data">
				<table width="403" id="rounded-corner" summary="cms">
          <thead>
            <tr>
     		<th scope="col" width="95"  class="rounded-company">File name</th>
			<th scope="col" width="98"  class="rounded">File title</th>
            	 <th scope="col" width="135" class="rounded">Status</th>
              <th scope="col" width="55" class="rounded-q4">Action</th>
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
       	
	
		
			<td><?php echo $pages["seo_file_name"];?></td> 	
				<td> <?php  echo $pages["seo_title"]?></td>
              <td>

			  <?php if($pages["seo_status"]=='Yes'){?>

<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_seo.php","action=status&type=No&id=".$pages["seo_id"]."");?>" onclick="tipsstatus()" class="bt_green"><span class="bt_green_lft"></span><strong>Active </strong><span class="bt_green_r"></span></a>

<?php }else{ ?>

<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_seo.php","action=status&type=Yes&id=".$pages["seo_id"]."");?>" class="bt_red">
<span class="bt_red_lft"></span><strong>Deactive </strong><span class="bt_red_r"></span></a>



</a><?php }?>


			  </td>
              <td><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_seo.php","action=edit&seoId=".$pages["seo_id"]);?>"><img src="images/images.jpeg" alt="view" title="view" border="0" /></a>
			  <a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_seo.php","action=edit&seoId=".$pages["seo_id"]);?>"><img src="images/user_edit.png" alt="user edit" title="Edit" border="0" /></a>
			    &nbsp;&nbsp;<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_seo.php","action=view&seoId=".$pages["seo_id"]);?>"></a></td>
            </tr>
<?php } ?>
          </tbody>
        </table>
	 </form>
       
	   
        <div class="pagination"><?php echo $pagingLink;?></div>
		<?php } elseif($_GET['action']=='add') {
		include("action/edit_seo.php"); }
		elseif($_GET['action']=='edit'){
		include("action/edit_seo.php"); 
		}elseif($_GET['action']=='view'){
		
		$seoId=(isset($_GET["seoId"]) ? $_GET["seoId"] : "");	
		$pageQuery=dbQuery("SELECT * FROM seo WHERE seo_id=".$seoId);
		$pageInfo=dbFetchArray($pageQuery);
		
		 ?>   
      <h2>View SEO Details </h2>
				<table width="423" id="rounded-corner" summary="cms">
				<tfoot>
            <tr>
              <td  class="rounded-foot-left">&nbsp;</td>
             <td  class="rounded-foot-right">&nbsp;</td>
            </tr>
          </tfoot>
		  
          <tbody scope="col">
      
			 <tr> <td colspan="2" class=""><strong>SEO Details</strong></td>   
           
            </tr>
            <tr> <td width="138" class="">Seo File Name</td>   
            <td width="273"><?php echo $pageInfo["seo_file_name"];?></td>
            </tr>
			<tr> <td>File Title</td>   <td><?php echo $pageInfo["seo_title"];?></td></tr>
			<tr> <td>Meta Keywords</td>   <td><?php echo $pageInfo["seo_meta_keywords"];?></td></tr>
			 <tr> <td width="138">Meta Description </td>   
            <td width="273"><?php echo $pageInfo["seo_description"];?>  </td>
            </tr>
			<tr> <td width="138">Creaed Date </td>   
            <td width="273"><?php echo $pageInfo["seo_creaed_date"];?>  </td>
            </tr>
			<tr> <td width="138">Modified Date </td>   
            <td width="273"><?php echo $pageInfo["seo_modified_date"];?>  </td>
            </tr>
			<tr> <td width="138">Status  </td>   
            <td width="273"><?php echo $pageInfo["seo_status"];?>  </td>seo_status
            </tr>
			

          </tbody>
     </table>
	 <a  onclick="javascript:goBack('<?php echo hrefLink(APP_ADMIN_DIR."manage_seo.php", "type=manage");?>');" href="javascript:void(0)" class="bt_green"><span class="bt_green_lft"></span><strong>Back To SEO </strong><span class="bt_green_r"></span></a>
	 
 
		<?php 
		
		}?>
	
		
		<?php
	require("action/footer.php");
?>  		