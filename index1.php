<?php 
	require("includes/application.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Welcome to homeguru</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>

<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/custom.js" type="text/javascript"></script>


<script src="js/tabcontent.js" type="text/javascript"></script>


</head>

<body>
<!--Header Start-->

<?php include('includes/header1.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">
<?php include('includes/search.php');?>

  

  <div id="box">
    <div class="box">
      <h3>Listed For sale </h3>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's ..</p>
    <div class="read"><a href="#">Read More</a></div>
    </div>
    
<div class="box2">
  <h3>Listed For Rent </h3>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's ..</p>
    <div class="read"><a href="#">Read More</a></div>
    </div>
    
<div class="box3">
  <h3>Listed For New Houses </h3>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's ..</p>
    <div class="read"><a href="#">Read More</a></div>
    </div>
    
<div class="box4">
  <h3>Homes Research</h3>
    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's ..</p>
    <div class="read"><a href="#">Read More</a></div>
    </div>
    <div class="clear"></div>
  </div>
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
<!--Middle End-->

<!--Fotter Start-->

<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
