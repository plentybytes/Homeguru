<?php
	require("../includes/application.php");
	require("../includes/admin_application.php");
	
	$contactsQuery=dbQuery("SELECT * FROM contact_details WHERE contacts_id=1");
	$contacts=dbFetchArray($contactsQuery);
	
	require("header.php");
?>
        <h2>Contact Details</h2>
        <form id="formContacts" name="formContacts" method="post">
				<table id="rounded-corner" summary="contact details">
          <thead>
            <tr>
              <th scope="col" class="rounded-company">&nbsp;</th>
              <th scope="col" class="rounded" width="25%">Conacts</th>
              <th scope="col" class="rounded-q4">Values</th>
            </tr>
          </thead>
					<tfoot>
            <tr>
              <td colspan="2" class="rounded-foot-left">&nbsp;</td>
              <td class="rounded-foot-right">&nbsp;</td>
            </tr>
          </tfoot>
          <tbody>
						<tr>
							<td colspan="2">Email</td>
							<td><?php echo stripslashes($contacts['email']);?></td>
						</tr>
						<tr>
							<td colspan="2">Mobile</td>
							<td><?php echo stripslashes($contacts['mobile']);?></td>
						</tr>
						<tr>
							<td colspan="2">Phone</td>
							<td><?php echo stripslashes($contacts['phone']);?></td>
						</tr>
						<tr>
							<td colspan="2">Fax</td>
							<td><?php echo stripslashes($contacts['fax']);?></td>
						</tr>
						<tr>
							<td colspan="2">Street</td>
							<td><?php echo stripslashes($contacts['street']);?></td>
						</tr>
						<tr>
							<td colspan="2">Suburb</td>
							<td><?php echo stripslashes($contacts['suburb']);?></td>
						</tr>
						<tr>
							<td colspan="2">Postcode</td>
							<td><?php echo stripslashes($contacts['post_code']);?></td>
						</tr>
						<tr>
							<td colspan="2">Country</td>
							<td><?php echo stripslashes($contacts['country']);?></td>
						</tr>
						<tr>
							<td colspan="2"> Facebook URL </td>
							<td><?php echo stripslashes($contacts['facebook_url']);?></td>
						</tr>
						<tr>
							<td colspan="2"> Twitter URL</td>
							<td><?php echo stripslashes($contacts['twitter_url']);?></td>
						</tr>
						<tr>
							<td colspan="2" valign="top">Google Map</td>
							<td><?php echo stripslashes($contacts['google_map']);?></td>
						</tr>
          </tbody>
        </table>
				</form>
        <a href="<?php echo hrefLink(APP_ADMIN_DIR."edit_contacts.php");?>" class="bt_green"><span class="bt_green_lft"></span><strong>Edit contact details</strong><span class="bt_green_r"></span></a> 
<?php
	require("footer.php");
?>  		