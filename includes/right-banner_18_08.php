<script type="text/javascript">
    var auto_refresh = setInterval(
    function(){
        $('#refresh2').load('right-banner.php?location=right&_=' +Math.random()).fadeIn("slow");
    }, 10000); // refresh every 10000 milliseconds
</script>
  <div  id="refresh2">
  <?php 
$banner=dbFetchArray(dbQuery("SELECT * FROM banner where banner_location='right' and banner_status='Yes' order by rand()"));

if($banner["google_code"]!=''){  echo $data['google_code']; } elseif($banner["banner_image"]!=''){?>
<a href="<?php echo $banner['banner_code']?>" accesskey="<?php echo $banner['banner_code']?>" target="_blank"><img  width="300px" height="250px" src="images/banner/<?php echo $banner['banner_image']?>" /></a>

<?php } ?>
</div>



