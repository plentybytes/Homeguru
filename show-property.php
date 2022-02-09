<?php $seoId=21;
include('includes/application.php');
	$rowsPerPage=(isset($_GET["row"])) ? (int)$_GET["row"] : 20;
	if($_GET['type']=="new")
	{
	$strProperty="SELECT  * FROM property where city_id='".base64_decode($_GET["source"])."' and  property_status='Active' and property_change_status='Unsold' and property_type='new'";
	}
	else
	{
	$strProperty="SELECT  * FROM property where city_id='".base64_decode($_GET["source"])."' and  property_status='Active' and property_change_status='Unsold' and property_transaction_type='sell'";
	
	}
	$rsProperty=dbQuery(getPagingQueries($strProperty, $rowsPerPage)); 
	$pagingLink1=getPaging($strProperty, $rowsPerPage, getAllGetParams(array("page")));
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
    <h1>Property for sale in <strong><?php //echo showLocality(base64_decode($_GET["source"]))
	echo base64_decode($_GET["source"])
	?></strong> </h1>

<div id="sale">
<div class="view">
<ul>
<li><a class="select" href="#"><span>List view</span></a></li>
<li><a href="map-view.php?en=<?php echo base64_encode(getPropertyID($strProperty));?>&source=<?php echo $_GET["source"]; ?>"><span>Map view</span></a></li>
</ul>
<div class="clear"></div>
</div>
<div class="clear">&nbsp;</div>
<?php 
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
<p><?php echo htmlspecialchars_decode($resultProperty["property_description"]);?></p>

<p> <a href="details.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>">Full details</a> | <a href="javaScript:void(0)" onclick="getSave(<?php echo $resultProperty["property_id"]?>,'<?php echo "req".$resultProperty["property_id"]?>')">Save to favourites </a>| <a href="contactForProperty.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>">Arrange viewing </a> | <a href="contactForProperty.php?source=<?php echo base64_encode($resultProperty["city_id"])?>&proid=<?php echo base64_encode($resultProperty["property_id"])?>">Contact agent</a> <span style="float:left;" id="<?php echo "req".$resultProperty["property_id"]?>"><br /></span> </p>
<p>Marketed by <?php if($resultProperty["property_owner_type"]=='Admin'){ echo "Homegurus";}else{ echo  $resultProperty["property_contact_person"]; }?> Call <?php  if($resultProperty["property_owner_type"]=='Admin'){ echo SITE_OWNER_PHONE; }else{ $cellnumber=explode(",",$resultProperty["property_contact_numer"]);echo $cellnumber[0];}?> (local rate) </p>
</div>
<div class="clear"></div>
</div>

<?php $i++; } ?>








</div>


<?php include('includes/popup.html');?>
<div class="clearfix"></div>
<div class="pagination" align="right"><?php echo $pagingLink1;?></div>

	
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
