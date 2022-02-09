<?php $seoId=29;
include('includes/application.php');
	
	$date    = date("Y-m-d,g:i:s");
	$dateOneMonthAdded = strtotime(date("Y-m-d,g:i:s", strtotime($date)) . " -1 years");
	$endDate=date("Y-m-d",$dateOneMonthAdded);
	$dateOneMonthAdded1 = strtotime(date("Y-m-d,g:i:s", strtotime($date)) . " -3 years");
	$endDate1=date("Y-m-d",$dateOneMonthAdded1);
	$currentValue=dbFetchArray(dbQuery("SELECT AVG(property_total_price) as avgPrice FROM property where property_created_date<='".$endDate."' and  city_id='".base64_decode($_GET["source"])."' and property_status='Active' and property_transaction_type='sell' and property_change_status='Unsold' and property_status='Active'"));
	$soldProperty=dbFetchArray(dbQuery("SELECT AVG(property_total_price) as avgPrice,count(*) as countproperty FROM property where property_created_date>='".$endDate1."' and  city_id='".base64_decode($_GET["source"])."' and  property_transaction_type='sell' and property_change_status='Sold' and property_status='Active'"));				
	$rsPropertyAVG=dbFetchArray(dbQuery("SELECT AVG(property_total_price) as avgPrice  FROM property where city_id='".base64_decode($_GET["source"])."' and property_status='Active' and property_transaction_type='sell' and property_change_status='Unsold' and property_status='Active'"));
	
	$rowsPerPage=(isset($_GET["row"])) ? (int)$_GET["row"] : 20;
	$strProperty="SELECT  * FROM property where city_id='".base64_decode($_GET["source"])."' and property_status='Active' and property_change_status='Unsold' and property_transaction_type='sell'";
	$rsProperty=dbQuery(getPagingQueries($strProperty, $rowsPerPage)); 
	$pagingLink1=getPaging($strProperty, $rowsPerPage, getAllGetParams(array("page")));
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?>
<?php echo $seoTitle;?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript"  src="js/jquery-1.2.6.pack.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
function getRate1(rate1,city) {		
if(rate1!='all'){
$.post('getRate.php?rate1='+rate1+"&cid="+city, function(data) {
//alert(data);

$('#rate1').html(data);
});
}else{ return false;
}
}


function getRate2(rate1,city) {		
//alert("mukesh");
$.post('getRate.php?rate2='+rate1+"&cid="+city, function(data) {
//alert(data);
$('#rate2').html(data);
});
	}
function getRate3(rate1,city) {		
//alert("mukesh");
$.post('getRate.php?rate3='+rate1+"&cid="+city, function(data) {
//alert(data);
$('#values7').html(data);
});
	}
</script>
</head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">


  <div id="left-panel">
<h1>Current property values in <?php echo showLocality(base64_decode($_GET["source"]))?></h1>

<div class="values">
<h4><?php echo showLocality(base64_decode($_GET["source"]))?> Zed-Index</h4>
<h3> <div id="rate1">  &pound; <?php echo number_format($rsPropertyAVG["avgPrice"]);?> </div> </h3>
stats for</div>


<div class="values">
<h4> Value change</h4>
<h3> <div  id="rate2">&pound; <?php echo number_format($currentValue["avgPrice"]);?>  </div></h3>
stats for   <select onchange="getRate2(this.value,<?php echo base64_decode($_GET["source"])?>)">
                        <option  value="3 months">3 months ago</option>
                        <option  value="6 months">6 months ago</option>
                        <option  value="1 years" selected="selected">1 year ago</option>
                        <option value="2 years">2 years ago</option>
                        <option  value="4 years">3 years ago</option>
                        <option  value="5 years">4 years ago</option>
                        <option  value="6 years">5 years ago</option></select>
</div>



<div class="values2">
<p id="values7">Avg. price paid: <strong>&pound; <?php echo number_format($soldProperty["avgPrice"]);?></strong><br />
No. of property sales: <a href="#"><?php echo $soldProperty["countproperty"];?></a></p>
over  <select onchange="getRate3(this.value,<?php echo base64_decode($_GET["source"])?>)">
<option  value="7 years">Last 7 years</option>
                        <option  value="5 years" selected="selected">Last 5 years</option>
                        <option value="3 years" selected="selected">Last 3 years</option> 
                        <option value="1 years">Last 1 year</option></select>
</div>

