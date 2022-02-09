<?php
/************************************************
/	 Code Edited by: Mubarik Khan      /
/              Date: 14/06/2013                 /
/***********************************************/
$seoId=28;


include('includes/application.php');

$rowsPerPage=(isset($_GET["row"])) ? (int)$_GET["row"] : 20;

if($_GET['type']=="sale")
{
	$action = "sale";
}
else
{
	$action = "rent";
}

//$action=(isset($_GET["type"])) ? $_GET["type"] : '';

if($action=='sale')
{

	if($_REQUEST["property_type"]!=='')
	{
		$propertyType=$_REQUEST["property_type"];
		$where.="property_category_id='$propertyType' or ";
	}

	
	if($_REQUEST["bedroom"]!=='')
	{
		$bedroom=$_REQUEST["bedroom"];
		$where.="property_bedrooms='$bedroom' or ";
	}
	
	if($_REQUEST["minimum_price"]!=='' && $_REQUEST["maximum_price"]!='')
	{
		$minimum=round($_REQUEST["minimum_price"],2); if($_REQUEST["minimum_price"]=='No Min') { $minimum=0; }
		$maximum=round($_REQUEST["maximum_price"],2); if($_REQUEST["maximum_price"]=='No Max') { $maximum=100000000000; }
		$where.="property_total_price between  '$minimum' and '$maximum'";
	}
if($_REQUEST["beds_min"]!='' && $_REQUEST["beds_max"]!='')
{
	$where.="property_bedrooms between  '".$_REQUEST["beds_min"]."' and '".$_REQUEST["beds_max"];
}
if($_REQUEST["posting"]!=='')
{
	$date= date("Y-m-d,g:i:s");
	$dateOneMonthAdded = strtotime(date("Y-m-d,g:i:s", strtotime($date)) . " -".$_REQUEST["posting"]." day");
	$nextDate = strtotime(date("Y-m-d", strtotime($dateOneMonthAdded)) . " -".$_REQUEST["posting"]." day");
	$end_date=date("Y-m-d",$dateOneMonthAdded);
	$where.=" or property_created_date < '$end_date'";  
}
if($_REQUEST["shorting"]!=='')
{
	if($_REQUEST["shorting"]=='highest_price')
	{
		$orderBy="order by property_total_price ASC";
	}
	elseif($_REQUEST["shorting"]=='lowest_price')
	{
		$orderBy="order by property_total_price DESC";
	}
	elseif($_REQUEST["shorting"]=='newest_listings')
	{
		$orderBy="  order by  property_id DESC";
	}
}	
else
{
	$orderBy=" order by  property_id DESC";
}


// changed here at 3/Mar/2014 by Stephin
	$strProperty="SELECT  * FROM property where (property_postal_code='".trim($_REQUEST["locationId"])."' OR  property_address like '%".$_REQUEST["locationId"]."%') and property_transaction_type='sell' and property_status='Active'  and (".$where.") $orderBy";
//echo 	$strProperty;
}
elseif($action=='rent')
{

	if($_REQUEST["property_type"]!='')
	{
		$propertyType=$_REQUEST["property_type"];
		$where.="property_category_id='$propertyType' or ";
	}
	if($_REQUEST["bedroom"]!='')
	{
		$bedroom=$_REQUEST["bedroom"];
		$where.="property_bedrooms='$bedroom' or ";
	}
	if($_REQUEST["minimum_price"]!='' && $_REQUEST["maximum_price"]!='')
	{
		$minimum=round($_REQUEST["minimum_price"],2);
		$maximum=round($_REQUEST["maximum_price"],2);
		$where.="property_total_price between  '$minimum' and '$maximum'  ";
	}
	if($_REQUEST["beds_min"]!='' && $_REQUEST["beds_max"]!='')
	{
		$where.=" or property_bedrooms between  '".$_REQUEST["beds_min"]."' and '".$_REQUEST["beds_max"];
	}
	if($_REQUEST["posting"]!='')
	{
		$date= date("Y-m-d,g:i:s");
		$dateOneMonthAdded = strtotime(date("Y-m-d,g:i:s", strtotime($date)) . " -".$_REQUEST["posting"]." day");
		$nextDate = strtotime(date("Y-m-d", strtotime($dateOneMonthAdded)) . " -".$_REQUEST["posting"]." day");
		$end_date=date("Y-m-d",$dateOneMonthAdded);
		$where.=" or property_created_date < '$end_date'";
	}
if($_REQUEST["shorting"]!='')
{
	if($_REQUEST["shorting"]=='highest_price')
	{
		$orderBy="order by property_total_price ASC";
	}
	elseif($_REQUEST["shorting"]=='lowest_price')
	{
		$orderBy="order by property_total_price DESC";
	}
	elseif($_REQUEST["shorting"]=='newest_listings')
	{
		$orderBy="  order by  property_id DESC";
	}	
	else
	{
		$orderBy=" order by  property_id DESC";
	}
}
	$strProperty = "SELECT  * FROM property where city_id='".$_REQUEST["locationId"]."' and property_transaction_type='rent' and property_status='Active'  and (".$where.") $orderBy";
	
}



