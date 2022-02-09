<div id="header">
<div class="main">
<div id="logo"><a href="index.php"><img src="images/homesguru.jpg" alt="" border="0" /></a></div>

<div id="right">
<?php if(!isSessionRegistered('user')){ ?>
<!--<script src="facefiles/jquery-1.2.2.pack.js" type="text/javascript"></script>-->
<link href="facefiles/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="facefiles/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox() 
    })
</script>
<script type="text/javascript">
function showlogin()
{	jQuery.noConflict();
	jQuery('#login-box').toggle('slow');
}
function is_valid_email(email)
{
var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
return email.match(reg);
}
$(function() {
        $( document ).tooltip();

    });
</script>

<div id="login-box" class="window">


 <form id="login" name="login" action="files/application_file.php?action=login" method="post" onsubmit="return submitForm()">
 <p>Enter Your Email</p>
<div class="input"><input type="email" required placeholder="Enter Your Email ID" name="user_name" id="user_name" value="" />
<input type="hidden" name="_method" id="_method" value="authentication process"  /></div>
<p>Enter Your Password</p>
<div class="input"><input type="password" required placeholder="********" name="login_password" id="login_password" value="" /></div>
  
 <input type="submit" name="login" class="go"  value="Login">
<strong><a href="forgot-password.php">Forgot password?</a></strong>

 </form>
</div>

<div class="rigster"><a href="#mydivga1" rel="facebox">Register</a></div>
<div class="login"><a id="loginimg" onclick="showlogin()" href="#">Sign in</a></div>
<div id="mydivga1" style="display: none;" >
<form action="files/application_file.php?action=register" method="post" id="register" name="register">
<div id="register">

<label>Name:</label> <input type="text" name="name" value="" class="input" /><br />
<label>Email Address: </label> <input type="email" name="user_email" id="user_email" value="" class="input" />
<input type="hidden" name="_method" id="_method" value="access request" class="input" /><br />
<label>Confirm email: </label> <input type="text" name="re_user_email" value="" class="input" /><br />
<label>Username: </label> <input type="text"  name="user_name" maxlength="20"  onkeyup="checkUsername(this.value);" value="" class="input" />  <span id="username"  align="right"></span><br />
<label>Password: </label> <input type="password" name="user_password" id="user_password" value="" class="input" /><br />
<label>Confirm password: </label> <input type="password" name="re_password" value="" class="input" /><br />
<label>How did you hear about us <span>(Optional)</span>: </label> <select name="hear_about" class="select">
<option value="">Select...</option>
       <?php 
	   $hear=showHearAboutUs();
	   foreach($hear as $key => $value)
	  { 
	   ?>
	   <option value="<?php echo $key;?>"><?php echo $value;?></option>
	   <?php } ?>
		</select><br />
<label><input type="checkbox" name="check" value="Yes" /></label> <span class="check">I do not wish to receive information from HomesGuru or selected partners. </span>
<div class="clear"></div>
<label>&nbsp;</label> <input type="submit" name="" class="submit" value="Register" />
<div class="clear"></div>
<span> By registering you accept our <a href="#">Terms of Use</a> and <a href="#">Privacy</a> and agree that we and our selected partners may contact you with relevant offers and services. You may unsubscribe or update your preferences at any time in <a href="#">MyHomesGuru</a>. </span>

</div>
</form>
</div>
<?php }else{ ?> 
<div class="rigster"><a href="logout.php">Logout</a></div>
<div class="login">
<ul id="menu-drop2">
<li><a href="#">Option</a></a>
<ul>
<li><a href="my-account.php">My Profile</a></li>
<li><a href="account-setting.php">Account Setting </a></li>
<li><a href="property_step_one.php">Add New Property</a></li>
<li><a href="property_list.php">My Property Listing</a></li>
</ul></li>
</ul>
</div>
<?php } ?> 
<div class="clear"></div>

<ul id="menu-drop">
<li><a href="#"><span>For Sale</span></a>
<ul>
<li><a href="#">UK property for sale</a></li>
<li><a href="#">UK new homes for sale</a></li>
<li><a href="#"> UK estate agents</a></li>
<li><a href="#">Homes Valuation</a></li>
</ul>
</li>

<li><a href="#"><span>To Rent</span></a>
<ul>
<li><a href="#">UK Property to Rent</a></li>
<li><a href="#">UK Letting Agents</a></li>
<li><a href="#">Holiday Rentals</a></li>
<li><a href="#">Flatshare</a></li>
</ul>
</li>

<li><a href="#"><span>Current Values</span></a>
<ul>
<li><a href="#">UK Property Values</a></li>
<li><a href="#">Agent Appraisal</a></li>
</ul>
</li>

<li><a href="#"><span>Sold Prices</span></a>
<ul>
<li><a href="#">UK House Prices</a></li>
<li><a href="#">UK Area Stats</a></li>
</ul>
</li>

<li><a href="#"><span>New Homes</span></a>
<ul>
<li><a href="#">UK Estate Agents</a></li>
<li><a href="#">UK Letting Agents</a></li>
<li><a href="#">Agent Appraisal</a></li>
<li><a href="#">Award Winning Agents</a></li>
</ul>
</li>

<li class="none"><a href="#"><span>Find Agents</span></a>
<ul>
<li><a href="#">UK property for sale</a></li>
<li><a href="#">UK new homes for sale</a></li>
<li><a href="#"> UK estate agents</a></li>
</ul>
</li>

</ul>

</div>

</div>
</div>
<?php
			if($messageStack->size > 0){
				echo "<div class=\"message\" align=\"center\" >\n";
				echo "  ".$messageStack->outputMessage();
				echo "</div>\n";
			}
			?>