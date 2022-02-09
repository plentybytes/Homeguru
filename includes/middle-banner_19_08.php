<?php //include('application.php');?>
<script type="text/javascript">
    var auto_refresh = setInterval(
    function(){
        $('#refresh1').load('right-banner.php?location=middle&_=' +Math.random()).fadeIn("slow");
    }, 10000); // refresh every 10000 milliseconds
</script>
  <div  id="refresh1">
  <?php 
$banner=dbFetchArray(dbQuery("SELECT * FROM banner where banner_location='middle' and banner_status='Yes'  order by rand()"));

if($banner["google_code"]!=''){  echo $data['google_code']; } elseif($banner["banner_image"]!=''){?>
<a href="<?php echo $banner['banner_code']?>" accesskey="<?php echo $banner['banner_code']?>" target="_blank"><img  width="644" height="100" src="images/banner/<?php echo $banner['banner_image']?>" /></a>

<?php } ?>
</div>



