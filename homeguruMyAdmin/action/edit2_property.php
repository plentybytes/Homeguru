<?php 


		$strProperty=dbQuery("SELECT * FROM property where property_id='".$_GET["proid"]."'");
$strPropertyImage=dbQuery("SELECT * FROM property_images where property_file_type='image'and property_id='".$_GET["proid"]."'");
$strPropertyVideo=dbQuery("SELECT * FROM property_images where property_file_type='video' and property_id='".$_GET["proid"]."'");
	$numVideo=dbNumRows($strPropertyVideo);
	$numImage=dbNumRows($strPropertyImage);
	$leftImage=9-($numImage);
	$leftVideo=9-($numVideo);
	$num=dbNumRows($strProperty); 
	?>
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
<script language="javascript">
    row_no1=0;
    function addRow(tbl,row){
    //row count
    row_no1++;
    var tick = String(row_no1);
    if (row_no1< <?php echo $leftImage?> ){
    //Declaring text boxes
    var textbox ='<input type="file" size="35" style="float:left; margin-top:15px;" class="input" name="property_images[]"  />';
   
    //delete button
    var stop = '<a href="javascript:void(0)" style="float:left;text-decoration:none; " onclick="deleteRow(this)"><strong>- Delete</strong></a>';
    //Inserting textboxes into table cells
    var tbl = document.getElementById(tbl);
    var rowIndex = document.getElementById(row).value;
    var newRow = tbl.insertRow(row_no1);
   
	  var newCell = newRow.insertCell(0);
      newCell.innerHTML = textbox;
    //delete button within cell
    var newCell = newRow.insertCell(1);
    newCell.innerHTML = stop;
    }
	else{
	alert("You Only Add 10 images");
	}
    }
    //Delete Function
    function deleteRow(r)
    {
    var i=r.parentNode.parentNode.rowIndex;
    document.getElementById('TableMaina').deleteRow(i);
    }
	row_n=0;
    function addRowa(tbl,row){
    //row count
    row_n++;
    var tick = String(row_n);
    if (row_n< <?php echo $leftVideo?>){
    //Declaring text boxes
    var textbox ='<input type="file" size="35" style="float:left; margin-top:15px;" class="input" name="property_video[]" />';
   
    //delete button
    var stop = '<a href="javascript:void(0)" style="float:left;text-decoration:none; " onclick="deleteeRow(this)"><strong>- Delete</strong></a>';
    //Inserting textboxes into table cells
    var tbl = document.getElementById(tbl);
    var rowIndex = document.getElementById(row).value;
    var newRow = tbl.insertRow(row_n);
   
	  var newCell = newRow.insertCell(0);
      newCell.innerHTML = textbox;
    //delete button within cell
    var newCell = newRow.insertCell(1);
    newCell.innerHTML = stop;
    }
	else{
	alert("You Only Add 10 video");
	}
    }
    //Delete Function
    function deleteeRow(r)
    {
    var i=r.parentNode.parentNode.rowIndex;
    document.getElementById('TableMain').deleteRow(i);
    }
    </script>
