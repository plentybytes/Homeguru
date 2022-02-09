<?php
include('includes/application.php');
if(isset($_POST['deleteallsubmit'])){
if (count($_POST['option2'])>0){
	foreach($_POST['option2'] as $key=>$val){
	  
		$tot_property_query=dbQuery("delete from tbl_savetofavorites where property_id=".$val." and user_id=".$_SESSION['user']['id']);
	}
}

header('location:myfavoritelistingdetails.php');	

}
if(isset($_POST['savesubmit']) && $_GET['mode']=="edit"){
  if(!empty($_POST['txtcomment'])){ 
     $id=$_POST['txtpropertyid'];
     $property_note=addslashes($_POST['txtcomment']);
     
     $sqlDataArray=array('property_note'=>$property_note);
     dbPerform("tbl_property_note",$sqlDataArray,"update","property_id=".$id." and user_id=".$_SESSION['user']['id']);
     header('location:notelistingdetails.php');	
   }
  else{
	 echo "please filled up property";  
	  
	}   

}

if(isset($_POST['cancelsubmit']) && $_GET['mode']=="edit"){
  
     header('location:notelistingdetails.php');	
  

}


if($_GET['mode']=="delete"){
		     $id=$_GET['proid'];		
			 
			 $tot_property_query=dbQuery("delete from tbl_property_note where property_id=".$id." and user_id=".$_SESSION['user']['id']);
			
             header('location:notelistingdetails.php');	   	
			} 
			


$proid=base64_decode($_GET['proid']);
$sql="SELECT * FROM(SELECT C.*,D.property_total_price,D.property_description,D.property_images FROM tbl_savetofavorites AS C,
(SELECT  A.*,B.property_images FROM property as A,(SELECT * from property_images GROUP BY property_id) as B WHERE A.property_id=B.property_id) 
AS D WHERE C.property_id=D.property_id) AS E WHERE E.user_id=".$_SESSION['user']['id'];
$strProperty=dbQuery($sql);
//echo dbNumRows($strProperty);





?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' /><meta name='description' content='Search Item show'>
<meta name='keywords' content='' /><title>Search-property</title><link href="css/style.css" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="css/js/all_check.js" type="text/javascript"></script>
</head>

<body>
<?php include('includes/header.php');?>	
<!--Header Start-->
<!--<div id="header">
<div class="main">
<div id="logo"><a href="index.php"><img src="images/homesguru.jpg" alt="" border="0" /></a></div>

<div id="right">

<div id="login-box" class="window">
 <form id="login" name="login" action="files/application_file.php?action=login" method="post" onsubmit="return submitForm()">
 <p>Enter Your Email</p>
<div class="input"><input type="email" required placeholder="Enter Your Email ID" name="user_name" id="user_name" value="" />
<input type="hidden" name="_method" id="_method" value="authentication process"  /></div>
<p>Enter Your Password</p>
<div class="input"><input type="password" required placeholder="********" name="login_password" id="login_password" value="" /></div>
  
 <input type="submit" name="login" class="go"  value="Login">
<strong><a href="forgot-password.php">Forgot password?</a></strong>

 </form>
</div>

<div class="rigster"><a href="register.php">Register</a></div>
<div class="login"><a id="loginimg" onclick="showlogin()" href="#">Sign in</a></div>
 
<div class="clear"></div>

<ul id="menu-drop">
<li ><a href="#" ><span>For Sale</span></a>
<ul>
<li><a href="property.php?shortby=sell">UK property for sale</a></li>
<li><a href="property.php?shortby=new">UK new homes for sale</a></li>
<li><a href="property-agent.php"> UK estate agents</a></li>

</ul>
</li>

<li><a href="#"><span>To Rent</span></a>
<ul>
<li><a href="property-for-rent.php">UK Property to Rent</a></li>
<li><a href="property-agent.php">UK Letting Agents</a></li>


</ul>
</li>

<li><a href="#"><span>Current Values</span></a>
<ul>
<li><a href="property-current-valuation.php">UK Property Values</a></li>

</ul>
</li>

<li><a href="#"><span>Sold Prices</span></a>
<ul>
<li><a href="property-sold-value.php">UK House Prices</a></li>

</ul>
</li>

<li><a href="#"><span>New Homes</span></a>
<ul>
<li><a href="property.php?shortby=new">UK new homes for sale</a></li>

<li><a href="newbuyhome.php">New Buy</a></li>
<li><a href="firstbuy.php">First buy </a></li>
</ul>
</li>

<li class="none"><a href="#"><span>Find Agents</span></a>
<ul>
<li><a href="property-agent.php">UK property for sale</a></li>
<li><a href="property.php?shortby=new">UK new homes for sale</a></li>
<li><a href="property-agent.php"> UK estate agents</a></li>
</ul>
</li>

</ul>

</div>

</div>
</div>-->
<!--Header End-->

<!--Middle Start-->
<div id="middle">


  <div id="left-panel">
    <h1>Listing Details <strong></strong> </h1>

<div id="sale">
<div class="view">

<div class="clear"></div>
</div>
<div class="clear">&nbsp;</div>

