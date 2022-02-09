
<!-- TinyMCE -->

<!-- /TinyMCE -->
        <h2>Add New  News</h2>
				<div class="form">
					<form id="formCMS"  name="formCMS" action="<?php echo hrefLink(APP_ADMIN_DIR."manage_buy_news.php", getAllGetParams(array("action", "banid"))."action=insert");?>" method="post" enctype="multipart/form-data">
					
						<div class="error_container"></div>
            <fieldset>
			  
				  <dl>
                <dt>
                  <label for="cms_name">News Title :*</label>
                </dt>
                <dd>
                 <input type="text" class="large "  name="buy_news_title" />
			
                </dd>
              </dl>	
			
							<dl>
                <dt>
                  <label for="cms_content">News Content:</label>
                </dt>
                <dd>
                <textarea name="buy_news_content" class="ckeditor" cols="150"  id="editor6"  ></textarea>
                </dd>
           </dl>
			  	
              <dl class="submit">
                <input type="submit" name="submit" id="submit" value="Add" />
								<input type="button" name="cancel" id="cancel" value="Cancel" onClick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."manage_buy_news.php", "type=manage");?>');" />
              </dl>
            </fieldset>
          </form>
        </div>
	