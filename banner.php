<?php
include('includes/application.php');
$banner=dbFetchArray(dbQuery("SELECT * FROM banner order by rand()"));

if($banner["google_code"]!=''){  echo $data['google_code']; } elseif($banner["banner_image"]!=''){?>
<a href="<?php echo $banner['banner_code']?>" accesskey="<?php echo $banner['banner_code']?>" target="_blank"><img src="images/banner/<?php echo $banner['banner_image']?>" /></a>

<?php } ?>


