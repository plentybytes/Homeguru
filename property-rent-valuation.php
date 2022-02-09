<?php $seoId=27;
include('includes/application.php');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?><?php echo $seoTitle;?>
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
      <?php include('includes/about.php');?>
      <div class="banner">
        <?php include('includes/middle-banner.php');?>
      </div>
      <h2>Browse property for rent by area</h2>
      <div class="area" id="area-back">
        <div class="left">Region</div>
        <div class="midd">No. properties</div>
        <div class="right">Avg. asking price</div>
        <div class="clear"></div>
      </div>
      <?php
$strProperty=dbQuery("SELECT property_total_price,city_id,property_id,state_id, count( state_id ) AS cnt FROM property where property_status='Active' and property_transaction_type='rent' GROUP BY state_id  ORDER BY cnt DESC LIMIT 0 ,8");
	while($rsProperty=dbFetchArray($strProperty)){
	$whereClouse='state_id';
	$whereClouseEquel=$rsProperty["state_id"];
	$table='property';
	$averageFelied='property_total_price';
	$averagePrice= getAverage($whereClouse,$whereClouseEquel,$table,$averageFelied);
 ?>
      <div class="menuheader expandable">
        <div class="area">
          <div class="left"><?php echo showCounty($rsProperty["state_id"])?></div>
          <div class="midd"><?php echo $rsProperty["cnt"]?></div>
          <div class="right"><?php echo "&pound; ".number_format($averagePrice,2)?></div>
          <div class="clear"></div>
        </div>
        <div class="clear"></div>
      </div>
      <div class="categoryitems">
        <?php 
	$strPropertyCity=dbQuery("SELECT  city_id,property_id,count(city_id) AS cityCount FROM property where state_id='".$rsProperty["state_id"]."' GROUP BY city_id  ORDER BY cityCount DESC LIMIT 0 , 5");
	while($rsPropertyCity=dbFetchArray($strPropertyCity)){
	$whereClouse1='city_id';
	$whereClouseEquel1=$rsPropertyCity["city_id"];
	$table1='property';
	$averageFelied1='property_total_price';
	$averagePrice1= getAverage($whereClouse1,$whereClouseEquel1,$table1,$averageFelied1);
	?>
        <div class="area2">
          <div class="left"><a href="show-rent-property.php?source=<?php echo base64_encode($rsPropertyCity["city_id"])?>"  title="Property in <?php echo showLocality($rsPropertyCity["city_id"])?>"><?php echo showLocality($rsPropertyCity["city_id"])?></a></div>
          <div class="midd"><?php echo getCountWhere('property','city_id',$rsPropertyCity["city_id"],'property_id')?></div>
          <div class="right"><?php echo "&pound; ".number_format($averagePrice1,2)?></div>
          <div class="clear"></div>
        </div>
        <?php }?>
      </div>
      <?php }?>
      
    </div>
    <div id="right-panel">
      <div  class="banner">
        <?php include('includes/right-banner.php');?>
      </div>
    </div>
    <div class="clear">&nbsp;</div>
    <div id="tab">
      <?php include('includes/middle_tab.php');?>
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
