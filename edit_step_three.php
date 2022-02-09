<?php 
$seoId=20;
include('includes/application.php');
require("includes/user_application.php");

$strProperty=dbQuery("SELECT * FROM property where user_id='".$_SESSION['user']['id']."' and property_id='".base64_decode($_GET["source"])."'");

	$num=dbNumRows($strProperty);
	if($num==0){
	$messageStack->addMessageSession("Source id not found try again.", "error");
	redirect(hrefLink("property_list.php"));
	
	}else{
	$row=dbFetchArray($strProperty);
	$mobile=explode(",",$row["property_mobile_number"]);  $landline=explode(",",$row["property_contact_numer"]);
	$numMob=count($mobile);
	$leftMob=5 -($numMob);
	 $numLand=count($mobile);
	$leftLand=5 -($numLand);
	//echo "</br>". $leftLand;die;
		}
	?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<?php echo $rsultSeo;?>


<title> <?php echo $userInfo["user_first_name"]."'s ".$rsultSe["seo_title"];?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery.min.js"></script>

<script src="js/jquery.validate.min.js" type="text/javascript"></script>
<script src="js/custom.js" type="text/javascript"></script>
<script language="javascript">
    row_no1=0;
    function addRow(tbl,row){
    //row count
    row_no1++;
    var tick = String(row_no1);
    if (row_no1< <?php echo $leftLand ?> ){
    //Declaring text boxes
    var textbox ='<input type="text" name="landline[]" class="input" />';
   
    //delete button
    var stop = '<a href="javascript:void(0)" style="float:left;text-decoration:none; " onclick="deleteRow(this)"><strong>- Delete</strong></a>';
    //Inserting textboxes into table cells
    var tbl = document.getElementById(tbl);
    var rowIndex = document.getElementById(row).value;
    var newRow = tbl.insertRow(row_no1);
   
	  var newCell = newRow.insertCell(0);
      newCell.innerHTML = textbox;
    //delete button within cell
    var newCell = newRow.insertCell(1);
    newCell.innerHTML = stop;
    }
	else{
	alert("You Only Add 4 Landline Number");
	}
    }
    //Delete Function
    function deleteRow(r)
    {
    var i=r.parentNode.parentNode.rowIndex;
    document.getElementById('TableMain').deleteRow(i);
    }
	row_n=0;
    function addRowa(tbl,row){
    //row count
    row_n++;
    var tick = String(row_n);
    if (row_n< <?php echo $leftMob ?>){
    //Declaring text boxes
    var textbox ='<input type="text" name="mobile_number[]" class="input" />';
   
    //delete button
    var stop = '<a href="javascript:void(0)" style="float:left;text-decoration:none; " onclick="deleteeRow(this)"><strong>- Delete</strong></a>';
    //Inserting textboxes into table cells
    var tbl = document.getElementById(tbl);
    var rowIndex = document.getElementById(row).value;
    var newRow = tbl.insertRow(row_n);
   
	  var newCell = newRow.insertCell(0);
      newCell.innerHTML = textbox;
    //delete button within cell
    var newCell = newRow.insertCell(1);
    newCell.innerHTML = stop;
    }
	else{
	alert("You Only Add 4 Mobile Number");
	}
    }
    //Delete Function
    function deleteeRow(r)
    {
    var i=r.parentNode.parentNode.rowIndex;
    document.getElementById('TableMaina').deleteRow(i);
    }
    </script>
 </head>

<body>
<!--Header Start-->
<?php include('includes/header.php');?>
<!--Header End-->

<!--Middle Start-->
<div id="middle">
<div id="register">
<div class="step2">Step 1: Edit List Property </div>
<div class="step2">Step 2: Edit Optional Property Details </div>
<div class="step">Step 3: Edit Contact Details </div>

<div id="tcontent1" style="display:;">
<form action="files/application_file.php?action=edit_step_three" method="post" name="step_three" id="step_three">

<label>Name :</label><input type="text" name="contact_person" value="<?php echo  $row["property_contact_person"]?>" id="contact_person" class="input" /><br />
 
