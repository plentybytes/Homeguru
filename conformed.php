<?php 
	require("includes/application.php");
	$from='info@homesguru.co.uk';
	$siteName=SITE_NAME;
	if($_GET["passkey"]!=''){
	$passkey=$_GET["passkey"];
	$id=base64_decode($_GET["id"]);
		$checkUserStr=dbQuery("SELECT * from  user WHERE verified_code ='".$passkey."'  AND user_status ='Deactive'");
		$adminUser=dbFetchArray(dbQuery("SELECT * from  admin_user WHERE  user_id  ='1'"));
	if(dbNumRows($checkUserStr) == 1){
		$user=dbFetchArray($checkUserStr);
		$userEmail=$user["user_email"];
		$userName=$user["user_first_name"];
		$userId=base64_encode($user["user_id"]);
	dbQuery("update user set user_status ='Active' where user_id='".$user["user_id"]."'");
	$subjects=" Approved by admin department your account";
						$messages="<html>
									<head>
									<title> Approved by admin department your account</title>
									</head>
										<body>
											<table width='100%' cellpadding='2' cellspacing='4' border='0' style='border:1px dashed #009966;'>
											<tr>
													<td style='font-family: Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; padding-bottom:10px;'>Dear  $userName,</td>
												  </tr>
												  <tr>
													<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'> Approved by admin department your account</td>
												  </tr>
												  <tr>
													<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'><strong>User name </strong> :- $userName </td>
												  </tr>
												  <tr>
													<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'><strong> Email address </strong>:- $userEmail</td>
												  </tr>
												 
									  <tr>
										<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;'>Thanks & regared <br />HomeGuru.com</td>
									  </tr>
											</table>
										</body>
									</html>";
						
						$header = "From:  Approved by admin department  <$from>\n";
						$header .= "MIME-Version: 1.0\n";
						$header .= "Return-Path: $siteName<$from>\n";
						$header .= "Content-Type: text/html;\n";
						$header .= "X-Mailer: PHP/" . phpversion();
						mail($userEmail,$subjects,$messages,$header);
						$messageStack->addMessageSession("Thanks, you are approved.", "success");
						redirect(hrefLink("index.php"));
	}
	else{
	$messageStack->addMessageSession("Your conformation link is not valid  this link is already in use  Thanks You !!!.", "error");
	redirect(hrefLink("index.php"));
	
	}
	}
	elseif($_GET["source"]!=''){
	$passkey=base64_decode($_GET["source"]);
	
		$checkUserStr=dbQuery("SELECT * from  user WHERE user_id ='".$passkey."'  AND user_status ='Wait'");
		if(dbNumRows($checkUserStr) == 1){
		$user=dbFetchArray($checkUserStr);
		$userEmail=$user["user_email"];
		$userName=$user["user_first_name"];
	dbQuery("update user set user_status ='Active' where user_id='".$user["user_id"]."'");
	$subjects=" Approved by admin department your account";
						$messages="<html>
									<head>
									<title> Approved by admin department your account</title>
									</head>
										<body>
											<table width='100%' cellpadding='2' cellspacing='4' border='0' style='border:1px dashed #009966;'>
											<tr>
													<td style='font-family: Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; padding-bottom:10px;'>Dear  $userName,</td>
												  </tr>
												  <tr>
													<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'> Approved by admin department your account</td>
												  </tr>
												  <tr>
													<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'><strong>User name </strong> :- $userName </td>
												  </tr>
												  <tr>
													<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'><strong> Email address </strong>:- $userEmail</td>
												  </tr>
												 
									  <tr>
										<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;'>Thanks & regared <br />HomeGuru.com</td>
									  </tr>
											</table>
										</body>
									</html>";
						
						$header = "From:  Approved by admin department  <$from>\n";
						$header .= "MIME-Version: 1.0\n";
						$header .= "Return-Path: $siteName<$from>\n";
						$header .= "Content-Type: text/html;\n";
						$header .= "X-Mailer: PHP/" . phpversion();
						mail($userEmail,$subjects,$messages,$header);
						$messageStack->addMessageSession("Thanks, you are approved.", "success");
						redirect(hrefLink("index.php"));
	}
	else{
	$messageStack->addMessageSession("Your conformation link is not valid  this link is already in use  Thanks You !!!.", "error");
	redirect(hrefLink("index.php"));
	
	}
	}
	?>