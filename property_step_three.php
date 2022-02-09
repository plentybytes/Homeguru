<?php 
$seoId=16;
include('includes/application.php');
require("includes/user_application.php");
//echo $_SESSION["source1"];echo base64_decode($_GET["source"]);die;
if($_SESSION["source1"]!=base64_decode($_GET["source"])){
redirect(hrefLink("property_step_one.php"));

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
    if (row_no1<4){
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
    if (row_n<4){
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
<div class="step2">Step 1: List Property </div>
<div class="step2">Step 2: Optional Property Details </div>
<div class="step">Step 3: Contact Details </div>

<div id="tcontent1" style="display:;">
<form action="files/application_file.php?action=property_step_three" method="post" name="step_three" id="step_three">

<label>Name :</label><input type="text" name="contact_person" id="contact_person" class="input" /><br />
 
<label>Mobile Numbers : </label> <input type="text" name="mobile_number[]"  id="mobile_numberq"  class="input" /> &nbsp; <a href="javascript:void(0)" onClick="addRowa('TableMaina','rowe1')" style="text-decoration:none;"><strong>+ Add More</strong></a><br />
<label>  &nbsp;</label>&nbsp;<table width="42%" border="0" style="" cellspacing="0" cellpadding="0" id="TableMaina">
    <!--Headers-->
  
    <tr id="rowe1">
    </tr>
    </table>
	<br />
 <label>Landline Numbers <span>(Optional)</span> : </label> <input type="text" name="landline[]"  id="landlineq" class="input" /> &nbsp; <a href="javascript:void(0)" onClick="addRow('TableMain','row1')" style="text-decoration:none;"><strong>+ Add More</strong></a><br />
<label>  &nbsp;</label>&nbsp;<table width="42%" border="0" style="" cellspacing="0" cellpadding="0" id="TableMain">
    <!--Headers-->
  
    <tr id="row1">
    </tr>
    </table>
	<br />
 <label>Email :</label><input type="text" name="email" class="input" /><br />

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
