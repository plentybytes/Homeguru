<?php
 $seoId=17;
include('includes/application.php');
if(isSessionRegistered('user')){
redirect(hrefLink("index.php"));
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?>
<?php echo $seoTitle;?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>

<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/custom.js" type="text/javascript"></script>
<script type="text/javascript" src="js/animatedcollapse.js"></script>
<script src="js/tabcontent.js" type="text/javascript"></script>
<script type="text/javascript">

animatedcollapse.addDiv('jason', 'fade=1,height=80px')
animatedcollapse.addDiv('kelly', 'fade=1,height=100px')
animatedcollapse.addDiv('michael', 'fade=1,height=120px')

animatedcollapse.addDiv('cat', 'fade=0,speed=400,group=pets')
animatedcollapse.addDiv('dog', 'fade=0,speed=400,group=pets,persist=1,hide=1')
animatedcollapse.addDiv('rabbit', 'fade=0,speed=400,group=pets,hide=1')

animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
	//$: Access to jQuery
	//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
	//state: "block" or "none", depending on state
}

animatedcollapse.init()

</script>
<script type="text/javascript">
function checkUsername(str)
{
if(str.length > 5 && str.length <=20)
	{
var xmlhttp;
if (str.length==0)
  { 
  document.getElementById("username").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("username").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","find_username.php?checkid="+str,true);
xmlhttp.send();
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
<form action="files/application_file.php?action=register" method="post" enctype="multipart/form-data" id="register" name="register">
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
<label>Company Name: </label> <input type="text"  name="comp_name" maxlength="20" value="" class="input" /><br />
<label>Upload Logo: </label>   <input type="file" size="39"  name="logo" id="logo"/><br />
<label style="margin-left:-245px;"><input type="checkbox" name="check" value="Yes" /></label> <span class="check">I do not wish to receive information from HomesGuru or selected partners. </span>
<div class="clear"></div>
<label>&nbsp;</label> <input type="submit" name="" class="submit" value="Register" />
<div class="clear"></div>
<span> By registering you accept our <a href="terms.php">Terms of Use</a> and <a href="privacy-terms.php">Privacy</a> and agree that we and our selected partners may contact you with relevant offers and services. You may unsubscribe or update your preferences at any time in <a href="<?php echo APP_DIR;?>">MyHomesGuru</a>. </span>


</div></form>
</div>
<!--Middle End-->

<!--Fotter Start-->
<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
