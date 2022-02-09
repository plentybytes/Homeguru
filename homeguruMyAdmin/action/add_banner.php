
<!-- TinyMCE -->

<!-- /TinyMCE -->
        <h2>Add New  Banners</h2>
				<div class="form">
					<form id="formCMS"  name="formCMS" action="<?php echo hrefLink(APP_ADMIN_DIR."manage_banner.php", getAllGetParams(array("action", "banid"))."action=insert");?>" method="post" enctype="multipart/form-data">
					
						<div class="error_container"></div>
            <fieldset>
			  <dl>
                <dt>
                  <label for="cms_name">Banner Location:*</label>
                </dt>
                <dd>
                 <select name="banner_location" >
				 <option  selected="selected" value="right">Right side</option>
				 <option value="middle">Middle side</option>
				 <option value="left">left side</option>
				</select>
				
                </dd>
              </dl>
				  <dl>
                <dt>
                  <label for="cms_name">Banner Image:*</label>
                </dt>
                <dd>
                 <input type="file"  name="banner_image" />
				 <label for="cms_name">image size must be 148 x 120</label>
                </dd>
              </dl>	
			
							<dl>
                <dt>
                  <label for="cms_content">Banner Url:</label>
                </dt>
                <dd>
                <textarea name="banner_code"  style="width:200px; height:100px" ></textarea>
                </dd>
              </dl>
			
			  
							<dl>
                <dt>
                  <label for="cms_content">Banner order:</label>
                </dt>
                <dd>
                <input type="text" name="banner_order">
                </dd>
              </dl>
			  	<dl>
                <dt>
                  <label for="banner_status">Active:</label>
                </dt>
                <dd>
                  <input type="radio" name="banner_status" id="banner_status" value="Yes" checked="checked" />
									<label class="check_label">Yes</label>
									<input type="radio" name="banner_status" id="banner_status" value="No"<?php echo (($pageInfo["banner_status"]=='No') ? "  checked=\"checked\"" : "");?> />
									<label class="check_label">No</label>
                </dd>
              </dl>
              <dl class="submit">
                <input type="submit" name="submit" id="submit" value="Add" />
								<input type="button" name="cancel" id="cancel" value="Cancel" onClick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."manage_banner.php", "type=manage");?>');" />
              </dl>
            </fieldset>
          </form>
        </div>
	