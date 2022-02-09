
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
					<form id="formCMS" action="<?php echo hrefLink(APP_ADMIN_DIR."application_file.php", getAllGetParams(array("action"))."action=property_step_one");?>" method="post" enctype="multipart/form-data">
					
            <fieldset>
							<dl>
                <dt>
                  <label for="cms_name">Property Type :</label>
                </dt>
                <dd>
                  <select class="" name="property_category_id" >
                    <?php

$strParentProperty=dbQuery("select * from property_category where property_category_parent_id=0") ;
while($rsPro=dbFetchArray($strParentProperty)){
?>
                    <optgroup label="<?php echo $rsPro["property_category_name"]?>" style="background-color:#ccff6a;"></optgroup>
                    <?php

$strProperty=dbQuery("select * from property_category where property_category_parent_id='".$rsPro['property_category_id']."'") ;
while($rsProperty=dbFetchArray($strProperty)){
?>
                    <option value="<?php echo $rsProperty["property_category_id"]?>"><?php echo $rsProperty["property_category_name"]?></option>
                    <?php } } ?>
                  </select>
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">Transaction Type  :</label>
                </dt>
                <dd><span class="profile">
                  <input type="radio" name="property_transaction_type" checked="checked"  value="sell"/>Sell <input type="radio"  value="rent" name="property_transaction_type" /> Rent <input type="radio" name="property_transaction_type" value="home" />Home <input type="hidden" name="_method"  value="Add Property"/>
                </span></dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">New/Resale Property : </label></dt>
                <dd><span class="profile">
                  <input checked="checked" type="radio" name="property_type" value="New" />
New Property
<input type="radio" name="property_type" value="Resale" />
Resale Property </span></dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">County :</label>
                </dt>
                <dd>
                  <select  name="state_id" required onchange="getcity(this.value)">
                    <option value="">Select Counties</option>
                    <?php

$strStates=dbQuery("select * from  states where country_id=222 order by state_name") ;
while($rsState=dbFetchArray($strStates)){
?>
                    <option value="<?php echo $rsState["state_id"]?>"><?php echo $rsState["state_name"]?></option>
                    <?php } ?>
                  </select>
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">Locality :</label>
                </dt>
                <dd id="city">
                  <select name="city_id"  required >
                    <option value="">Select Counties First</option>
                  </select>
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">Listing Price :</label></dt>
                <dd>
                  <input type="text" name="property_total_price" class="input"  required/>
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
                  <select   required name="property_bedrooms">
                    <option value="">-- Number of Bedroom --</option>
                    <?php for($i=1;$i<11;$i++){ ?>
                    <option value="<?php echo $i?>"><?php echo $i?></option>
                    <?php } ?>
                    <option value="11">10+</option>
                  </select>
                </dd>
              </dl>
			  
				<dl>
                <dt>
                  <label for="is_active">Bathrooms</label>
                </dt>
                <dd>
                  <select name="property_bathrooms"  required>
                    <option value="">-- Number of Bathrooms --</option>
                    <?php for($j=1;$j<11;$j++){ ?>
                    <option value="<?php echo $j?>"><?php echo $j?></option>
                    <?php } ?>
                    <option value="11">10+</option>
                  </select>
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">Floor Number</label></dt>
                <dd>
                  <select   required name="property_floor_number">
                    <option value=""  selected="selected" required>-- Floor Number --</option>
                    <option value="Under Construction">Under Construction</option>
                    <option value="Basement">Basement</option>
                    <option value="Ground Floor">Ground Floor</option>
                    <option value="Mezzanine Floor">Mezzanine Floor</option>
                    <?php for($i=1;$i<41;$i++){ ?>
                    <option value="<?php echo $i?>"><?php echo $i?></option>
                    <?php } ?>
                    <option value="41">More than 40</option>
                  </select>
                </dd>
              </dl>
			  <dl>
                <dt>
                  <label for="cms_name">Property Description <span>(Min 200 chars)</span></label></dt>
                <dd>
                  <textarea name="property_description" class="ckeditor" id="editor6" required></textarea>
</dd>
              </dl>
              <dl class="submit">
                <input type="submit" name="submit" id="submit" value="Add" />
								<input type="button" name="cancel" id="cancel" value="Cancel" onclick="goBack('<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","type=manage");?>');" />
              </dl>
			  
			  
            </fieldset>
          </form>
        </div>
