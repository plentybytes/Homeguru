<?php $seoId=1;
require("includes/application.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?>
<?php echo $seoTitle;?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
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
<?php include('includes/search.php');?>
<?php $cmsinfo5=dbFetchArray(dbQuery("select * from cms where cms_id=13"));
$cmsinfo6=dbFetchArray(dbQuery("select * from cms where cms_id=14"));
$cmsinfo7=dbFetchArray(dbQuery("select * from cms where cms_id=15"));
$cmsinfo8=dbFetchArray(dbQuery("select * from cms where cms_id=16"));?>
  

  <div id="box">
    <div class="box">
      <h3>Listed For sale </h3>
    <p><?php echo substr($cmsinfo5["cms_content"],0,120)?></p>
    <div class="read"><a href="content.php?source=<?php echo $cmsinfo5["cms_id"]?>" title="Read More">Read More</a></div>
    </div>
    
<div class="box2">
  <h3>Listed For Rent </h3>
    <p><?php echo substr($cmsinfo6["cms_content"],0,120)?></p>
    <div class="read"><a href="content.php?source=<?php echo $cmsinfo6["cms_id"]?>" title="Read More">Read More</a></div>
    </div>
    
<div class="box3">
  <h3>Listed For New Houses </h3>
    <p><?php echo substr($cmsinfo7["cms_content"],0,120)?></p>
    <div class="read"><a href="content.php?source=<?php echo $cmsinfo7["cms_id"]?>" title="Read More">Read More</a></div>
    </div>
    
<div class="box4">
  <h3>Homes Research</h3>
    <p><?php echo substr($cmsinfo8["cms_content"],0,120)?></p>
    <div class="read"><a href="content.php?source=<?php echo $cmsinfo8["cms_id"]?>" title="Read More">Read More</a></div>
    </div>
    <div class="clear"></div>
  </div>
  
  <div id="tab">
  <?php include('includes/middle_tab.php');?>
  <?php include('includes/popup.html');?>
  </div>
  <div class="clear"></div>
</div>
<!--Middle End-->

<!--Fotter Start-->

<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
