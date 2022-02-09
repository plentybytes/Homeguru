<div id="fotter">
<div class="main">
<?php $cmsinfo=dbFetchArray(dbQuery("select * from cms where cms_id=12"));
$cmsinfo1=dbFetchArray(dbQuery("select * from cms where cms_id=11"));
$cmsinfo2=dbFetchArray(dbQuery("select * from cms where cms_id=10"));?>
<div class="around">
<h3><?php echo $cmsinfo["cms_name"]?></h3>
<p><?php echo substr($cmsinfo["cms_content"],0,150)?> <a href="content.php?source=<?php echo $cmsinfo["cms_id"]?>" title="More">[More]</a></p>
</div>
<!-- code is commented by Akash to hide the footer section-->
<div class="property">
<h3>[TITLE PLEASE]</h3>
<!--<h3><?php //echo $cmsinfo2["cms_name"]?></h3>
<p><?php //echo substr($cmsinfo2["cms_content"],0,150)?> <a href="content.php?source=<?php //echo $cmsinfo2["cms_id"]?>" title="More">[More]</a></p>-->
</div>


<div class="house">
<h3>[TITLE PLEASE]</h3>
<!--<h3><?php //echo $cmsinfo1["cms_name"]?></h3>
<p><?php //echo substr($cmsinfo1["cms_content"],0,150)?> <a href="content.php?source=<?php //echo $cmsinfo1["cms_id"]?>" title="More">[More]</a></p>-->
</div>


<div class="connect">
<h3>Connect us</h3>
<p><a href="https://www.facebook.com/pages/Homesgurucouk/1494302914223478"><img src="images/facebook.jpg" alt="" /> Like us on Facebook</a></p>
<!--<p><a href="#"><img src="images/twitter.jpg" alt="" /> Follow us on Twitter</a></p>
<p><a href="#"><img src="images/you-tube.jpg" alt="" /> Find us on YouTube</a></p>
<p><a href="#"><img src="images/google.jpg" alt="" /> Follow us on Google</a></p>-->
</div>

<div class="copy">
Copyright &copy; 2013 homesguru.co.uk  All Rights Reserved  <!--Design and Development by: <a href="http://galaxywebtechnology.com" target="_blank">Galaxywebtechnology.com</a>-->
</div>

<div class="clear"></div>
</div>
</div>