$rsProperty=dbQuery(getPagingQueries($strProperty, $rowsPerPage)); 
$numberRows=dbNumRows($rsProperty);
$pagingLink1=getPaging($strProperty, $rowsPerPage, getAllGetParams(array("page")));
//echo "SELECT  * FROM property where $where";die;
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?>
<?php echo $seoTitle;?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" src="js/jquery.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	


function getSave(reqId,showid) {		
		var strURL="submitFav.php?reqId="+reqId;
		var req = getXMLHTTP();
		
		if (req) {
			
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById(showid).innerHTML=req.responseText;	
						
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
				
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
    <h1>Property by search  <strong></strong> </h1>

<div id="sale">
<div class="view">
<ul>
<li><a class="select" href="#"><span>List view</span></a></li>
<li><a href="#map-view.php?source=<?php echo $_GET["source"]?>"><span>Map view</span></a></li>
</ul>
<div class="clear"></div>
</div>
<div class="clear">&nbsp;</div>
<?php 
$i=0;
if($numberRows>0)
	{
	while($resultProperty=dbFetchArray($rsProperty)){
	//echo "select * from property_images where property_id='".$resultProperty["property_id"]."' and property_images!=''";die;
	$proImage=dbFetchArray(dbQuery("select * from property_images where property_id='".$resultProperty["property_id"]."' and property_images!=''"));
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
<div class="left"><a href="details.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>"><?php 

if(file_exists("images/property_images/".$proImage["property_images"])){?>
<img   width="150" height="113"  src="images/property_images/<?php echo $proImage["property_images"]?>" />

<?php }else{?>
<img src="images/img4.jpg"  width="150" height="113"  />
<?php } ?></a></div>

<div class="right">
<div class="agent-logo">
<?php if($resultProperty["property_owner_type"]=='User'){
?><img src="images/user_images/<?php echo $userInfo["user_image"]?>" alt="" width="100" height="40" />
<?php  }  else{ ?>

<img src="images/homesguru.jpg" alt=""  width="100" height="40" />
 <?php }?></div>
<h2><a href="details.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>"><?php echo "&pound; ".number_format($resultProperty["property_total_price"],2)?></a> <span>Just added</span></h2>
<h3><a href="details.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>"><?php echo $resultProperty["property_bedrooms"]?> bedroom flat for sale </a></h3>
<p class="add"><a href="details.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>"><?php echo $resultProperty["property_address"]?>,<?php echo $resultProperty["property_postal_code"]?></a></p>
<p><strong>Listed on  <?php echo date('j M  Y', strtotime($resultProperty["property_created_date"]));?></strong></p>
<p><?php echo $resultProperty["property_description"]?></p>

<p> <a href="details.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>">Full details</a> | <a href="javaScript:void(0)" onclick="getSave(<?php echo $resultProperty["property_id"]?>,'<?php echo "req".$resultProperty["property_id"]?>')">Save to favourites </a>| <a href="contactForProperty.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>">Arrange viewing </a> | <a href="contactForProperty.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>">Contact agent</a> <span style="float:left;" id="<?php echo "req".$resultProperty["property_id"]?>"><br /></span> </p>
<p>Marketed by <?php if($resultProperty["property_owner_type"]=='Admin'){ echo "Homegurus";}else{ echo  $resultProperty["property_contact_person"]; }?> Call <?php  if($resultProperty["property_owner_type"]=='Admin'){ echo SITE_OWNER_PHONE; }else{ $cellnumber=explode(",",$resultProperty["property_contact_numer"]);echo $cellnumber[0];}?> (local rate) </p>
</div>
<div class="clear"></div>
</div>

<?php $i++; }
}else{ ?>
<h2>Search Not found any type property </h2>
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
