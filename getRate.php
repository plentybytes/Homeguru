<?php
include('includes/application.php');
if($_GET['rate1']!=''){
	$strProperty=dbFetchArray(dbQuery("SELECT  AVG(property_total_price) as averageCityPrice FROM property where city_id='".$_GET["cid"]."' and property_furnishing='".$_GET["rate1"]."' and property_status='Active' and property_transaction_type='sell' and property_change_status='Unsold'"));
echo "&pound; ".number_format($strProperty['averageCityPrice']);


	} 
	if($_GET["rate2"]!=''){
		$date    = date("Y-m-d,g:i:s");
	$dateOneMonthAdded = strtotime(date("Y-m-d,g:i:s", strtotime($date)) . " -".$_GET["rate2"]."");
	$end_date=date("Y-m-d",$dateOneMonthAdded);
	$currentValue=dbFetchArray(dbQuery("SELECT AVG(property_total_price) as avgPrice FROM property where property_created_date<=$end_date and  city_id='".$_GET["cid"]."' and property_status='Active' and property_transaction_type='sell' and property_change_status='Sold' and property_status='Active'"));
	
	echo "&pound; ".number_format($currentValue['averageCityPrice']);
	} 
		if($_GET["rate3"]!=''){
		$date    = date("Y-m-d,g:i:s");
	$dateOneMonthAdded = strtotime(date("Y-m-d,g:i:s", strtotime($date)) . " -".$_GET["rate3"]."");
	$end_date=date("Y-m-d",$dateOneMonthAdded);
	$soldProperty=dbFetchArray(dbQuery("SELECT AVG(property_total_price) as avgPrice,count(*) as countproperty FROM property where property_created_date>='".$end_date."' and  city_id='".base64_decode($_GET["source"])."' and  property_transaction_type='sell' and property_change_status='Sold' and property_status='Active'"));

	?>
	Avg. price paid: <strong>&pound; <?php echo number_format($soldProperty["avgPrice"]);?></strong><br />
No. of property sales: <a href="#"><?php echo $soldProperty["countproperty"];?></a>
	<?php }
	
	?>