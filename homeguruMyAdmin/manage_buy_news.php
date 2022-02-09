<?php
	require("../includes/application.php");
	require("../includes/admin_application.php");
	$action=isset($_GET["action"]) ? $_GET["action"] : "";
	if($action == "insert"){
	
		$buyNewsTitle=$_POST['buy_news_title'];
		$buyNewsContent=$_POST['buy_news_content'];
		$sqlDataArray=array("buy_news_title"=>$buyNewsTitle,"buy_news_content"=>$buyNewsContent,"buy_news_created"=>"NOW()");
		dbPerform("buy_news", $sqlDataArray);
			redirect(hrefLink(APP_ADMIN_DIR."manage_buy_news.php", "type=manage"));
			}
	if($action=="update"){
	
		$buyNewsTitle=$_POST['buy_news_title'];
		$buyNewsContent=$_POST['buy_news_content'];
	
		$sqlDataArray=array("buy_news_title"=>$buyNewsTitle,"buy_news_content"=>$buyNewsContent,"buy_news_created"=>"NOW()");
		dbPerform("buy_news", $sqlDataArray, "update", "buy_news_id=".(int)$banid);
		redirect(hrefLink(APP_ADMIN_DIR."manage_buy_news.php", "type=manage"));		
	}
	
		
	$rowsPerPage=(isset($_GET["row"])) ? (int)$_GET["row"] : 20;
	$strPages="SELECT * FROM  buy_news order by buy_news_id DESC";
	$pagesQuery=dbQuery(getPagingQuery($strPages, $rowsPerPage)); 
	$pagingLink=getPagingLink($strPages, $rowsPerPage, getAllGetParams(array("page")));
	$num=dbNumRows($pagesQuery);
	if($action=="status") {
	$data=$_GET['type'];
	$where1="buy_news_id";
	$whereid=$_GET['id'];
	$tb="buy_news";
	$fild="buy_news_status";

ChangeStatus($tb,$fild,$data,$where1,$whereid);


	redirect(hrefLink(APP_ADMIN_DIR."manage_buy_news.php", "type=manage")); 

	}
	if($action=="delete") {

		if(isset($_GET["newsId"])){

			$pageId=dbPrepareInput($_GET["newsId"]);

			dbQuery("DELETE FROM buy_news WHERE buy_news_id=".(int)$pageId);

		}

		redirect(hrefLink(APP_ADMIN_DIR."manage_buy_news.php", "type=manage")); 

	}
 
	
	
	
	require("header.php");
?>
     <?php if($_GET['type']=='manage'){ ?>   <h2>Manage Buy News</h2>
     <form id="formCms" name="formCms" method="post" enctype="multipart/form-data">
				<table width="537" id="rounded-corner" summary="cms">
          <thead>
            <tr>
     		<th width="259" height="21"  class="rounded-company" scope="col">News  Title</th>
			<th scope="col" width="79"  class="rounded">News Date </th>
            	 <th scope="col" width="107" class="rounded" align="center">Status</th>
              <th scope="col" width="72" class="rounded-q4">Action</th>
            </tr>
          </thead>
					<tfoot>
            <tr>
              <td colspan="3" class="rounded-foot-left"  style="color:#FF0000; font-size:14px;"><?php if($num<1){?> <strong>Empty list</strong> <?php } ?>&nbsp;</td>
             <td  class="rounded-foot-right"></td>
            </tr>
          </tfoot>
          <tbody>
<?php 
if($num>0){
	while($pages = dbFetchArray($pagesQuery)) { 
?>
            <tr height="50px">
       	
	
		
			<td width="259"><?php echo substr($pages["buy_news_title"],0,70);?></td> 	
				<td> <?php  echo $pages["buy_news_created"]?></td>
              <td>

			  <?php if($pages["buy_news_status"]=='Yes'){?>

<a  href="<?php echo hrefLink(APP_ADMIN_DIR."manage_buy_news.php","action=status&type=No&id=".$pages["buy_news_id"]."");?>"  class="bt_green"><span class="bt_green_lft"></span><strong>Active </strong><span class="bt_green_r"></span></a>

<?php }else{ ?>

<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_buy_news.php","action=status&type=Yes&id=".$pages["buy_news_id"]."");?>" class="bt_red">
<span class="bt_red_lft"></span><strong>Deactive </strong><span class="bt_red_r"></span></a>



</a><?php }?>


			  </td>
              <td><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_buy_news.php","action=view&newsId=".$pages["buy_news_id"]);?>"><img src="images/images.jpeg" alt="View" width="16" height="16" border="0" title="view" /></a>&nbsp;&nbsp;<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_buy_news.php","action=edit&newsId=".$pages["buy_news_id"]);?>"><img src="images/user_edit.png" alt="Edit" title="Edit" border="0" /></a>
			    &nbsp;&nbsp;<a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_buy_news.php", getAllGetParams(array("action", "newsId"))."action=delete&newsId=".$pages["buy_news_id"]);?>" class="ask"><img src="images/trash.png" alt="trash" title="trash" border="0" /></a><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_buy_news.php","action=delete&newsId=".$pages["buy_news_id"]);?>"></a></td>
            </tr>
<?php } } ?>
          </tbody>
       </table>
	 </form>
       <a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_buy_news.php", "action=add");?>" class="bt_green"><span class="bt_green_lft"></span><strong>Add News</strong><span class="bt_green_r"></span></a> 
	   
        <div class="pagination"><?php echo $pagingLink;?></div>
		<?php } elseif($_GET['action']=='add') {
		include("action/add_news.php"); }
		elseif($_GET['action']=='edit'){
		include("action/edit_news.php"); 
		}elseif($_GET['action']=='view'){
		
		$cmsId=(isset($_GET["userid"]) ? $_GET["userid"] : "");	
		$pageInfo=dbFetchArray(dbQuery("SELECT * FROM buy_news WHERE buy_news_id=".$cmsId));
		
		 ?>   
      <h2>View News Details  </h2>
				<table width="337" id="rounded-corner" summary="cms">
				<tfoot>
            <tr>
              <td colspan="3"  class="rounded-foot-left">&nbsp;</td>
             <td  class="rounded-foot-right">&nbsp;</td>
            </tr>
          </tfoot>
		  
          <tbody scope="col">
       

          	<tr> <td > News Title</td>   <td><?php echo $pageInfo["buy_news_title"];?></td></tr>
			<tr> <td>News Content</td>   <td><?php echo $pageInfo["buy_news_content"];?></td></tr>
			<tr> <td>Created Date</td>   <td><?php echo date('j s M , Y', strtotime($pageInfo["buy_news_created"]));?></td></tr>
			<tr> <td width="138">Status  </td>   
            <td width="187"><?php echo $pageInfo["buy_news_status"];?> </td>
            </tr>
			

          </tbody>
     </table>
	 <span style="float:right;"><a   onclick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."manage_buy_news.php", "type=manage");?>');" href="javaScript:void(0)"  class="bt_green"><span class="bt_green_lft"></span><strong>Go Back</strong><span class="bt_green_r"></span></a></span><?php 
		

		}
	?>
		
		<?php
	require("action/footer.php");
?>  		