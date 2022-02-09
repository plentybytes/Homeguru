<?php $seoId=1;
require("includes/application.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?>
<?php echo $seoTitle;?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>

<script src="js/tabcontent.js" type="text/javascript"></script>




</head>

<body>
<!--Header Start-->

<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">

<iframe height="auto" width="100%" src="http://landregistry.data.gov.uk/app/hpi/hpi"></iframe>
  <div class="clear"></div>
</div>
<!--Middle End-->

<!--Fotter Start-->

<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
