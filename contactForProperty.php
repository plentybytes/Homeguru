<?php $seoId=22;
include('includes/application.php');
if($_GET["proid"])
{
	$strProperty=dbQuery("SELECT  * FROM property where property_id='".base64_decode($_GET["proid"])."'");
	$num=dbNumRows($strProperty);
	if($num>0)
	{
		$resultProperty=dbFetchArray($strProperty);
	}
	else
	{
		redirect(hrefLink("show-property.php","source=".$_GET["source"]));
	}
	}
	elseif($_GET["agent"])
	{
		$strProperty=dbQuery("SELECT  * FROM user where user_id='".base64_decode($_GET["agent"])."'");
	if($num>0)
	{
		$resultProperty=dbFetchArray($strProperty);
	}
	else
	{
		redirect(hrefLink("show-property.php","source=".$_GET["agent"]));
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo $rsultSeo;?>
<?php echo $seoTitle;?>
<script type="text/javascript" src="js/jquery.min.js"></script>

<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/custom.js" type="text/javascript"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" />



</head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">


  <div id="left-panel">
    <h1>Property for sale in <strong><?php echo showLocality(base64_decode($_GET["source"]))?></strong> </h1>
	<div class="details">
	
	

<form name="agent_contact_form" id="agent_contact_form" method="post" class="validate" action="files/application_file.php?action=agent_contact_form&source=<?php echo $_GET["source"]?>">


<h2>Enter details</h2>   
<label for="msg_body_name">Name</label>
<input type="text" name="msg_body_name" value="" id="msg_body_name" class="input" placeholder="Full name, e.g. John Smith"><br />

<label for="msg_body_email">Email</label>
<input type="email" name="msg_body_email" value="" id="msg_body_email" class="input"><br />

 <label for="msg_body_phone">Telephone</label>
<input type="tel" name="msg_body_phone" value="" id="msg_body_phone" class="input"><br />

<label>Type of enquiry</label>

<input type="radio" name="msg_type_of_enquiry"  value="Property request details" checked="checked">
Request details
<input type="hidden" name="_method"  value="agent contact" checked="checked">
<?php if($_GET["proid"]){?>
<input type="hidden" name="proid"  value="<?php echo $resultProperty["property_id"]?>">
<input type="hidden" name="agent"  value="<?php echo $resultProperty["user_id"]?>" >
<?php } ?>
<input type="hidden" name="agent"  value="<?php echo $resultProperty["user_id"]?>" >
<input type="radio" name="msg_type_of_enquiry" value="Organise viewing" >
Arrange viewing
<div class="clear">&nbsp;</div>

<label for="msg_body">Message <em>(Optional)</em></label>
<textarea name="msg_body" id="msg_body" class="textarea" rows="5" cols="20" placeholder="Please include any useful details, i.e. current status, availability for viewings, etc."></textarea> <br />

<div class="clear">&nbsp;</div>

    <label>About me</label>

    <select class="select" name="msg_body_about_me">

        <option value="">Please select:</option>


            <option value="1" >I am a first-time buyer</option>


            <option value="2" >I have a property to sell/let</option>


            <option value="3" >I have an offer on my property</option>


            <option value="4" >I have recently sold</option>


            <option value="5" >I am looking to invest</option>


            <option value="6" >None of the above</option>
    </select>
             <br />
    
    

<label for="msg_body_postcode">Postcode</label>
<input type="text" name="msg_body_postcode" value="" id="msg_body_postcode" class="input"><br />


       
	
<div class="clear">&nbsp;</div>



                  <input type="checkbox" name="msg_send_confirmation" id="msg_send_confirmation" value="true" checked="checked">
  By submitting this form, you accept our <a href="#" target="_blank">Terms of Use</a>.  
             
          <div id="form_contact_buttons">

              <button type="submit" name="contact_agent_submit" id="contact_agent_submit" value="Submit" class="submit"><span>Send message</span></button>

              <input type="hidden" name="lead_type" value="Buyer">
          </div>
         
                          
          
</form>

</div>

	
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
