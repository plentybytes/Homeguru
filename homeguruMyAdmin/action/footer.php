<?php
if(isSessionRegistered("admin")){
?>	
      </div>
      <!--end of right content-->
    </div>
    <!--end of center content -->
		<div class="clear"></div>
  </div>
  <!--end of main content-->
	<!--begin of footer-->
  <div class="footer">
    <div class="left_footer">homesguru.co.uk Admin Panel | Powered by <a href="http://galaxywebtechnology.com/" target="_blank">GalaxywebTechnology</a></div>
    <div class="right_footer">&nbsp;</div>
  </div>
	<!--end of footer-->
<?php
}else{
?>
		<div class="clear"></div>
  </div>
  <!--end of main content-->
	<!--begin of footer login-->
	<div class="footer_login">
    <div class="left_footer_login">homesguru.co.uk Admin Panel | Powered by: <a href="http://galaxywebtechnology.com/" target="_blank">GalaxywebTechnology</a></div>
    <div class="right_footer_login">&nbsp;</div>
  </div>
	<!--end of footer login-->
<?php
}
?>
</div>
<!--end of main container-->
</body>
</html>