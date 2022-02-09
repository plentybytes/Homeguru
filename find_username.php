<?php
include("includes/application.php");


if($_GET['checkid']){
$strProduct="SELECT * FROM user where user_name='".$_GET['checkid']."'";
		$resultProduct=dbQuery($strProduct);
		$cart_item=dbNumRows($resultProduct);
		if($cart_item==0){
			$response="<strong style='color:green;'>Username is valid.</strong>";
 		 }else{
  			$response="<strong style='color:#ff0000;'>Username already exists.</strong>";
  		}

//output the response
echo $response;
}


?>