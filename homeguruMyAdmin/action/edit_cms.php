<?php
	
		$cmsId=(isset($_GET["cmsid"]) ? $_GET["cmsid"] : "");	
		$pageQuery=dbQuery("SELECT * FROM cms WHERE cms_id=".$cmsId);
		$pageInfo=dbFetchArray($pageQuery);
	

?>
<!-- TinyMCE -->

<!-- /TinyMCE -->
        <h2>Edit Page</h2>
				<div class="form">
					<form id="formCMS" action="<?php echo hrefLink(APP_ADMIN_DIR."cms.php", getAllGetParams(array("action", "cmsid"))."action=update");?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="cms_id" id="cms_id" value="<?php echo outputString($pageInfo["cms_id"]);?>" />
						<div class="error_container"></div>
            <fieldset>
							<dl>
                <dt>
                  <label for="cms_name">Name:</label>
                </dt>
                <dd>
                 <input type="text" name="cms_name" id="cms_name" class="large" value="<?php echo outputString($pageInfo["cms_name"]);?>" />
                </dd>
              </dl>
							<dl>
                <dt>
                  <label for="cms_content">Content:</label>
                </dt>
                <dd>
                  <textarea name="cms_content" class="ckeditor" id="editor6" cols="150" ><?php echo $pageInfo["cms_content"];?></textarea>
                </dd>
              </dl>
					
							<dl>
                <dt>
                  <label for="is_active">Active:</label>
                </dt>
                <dd>
                  <input type="radio" name="is_active" id="is_active" value="1"<?php echo (($pageInfo["is_active"]==1) ? "  checked=\"checked\"" : "");?> />
									<label class="check_label">Yes</label>
									<input type="radio" name="is_active" id="is_active" value="0"<?php echo (($pageInfo["is_active"]==0) ? "  checked=\"checked\"" : "");?> />
									<label class="check_label">No</label>
                </dd>
              </dl>
              <dl class="submit">
                <input type="submit" name="submit" id="submit" value="Update" />
								<input type="button" name="cancel" id="cancel" value="Cancel" onclick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."cms.php", "type=manage");?>');" />
              </dl>
            </fieldset>
          </form>
        </div>
		