<!-- /TinyMCE -->
        <h2>Edit Property</h2>
				<div class="form">
					<form id="formCMS" action="<?php echo hrefLink(APP_ADMIN_DIR."application_file.php", getAllGetParams(array("action"))."action=edit_step_two");?>" method="post" enctype="multipart/form-data">
					
            <fieldset>
							<dl>
                <dt>
                  <label for="cms_name">Total Floors in Building :</label>
                </dt>
                <dd>
                  <select name="property_total_floor_number" class="select">
                    <option value="" selected="selected">-- Total Floors in Building --</option>
                    <?php for($i=1;$i<41;$i++){ ?>
                    <option <?php if($pageInfo["property_total_floor_number"]==$i){?> selected="selected"<?php } ?> value="<?php echo $i?>"><?php echo $i?></option>
                    <?php } ?>
                    <option <?php if($pageInfo["property_total_floor_numbers"]=='41'){?> selected="selected"<?php } ?> value="41">More than 40</option>
                  </select>
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">Edit Age of Construction   :</label>
                </dt>
                <dd>
                  <select name="property_construction" class="select">
                    <option value="">-- Age of Construction --</option>
                    <option <?php if($pageInfo["property_construction"]=='Under Construction'){?> selected="selected"<?php } ?> value="Under Construction">Under Construction</option>
                    <option <?php if($pageInfo["property_construction"]=='New - Ready to move-in'){?> selected="selected"<?php } ?> value="Ready to move">New - Ready to move-in</option>
                    <option <?php if($pageInfo["property_construction"]=='0 - 2 Years old'){?> selected="selected"<?php } ?> value="2 years">0 - 2 Years old</option>
                    <option <?php if($pageInfo["property_construction"]=='2 - 5 Years old'){?> selected="selected"<?php } ?> value="5 years">2 - 5 Years old</option>
                    <option <?php if($pageInfo["property_construction"]=='5 - 10 Years old'){?> selected="selected"<?php } ?> value="10 years">5 - 10 Years old</option>
                    <option <?php if($pageInfo["property_construction"]=='10 - 15 Years old'){?> selected="selected"<?php } ?> value="15 years">10 - 15 Years old</option>
                    <option <?php if($pageInfo["property_construction"]=='15 - 20'){?> selected="selected"<?php } ?> value="20 years">15 - 20 Years old</option>
                    <option <?php if($pageInfo["property_construction"]=='More than 20 Years old'){?> selected="selected"<?php } ?>value="21 years">More than 20 Years old</option>
                  </select>
                </dd>
              </dl>
			  
			  <dl>
                <dt>
                  <label for="cms_name">Furnished :</label>
                </dt>
                <dd>
                  <select name="property_furnishing" class="select" required>
                    <option <?php if($pageInfo["property_furnishing"]=='Resale Property'){?> selcted="selcted"<?php } ?>value="">-- Select furnishing --</option>
                    <option <?php if($pageInfo["property_furnishing"]=='Unfurnished'){?> selcted="selcted"<?php } ?>value="Unfurnished">Unfurnished</option>
                    <option <?php if($pageInfo["property_furnishing"]=='Semi-furnished'){?> selcted="selcted"<?php } ?> value="Semi-Furnished">Semi-furnished</option>
                    <option <?php if($pageInfo["property_furnishing"]=='Furnished'){?> selcted="selcted"<?php } ?> value="Furnished">Furnished</option>
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
                    <option <?php if($pageInfo["property_directional_facing"]=='$key'){?> selcted="selcted"<?php } ?> value="<?php echo $key; ?>"><?php echo $value;?></option>
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
                    <option <?php if($pageInfo["property_ownership_type"]=='$key'){?> checked="checked"<?php } ?>value="<?php echo $key; ?>"><?php echo $value;?></option>
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
                      <td width="42%"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities"  <?php if($pageInfo["property_amenties"]=='1'){?> checked="checked"<?php } ?> value="1" type="checkbox" />
                      Power Backup</td>
                      <td class="paddingleft10" width="20%"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities"  <?php if($pageInfo["property_amenties"]=='2'){?> checked="checked"<?php } ?> value="2" type="checkbox" />
                      Lift</td>
                      <td width="38%" class="paddingleft10" ><input title="amenities" name="amenities[]" class="textcontrol" id="amenities"  <?php if($pageInfo["property_amenties"]=='3'){?> checked="checked"<?php } ?> value="3" type="checkbox" />
                      Club</td>
                      
                    </tr>
                    <tr>
                      <td colspan="4" class="lineheight" height="10">&nbsp;</td>
                    </tr>
                    <tr class="columnhead" style="font-size:12px;">
                      <td width="42%"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities"  <?php if($pageInfo["property_amenties"]=='5'){?> checked="checked"<?php } ?> value="5" type="checkbox" />
                      Swimming Pool</td>
                      <td class="paddingleft10" width="20%"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities"  <?php if($pageInfo["6"]=='New Property'){?> checked="checked"<?php } ?> value="6" type="checkbox" />
                      Security</td>
                      <td class="paddingleft10"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities"     <?php if($pageInfo["property_amenties"]=='7'){?> checked="checked"<?php } ?> value="7" type="checkbox" />
                        Reserved Parking</td>
                      
                    </tr>
                    <tr>
                      <td colspan="4" class="lineheight" height="10">&nbsp;</td>
                    </tr>
                    <tr class="columnhead" style="font-size:12px;">
                      <td><input title="amenities" name="amenities[]" class="textcontrol" id="amenities"  <?php if($pageInfo["property_amenties"]=='9'){?> checked="checked"<?php } ?> value="9" type="checkbox" />
                        Servant Quarters</td>
                      <td class="paddingleft10"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities"  <?php if($pageInfo["property_amenties"]=='10'){?> checked="checked"<?php } ?> value="10" type="checkbox" />
                        Park</td>
                      <td class="paddingleft10"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities"  <?php if($pageInfo["property_amenties"]=='11'){?> checked="checked"<?php } ?> value="11" type="checkbox" />
                        Vaastu Compliant </td>
                    </tr>
					  <tr>
                      <td colspan="4" class="lineheight" height="10">&nbsp;</td>
                    </tr>
					<tr class="columnhead" style="font-size:12px;">
					<td class="paddingleft10" width="42%"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities"  <?php if($pageInfo["property_amenties"]=='4'){?> checked="checked"<?php } ?> value="4" type="checkbox" />
					Rain Water Harvesting </td>
					<td class="paddingleft10"><input title="amenities" name="amenities[]" class="textcontrol" id="amenities"  <?php if($pageInfo["property_amenties"]=='8'){?> checked="checked"<?php } ?> value="8" type="checkbox" />
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
                            <option <?php if($pageInfo["property_landmarks"]=='0.5 Kms'){?> selected="selected"<?php } ?> value="0.5 Kms">0.5 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='1 Km'){?> selected="selected"<?php } ?> value="1 Km">1 Km</option>
                            <option <?php if($pageInfo["property_landmarks"]=='2 Kms'){?> selected="selected"<?php } ?> value="2 Kms">2 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='3 Kms'){?> selected="selected"<?php } ?> value="3 Kms">3 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='4 Kms'){?> selected="selected"<?php } ?> value="4 Kms">4 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='5 Kms'){?> selected="selected"<?php } ?> value="5 Kms">5 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='6 Kms'){?> selected="selected"<?php } ?> value="6 Kms">6 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='7 Kms'){?> selected="selected"<?php } ?> value="7 Kms">7 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='8 Kms'){?> selected="selected"<?php } ?> value="8 Kms">8 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='9 Kms'){?> selected="selected"<?php } ?> value="9 Kms">9 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='10 Kms'){?> selected="selected"<?php } ?> value="10 Kms">10 Kms</option>
                      </select></td>
                      <td width="20%"><strong>School</strong>
                          <select id="school" name="school" class="select2" title="landmarks">
                            <option value="" selected="selected">Select</option>
                            <option <?php if($pageInfo["property_landmarks"]=='0.5 Kms'){?> selected="selected"<?php } ?>value="0.5 Kms">0.5 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='1 Kms'){?> selected="selected"<?php } ?>value="1 Km">1 Km</option>
                            <option <?php if($pageInfo["property_landmarks"]=='2 Kms'){?> selected="selected"<?php } ?>value="2 Kms">2 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='3 Kms'){?> selected="selected"<?php } ?>value="3 Kms">3 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='4 Kms'){?> selected="selected"<?php } ?>value="4 Kms">4 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='5 Kms'){?> selected="selected"<?php } ?>value="5 Kms">5 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='6 Kms'){?> selected="selected"<?php } ?>value="6 Kms">6 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='7 Kms'){?> selected="selected"<?php } ?>value="7 Kms">7 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='8 Kms'){?> selected="selected"<?php } ?>value="8 Kms">8 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='9 Kms'){?> selected="selected"<?php } ?>value="9 Kms">9 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='10 Kms'){?> selected="selected"<?php } ?>value="10 Kms">10 Kms</option>
                      </select></td></tr>
					  <tr class="columnhead" style="font-size:12px;">
                      <td width="22%"><strong>Hospital</strong>
                          <select id="hospital" name="hospital"  class="select2" title="landmarks">
                            <option value="" selected="selected">Select</option>
                            <option <?php if($pageInfo["property_landmarks"]=='0.5 Kms'){?> checked="checked"<?php } ?>value="0.5 Kms">0.5 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='1 Kms'){?> selected="selected"<?php } ?>value="1 Km">1 Km</option>
                            <option <?php if($pageInfo["property_landmarks"]=='2 Kms'){?> selected="selected"<?php } ?>value="2 Kms">2 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='3 Kms'){?> selected="selected"<?php } ?>value="3 Kms">3 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='4 Kms'){?> selected="selected"<?php } ?>value="4 Kms">4 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='5 Kms'){?> selected="selected"<?php } ?>value="5 Kms">5 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='6 Kms'){?> selected="selected"<?php } ?>value="6 Kms">6 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='7 Kms'){?> selected="selected"<?php } ?>value="7 Kms">7 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='8 Kms'){?> selected="selected"<?php } ?>value="8 Kms">8 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='9 Kms'){?> selected="selected"<?php } ?>value="9 Kms">9 Kms</option>
                            <option <?php if($pageInfo["property_landmarks"]=='10 Kms'){?> selected="selected"<?php } ?>value="10 Kms">10 Kms</option>
                      </select></td>
                      <td width="4%"><p><strong>ATM</strong>
                        <select id="atm" name="atm"   class="select2" title="landmarks">
                          <option value="" selected="selected">Select</option>
                          <option <?php if($pageInfo["property_landmarks"]=='0.5 Kms'){?> selected="selected"<?php } ?>value="0.5 Kms">0.5 Kms</option>
                          <option <?php if($pageInfo["property_landmarks"]=='1 Kms'){?> selected="selected"<?php } ?>value="1 Km">1 Km</option>
                          <option <?php if($pageInfo["property_landmarks"]=='2 Kms'){?> selected="selected"<?php } ?>value="2 Kms">2 Kms</option>
                          <option <?php if($pageInfo["property_landmarks"]=='3 Kms'){?> selected="selected"<?php } ?>value="3 Kms">3 Kms</option>
                          <option <?php if($pageInfo["property_landmarks"]=='4 Kms'){?> selected="selected"<?php } ?>value="4 Kms">4 Kms</option>
                          <option <?php if($pageInfo["property_landmarks"]=='5 Kms'){?> selected="selected"<?php } ?>value="5 Kms">5 Kms</option>
                          <option <?php if($pageInfo["property_landmarks"]=='6 Kms'){?> selected="selected"<?php } ?>value="6 Kms">6 Kms</option>
                          <option <?php if($pageInfo["property_landmarks"]=='7 Kms'){?> selected="selected"<?php } ?>value="7 Kms">7 Kms</option>
                          <option <?php if($pageInfo["property_landmarks"]=='8 Kms'){?> selected="selected"<?php } ?>value="8 Kms">8 Kms</option>
                          <option <?php if($pageInfo["property_landmarks"]=='9 Kms'){?> selected="selected"<?php } ?>value="9 Kms">9 Kms</option>
                          <option <?php if($pageInfo["property_landmarks"]=='10 Kms'){?> selected="selected"<?php } ?>value="10 Kms">10 Kms</option>
                        </select>
                        </p>
                      </td>
                    </tr>
                  </table>
                </dd>
              </dl>
			  <dl>
			
                <dt>
                  <label for="cms_name">Upload property image<span> (Min. dimension 350 x 350) </span></label></dt>
                <dd>
			
