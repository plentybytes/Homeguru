<?php 
		$bannerId=(isset($_GET["banid"]) ? $_GET["banid"] : "");	
		$pageQuery=dbQuery("SELECT * FROM banner WHERE banner_id='".$bannerId."'");
		$pageInfo=dbFetchArray($pageQuery);
	?>
<!-- TinyMCE -->

<!-- /TinyMCE -->
        <h2>Edit  Banner</h2>
				<div class="form">
					<form id="formCMS"  name="formCMS" action="<?php echo hrefLink(APP_ADMIN_DIR."manage_banner.php", getAllGetParams(array("action", "banid"))."action=update");?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="banner_id" id="banner_id" value="<?php echo outputString($pageInfo["banner_id"]);?>" />
						<div class="error_container"></div>
            <fieldset>
			   
			   <dl>
                <dt>
                  <label for="cms_name">Banner Location:*</label>
                </dt>
                <dd>
                 <select name="banner_location" >
				 <option <?php if($pageInfo["banner_image"]=="right"){ ?>  selected="selected" <?php } ?>value="right">Right side</option>
				 <option  <?php if($pageInfo["banner_image"]=="middle"){ ?>  selected="selected" <?php } ?>value="middle">Middle side</option>
				 <option  <?php if($pageInfo["banner_image"]=="left"){ ?>  selected="selected" <?php } ?>value="left">left side</option>
				</select>
				
                </dd>
              </dl>
			   <dl>
                <dt>
                  <label for="cms_name">Banner image:*</label>
                </dt>
                <dd>
                <img src="../images/banner/<?php echo $pageInfo["banner_image"];?>"/>
				<label for="cms_name">image size must be 148 x 120</label>
				
                </dd>
              </dl>	
			  <dl>
                <dt>
                  <label for="cms_name">Change image:*</label>
                </dt>
                <dd>
              
				<input type="file" name="banner_image" />
                </dd>
              </dl>	
			  
							<dl>
                <dt>
                  <label for="cms_content">Banner order:</label>
                </dt>
                <dd>
                <input type="text" name="banner_order" value="<?php echo $pageInfo["banner_order"];?>">
                </dd>
              </dl>
			  
			<dl>
                <dt>
                  <label for="cms_content">Banner Url:</label>
                </dt>
                <dd>
                <textarea name="banner_code"  style="width:200px; height:100px" ><?php echo $pageInfo["banner_code"];?></textarea>
                </dd>
              </dl>
			  	<dl>
                <dt>
                  <label for="is_active">Active:</label>
                </dt>
                <dd>
                  <input type="radio" name="banner_status" id="banner_status" value="Yes"<?php echo (($pageInfo["banner_status"]=='Yes') ? "  checked=\"checked\"" : "");?>  checked="checked" />
									<label class="check_label">Yes</label>
									<input type="radio" name="banner_status" id="banner_status" value="No"<?php echo (($pageInfo["banner_status"]=='No') ? "  checked=\"checked\"" : "");?> />
									<label class="check_label">No</label>
                </dd>
              </dl>
              <dl class="submit">
                <input type="submit" name="submit" id="submit" value="update" />
								<input type="button" name="cancel" id="cancel" value="Cancel" onClick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."manage_banner.php", "type=manage");?>');" />
              </dl>
            </fieldset>
          </form>
        </div>
	