<div class="utilsl">
<form name="f2" method="post">
<div class="selectall_ut"><input id="selectall" name="check" type="checkbox" value="" class="second" /><label>Select all</label>  <span> <!--<img src="images/cross.png" width="11" height="11" alt="img" /> Delete notes</span>--><input type="submit" name="deleteallsubmit" value="Delete All"></div>

</div>

<div class="list_part">
		<?php 
	while($resultProperty=dbFetchArray($strProperty)){
	
	$strCommentProperty=dbQuery("SELECT  * FROM property where property_id='".$resultProperty['property_id']."'");
	$num=dbNumRows($strCommentProperty);
	if($num>0){
		$resultCommentProperty=dbFetchArray($strCommentProperty);
		$strLogoProperty=dbQuery("SELECT  * FROM user where user_id='".$resultCommentProperty['user_id']."'");
		$resultLogoProperty=dbFetchArray($strLogoProperty);
	}
	
	
	?>
	<div class="list_part_box">
		<div class="list_part_box_left"><input id="<?php echo $resultProperty['property_id']?>" name="option2[]" type="checkbox" value="<?php echo $resultProperty['property_id']?>" class="second" /> <span>
			<img src="images/property_images/<?php echo $resultProperty['property_images']?>" width="93" height="66" alt="img" /></span></div>
			<div class="list_part_box_mid">

				<p class="price_st"><strong>£<?php echo $resultProperty['property_total_price']?></strong> <span><?php echo substr($resultProperty['property_description'],0,20)?></span> </p>
				<p><a href="#"><?php echo $resultProperty['property_address']?></a></p>
				<!--<p>Listed on--> <?php //echo date("j M Y", strtotime($resultProperty['comment_date']))?><!--<a href="#">Contact agent</a> | <a href="#">Email a friend</a></p>-->

				<!--<div class="noteAdded"><span class="Note_Addeed"><span class="glyphicon glyphicon-file">
					<div class="Note_Addeed_hidden">
						<?php //if($_GET['mode']=="edit" && ($_GET['proid']==$resultProperty['property_id'])){ ?>
						<form name="f1" method="post">
							<div class="Note_Addeed_hidden">
							
								<textarea name="txtcomment" rows="3" cols="50"><?php //echo $resultProperty['property_note'];?></textarea>
								<input type="hidden" name="txtpropertyid" value="<?php //echo $resultProperty['property_id']?>">
							</div>
						
						<div class="link_note"><input type="submit" name="cancelsubmit" value="Cancel">|<input type="submit" name="savesubmit" value="Save"> </div>
						</form>
						<?php //}else{ ?>
						<div class="Note_Addeed_hidden"><?php //echo $resultProperty['property_note'];?></div>
						<div class="link_note"><a href="notelistingdetails.php?mode=delete&proid=<?php //echo $resultProperty['property_id']?>">delete</a> | <a href="notelistingdetails.php?mode=edit&proid=<?php echo $resultProperty['property_id']?>">edit</a></div>
				
						<?php// }?> 
					    
					</div>
				</div>-->
				
				
			</div>
			<?php if(!empty($resultLogoProperty['logo'])){?>
			<div class="list_part_box_right"><img src="images/user_images/<?php echo $resultLogoProperty['user_image']?>" width="100" height="69" alt="img" /></div>
			<?php }?>
		</div>

		<?php  }?> 
	</div>
</div>
</form>

	
</div>
<div class="clear"></div>
</div><!--Middle End-->

<!--Fotter Start-->
<div id="fotter">
<div class="main">
<div class="around">
<h3>Around the site</h3>
<p><p>
	Search for UK Letting Agents Search for property for sale House prices near you Search for property to rent Get removal quotes. Search for proper <a href="content.php?source=12" title="More">[More]</a></p>
</div>

<div class="property">
<h3>Property guides</h3>
<p><p>
	Buying guide<br />
	First-time buyers&#39; guide<br />
	Selling guide<br />
	Renting guide<br />
	Guide to letting property</p>
 <a href="content.php?source=10" title="More">[More]</a></p>
</div>


<div class="house">
<h3>House Price Index.</h3>
<p><p>
	Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever sinc <a href="content.php?source=11" title="More">[More]</a></p>
</div>


<div class="connect">
<h3>Connect us</h3>
<p><a href="#"><img src="images/facebook.jpg" alt="" /> Like us on Facebook</a></p>
<p><a href="#"><img src="images/twitter.jpg" alt="" /> Follow us on Twitter</a></p>
<p><a href="#"><img src="images/you-tube.jpg" alt="" /> Find us on YouTube</a></p>
<p><a href="#"><img src="images/google.jpg" alt="" /> Follow us on Google</a></p>
</div>

<div class="copy">
Copyright &copy; 2013 homesguru.co.uk  All Rights Reserved  <!--Design and Development by: <a href="http://galaxywebtechnology.com" target="_blank">Galaxywebtechnology.com</a>-->
</div>

<div class="clear"></div>
</div>
</div><!--Fotter End-->




</body>
</html>