<?php if($numImage<10){?>

 <input  type="file" name="property_images[]" class="input" style="float:left; margin-top:15px;" size="35" /> <div><img src="images/property.jpg" alt="" /></div> <a href="javascript:void(0)" onClick="addRow('TableMaina','rowe1')" style="text-decoration:none;"><strong>+ Add More</strong></a> <br />
<label>  &nbsp;</label>&nbsp;<table width="42%" border="0" style="" cellspacing="0" cellpadding="0" id="TableMaina">
    <!--Headers-->
  
    <tr id="rowe1">
    </tr>
    </table>
	<?php }else{ ?>
<label>  &nbsp;</label><div class="">You upload maximum property images </div>	
	<?php } ?>
	


				  
</dd>
              </dl>
			  <dl>
			
                <dt>
                  <label for="cms_name">Upload property video</label></dt>
                <dd>
		<?php if($numImage<10){?>	
<input  type="file" name="property_video[]" style="float:left; margin-top:15px;" class="input" size="35" /> <div><br /><a href="javascript:void(0)" onClick="addRowa('TableMain','rowe')" style="text-decoration:none;"><strong>+ Add More</strong></a></div> 
 <br />
<label>  &nbsp;</label>&nbsp;<table width="42%" border="0" style="" cellspacing="0" cellpadding="0" id="TableMain">
    <!--Headers-->
  
    <tr id="rowe">
    </tr>
    </table>
	<?php }else{ ?>
<label>  &nbsp;</label><div class="">You upload maximum property video </div>	
	<?php } ?>

				  
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
