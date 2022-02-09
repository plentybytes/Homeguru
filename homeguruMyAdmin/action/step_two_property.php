
<!-- TinyMCE -->
<script language="javascript" type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	


function getcity(countryId) {		
		var strURL="findCity.php?county="+countryId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('city').innerHTML=req.responseText;						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
	}


</script>
<!-- /TinyMCE -->
        <h2>Add Property</h2>
				<div class="form">
					<form id="formCMS" action="<?php echo hrefLink(APP_ADMIN_DIR."application_file.php", getAllGetParams(array("action"))."action=property_step_two");?>" method="post" enctype="multipart/form-data">
					
            <fieldset>
							<dl>
                <dt>
                  <label for="cms_name">Total Floors in Building :</label>
                </dt>
                <dd>
                  <select name="property_total_floor_number" class="select">
                    <option value="" selected="selected">-- Total Floors in Building --</option>
                    <?php for($i=1;$i<41;$i++){ ?>
                    <option value="<?php echo $i?>"><?php echo $i?></option>
                    <?php } ?>
                    <option value="41">More than 40</option>
                  </select>
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">Age of Construction   :</label>
                </dt>
                <dd>
                  <select name="property_construction" class="select">
                    <option value="">-- Age of Construction --</option>
                    <option value="Under Construction">Under Construction</option>
                    <option value="Ready to move">New - Ready to move-in</option>
                    <option value="2 years">0 - 2 Years old</option>
                    <option value="5 years">2 - 5 Years old</option>
                    <option value="10 years">5 - 10 Years old</option>
                    <option value="15 years">10 - 15 Years old</option>
                    <option value="20 years">15 - 20 Years old</option>
                    <option value="21 years">More than 20 Years old</option>
                  </select>
                </dd>
              </dl>
			  
			  <dl>
                <dt>
                  <label for="cms_name">Furnished :</label>
                </dt>
                <dd>
                  <select name="property_furnishing" class="select" required>
                    <option value="">-- Select furnishing --</option>
                    <option value="Unfurnished">Unfurnished</option>
                    <option value="Semi-Furnished">Semi-furnished</option>
                    <option value="Furnished">Furnished</option>
                  </select>
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">Facing :</label>
                </dt>
                <dd>
                  <select  name="property_directional_facing" class="select">
                    <option value="">-- Select direction --</option>
                    <?php 
$face=showDirectionalFacing();
foreach($face as $key => $value){?>
                    <option value="<?php echo $key; ?>"><?php echo $value;?></option>
                    <?php } ?>
                  </select>
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">Ownership Type :</label>
                </dt>
                <dd>
                  <select name="property_ownership_type" class="select" required>
                    <option value="">-- Select Ownership Type --</option>
                    <?php 
