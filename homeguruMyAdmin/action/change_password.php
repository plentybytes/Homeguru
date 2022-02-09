<?php
	
		$acid=(isset($_GET["acid"]) ? $_GET["acid"] : "");	
	
	

?>

<!-- TinyMCE -->


<!-- /TinyMCE -->
        <h2>Edit Account Password </h2>
				<div class="form">
					<form id="Change" action="<?php echo hrefLink(APP_ADMIN_DIR."account.php", getAllGetParams(array("action"))."action=change");?>" method="post" enctype="multipart/form-data">
						
            <fieldset>
		
		
							<dl>
                <dt>
                  <label for="">Old Password:</label><span style=" color:#FF0000">*</span>
                </dt>
                <dd>
                 <input type="password" name="old_pwd" id="lastname" class="required" value="" />
				
                </dd>
              </dl>
			  
							<dl>
                <dt>
                  <label for="">New  Password:</label><span style=" color:#FF0000">*</span>
                </dt>
                <dd>
                 <input type="password" name="new_password" id="new_password" />
				
                </dd>
              </dl>
			  
							<dl>
                <dt>
                  <label for="">Verify Password:</label><span style=" color:#FF0000">*</span>
                </dt>
                <dd>
                 <input type="password" name="verify_pwd" id="verify_pwd"  />
		
                </dd>
              </dl>
			  		
              <dl class="submit">
                <input type="submit" name="submit" id="submit" value="update" />
								<input type="button" name="cancel" id="cancel" value="Cancel" onclick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."account.php", "type=manage");?>');" />
              </dl>
            </fieldset>
          </form>
        </div>
