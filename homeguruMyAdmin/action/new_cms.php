
<!-- TinyMCE -->


<!-- /TinyMCE -->
        <h2>Add New Page</h2>
				<div class="form">
					<form id="formCMS" action="<?php echo hrefLink(APP_ADMIN_DIR."cms.php", getAllGetParams(array("action"))."action=insert");?>" method="post" enctype="multipart/form-data">
						<div class="error_container"></div>
            <fieldset>
							<dl>
                <dt>
                  <label for="cms_name">Name:</label>
                </dt>
                <dd>
                  <input type="text" name="cms_name" id="cms_name" class="large" />
                </dd>
              </dl>
							<dl>
                <dt>
                  <label for="cms_content">Content:</label>
                </dt>
                <dd>
                  <textarea name="cms_content"  class="ckeditor" cols="150"  id="editor6"></textarea>
                </dd>
              </dl>
			
							<dl>
                <dt>
                  <label for="is_active">Active:</label>
                </dt>
                <dd>
                  <input type="radio" name="is_active" id="is_active" value="1" checked="checked" />
									<label class="check_label">Yes</label>
									<input type="radio" name="is_active" id="is_active" value="0" />
									<label class="check_label">No</label>
                </dd>
              </dl>
              <dl class="submit">
                <input type="submit" name="submit" id="submit" value="Add" />
								<input type="button" name="cancel" id="cancel" value="Cancel" onclick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."cms.php","type=manage");?>');" />
              </dl>
            </fieldset>
          </form>
        </div>
