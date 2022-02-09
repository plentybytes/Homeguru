<?php
	
		$acid=(isset($_GET["acid"]) ? $_GET["acid"] : "");	
		$booksQuery=dbQuery("SELECT * FROM  admin_user WHERE user_id=".$_SESSION["admin"]["id"]);
		$accountInfo=dbFetchArray($booksQuery);
	

?>

<!-- TinyMCE -->


<!-- /TinyMCE -->
        <h2>Edit Account Details </h2>
				<div class="form">
					<form id="formCMS" action="<?php echo hrefLink(APP_ADMIN_DIR."account.php", getAllGetParams(array("action"))."action=update");?>" method="post" enctype="multipart/form-data">
						
            <fieldset>
		
			
							<dl>
                <dt>
                  <label for="">First Name:</label><span style=" color:#FF0000">*</span>
                </dt>
                <dd>
                 <input type="text" name="firstname" id="firstname" class="required" value="<?=$accountInfo["firstname"];?>" />
				 <input type="hidden" name="user_id" id="user_id" class="required" value="<?=$accountInfo["user_id"];?>" />
                </dd>
              </dl>
			  
							<dl>
                <dt>
                  <label for="">Last  Name:</label><span style=" color:#FF0000">*</span>
                </dt>
                <dd>
                 <input type="text" name="lastname" id="lastname" class="required" value="<?=$accountInfo["lastname"];?>" />
				
                </dd>
              </dl>
			  
							<dl>
                <dt>
                  <label for="">Email- Address:</label><span style=" color:#FF0000">*</span>
                </dt>
                <dd>
                 <input type="text" name="email" id="email" class="required" value="<?=$accountInfo["email"];?>" />
				
                </dd>
              </dl>
			  
							<dl>
                <dt>
                  <label for="">User Name:</label><span style=" color:#FF0000">*</span>
                </dt>
                <dd>
                 <input type="text" name="username" id="username" class="required" value="<?=$accountInfo["username"];?>" />
		
                </dd>
              </dl>
			  		
              <dl class="submit">
                <input type="submit" name="submit" id="submit" value="update" />
								<input type="button" name="cancel" id="cancel" value="Cancel" onclick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."account.php", "type=manage");?>');" />
              </dl>
            </fieldset>
          </form>
        </div>
