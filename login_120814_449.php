
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' /><meta name='description' content='Search Item show'>
<meta name='keywords' content='' /><title>Search-property</title><link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery.min.js" type="text/javascript"></script>
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
	


function getSave(reqId,showid) {		
		var strURL="submitFav.php?reqId="+reqId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById(showid).innerHTML=req.responseText;	
						
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
<div id="header">
<div class="main">
<div id="logo"><a href="index.php"><img src="images/homesguru.jpg" alt="" border="0" /></a></div>

<div id="right">
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
<!--Header End-->

<!--Middle Start-->
<div id="middle">


  <div id="left-panel">
    <h1>Property by search  <strong></strong> </h1>

<div id="sale">
<div class="view">
<ul>
<li><a class="select" href="#"><span>Login</span></a></li>
<li><a href="#map-view.php?source="><span>Register</span></a></li>
</ul>
<div class="clear"></div>
</div>
<div class="clear">&nbsp;</div>

<div class="login_part">
<form action="" method="get">
<div class="login_fild">
<label>Email address</label>
<input name="" type="text" />
</div>

<div class="login_fild">
<label>Password</label>
<input name="" type="password" />
</div>

<div class="login_butt_frt">
<a href="#" class="ForgottenPassword">Forgotten password?</a> 

<input name="" type="submit" value="Login" />
</div>

<div class="Remember_tex">
<input name="" type="checkbox" value="" /> <span>Remember me on this computer </span></div>
</form>

</div>

</div>


	
</div>
  

  <div class="clear"></div>
</div><!--Middle End-->

<!--Fotter Start-->
<div id="fotter">
<div class="main">
<div class="around">
<h3>Around the site</h3>
<p><p>
	Search for UK estate agents Search for property for sale House prices near you Search for property to rent Get removal quotes. Search for proper <a href="content.php?source=12" title="More">[More]</a></p>
</div>

<div class="property">
<h3>Property guides</h3>
<p><p>
	Buying guide<br />
	First-time buyers&#39; guide<br />
	Selling guide<br />
	Renting guide<br />
	Guide to letting property</p>
 <a href="content.php?source=10" title="More">[More]</a></p>
</div>


<div class="house">
<h3>House Price Index.</h3>
<p><p>
	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever sinc <a href="content.php?source=11" title="More">[More]</a></p>
</div>


<div class="connect">
<h3>Connect us</h3>
<p><a href="#"><img src="images/facebook.jpg" alt="" /> Like us on Facebook</a></p>
<p><a href="#"><img src="images/twitter.jpg" alt="" /> Follow us on Twitter</a></p>
<p><a href="#"><img src="images/you-tube.jpg" alt="" /> Find us on YouTube</a></p>
<p><a href="#"><img src="images/google.jpg" alt="" /> Follow us on Google</a></p>
</div>

<div class="copy">
Copyright &copy; 2013 homesguru.co.uk  All Rights Reserved  <!--Design and Development by: <a href="http://galaxywebtechnology.com" target="_blank">Galaxywebtechnology.com</a>-->
</div>

<div class="clear"></div>
</div>
</div><!--Fotter End-->

</body>
</html>

