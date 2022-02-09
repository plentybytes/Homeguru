<?php
	
		$proid=(isset($_GET["userid"]) ? $_GET["userid"] : "");	
		$pageQuery=dbQuery("SELECT * FROM user WHERE user_id=".$proid);
		$pageInfo=dbFetchArray($pageQuery);
	

?>
<!-- TinyMCE -->

<!-- /TinyMCE -->
        <h2>Edit User Status </h2>
				<div class="form">
					<form id="formCMS" action="<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php", getAllGetParams(array("action", "userid"))."action=send");?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="user_id" id="user_id" value="<?php echo outputString($pageInfo["user_id"]);?>" />
						<div class="error_container"></div>
            <fieldset>
							<dl>
                <dt>
                  <label for="cms_name">User Name :</label>
                </dt>
                <dd>
                  <input type="text" name="userName" id="" value="<?=$pageInfo["user_first_name"]?>" readonly="" class="required large" />
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">Email address:</label>
                </dt>
                <dd>
				 <input type="text" name="user_email" id="package_id" class="required large" readonly=""  value="<?=$pageInfo['user_email']?>" />
               	</dd></dl>
			  	<dl>
                <dt>
                  <label for="cms_name">Subject:</label>
                </dt>
                <dd>
				 <input type="text" name="Subject" class="required large" id="Subject" value="" />
               	</dd></dl>
				<dl>
                <dt>
                  <label for="cms_content">Content:</label>
                </dt>
                <dd>
                  <textarea name="content" class="ckeditor" cols="150" id="editor6" rows="10" ><?php echo"Dear sir,</br>"?></textarea>
                </dd>
              </dl>
			  
			
              <dl class="submit">
                <input type="submit" name="submit" id="submit" value="Update" />
								<input type="button" name="cancel" id="cancel" value="Cancel" onclick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php","type=manage");?>');" />
              </dl>
            </fieldset>
          </form>
        </div>
		