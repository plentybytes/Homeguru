<?php include('includes/application.php');
  if($_GET["location"]=='right'){
$banner=dbFetchArray(dbQuery("SELECT * FROM banner where banner_location='right' and banner_status='Yes'  order by rand()"));

if($banner["google_code"]!=''){  echo $data['google_code']; } elseif($banner["banner_image"]!=''){?>
<a href="<?php echo $banner['banner_code']?>" accesskey="<?php echo $banner['banner_code']?>" target="_blank"><img  width="300px" height="250px" src="images/banner/<?php echo $banner['banner_image']?>" /></a>

<?php }

}

if($_GET["location"]=='middle'){

$banner=dbFetchArray(dbQuery("SELECT * FROM banner where banner_location='middle' and banner_status='Yes'  order by rand()"));

if($banner["google_code"]!=''){  echo $data['google_code']; } elseif($banner["banner_image"]!=''){?>
<a href="<?php echo $banner['banner_code']?>" accesskey="<?php echo $banner['banner_code']?>" target="_blank"><img  width="644px" height="100px"  src="images/banner/<?php echo $banner['banner_image']?>" /></a>

<?php } 

} ?>


