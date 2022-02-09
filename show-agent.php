<?php $seoId=26;
include('includes/application.php');
 if($_GET["show"]=="map"){
	$rowsPerPage=(isset($_GET["row"])) ? (int)$_GET["row"] : 20;
	//echo "SELECT  * FROM property where city_id='".base64_decode($_GET["source"])."' and property_status='Active' and property_transaction_type='sell'";die;
	$strAgent="SELECT  * FROM user where user_company LIKE '%".$_GET["key"]."%' or  user_first_name LIKE '%".$_GET["key"]."%' and  user_status='Active' and   user_type_agent='Yes'";
	$rsAgent=dbQuery(getPagingQueries($strAgent, $rowsPerPage));  
	$pagingLink1=getPaging($strAgent, $rowsPerPage, getAllGetParams(array("page")));
	}else{
	$rowsPerPage=(isset($_GET["row"])) ? (int)$_GET["row"] : 20;
	//echo "SELECT  * FROM property where city_id='".base64_decode($_GET["source"])."' and property_status='Active' and property_transaction_type='sell'";die;
	$strAgent="SELECT  * FROM user where user_company LIKE '%".$_GET["key"]."%' or  user_first_name LIKE '%".$_GET["key"]."%' and  user_status='Active' and   user_type_agent='Yes'";
	$rsAgent=dbQuery(getPagingQueries($strAgent, $rowsPerPage));  
	$pagingLink1=getPaging($strAgent, $rowsPerPage, getAllGetParams(array("page")));
	}
	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?>
<?php echo $seoTitle;?>
<link href="css/style.css" rel="stylesheet" type="text/css" />



</head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<?php if($_GET["show"]=="view" || $_GET["show"]==""){ ?>
<div id="middle">


  <div id="left-panel">
    <h1>Agent  in <strong>U.K</strong> </h1>

    <div id="sale">
<div class="view">
<ul>
<li><a <?php if($_GET["show"]=="view"){ ?> class="select"<?php } ?> href="show-agent.php?show=view&key=<?php echo $_GET["key"]?>"><span>List view</span></a></li>
<li><a <?php if($_GET["show"]=="map"){ ?> class="select"<?php } ?> href="show-agent.php?show=map&key=<?php echo $_GET["map"]?>"><span>Map view</span></a></li>
</ul>
<div class="clear"></div>
</div>
<div class="clear">&nbsp;</div>
<?php 
$i=0;
	while($agentInfo=dbFetchArray($rsAgent)){

	
	if($i%2==0){
	$class="panel";
	}else{
	$class="panel2";
	}


?>

<div class="<?php echo $class;?>">


<div class="agent-logo">

<img src="images/user_images/<?php echo $agentInfo["user_image"]?>" alt="" width="100" height="40" /></div>
<h3>
<a href="contactForProperty.php?agent=<?php echo base64_encode($agentInfo["user_id"])?>"> <?php echo $agentInfo["user_company"]?></a></h3>
<p class="add"><a href="contactForProperty.php?agent=<?php echo base64_encode($agentInfo["user_id"])?>"><?php echo $agentInfo["user_address"]?>,<?php echo showLocality($agentInfo["city_id"])?>,<?php echo showCounty($agentInfo["state_id"])?></a></p>

<p><?php echo $agentInfo["about_me"]?></p>

<p>  <a href="contactForProperty.php?agent=<?php echo base64_encode($agentInfo["user_id"])?>">Contact agent</a>  </p>
<p>Marketed by <?php  echo  $agentInfo["user_first_name"]; ?> Call <?php  if($agentInfo["contact_to_public"]=='Yes'){ echo $agentInfo["user_mobile_number"];}?> (local rate) </p>

<div class="clear"></div>
</div>

<?php $i++; } ?>





<div class="pagination" align="right"><?php echo $pagingLink1;?></div>


</div>





	
</div>
  <div id="right-panel">
  <?php include('includes/right-panel.php');?>

</div>





  <div class="clear"></div>
</div>
<?php }elseif($_GET["show"]=="map"){ ?>
<div id="middle2">
<div class="view">
<ul>
<li><a <?php if($_GET["show"]=="view"){ ?> class="select"<?php } ?> href="show-agent.php?show=view&key=<?php echo $_GET["key"]?>"><span>List view</span></a></li>
<li><a <?php if($_GET["show"]=="map"){ ?> class="select"<?php } ?> href="show-agent.php?show=map&key=<?php echo $_GET["key"]?>"><span>Map view</span></a></li>
</ul>
<div class="clear"></div>
</div>
<div class="clear"></div>
<div id="map-left">
  

<h2> Refine your search </h2>
<form action="" method="get">
<label>Location</label> <input type="text" class="input" name="" /><br />
<label>Radius</label>  <select name="radius" class="text">
        <option value="0">This area only</option>
        <option value="0.25">Within ¼ mile</option>
        <option value="0.5">Within ½ mile</option>
        <option value="1">Within 1 mile</option>
        <option value="3">Within 3 miles</option>
        <option value="5">Within 5 miles</option>
        <option value="10">Within 10 miles</option>
        <option value="15">Within 15 miles</option>
        <option value="20">Within 20 miles</option>
        <option value="30">Within 30 miles</option>
        <option value="40">Within 40 miles</option>
    </select><br />
<label>Type</label> <select name="property_type"  class="text">
        <option value="" selected="selected">Show all</option>
        <option value="houses">Houses</option>
            <option value="flats">Flats</option>
            <option value="commercial">Commercial</option> 
            <option value="land">Land</option> 
    </select><br />
<label>Beds</label> <select name="beds_min"  class="notext">
    <option value="" selected="selected">No min</option>
    <option value="0">Studio</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
</select> 
<select name="beds_min" id="beds_min" class="notext">
    <option value="" selected="selected">No min</option>
    <option value="0">Studio</option>
    <option value="1">1</option>
    <option value="2">2</option>
    <option value="3">3</option>
    <option value="4">4</option>
    <option value="5">5</option>
    <option value="6">6</option>
    <option value="7">7</option>
    <option value="8">8</option>
    <option value="9">9</option>
    <option value="10">10</option>
</select>
 <br />
<label>Price</label> <select class="notext"></select> <select class="notext"></select> <br />
<label>Added</label> <select class="text"></select><br />
<label>Keywords</label> <input class="input" type="text" name="" /><br />
<label>Include</label> <div class="include"> <input type="checkbox" name="" /> New homes<br />
<input type="checkbox" name="" value="" /> Shared ownership homes<br />
<input type="checkbox" name="" /> Retirement homes<br />
<input type="checkbox" name="" />Under offer or sold STC</div>
<div class="clear"></div>
<label>&nbsp;</label> <input type="submit" class="submit" name="" value="Refine Search" />

</form>

  
    <div class="banner">
  <img src="images/banner.jpg" alt="" />  </div>
</div>

  <div id="map-right">
<iframe width="100%" height="670" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=United+Kingdom&amp;aq=3&amp;oq=u&amp;sll=30.066753,79.0193&amp;sspn=5.019055,10.821533&amp;ie=UTF8&amp;hq=&amp;hnear=United+Kingdom&amp;ll=55.378051,-3.435973&amp;spn=13.214095,43.286133&amp;t=m&amp;z=5&amp;output=embed"></iframe>

	
</div>
  

  <div class="clear"></div>
</div>
<?php } ?>

<!--Middle End-->

<!--Fotter Start-->
<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
