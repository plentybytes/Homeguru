<?php 
$seoId=11;

include('includes/application.php');
require("includes/user_application.php");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?>


<title> <?php echo $userInfo["user_first_name"]."'s ".$rsultSe["seo_title"];?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="js/tabcontent.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>

<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/custom.js" type="text/javascript"></script>
</head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">
<div id="register">
<div id="view-property">
<h2>My Account </h2>





<label>Username :</label> <div class="view-content"><?php echo $userInfo['user_email']?></div>
 <div class="clear"></div>  

<label>Contact Name  : </label><div class="view-content"> <?php echo $userInfo['user_first_name']?> 
</div>
 <div class="clear"></div>  
<label>Telephone Number : </label>	<div class="view-content"><?php echo $userInfo['user_mobile_number']?> </div>
 <div class="clear"></div>  
<!--<label>I am a : </label> <div class="view-content">  <?php if($userInfo["user_type_agent"]=='Yes'){echo "Agent";}?> </div>-->
<div class="clear"></div>  
<label>Company : </label> <div class="view-content">  <?php if($userInfo["user_company"]!=''){echo$userInfo["user_company"];}else{ echo "none";}?> </div>
 <div class="clear"></div>   

<label>Show contact name in Public profile? </label>	<div class="view-content"> <?php echo $userInfo["contact_to_public"]?> </div>
<div class="clear"></div>
<label>About Me : </label> <div class="view-content"><?php echo $userInfo['about_me']?></div>
 <div class="clear"></div>  

<label>Profile Photo</label> <div class="view-content">
<?php if($userInfo['user_image']!=''){?>
<img src="images/user_images/<?php echo $userInfo['user_image']?>" alt="" width="120" height="120" />
<?php }else {?>
<img src="images/thums.jpg" alt="" width="120" height="120" />
<?php } ?>
</div>
 <div class="clear"></div>  

</div>








</div>
</div>
</div>
<!--Middle End-->

<!--Fotter Start-->
<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
