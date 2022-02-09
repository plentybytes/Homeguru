<?php
	
		$cmsId=(isset($_GET["seoId"]) ? $_GET["seoId"] : "");	
		$pageQuery=dbQuery("SELECT * FROM seo WHERE seo_id=".$cmsId);
		$pageInfo=dbFetchArray($pageQuery);
	

?>
<!-- TinyMCE -->

<!-- /TinyMCE -->
        <h2>Edit SEO Content </h2>
				<div class="form">
					<form id="formCMS" action="<?php echo hrefLink(APP_ADMIN_DIR."manage_seo.php", getAllGetParams(array("action", "seoId"))."action=update");?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="seo_id" id="seo_id" value="<?php echo outputString($pageInfo["seo_id"]);?>" />
						<div class="error_container"></div>
            <fieldset>
							<dl>
                <dt>
                  <label for="cms_name">File name:</label>
                </dt>
                <dd>
                 <input type="text" name="seo_file_name" id="seo_file_name" class="large" value="<?php echo outputString($pageInfo["seo_file_name"]);?>" />
                </dd>
              </dl>
				<dl>
                <dt>
                  <label for="cms_name">File Title:</label>
                </dt>
                <dd>
                 <input type="text" name="seo_title" id="seo_title" class="large" value="<?php echo outputString($pageInfo["seo_title"]);?>" />
                </dd>
              </dl>
			  			<dl>
                <dt>
                  <label for="cms_content">Meta Keywords:</label>
                </dt>
                <dd>
                  <textarea name="seo_meta_keywords" cols="150" ><?php echo $pageInfo["seo_meta_keywords"];?></textarea>
                </dd>
              </dl>
					<dl>
                <dt>
                  <label for="cms_content">Meta Description:</label>
                </dt>
                <dd>
                  <textarea name="seo_description" cols="150" ><?php echo $pageInfo["seo_description"];?></textarea>
                </dd>
              </dl>
							
              <dl class="submit">
                <input type="submit" name="submit" id="submit" value="Update" />
								<input type="button" name="cancel" id="cancel" value="Cancel" onclick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."manage_seo.php", "type=manage");?>');" />
              </dl>
            </fieldset>
          </form>
        </div>
		