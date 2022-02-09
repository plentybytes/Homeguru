<?php
	require("../includes/application.php");
	require("../includes/admin_application.php");
	$action=isset($_GET["action"]) ? $_GET["action"] : "";
	if($action=="update"){
		$configurationId=dbPrepareInput($_POST["configuration_id"]);
		//$configurationValue=dbPrepareInput($_POST["configuration_value"]);
		$configurationValue=$_POST["configuration_value"];
		if(!isNull($configurationValue)){
			dbQuery("UPDATE configuration SET configuration_value='".$configurationValue."', modified=NOW() WHERE configuration_id=".(int)$configurationId);
			//$sqlDataArray = array("configuration_value" => $configurationValue, "modified" => "NOW()");
			//dbPerform("configuration", $sqlDataArray, "update", "configuration_id=".(int)$configurationId);
		}
		redirect(hrefLink(APP_ADMIN_DIR."configuration.php", getAllGetParams(array("action", "conid"))));
	}
	$rowsPerPage=(isset($_GET['row'])) ? (int)$_GET['row'] : 20;
	$strConfiguration="SELECT configuration_id, configuration_title, configuration_value, configuration_description, is_visible FROM configuration ORDER BY sort_order, configuration_title";
	$configurationQuery=dbQuery(getPagingQuery($strConfiguration, $rowsPerPage));
	$pagingLink=getPagingLink($strConfiguration, $rowsPerPage, getAllGetParams(array("page", "conid", "action")));
	require("header.php");
?>
        <h2>Settings</h2>
				<form id="formConfiguration" name="formConfiguration" action="<?php echo hrefLink(APP_ADMIN_DIR."configuration.php", getAllGetParams(array("action", "conid"))."action=update");?>" method="post">
					<table id="rounded-corner" summary="Store Settings">
						<thead>
							<tr>
								<th scope="col" class="rounded-company">&nbsp;</th>
								<th scope="col" class="rounded">Title</th>
								<th scope="col" class="rounded">Value</th>
								<th scope="col" class="rounded">Description</th>
								<th scope="col" class="rounded-q4">Edit</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<td colspan="4" class="rounded-foot-left">&nbsp;</td>
								<td class="rounded-foot-right">&nbsp;</td>
							</tr>
						</tfoot>
	          <tbody>
<?php
	while($configuration=dbFetchArray($configurationQuery)){
		if($configuration["is_visible"] == "Y"){
?>
							<tr>
								<td colspan="2"><?php echo $configuration["configuration_title"];?></td>
								<td><?php echo htmlspecialchars($configuration["configuration_value"]);?></td>
								<td><?php echo $configuration["configuration_description"];?></td>
								<td><a href="<?php echo hrefLink(APP_ADMIN_DIR."configuration.php", getAllGetParams(array("action", "conid"))."action=edit&conid=".$configuration["configuration_id"]);?>"><img src="images/user_edit.png" alt="user edit" title="user edit" border="0" /></a></td>
							</tr>
<?php
			if(isset($_GET["action"]) && isset($_GET["conid"]) && ($_GET["action"]=="edit") && ((int)$_GET["conid"]==$configuration["configuration_id"])){
?>
							<tr>
								<td colspan="2"><strong><?php echo $configuration["configuration_title"];?>:</strong></td>
								<td colspan="2"><input type="hidden" name="configuration_id" id="configuration_id" value="<?php echo $configuration["configuration_id"];?>" /><input type="text" name="configuration_value" id="configuration_value" size="45" value="<?php echo outputString($configuration["configuration_value"]);?>" /><div class="configerror_container"></div></td>
								<td><input type="submit" name="submit" id="submit" value="Update" /></td>
							</tr>
<?php
			}
		}
	}
?>
	          </tbody>
        	</table>
				</form>
				<div class="pagination"> <?php echo $pagingLink;?> </div>
<?php
	require("action/footer.php");
?>  		