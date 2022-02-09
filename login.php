<?php include('includes/application.php');
$seoId=6;

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

<script src="js/tabcontent.js" type="text/javascript"></script>


</head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">
<form action="files/application_file.php?action=login" method="post" id="login_attamt" name="login_attamt">
<div id="register">


<label>Email Address/ Username: </label> <input type="email" name="user_name" id="user_name" value="" class="input" />
<input type="hidden" name="_method" id="_method" value="authentication process" class="input" /><br />

<label>Password: </label> <input type="password" name="login_password" id="login_password" value="" class="input" /><br />

<div class="clear"></div>
<label>&nbsp;</label> <input type="submit" name="" class="submit" value="Login" />
<div class="clear">&nbsp;</div>
<div class="clear" style="float:; padding:5px 0 10px 450px"><a href="forgot-password.php" style="text-decoration:none;"><strong>Forgot Password</strong></a></div>
<div class="clear" style="height:110px">&nbsp;</div>
</div></form>
</div>
<!--Middle End-->

<!--Fotter Start-->
<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