<label>Mobile Numbers : </label> <?php   $mobile=explode(",",$row["property_mobile_number"]); ?><input type="text" name="mobile_number[]"  id="mobile_numberq" value="<?php echo $mobile[0]?>"  class="input" /> &nbsp; <a href="javascript:void(0)" onClick="addRowa('TableMaina','rowe1')" style="text-decoration:none;"><strong>+ Add More</strong></a><br />
<label>  &nbsp;</label>&nbsp;<table width="42%" border="0" style="" cellspacing="0" cellpadding="0" id="TableMaina">
    <!--Headers-->
  <?php if($mobile[1]!=''){?>
    <tr >
	<td><input type="text" name="mobile_number[]" value="<?php echo $mobile[1]?>" class="input" /></td><td><a href="javascript:void(0)" style="float:left;text-decoration:none; " onclick="deleteeRow(this)"><strong>- Delete</strong></a> </td>
    </tr>
	<?php }if($mobile[2]!=''){ ?>
	<tr >
	<td><input type="text" name="mobile_number[]" value="<?php echo $mobile[2]?>" class="input" /></td><td><a href="javascript:void(0)" style="float:left;text-decoration:none; " onclick="deleteeRow(this)"><strong>- Delete</strong></a> </td>
    </tr>	<?php }if($mobile[3]!=''){ ?>
	<tr i>
	<td><input type="text" name="mobile_number[]" value="<?php echo $mobile[3]?>" class="input" /></td><td><a href="javascript:void(0)" style="float:left;text-decoration:none; " onclick="deleteeRow(this)"><strong>- Delete</strong></a> </td>
    </tr>
<?php }?>
	
    <tr id="rowe1"> 	
    </tr>
    </table>
	<br />
 <label>Landline Numbers <span>(Optional)</span> : </label>  <?php   $landline=explode(",",$row["property_contact_numer"]); ?><input value="<?php echo $landline[0] ?>" type="text" name="landline[]"  id="landlineq" class="input" /> &nbsp; <a href="javascript:void(0)" onClick="addRow('TableMain','row1')" style="text-decoration:none;"><strong>+ Add More</strong></a><br />

<label>  &nbsp;</label>&nbsp;<table width="42%" border="0" style="" cellspacing="0" cellpadding="0" id="TableMain">
    <!--Headers-->
  <?php if($landline[1]!=''){?>
    <tr >
	<td><input type="text" name="landline[]" class="input" value="<?php echo $landline[1]?>"/></td><td><a href="javascript:void(0)" style="float:left;text-decoration:none; " onclick="deleteRow(this)"><strong>- Delete</strong></a> </td>
    </tr>
	<?php }if($landline[2]!=''){ ?>
	<tr >
	<td><input type="text" name="landline[]" class="input" value="<?php echo $landline[2]?>"/></td><td><a href="javascript:void(0)" style="float:left;text-decoration:none; " onclick="deleteRow(this)"><strong>- Delete</strong></a> </td>
    </tr>	<?php }if($landline[3]!=''){ ?>
	<tr >
	<td><input type="text" name="landline[]" class="input" value="<?php echo $landline[3]?>" /></td><td><a href="javascript:void(0)" style="float:left;text-decoration:none; " onclick="deleteRow(this)"><strong>- Delete</strong></a> </td>
    </tr>
<?php }?>
	
	<tr id="row1"></tr>
    </table>
	<br />
 <label>Email :</label><input type="hidden" value="<?php echo $_GET["source"];?>" name="source" /><input type="text" value="<?php echo $row["property_contact_email"]?>" name="email" class="input" /><br />
 	
		<div class="clear">&nbsp;</div>			
<label>&nbsp;</label> <input type="hidden" name="addId" value="<?php echo $_GET["addId"];?>" /><input type="hidden" name="source" value="<?php echo $_GET["source"];?>" /> <input type="hidden" name="_method" value="Add Step three" /><input type="submit" name="" class="submit" value="Submit" />

</form>




</div>


</div>
</div>
<!--Middle End-->

<!--Fotter Start-->
<?php include('includes/footer.php');?>
<!--Fotter End-->

</body>
</html>
