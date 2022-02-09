<?php 
include('includes/application.php');
$cid=$_GET["reqId"];
if($cid!=''){
if($_SESSION["user"]["id"]!=''){
$row=dbNumRows(dbQuery("select * from favourite_property where user_id='".$_SESSION["user"]["id"]."' and property_id='".$cid."'"));
if($row==0){
dbQuery("insert into favourite_property set user_id='".$_SESSION["user"]["id"]."', property_id='".$cid."'");
echo  "<font color='#339933'>Saved successfully.. </font>";
}else{
 echo "<font color='#FF0000'>Already Saved... </font>";
 }
 }
 else{
 echo "<font color='#FF0000'>Login for Save to favourites </font>";
 }
 }