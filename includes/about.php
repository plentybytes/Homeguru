<div id="about">
<?php if($seoId==10){
$cmsinfo10=dbFetchArray(dbQuery("select * from cms where cms_id=13"));?>
<h1>Find your next home to buy with <strong>HomeGuru</strong></h1>

<p><?php echo $cmsinfo10["cms_content"]?></p>
<?php } elseif($seoId==27){
$cmsinfo10=dbFetchArray(dbQuery("select * from cms where cms_id=14"));?>
<h1>Find your next home to rent with <strong>HomeGuru</strong></h1>
<p><?php echo $cmsinfo10["cms_content"]?></p> 	
<?php }  elseif($seoId==25){
$cmsinfo10=dbFetchArray(dbQuery("select * from cms where cms_id=17"));?>
<h1>Letting agent to help you buy <strong>the perfect property?</strong></h1>
<p><?php echo $cmsinfo10["cms_content"]?></p> 	
<?php }?>

</div>