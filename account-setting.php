<?php 
$seoId=2;

include('includes/application.php');
require("includes/user_application.php");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?>
<title>
<?php echo $userInfo["user_first_name"]."'s ".$rsultSe["seo_title"];?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/tabcontent.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>

<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/custom.js" type="text/javascript"></script>
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

function getAtribute(countryId) {		
		var strURL="getProperty.php?cid="+countryId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('pro').innerHTML=req.responseText;						
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
</head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">
<div id="register">
<h2>Account setting</h2>

<div id="flowertabs" class="modernbricksmenu2">
				 <ul>
				 <li><a class="selected" href="#" rel="tcontent1">My Profile</a></li>
				 <li><a class="" href="#" rel="tcontent2">Upload Photo</span></a></li>
				 <li><a class="" href="#" rel="tcontent3">Change password</span></a></li>
		</ul>

<div class="clear"></div>
    </div>

<div id="tcontent1" style="display:;">
<form action="files/application_file.php?action=update-profile" method="post" name="change_profile" id="change_profile" >
<label>Username <span> </span>:</label> <input type="text" disabled="disabled" value="<?php echo $userInfo['user_name']?>" class="input" /><br />


<label>Contact Name <span>(Required)</span> : </label> <input type="text" name="name" value="<?php echo $userInfo['user_first_name']?>" class="input" /> 
<br />
<label>Telephone Number : </label> <?php  $userType=explode(",",$userInfo["user_type"]);?><input type="hidden" value="update account" name="_method" class="input" /><input type="text" name="user_number" value="<?php echo $userInfo['user_mobile_number']?>" class="input" /><br />
<label>I am a : </label> <div class="profile">  <!-- <input type="checkbox" value="Yes" <?php //if($userInfo["user_type_buyer"]=='Yes'){?> checked="checked" <?php ///} ?> name="Buyer" />  Buyer <input type="checkbox" value="Seller" <?php //if($userType[1]=='Seller'){?> checked="checked" <?php // } ?> name="Seller" />   Seller -->   <input type="checkbox"  <?php if($userInfo["user_type_agent"]=='Yes'){?> checked="checked" <?php } ?> value="Yes" name="Agent" />   Agent   <!--<input type="checkbox"  value="Yes"  <?php // if($userInfo["user_type_owner"]=='Yes'){?> checked="checked" <?php // } ?>  name="Owner" />   Owner --> </div> 
<div class="clear">&nbsp;</div>
<label>&nbsp;</label> <input type="checkbox" name="public" <?php if($userInfo["contact_to_public"]=='Yes'){?> checked="checked" <?php } ?> value="Yes" /> Show contact name in Public profile? 
<div class="clear"></div> 
<label>Telephone Number : </label> <input type="text" name="user_company" value="<?php echo $userInfo['user_company']?>" class="input" /><br />  
<label>County :</label> <select class="select" name="state_id" required onchange="getcity(this.value)">
<option value="">Select Counties</option>
<?php

$strStates=dbQuery("select * from  states where country_id='222' order by state_name") ;
while($rsState=dbFetchArray($strStates)){
?>
 
<option value="<?php echo $rsState["state_id"]?>" <?php if($userInfo['state_id']==$rsState["state_id"]){ ?> selected="selected"<?php } ?> ><?php echo $rsState["state_name"]?></option>
<?php } ?> </select><br />
<label>Locality :</label> <div id="city"><select name="city_id" required class="select" >
<option value="">Select Counties First</option>
<?php

$strCity=dbQuery("select * from  cities where state_id='".$userInfo['state_id']."' order by name") ;
while($rsCity=dbFetchArray($strCity)){
?>
 
<option value="<?php echo $rsCity["ID"]?>" <?php if($userInfo['city_id']==$rsCity["ID"]){ ?> selected="selected"<?php } ?> ><?php echo $rsCity["name"]?></option>
<?php } ?>
</select></div>
<div class="clear"></div>
<label>Address  : </label> <textarea class="textarea" name="user_address"><?php echo $userInfo['user_address']?></textarea>

<div class="clear"></div>
<label>About Me : </label> <textarea class="textarea" name="about_me"><?php echo $userInfo['about_me']?></textarea>
<div class="user">Tell the HomeGuru community about yourself</div>
<label>&nbsp;</label> <input type="submit" name="" class="submit" value="Update profile" />

</form><div class="clear" style="height:110px">&nbsp;</div>
</div>

<div id="tcontent2" style="display:none;">
<form action="files/application_file.php?action=upload_pic" method="post" enctype="multipart/form-data" id="upload_pic" name="upload_pic" style="margin-left:100px;">
<?php if($userInfo['user_image']!=''){?>
<img src="images/user_images/<?php echo $userInfo['user_image']?>" alt="" width="120" height="120" />
<?php }else {?>
<img src="images/thums.jpg" alt="" width="120" height="120" />
<?php } ?>
<div class="clear">&nbsp;</div>
<input type="file" name="upload_file"  />
<input type="hidden" value="update picture" name="_method" class="input" />
<div class="clear"></div>
<input type="submit" name="" class="submit" value="Upload Photo" />

</form>
<div class="clear" style="height:110px">&nbsp;</div>
</div>

<div id="tcontent3" style="display:none;">
<form action="files/application_file.php?action=change-password" method="post" name="change_pwd" autocomplete="off" id="change_pwd">
<label>Current Password :</label> <input type="password" value="Sandeep" name="old_pwd" autocomplete="off" class="input" /><input type="hidden" value="password request" name="_method" class="input" /><br />

<label>New password : </label> <input type="password" value="Sandeep" name="new_pwd" autocomplete="off" id="new_pwd" class="input" /> 
<div class="user">Password must be at least 5 characters</div>

<label>Confirm new password : </label> <input type="password"  value=""  name="re_new_pwd" class="input" /><br />
<label>&nbsp;</label> <input type="submit" name="" class="submit" value="Change Password" />

</form>
<div class="clear" style="height:110px">&nbsp;</div>
</div>



<script type="text/javascript">

var myflowers=new ddtabcontent("flowertabs")
myflowers.setpersist(true)
myflowers.setselectedClassTarget("link") //"link" or "linkparent"
myflowers.init()
</script>

</div>
</div>
<!--Middle End-->

<!--Fotter Start-->
<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
