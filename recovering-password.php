<?php
$seoId=15;
	require("includes/application.php");
	if($_GET["passkey"]){
	$id=$_GET["id"];
	$userPasswordQuery=dbQuery("SELECT * from  user WHERE user_email ='".base64_decode($id)."' AND verified_code ='".$_GET["passkey"]."' AND user_status ='Active'");
						if(dbNumRows($userPasswordQuery)==0){
						$messageStack->addMessageSession("Your recovering code or id not matched try again !!!.", "error");
					redirect(hrefLink("forgot-password.php"));
					}
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

</head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">
<form action="files/application_file.php?action=recover-password" name="recoverPwd" id="recoverPwd" method="post" style="padding:0px;">
<div id="register">

<div class="clear">&nbsp;</div>
<div class="clear">&nbsp;</div>
<label>New password: </label>  <input name="new_password" id="new_password"  value="" class="input" type="password">
<br />

<label>Re-enter password:  </label> <input name="id" id="id"  value="<?=$_GET["id"]?>" type="hidden">
									<input name="passkey" id="passkey"  value="<?=$_GET["passkey"]?>" type="hidden">
                            <input name="re_password" id="re_password"  value="" class="input" type="password"><input type="hidden"  name="_method"  value="recovering process" /><br />

<div class="clear"></div>
<label>&nbsp;</label> <input type="submit" name="" class="submit" value="Recover" />
<div class="clear" style="height:110px">&nbsp;</div>


</div></form>
</div>
<!--Middle End-->

<!--Fotter Start-->
<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
