<?php
	
		$queryId=(isset($_GET["queryId"]) ? $_GET["queryId"] : "");	
		$pageQuery=dbQuery("SELECT * FROM help_desk_query WHERE help_desk_query_id=".$queryId);
		$pageInfo=dbFetchArray($pageQuery);
	

?>
<!-- TinyMCE -->

<!-- /TinyMCE -->
        <h2>Send Mailing</h2>
				<div class="form">
					<form id="formCMS" action="<?php echo hrefLink(APP_ADMIN_DIR."manage_help_desk.php", getAllGetParams(array("action"))."action=send");?>" method="post" enctype="multipart/form-data">
						<div class="error_container"></div>
            <fieldset>
			<dl>
                <dt>
                  <label for="cms_name">Email address:</label>
                </dt>
                <dd>
				 <input type="text" name="email" id="package_id" readonly=""  value="<?=$pageInfo['email_address']?>" />
               	</dd></dl>
				<dl>
                <dt>
                  <label for="cms_name">Subject:</label>
                </dt>
                <dd>
				 <input type="text" name="Subject" class="required" id="Subject" value="" />
               	</dd></dl>
				<dl>
                <dt>
                  <label for="cms_content">Content:</label>
                </dt>
                <dd>
                  <textarea name="content" class="required" rows="10" cols="40"></textarea>
                </dd>
              </dl>
			  
				
              <dl class="submit">
                <input type="submit" name="submit" id="submit" value="Update" />
								<input type="button" name="cancel" id="cancel" value="Cancel" onClick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."manage_package.php", "type=manage");?>');" />
              </dl>
            </fieldset>
          </form>
        </div>
		