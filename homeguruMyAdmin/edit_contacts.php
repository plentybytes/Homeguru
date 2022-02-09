<?php
	require("../includes/application.php");
	require("../includes/admin_application.php");
	$action=(isset($_GET["action"]) ? $_GET["action"] : "");
	if($action=="update"){
		$contactIntroText=$_POST["intro_text"];
		$contactEmail=dbPrepareInput($_POST["email"]);
		$contactMobile=dbPrepareInput($_POST["mobile"]);
		$contactPhone=dbPrepareInput($_POST["phone"]);
		$contactFax=dbPrepareInput($_POST["fax"]);
		$contactStreet=dbPrepareInput($_POST["street"]);
		$contactSuburb=dbPrepareInput($_POST["suburb"]);
		$contactPostCode=dbPrepareInput($_POST["post_code"]);
		$contactCountry=dbPrepareInput($_POST["country"]);
		$contactFacebookUrl=dbPrepareInput($_POST["facebook_url"]);
		$contactTwitterUrl=dbPrepareInput($_POST["twitter_url"]);
		$contactGoogleMap=$_POST["google_map"];
		
		dbQuery("UPDATE contact_details SET intro_text='".dbInput($contactIntroText)."', email='".dbInput($contactEmail)."', mobile='".dbInput($contactMobile)."', phone='".dbInput($contactPhone)."', fax='".dbInput($contactFax)."', street='".dbInput($contactStreet)."', suburb='".dbInput($contactSuburb)."', post_code='".dbInput($contactPostCode)."', country='".dbInput($contactCountry)."', country='".dbInput($contactCountry)."', facebook_url='".dbInput($contactFacebookUrl)."', twitter_url='".dbInput($contactTwitterUrl)."', google_map='".dbInput($contactGoogleMap)."'");
		
		redirect(hrefLink(APP_ADMIN_DIR."contact_details.php"));
	}
	$contactsQuery=dbQuery("SELECT * FROM contact_details WHERE contacts_id=1");
	$contacts=dbFetchArray($contactsQuery);
	require("header.php");
?>
<!-- TinyMCE -->
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "intro_text",
		theme : "simple"
	});
</script>
<!-- /TinyMCE -->
        <h2>Edit Conatc Details</h2>
				<div class="form">
					<form id="formEditContacts" name="formEditContacts" action="<?php echo hrefLink(APP_ADMIN_DIR."edit_contacts.php", "action=update");?>" method="post" enctype="multipart/form-data">
						<div class="error_container"></div>
            <fieldset>
							<dl>
                <dt>
                  <label for="email">Email:</label>
                </dt>
                <dd>
                  <input type="text" name="email" id="email" class="large" value="<?php echo outputString($contacts["email"]);?>" />
                </dd>
              </dl>
							<dl>
                <dt>
                  <label for="phone">Mobile:</label>
                </dt>
                <dd>
                  <input type="text" name="mobile" id="mobile" class="large" value="<?php echo outputString($contacts["mobile"]);?>" />
                </dd>
              </dl>
							<dl>
                <dt>
                  <label for="phone">Phone:</label>
                </dt>
                <dd>
                  <input type="text" name="phone" id="phone" class="large" value="<?php echo outputString($contacts["phone"]);?>" />
                </dd>
              </dl>
							<dl>
                <dt>
                  <label for="fax">Fax:</label>
                </dt>
                <dd>
                  <input type="text" name="fax" id="fax" class="large" value="<?php echo outputString($contacts["fax"]);?>" />
                </dd>
              </dl>
							<dl>
                <dt>
                  <label for="street">Street:</label>
                </dt>
                <dd>
                  <input type="text" name="street" id="street" class="large" value="<?php echo outputString($contacts["street"]);?>" />
                </dd>
              </dl>
							<dl>
                <dt>
                  <label for="suburb">Suburb:</label>
                </dt>
                <dd>
                  <input type="text" name="suburb" id="suburb" class="large" value="<?php echo outputString($contacts["suburb"]);?>" />
                </dd>
              </dl>
							<dl>
                <dt>
                  <label for="post_code">Post Code:</label>
                </dt>
                <dd>
                  <input type="text" name="post_code" id="post_code" class="large" value="<?php echo outputString($contacts["post_code"]);?>" />
                </dd>
              </dl>
							<dl>
                <dt>
                  <label for="country">Country:</label>
                </dt>
                <dd>
                  <input type="text" name="country" id="country" class="large" value="<?php echo outputString($contacts["country"]);?>" />
                </dd>
              </dl>
							<dl>
                <dt>
                  <label for="shop_facebook_link">Facebook URL:</label>
                </dt>
                <dd>
                  <input type="text" name="facebook_url" id="facebook_url" class="large" value="<?php echo outputString($contacts["facebook_url"]);?>" />
                </dd>
              </dl>
							<dl>
                <dt>
                  <label for="twitter_url">Twitter URL:</label>
                </dt>
                <dd>
                  <input type="text" name="twitter_url" id="twitter_url" class="large" value="<?php echo outputString($contacts["twitter_url"]);?>" />
                </dd>
              </dl>
							<dl>
                <dt>
                  <label for="google_map">Google Map:</label>
                </dt>
                <dd>
									<textarea name="google_map" id="google_map" rows="5" cols="36"><?php echo stripslashes($contacts["google_map"]);?></textarea>
                </dd>
              </dl>
              <dl class="submit">
                <input type="submit" name="submit" id="submit" value="Update" />
								<input type="button" name="cancel" id="cancel" value="Cancel" onclick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."contact_details.php");?>');" />
              </dl>
            </fieldset>
          </form>
        </div>
<?php
	require("footer.php");
?>  		