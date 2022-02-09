<?php
/************************************************
/	 Code Edited by: Mubarik Khan      /
/              Date: 14/06/2013                 /
/***********************************************/
$seoId=28;




include('includes/application.php');
/************************************************
/		Code Edited by: Akash singh              /
/		Date:  20/08/2015						 /
/		Company :CvInfotech(www.cvinfotech.com) */
		
if(isset($_GET['from'])=='ukforsale'){
	$_REQUEST["property_type"] = 1;
	$_REQUEST["minimum_price"] = 'No Min';
	$_REQUEST["maximum_price"] = 850000;
	$_REQUEST["radius"] = 'This area only';
	$_REQUEST["shorting"] = 'newest_listings';
}

if(isset($_GET['shorting'])!==''){
	//$_REQUEST["property_type"] = 1;
	$_REQUEST["minimum_price"] = 'No Min';
	$_REQUEST["maximum_price"] = 850000;
	$_REQUEST["radius"] = 'This area only';
	
}
$ak_property_type=$_GET['property_type'];





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
/* Filter Search Code By Akash*/
if($_GET['type']=="sale1"){
	
	$action="sale1";
	
}

if($action=='sale1')
{
	
	if($_REQUEST["property_type"]!=='')
	{
		
		$propertyType=$_REQUEST["property_type"];
		
		$where.="property_category_id='$propertyType' ";
	}

	
	
if($_REQUEST["shorting"]!=='')
{
	
	if(str_replace(' ','',$_REQUEST["shorting"])=='highest_price')
	{
		$orderBy="order by property_total_price DESC";
		
	}
	elseif($_REQUEST["shorting"]=='lowest_price')
	{
		$orderBy="order by property_total_price ASC";
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

if($_REQUEST["property_type"]!=='' AND $_REQUEST["form"]!=='uksale'){
	$strProperty="SELECT  * FROM property where  property_transaction_type='sell' and property_status='Active'  and (".$where.") $orderBy";
}
else{
	$strProperty="SELECT  * FROM property where  property_transaction_type='sell' and property_status='Active' $orderBy";
	
}
}
/*Code for Rent Search*/
if($_GET['type']=="rent1"){
	
	$action="rent1";
	
}

if($action=='rent1')
{
	
	if($_REQUEST["property_type"]!=='')
	{
		
		$propertyType=$_REQUEST["property_type"];
		
		$where.="property_category_id='$propertyType' ";
	}

	
	
if($_REQUEST["shorting"]!=='')
{
	
	if(str_replace(' ','',$_REQUEST["shorting"])=='highest_price')
	{
		$orderBy="order by property_total_price DESC";
		
	}
	elseif($_REQUEST["shorting"]=='lowest_price')
	{
		$orderBy="order by property_total_price ASC";
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
	if($_REQUEST["property_type"]!=='' AND $_REQUEST["form"]!=='uksale'){
	$strProperty="SELECT  * FROM property where  property_transaction_type='rent' and property_status='Active'  and (".$where.") $orderBy";
}
else{
	$strProperty="SELECT  * FROM property where  property_transaction_type='rent' and property_status='Active' $orderBy";
	
}

}









/*Coded End By Akash*/





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
	
	if(str_replace(' ','',$_REQUEST["shorting"])=='highest_price')
	{
		$orderBy="order by property_total_price DESC";
		
	}
	elseif($_REQUEST["shorting"]=='lowest_price')
	{
		$orderBy="order by property_total_price ASC";
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


if(($_GET['type'])=='sale' && $_GET['shorting']=='newest_listings'){

		$strProperty="SELECT  * FROM property where (property_postal_code='".trim($_REQUEST["locationId"])."' OR  property_address like '%".$_REQUEST["locationId"]."%') and property_transaction_type='sell' and property_type='New' and property_status='Active'  and (".$where.") $orderBy";

		//echo $strProperty;
		
}
else{
	
	$strProperty="SELECT  * FROM property where (property_postal_code='".trim($_REQUEST["locationId"])."' OR  property_address like '%".$_REQUEST["locationId"]."%') and property_transaction_type='sell' and property_status='Active'  and (".$where.") $orderBy";
}
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
		$orderBy="order by property_total_price DESC";
	}
	elseif($_REQUEST["shorting"]=='lowest_price')
	{
		$orderBy="order by property_total_price ASC";
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
	$strProperty = "SELECT  * FROM property where city_id='".$_REQUEST["locationId"]."' and property_transaction_type='rent' and property_status='Active' and (".$where.") $orderBy";
	
}








if($_GET['param']=='none' && $action=='sale')
{
		
		$strProperty="SELECT  * FROM property where (property_category_id='1' or property_total_price between '0' and '100000000000') and property_transaction_type='sell' and property_status='Active' order by property_id desc";
		if($_GET['status']=="newhome")
		  	// $strProperty="SELECT  * FROM property where (property_category_id='1' 
		  	// or property_total_price between '0' and '100000000000') 
		  	// and property_transaction_type='sell' and property_status='Active' and new_home_status='new' order by property_id desc";
			$strProperty="SELECT  * FROM property where (property_category_id='1' 
		  	or property_total_price between '0' and '100000000000') 
		  	and property_transaction_type='sell' and property_status='Active' and property_type='new' order by property_id desc";
	
	
	
} 


 
 if(isSessionRegistered('user')){

    $strPropertyIdNotIn="select property_id from tbl_propertyhideunhide where user_id=".$_SESSION['user']['id'];
    $strProperty="select * from (".$strProperty.") as A where A.property_id not in(".$strPropertyIdNotIn.")";
   

}
$rsProperty=dbQuery(getPagingQueries($strProperty, $rowsPerPage)); 
$nrsProperty=dbQuery(getPagingQueries($strProperty, $rowsPerPage)); 
$numberRows=dbNumRows($rsProperty);
$pagingLink1=getPaging($strProperty, $rowsPerPage, getAllGetParams(array("page")));
//echo "SELECT  * FROM property where $where";die;
	
?>

<?php $seoId=10;
//include('includes/application.php');



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?><?php echo $seoTitle;?>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
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
      <?php //include('includes/about.php');?>
      <div class="banner">
        <?php include('includes/middle-banner.php');?>
      </div>
 <div id="left-panel">
    <h1>List of New Homes  <strong></strong> </h1>

<div id="sale">
<div class="view">
<ul>
<li><a class="select" href="#"><span>List view</span></a></li>
<li><a href="map-view.php?en=<?php 

	$r_Property=dbFetchArray($nrsProperty);
	
	echo base64_encode($r_Property["property_id"]);
	
	?>==&source=<?php echo $_GET["source"]?>"><span>Map view</span></a></li>
</ul>
<div class="clear"></div>
</div>
<div class="clear">&nbsp;</div>
<?php 
$i=0;
if($numberRows>0)
	{
		
		$strProperty=dbQuery("SELECT * FROM property where property_status='Active' and property_transaction_type='sell' and  property_type='New' and property_change_status='Unsold'  ORDER BY property_created_date DESC LIMIT 0 ,8");
	while($resultProperty=dbFetchArray($strProperty)){
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
?><img src="images/user_images/<?php echo $userInfo["logo"]?>" alt="" width="100" height="40" />
<?php  }  else{ ?>

<img src="images/user_images/<?php echo $userInfo["logo"]?>" alt=""  width="100" height="40" />
 <?php }?></div>
<h2><a href="details.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>"><?php echo "&pound; ".number_format($resultProperty["property_total_price"],2)?></a> <span>Just added</span></h2>
<h3><a href="details.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>"><?php echo $resultProperty["property_bedrooms"]?> bedroom flat for sale </a></h3>
<p class="add"><a href="details.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>"><?php echo $resultProperty["property_address"]?>,<?php echo substr($resultProperty["property_postal_code"], 0, 3);?></a></p>
<p><strong>Listed on  <?php echo date('j M  Y', strtotime($resultProperty["property_created_date"]));?></strong></p>
<p><?php echo htmlspecialchars_decode($resultProperty["property_description"]);?></p>

<!--<p> <a href="details.php?source=<?php //echo base64_encode($resultProperty["city_id"])?>&proid=<?php //echo base64_encode($resultProperty["property_id"])?>">Full details</a> | <a href="javaScript:void(0)" onclick="getSave(<?php //echo $resultProperty["property_id"]?>,
'<?php //echo "req".$resultProperty["property_id"]?>')">Save to favourites </a>| <a href="contactForProperty.php?source=
<?php //echo base64_encode($resultProperty["city_id"])?>&proid=<?php //echo base64_encode($resultProperty["property_id"])?>">Arrange viewing </a> | <a href="contactForProperty.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>">Contact agent</a> <span style="float:left;" id="<?php echo "req".$resultProperty["property_id"]?>"><br /></span> </p>-->
<p>Marketed by <?php if($resultProperty["property_owner_type"]=='Admin'){ echo "Homegurus";}else{ echo  $resultProperty["property_contact_person"]; }?> Call <?php  if($resultProperty["property_owner_type"]=='Admin'){ echo SITE_OWNER_PHONE; }else{ $cellnumber=explode(",",$resultProperty["property_contact_numer"]);echo $cellnumber[0];}?> (local rate) </p>
</div>
<div class="clear"></div>
</div>

<?php $i++; }
}else{ ?>
<h2>Search Not found any type property </h2>
<?php } ?>






</div>


</script><!--
<select id="selectOrder">
 <option value="">Sort By </option>
 <option value="highest_price">Highest Price</option>
 <option value="lowest_price">Lowest Price</option>
 <option value="newest_listings">Newest Listings</option>
  </select>-->
<?php if($numberRows<20 && $numberRows>0 or $numberRows>20){?>
<div class="pagination" align="right"><?php echo $pagingLink1;?></div>



<?php } ?>
<div class="clearfix"></div><br />
<?php include('includes/popup.html');?>	
<div class="clearfix"></div>
</div>
	
	
	
	<?php
	/*	$strProperty=dbQuery("SELECT property_total_price,city_id,property_id,state_id, count( state_id ) AS cnt FROM property where property_status='Active' and property_transaction_type='sell' and  property_type='New' and property_change_status='Unsold' GROUP BY state_id  ORDER BY cnt DESC LIMIT 0 ,8");
	
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
		$strPropertyCity=dbQuery("SELECT  city_id, property_id,count(city_id) AS cityCount FROM property where property_status='Active' and state_id='".$rsProperty["state_id"]."' and property_transaction_type='sell' and property_type='New' and property_change_status='Unsold' GROUP BY city_id  ORDER BY cityCount DESC LIMIT 0 , 5");
		while($rsPropertyCity=dbFetchArray($strPropertyCity)){
		$whereClouse1='city_id';
		$whereClouseEquel1=$rsPropertyCity["city_id"];
		$table1='property';
		$averageFelied1='property_total_price';
		$averagePrice1= getAverage($whereClouse1,$whereClouseEquel1,$table1,$averageFelied1);
		?>
			<div class="area2">
			<div class="left"><a href="show-property.php?source=<?php echo base64_encode($rsPropertyCity["city_id"])?>"  title="Property in <?php echo showLocality($rsPropertyCity["city_id"])?>"><?php echo showLocality($rsPropertyCity["city_id"])?></a></div>
			<div class="midd"><?php echo getCountWhere('property','city_id',$rsPropertyCity["city_id"],'property_id')?></div>
			<div class="right"><?php echo "&pound; ".number_format($averagePrice1,2)?></div>
			<div class="clear"></div>
			</div>
			<?php }?>
		</div>
      <?php }
	   } */
	  ?> 
	  
	  
	  
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
