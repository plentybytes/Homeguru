<?php
	
		$cmsId=(isset($_GET["proid"]) ? $_GET["proid"] : "");	
		
		
		$pageInfo=dbFetchArray(dbQuery("SELECT * FROM property WHERE property_id='".$cmsId."'"));
		 
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
<!-- /TinyMCE -->
        <h2>Add Property</h2>
				<div class="form">
					<form id="formCMS" action="<?php echo hrefLink(APP_ADMIN_DIR."application_file.php", getAllGetParams(array("action"))."action=edit_step_one");?>" method="post" enctype="multipart/form-data">
					
            <fieldset>
							<dl>
                <dt>
                  <label for="cms_name">Property Type :</label>
                </dt>
                <dd><select class="select" name="property_category_id" >
                    <?php

$strParentProperty=dbQuery("select * from property_category where property_category_parent_id=0") ;
while($rsPro=dbFetchArray($strParentProperty)){
?>
                    <optgroup label="<?php echo $rsPro["property_category_name"]?>" style="background-color:#ccff6a;"></optgroup>
                    <?php

$strProperty=dbQuery("select * from property_category where property_category_parent_id='".$rsPro['property_category_id']."'") ;
while($rsProperty=dbFetchArray($strProperty)){
?>
                    <option <?php if($pageInfo["property_category_id"]==$rsProperty["property_category_id"]){?> selected="selected"<?php } ?> value="<?php echo $rsProperty["property_category_id"]?>"><?php echo $rsProperty["property_category_name"]?></option>
                    <?php } } ?>
                  </select>
                  
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">Transaction Type  :</label>
                </dt>
                <dd><span class="profile">
                  <input type="radio" name="property_transaction_type" <?php if($pageInfo["property_transaction_type"]=='sell'){?> checked="checked"<?php } ?>   value="sell"/>Sell <input type="radio" <?php if($pageInfo["property_transaction_type"]=='rent'){?> checked="checked"<?php } ?>   value="rent" name="property_transaction_type" /> Rent <input type="radio" <?php if($pageInfo["property_transaction_type"]=='home'){?> checked="checked"<?php } ?>  name="property_transaction_type" value="home" />Home <input type="hidden" name="_method"  value="Add Property"/><input type="hidden" name="property_id"  value="<?php echo $pageInfo['property_id'];?>"/>
                </span></dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">New/Resale Property: </label></dt>
                <dd><span class="profile">
                  <input  type="radio" name="property_type" <?php if($pageInfo["property_type"]=='New'){?> checked="checked"<?php } ?> value="New" />
New Property
<input type="radio" name="property_type" <?php if($pageInfo["property_type"]=='Resale'){?> checked="checked"<?php } ?>value="Resale" />
Resale Property </span></dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name"> Edit County :</label>
                </dt>
                <dd>
                  <select class="select" name="state_id" required onchange="getcity(this.value)">
                    <option value="">Select Counties</option>
                    <?php

$strStates=dbQuery("select * from  states where country_id=222 order by state_name") ;
while($rsState=dbFetchArray($strStates)){
?>
                    <option <?php if($pageInfo["state_id"]==$rsState["state_id"]){?> selected="selected"<?php } ?> value="<?php echo $rsState["state_id"]?>"><?php echo $rsState["state_name"]?></option>
                    <?php } ?>
                  </select>
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name"> Edit Locality :</label>
                </dt>
                <dd id="city">
                  <select name="city_id" class="select" required >
                    <option value="">Select Counties First</option>
					<?php

$cityQuery=dbQuery("SELECT * FROM cities where state_id='".$pageInfo["state_id"]."' ORDER BY name");
					while($cityInfo=dbFetchArray($cityQuery)){?>
				 <option  <?php if($pageInfo["city_id"]==$cityInfo['ID']){?> selected="selected"<?php } ?> value="<?php echo $cityInfo['ID'];?>"><?php echo $cityInfo['name'];?></option>
				 <?php } ?>
                  </select>
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">Edit Listing Price :</label></dt>
                <dd>
                  <input type="text" name="property_total_price" class="input" value="<?php echo $pageInfo['property_total_price'];?>" required/>
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
                  <label for="cms_name">Bedrooms </label>
                </dt>
                <dd>
                  <select class="select"  required name="property_bedrooms">
                    <option value="">-- Number of Bedroom --</option>
                    <?php for($i=1;$i<11;$i++){ ?>
                    <option  <?php if($pageInfo["property_bedrooms"]==$i){?> selected="selected"<?php } ?> value="<?php echo $i?>"><?php echo $i?></option>
                    <?php } ?>
                    <option <?php if($pageInfo["property_bedrooms"]=='11'){?> selected="selected"<?php } ?>value="11">10+</option>
                  </select>
                </dd>
              </dl>
			  
				<dl>
                <dt>
                  <label for="is_active">Bathrooms</label>
                </dt>
                <dd>
                  <select name="property_bathrooms" class="select" required>
                    <option value="">-- Number of Bathrooms --</option>
                    <?php for($j=1;$j<11;$j++){ ?>
                    <option <?php if($pageInfo["property_bathrooms"]==$j){?> selected="selected"<?php } ?> value="<?php echo $j?>"><?php echo $j?></option>
                    <?php } ?>
                    <option <?php if($pageInfo["property_bathrooms"]=='11'){?> selected="selected"<?php } ?> value="11">10+</option>
                  </select>
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">Floor Number</label></dt>
                <dd>
                  <select class="select"  required name="property_floor_number">
                    <option value=""  selected="selected" required>-- Floor Number --</option>
                    <option <?php if($pageInfo["property_floor_number"]=='Under Construction'){?> selected="selected"<?php } ?>value="Under Construction">Under Construction</option>
                    <option <?php if($pageInfo["property_floor_number"]=='Basemen'){?> selected="selected"<?php } ?>value="Basement">Basement</option>
                    <option <?php if($pageInfo["property_floor_number"]=='Ground Floor'){?> selected="selected"<?php } ?>value="Ground Floor">Ground Floor</option>
                    <option <?php if($pageInfo["property_floor_number"]=='Mezzanine Floor'){?> selected="selected"<?php } ?>value="Mezzanine Floor">Mezzanine Floor</option>
                    <?php for($i=1;$i<41;$i++){ ?>
                    <option <?php if($pageInfo["property_floor_number"]=='$i'){?> selected="selected"<?php } ?>value="<?php echo $i?>"><?php echo $i?></option>
                    <?php } ?>
                    <option <?php if($pageInfo["property_floor_number"]=='41'){?> selected="selected"<?php } ?>value="41">More than 40</option>
                  </select>
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">Property Description <span>(Min 200 chars)</span></label></dt>
                <dd>
                  <textarea name="property_description"   class="ckeditor" id="editor6"  required ><?php echo $pageInfo['property_description'];?></textarea>
</dd>
              </dl>
              <dl class="submit">
                <input type="submit" name="submit" id="submit" value="Add" />
								<input type="button" name="cancel" id="cancel" value="Cancel" onclick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","type=manage");?>');" />
              </dl>
			  
			  
            </fieldset>
          </form>
        </div>
