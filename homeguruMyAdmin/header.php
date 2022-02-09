<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HomeGuru Admin Panel</title>
<link rel="stylesheet" type="text/css" href="css/global.css" />
<?php
if(isSessionRegistered("admin")){
?>
<script type="text/javascript" src="scripts/clockp.js"></script>
<script type="text/javascript" src="scripts/clockh.js"></script>
<?php
}
?>
<script type="text/javascript" src="scripts/jquery.min.js"></script>
<script type="text/javascript" src="scripts/jquery.validate.min.js"></script>
<script type="text/javascript" src="scripts/ddaccordion.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>
<script type="text/javascript" src="scripts/jconfirmaction.jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$('.ask').jConfirmAction();
	});
</script>
<script language="javascript" type="text/javascript" src="scripts/niceforms.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="css/niceforms.css" />
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/_samples/sample.js" type="text/javascript"></script>
</head>
<body>
<!--begin of main container-->
<div id="main_container">
<?php
if(isSessionRegistered("admin")){
?>
<!--begin of header-->
<div class="header">
  <div class="logo"><a href="#"><img src="images/homesguru.jpg" width="299px" height="72px" alt="logo" title="logo" border="0" /></a></div>
  <div class="right_header">Welcome <?php echo $_SESSION["admin"]["firstname"]?>, <a href="<?php echo hrefLink("index.php");?>" target="_blank">Visit site</a> | <a href="<?php echo hrefLink(APP_ADMIN_DIR."login.php", "action=logoff");?>" class="logout">Logout</a></div>
  <div id="clock_a"></div>
</div>
<!--end of header-->
<!--begin of main content-->
<div class="main_content">
<!--begin of menu-->
<div class="menu">
  <ul>
    <li><a class="current" href="<?php echo hrefLink(APP_ADMIN_DIR."index.php");?>">Admin Home</a></li>
    <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."configuration.php");?>">Settings</a></li>
    <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."cms.php");?>">Manage CMS
      <!--[if IE 7]><!-->
      </a>
      <!--<![endif]-->
      <!--[if lte IE 6]><table><tr><td><![endif]-->
      <ul>
        <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."cms.php","type=manage");?>" title="CMS">CMS</a></li>
        <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."cms.php","action=add");?>" title="New Page">New CMS</a></li>
      </ul>
      <!--[if lte IE 6]></td></tr></table></a><![endif]-->
    </li>
    
    <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."contact_details.php");?>">Contact</a></li>
  </ul>
</div>
<!--end of menu-->
<!--begin of center content -->
<div class="center_content">
<?php
	if(isSessionRegistered("admin")){
?>
<!--begin of left content-->
<div class="left_content">
  <div class="sidebarmenu">
  <a class="menuitem submenuheader" href="">Manage SEO</a>
    <div align="center" class="submenu">
      <ul>
        <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_seo.php","type=manage");?>" title="Manage SEO">Manage SEO</a></li>
    
      </ul>
    </div>
    <a class="menuitem submenuheader" href="">CMS</a>
    <div align="center" class="submenu">
      <ul>
        <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."cms.php","type=manage");?>" title="CMS">Manage CMS</a></li>
        <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."cms.php","action=add");?>" title="New Page">New CMS</a></li>
      </ul>
    </div>

    <a class="menuitem submenuheader" href="">Manage Property</a>
    <div align="center" class="submenu">
      <ul>
        <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","type=manage&owner=admin");?>" title="Admin Property">Admin Property</a></li>
		 <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","type=manage&owner=user");?>" title="User Property">User Property</a></li>
		  <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","type=block");?>" title="Block Property">Block Property</a></li>
        <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_property.php","action=add");?>" title=" Add Property">Add Property </a></li>
      </ul>
    </div>
	<a class="menuitem submenuheader" href="">Manage Banner</a>
    <div align="center" class="submenu">
      <ul>
        <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_banner.php","type=manage");?>" title="Manage Banner">Manage Banner</a></li>
        <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_banner.php","action=add");?>" title=" Add Banner">Add Banner </a></li>
      </ul>
    </div>
	<a class="menuitem submenuheader" href="">Manage Buy News</a>
    <div align="center" class="submenu">
      <ul>
        <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_buy_news.php","type=manage");?>" title="Manage News">Manage News</a></li>
        <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_buy_news.php","action=add");?>" title=" Add News">Add News </a></li>
      </ul>
    </div>
	 <a class="menuitem submenuheader" href="">Manage users</a>
    <div align="center" class="submenu">
      <ul>
        <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."manage_user.php","type=manage");?>" title="Manage All users">Manage User</a></li>
		
      </ul>
    </div>
    <a class="menuitem_red menuitem submenuheader" href="<?php echo hrefLink(APP_ADMIN_DIR."configuration.php");?>">Settings</a>
    <div align="center" class="submenu">
      <ul>
        <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."account.php","type=manage");?>" title="Manage Account">Account Setting </a></li>
        <li><a href="<?php echo hrefLink(APP_ADMIN_DIR."account.php","action=pwd");?>" title="Change Password">Change Password </a></li>
      </ul>
    </div>
  </div>
</div>
<!--end of left content-->
<?php
	}
?>
<!--begin of right content-->
<div class="right_content">
<?php
			if($messageStack->size > 0){
				echo "<div class=\"message\" align=\"center\" >\n";
				echo "  ".$messageStack->outputMessage();
				echo "</div>\n";
			}
			?>
<?php
}else{
?>
<!--begin of header login-->
<div class="header_login">
  <div class="logo"><a href="#"><img src="images/homesguru.jpg" width="299px" height="72px" alt="logo" title="logo" border="0" /></a></div>
</div>
<!--end of header login-->
<?php
	if($messageStack->size > 0){
		echo "<div class=\"message login_message\">\n";
		echo "  ".$messageStack->outputMessage();
		echo "</div>\n";
	}
	?>
<div class="login_form">
<?php
}
?>