<div class="clear">&nbsp;<span class="values">
  <select name="select" onchange="getRate1(this.value,<?php echo base64_decode($_GET["source"])?>)">
    <option  value="all"   selected="selected">All properties</option>
    <option value="Furnished">Furnished</option>
    <option  value="Semi-Furnished">Semi-Furnished</option>
    <option  value="Unfurnished">Flats</option>
  </select>
</span></div>

<!-- <div class="asking">Avg. asking price in London: <span>&pound;813,954</span><br />
No. of properties for sale in London: <a href="#">53,530 </a></div>

<div class="asking2">Avg. asking rent in London:  <span>&pound;2,607 pcm</span><br />
No. of properties for sale in London: <a href="#">93,054</a></div>-->

<div class="clear">&nbsp;</div>

<div class="clear">&nbsp;</div>

<div id="sale">
<div class="view">
<ul>
<li><a class="select" href="#"><span>List view</span></a></li>
<li><a href="map-view.php?source=<?php echo $_GET["source"]?>"><span>Map view</span></a></li>
</ul>
<div class="clear"></div>
</div>
<div class="clear">&nbsp;</div>
<?php 
$numberRows=dbNumRows($rsProperty);
if($numberRows>0)

	{
$i=0;
	while($resultProperty=dbFetchArray($rsProperty)){
	//echo "select * from property_images where property_id='".$resultProperty["property_id"]."' and property_images!=''";die;
	$image=dbQuery("select * from property_images where property_id='".$resultProperty["property_id"]."' and property_images!=''");
	if($i%2==0){
	$class="panel";
	}else{
	$class="panel2";
	}
	if($resultProperty["property_owner_type"]=='User'){
	$userInfo=dbFetchArray(dbQuery("select * from user where user_id='".$resultProperty["user_id"]."'"));
	}
?>

<div class="<?php echo $class;?>">
<div class="left"><?php 
while($proImage=dbFetchArray($image)){
if(file_exists("images/property_images/".$proImage["property_images"])){?>
<img   width="150" height="113"  src="images/property_images/<?php echo $proImage["property_images"]?>" />

<?php $check ='success';
 }  } if($check==''){?>
<img src="images/img4.jpg"  width="150" height="113"  />
<?php } ?></div>

<div class="right">
<div class="agent-logo">
<?php if($resultProperty["property_owner_type"]=='User'){
?><img src="images/user_images/<?php echo $userInfo["user_image"]?>" alt="" width="100" height="40" />
<?php  }  else{ ?>

<img src="images/homesguru.jpg" alt=""  width="100" height="40" />
 <?php }?></div>
<h2><a href="#"><?php echo "&pound; ".number_format($resultProperty["property_total_price"],2)?></a> <span>Just added</span></h2>
<h3><a href="details.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>"><?php echo $resultProperty["property_bedrooms"]?> bedroom flat for sale </a></h3>
<p class="add"><a href="details.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>"><?php echo $resultProperty["property_address"]?></a></p>
<p><strong>Listed on  <?php echo date('j M  Y', strtotime($resultProperty["property_created_date"]));?></strong></p>
<p><?php echo $resultProperty["property_description"]?></p>

<p> <a href="details.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>">Full details</a> | <a href="javaScript:void(0)" onclick="getSave(<?php echo $resultProperty["property_id"]?>,'<?php echo "req".$resultProperty["property_id"]?>')">Save to favourites </a>| <a href="contactForProperty.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>">Arrange viewing </a> | <a href="contactForProperty.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>">Contact agent</a> <span style="float:left;" id="<?php echo "req".$resultProperty["property_id"]?>"><br /></span> </p>
<p>Marketed by <?php if($resultProperty["property_owner_type"]=='Admin'){ echo "Homegurus";}else{ echo  $resultProperty["property_contact_person"]; }?> Call <?php  if($resultProperty["property_owner_type"]=='Admin'){ echo SITE_OWNER_PHONE; }else{ $cellnumber=explode(",",$resultProperty["property_contact_numer"]);echo $cellnumber[0];}?> (local rate) </p>
</div>
<div class="clear"></div>
</div>

<?php $i++; } 

}else{ ?>
<h2>Empty found property </h2>
<?php } ?>









</div>
<?php if($numberRows>20){?>
<div class="pagination" align="right"><?php echo $pagingLink1;?></div>
<?php } ?>



  </div>
  
  
  
  
  
  <div id="right-panel">
  
 <?php include('includes/right-panel.php');?>
  
    
</div>

  <div class="clear"></div>
</div><!--Middle End-->

<!--Fotter Start-->
<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
