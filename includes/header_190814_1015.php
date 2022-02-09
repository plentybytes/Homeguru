<div id="header">
<div class="main">
<div id="logo"><a href="index.php"><img src="images/homesguru.jpg" alt="" border="0" /></a></div>

<div id="right">
<?php if(!isSessionRegistered('user')){ ?>
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

<div class="rigster"><a href="register.php">Register</a></div>
<div class="login"><a id="loginimg" onclick="showlogin()" href="#">Sign in</a></div>
<?php }else{ ?> 
<div class="rigster"><a href="logout.php">Logout</a></div>
<div class="login">
<ul id="menu-drop2">
<li><a href="#">Account</a></a>
<ul>
<li><a href="my-account.php">My Profile</a></li>
<li><a href="account-setting.php">Account Setting </a></li>
<li><a href="property_step_one.php">Add New Property</a></li>
<li><a href="property_list.php">My Property Listing</a></li>
<li><a href="property_step_one.php">My Favourites</a></li>
<li><a href="property_list.php">My Notes</a></li>
</ul></li>
</ul>
</div>
<?php } ?> 
<div class="clear"></div>

<ul id="menu-drop">
<li ><a href="#" ><span>For Sale</span></a>
<ul>
<li><a href="property.php?shortby=sell">UK property for sale</a></li>
<li><a href="property.php?shortby=new">UK new homes for sale</a></li>
<li><a href="property-agent.php"> UK estate agents</a></li>

</ul>
</li>

<li><a href="#"><span>To Rent</span></a>
<ul>
<li><a href="property-for-rent.php">UK Property to Rent</a></li>
<li><a href="property-agent.php">UK Letting Agents</a></li>


</ul>
</li>

<li><a href="#"><span>Current Values</span></a>
<ul>
<li><a href="property-current-valuation.php">UK Property Values</a></li>

</ul>
</li>

<li><a href="#"><span>Sold Prices</span></a>
<ul>
<li><a href="property-sold-value.php">UK House Prices</a></li>

</ul>
</li>

<li><a href="#"><span>New Homes</span></a>
<ul>
<li><a href="property.php?shortby=new">UK new homes for sale</a></li>

<li><a href="newbuyhome.php">New Buy</a></li>
<li><a href="firstbuy.php">First buy </a></li>
</ul>
</li>

<li class="none"><a href="#"><span>Find Agents</span></a>
<ul>
<li><a href="property-agent.php">UK property for sale</a></li>
<li><a href="property.php?shortby=new">UK new homes for sale</a></li>
<li><a href="property-agent.php"> UK estate agents</a></li>
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