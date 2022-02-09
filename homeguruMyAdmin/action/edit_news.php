<?php
	
		$cmsId=(isset($_GET["newsId"]) ? $_GET["newsId"] : "");	
		$pageQuery=dbQuery("SELECT * FROM buy_news WHERE buy_news_id=".$cmsId);
		$pageInfo=dbFetchArray($pageQuery);
	

?>
<!-- TinyMCE -->

<!-- /TinyMCE -->
        <h2>Edit News </h2>
				<div class="form">
					<form id="formCMS" action="<?php echo hrefLink(APP_ADMIN_DIR."manage_buy_news.php", getAllGetParams(array("action"))."action=update");?>" method="post" enctype="multipart/form-data">
					
            <fieldset>
			<dl>
                <dt>
                  <label for="latest_news_title">News Title:</label>
                </dt> <input type="hidden" name="buy_news_id" id="buy_news_id" class="large" value="<?=$pageInfo["buy_news_id"]?>" />
                <dd>
                  <input type="text" name="buy_news_title" id="buy_news_title" class="large" value="<?=$pageInfo["buy_news_title"]?>" />
                </dd>
            </dl>
			  <dl>
                <dt>
                  <label for="buy_news_content">News content:</label>
                </dt>
                <dd>
                  <textarea  name="buy_news_content" class="ckeditor" cols="150"  id="editor6" ><?=$pageInfo["buy_news_content"]?></textarea>
                </dd>
              </dl>
		  
			
			 
              <dl class="submit">
                <input type="submit" name="submit" id="submit" value="Update" />
								<input type="button" name="cancel" id="cancel" value="Cancel" onclick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."manage_buy_news.php","type=manage");?>');" />
              </dl>
            </fieldset>
          </form>
        </div>