$Ownership=showOwnership();
foreach($Ownership as $key => $value){?>
                    <option value="<?php echo $key; ?>"><?php echo $value;?></option>
                    <?php } ?>
                  </select>
                </dd>
              </dl>
			  <dl id="show" style="display:none;">
                <dt>
                  <label for="cms_name">Category_image:</label>
                </dt>
                <dd>
                  <input type="file" name="category_image" id="category_image" class="required large" />
                </dd>
              </dl>
			  	<dl>
                <dt>
                  <label for="cms_name"><span style="color:#163967;">Additional Features :</span></label></dt>
                <dd>&nbsp;</dd>
              </dl>
			  
				<dl>
                <dt>
                  <label for="is_active">Amenities</label>
                </dt>
                </br><dd>
				
                  <table border="0" cellpadding="0" cellspacing="0" width="87%" align="center">
                    <tr class="columnhead" style="font-size:12px;">
                      <td width="42%"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="1" type="checkbox" />
                      Power Backup</td>
                      <td class="paddingleft10" width="20%"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="2" type="checkbox" />
                      Lift</td>
                      <td width="38%" class="paddingleft10" ><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="3" type="checkbox" />
                      Club</td>
                      
                    </tr>
                    <tr>
                      <td colspan="4" class="lineheight" height="10">&nbsp;</td>
                    </tr>
                    <tr class="columnhead" style="font-size:12px;">
                      <td width="42%"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="5" type="checkbox" />
                      Swimming Pool</td>
                      <td class="paddingleft10" width="20%"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="6" type="checkbox" />
                      Security</td>
                      <td class="paddingleft10"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="7" type="checkbox" />
                        Reserved Parking</td>
                      
                    </tr>
                    <tr>
                      <td colspan="4" class="lineheight" height="10">&nbsp;</td>
                    </tr>
                    <tr class="columnhead" style="font-size:12px;">
                      <td><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="9" type="checkbox" />
                        Servant Quarters</td>
                      <td class="paddingleft10"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="10" type="checkbox" />
                        Park</td>
                      <td class="paddingleft10"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="11" type="checkbox" />
                        Vaastu Compliant </td>
                    </tr>
					  <tr>
                      <td colspan="4" class="lineheight" height="10">&nbsp;</td>
                    </tr>
					<tr class="columnhead" style="font-size:12px;">
					<td class="paddingleft10" width="42%"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="4" type="checkbox" />
					Rain Water Harvesting </td>
					<td class="paddingleft10"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities" value="8" type="checkbox" />
                        Gym</td>
						
						
                  </table>
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">Proximity Landmarks</label> </br></dt>
                
				</br><dd>
                  <table width="25%" height="66" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr class="columnhead" style="font-size:12px;">
                      <td width="14%"><strong>Shopping Mall</strong>
                          <select  id="shopping" name="shopping"  required class="select2" title="landmarks">
                            <option value="" selected="selected">Select</option>
                            <option value="0.5 Kms">0.5 Kms</option>
                            <option value="1 Km">1 Km</option>
                            <option value="2 Kms">2 Kms</option>
                            <option value="3 Kms">3 Kms</option>
                            <option value="4 Kms">4 Kms</option>
                            <option value="5 Kms">5 Kms</option>
                            <option value="6 Kms">6 Kms</option>
                            <option value="7 Kms">7 Kms</option>
                            <option value="8 Kms">8 Kms</option>
                            <option value="9 Kms">9 Kms</option>
                            <option value="10 Kms">10 Kms</option>
                      </select></td>
                      <td width="20%"><strong>School</strong>
                          <select id="school" name="school" class="select2" title="landmarks">
                            <option value="" selected="selected">Select</option>
                            <option value="0.5 Kms">0.5 Kms</option>
                            <option value="1 Km">1 Km</option>
                            <option value="2 Kms">2 Kms</option>
                            <option value="3 Kms">3 Kms</option>
                            <option value="4 Kms">4 Kms</option>
                            <option value="5 Kms">5 Kms</option>
                            <option value="6 Kms">6 Kms</option>
                            <option value="7 Kms">7 Kms</option>
                            <option value="8 Kms">8 Kms</option>
                            <option value="9 Kms">9 Kms</option>
                            <option value="10 Kms">10 Kms</option>
                      </select></td></tr>
					  <tr class="columnhead" style="font-size:12px;">
                      <td width="22%"><strong>Hospital</strong>
                          <select id="hospital" name="hospital"  class="select2" title="landmarks">
                            <option value="" selected="selected">Select</option>
                            <option value="0.5 Kms">0.5 Kms</option>
                            <option value="1 Km">1 Km</option>
                            <option value="2 Kms">2 Kms</option>
                            <option value="3 Kms">3 Kms</option>
                            <option value="4 Kms">4 Kms</option>
                            <option value="5 Kms">5 Kms</option>
                            <option value="6 Kms">6 Kms</option>
                            <option value="7 Kms">7 Kms</option>
                            <option value="8 Kms">8 Kms</option>
                            <option value="9 Kms">9 Kms</option>
                            <option value="10 Kms">10 Kms</option>
                      </select></td>
                      <td width="4%"><p><strong>ATM</strong>
                        <select id="atm" name="atm"   class="select2" title="landmarks">
                          <option value="" selected="selected">Select</option>
                          <option value="0.5 Kms">0.5 Kms</option>
                          <option value="1 Km">1 Km</option>
                          <option value="2 Kms">2 Kms</option>
                          <option value="3 Kms">3 Kms</option>
                          <option value="4 Kms">4 Kms</option>
                          <option value="5 Kms">5 Kms</option>
                          <option value="6 Kms">6 Kms</option>
                          <option value="7 Kms">7 Kms</option>
                          <option value="8 Kms">8 Kms</option>
                          <option value="9 Kms">9 Kms</option>
                          <option value="10 Kms">10 Kms</option>
                        </select>
                        </p>
                      </td>
                    </tr>
                  </table>
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">Upload property multiple image</label></dt>
                <dd>
				  <input style="float:left; margin-top:15px;" multiple="multiple" type="file"  required="required" name="property_images[]" class="input" size="35" />
				  </br>
</dd>
              </dl>
              <dl>
                <dt>
                  <label for="cms_name">Locate your property  </label>
                </dt>
                <dd>
                  <input type="text" name="property_total_price" class="input"  required="required"/>
                </dd>
              </dl>
              <p>&nbsp;</p>
              <dl class="submit"><input type="hidden" name="addId" value="<?php echo $_GET["addId"];?>" /><input type="hidden" name="source" value="<?php echo $_GET["source"];?>" /> <input type="hidden" name="_method" value="Add Step Two" />
                <input type="submit" name="submit" id="submit" value="Add" />
								<input type="button" name="cancel" id="cancel" value="Cancel" onclick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","type=manage");?>');" />
              </dl>
			  
			  
            </fieldset>
          </form>
        </div>
