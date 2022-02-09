<?php $seoId=10;
include('includes/application.php');

?>
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


<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="js/ddaccordion.js"></script>
<script type="text/javascript" src="js/ddaccordion2.js"></script>
</head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">
<div class="main">

<?php include('includes/search.php');?>

<div class="clear">&nbsp;</div>

<div id="left-panel">
<div id="about">
<h1>Find your next home to buy with <strong>HomeGuru</strong></h1>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
</div>

<div class="banner"><img src="images/banner2.jpg" alt="" /></div>


<h2>Browse property for sale by area</h2>


<div class="area" id="area-back">
  <div class="left">Region</div>
  <div class="midd">No. properties</div>
  <div class="right">Avg. asking price</div>
  <div class="clear"></div>
</div>

<div class="menuheader expandable">
  <div class="area">
  <div class="left">London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
  </div>
  <div class="clear"></div>
  </div>
  
<div class="categoryitems">
<div class="area2">
  <div class="left">East London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
</div>

<div class="area2">
  <div class="left">East Central London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
</div>

<div class="area2">
  <div class="left">Greater London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
</div>

<div class="area2">
  <div class="left">North London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
</div>
</div>


<div class="menuheader expandable">
  <div class="area">
  <div class="left">East of England</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
  </div>
  <div class="clear"></div>
  </div>
  
<div class="categoryitems">
<div class="area2">
  <div class="left">East London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
</div>

<div class="area2">
  <div class="left">East Central London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
</div>

<div class="area2">
  <div class="left">Greater London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
</div>

<div class="area2">
  <div class="left">North London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
</div>
</div>

<div class="menuheader expandable">
  <div class="area">
  <div class="left">South East England</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
  </div>
  <div class="clear"></div>
  </div>
  
<div class="categoryitems">
<div class="area2">
  <div class="left">East London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
</div>

<div class="area2">
  <div class="left">East Central London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
</div>

<div class="area2">
  <div class="left">Greater London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
</div>

<div class="area2">
  <div class="left">North London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
</div>
</div>

<div class="menuheader expandable">
  <div class="area">
  <div class="left">East Midlands</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
  </div>
  <div class="clear"></div>
  </div>
  
<div class="categoryitems">
<div class="area2">
  <div class="left">East London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
</div>

<div class="area2">
  <div class="left">East Central London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
</div>

<div class="area2">
  <div class="left">Greater London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
</div>

<div class="area2">
  <div class="left">North London</div>
  <div class="midd">84,720</div>
  <div class="right">£689,594</div>
  <div class="clear"></div>
</div>
</div>

</div>



<div id="right-panel">
  <div class="banner">
<img src="images/banner.jpg" alt="" />
</div>

</div>



<div class="clear">&nbsp;</div>
<div id="tab">
<div class="tab">
<h4>Home buying news</h4>
<ul>
<li><a href="#">First-time buyer activity hits a ...</a> <span>Posted: 12th Mar 2013</span> </li>
<li><a href="#">First-time buyer activity hits a ...</a>  <span> Posted: 12th Mar 2013</span> </li>
<li><a href="#">First-time buyer activity hits a ...</a> <span> Posted: 12th Mar 2013</span> </li>
<li><a href="#">First-time buyer activity hits a ...</a>  <span>Posted: 12th Mar 2013</span> </li>
</ul>
</div>

<div class="tab">
<h4>Home buying</h4>
<p><a href="#">How can I find council tax bands? </a><br />
<strong>Asked on Mar 21 2013,</strong> <span><a href="#">General in Dunstable</a></span></p>

<p><a href="#">How can I find council tax bands? </a><br />
<strong>Asked on Mar 21 2013,</strong> <span><a href="#">General in Dunstable</a></span></p>

<p><a href="#">How can I find council tax bands? </a><br />
<strong>Asked on Mar 21 2013,</strong> <span><a href="#">General in Dunstable</a></span></p>
</div>

<div class="tab2">
<h4>Newly listed properties for sale</h4>

<p><img src="images/img1.jpg" alt="" /> <strong>£1,450 pcm</strong> - 1 bedroom flat <br />
  <a href="#">Rushcroft Road, South ...</a></p>
  
<p><img src="images/img1.jpg" alt="" /> <strong>£1,450 pcm</strong> - 1 bedroom flat <br />
  <a href="#">Rushcroft Road, South ...</a></p>
  
<p><img src="images/img1.jpg" alt="" /> <strong>£1,450 pcm</strong> - 1 bedroom flat <br />
  <a href="#">Rushcroft Road, South ...</a></p>
</div>
<div class="clear"></div>
</div>

<div class="clear"></div>
</div>
</div>
<!--Middle End-->

<!--Fotter Start-->
<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
