<?php 
error_reporting(0);require("../includes/application.php");
	
	
	$action=isset($_GET["action"]) ? $_GET["action"] : "";
	$currentPage=basename($PHP_SELF);
$from=SITE_OWNER_EMAIL_ADDRESS;
	$siteName=SITE_NAME;
	

	
			if($action=="login"){
				if(isset($_POST["_method"]) && ($_POST["_method"] == "authentication process")){
					$loginEmail=dbPrepareInput($_POST["user_name"]);
					$loginPassword=md5($_POST["login_password"]);
					$sql="SELECT * from  user WHERE (user_email ='".dbInput($loginEmail).
					"' or user_name ='".dbInput($loginEmail)."') AND user_password ='".dbInput($loginPassword).
					"' AND user_status ='Active'";
					
					$checkUserQuery=dbQuery($sql);
					
					if(dbNumRows($checkUserQuery) == 1){
						$rsCustomers=dbFetchArray($checkUserQuery);
                         $user=array('id'=> $rsCustomers["user_id"]);
						sessionRegister("user", $user); 
						$checkUserLogs=dbQuery("SELECT * from user_logs WHERE user_id ='".$rsCustomers["user_id"]."'");
						$rsLogs=dbFetchArray($checkUserLogs);
						$totalLogs=$rsLogs["user_number_log"]+1;
						$sqlDataArray=array("user_last_login" => "NOW()", "user_number_log" => $totalLogs);
                        dbPerform("user_logs", $sqlDataArray, "update", "user_id=".$rsLogs["user_id"]);
						$messageStack->addMessageSession("Login successfully.", "success");
						if(!empty($_POST['txturl'])){
						 echo "<script>location.href='".$_POST['txturl']."'</script>";
						 exit;
					    }
						 else
						 redirect(hrefLink("my-account.php"));
						}
						else{
							$messageStack->addMessageSession("Email or Password do not match.", "error");
							redirect(hrefLink("member-login.php?msg=Email or Password do not match"));
						}
					}
				else{
					$messageStack->addMessageSession("Unauthorized action.", "error");
					redirect(hrefLink("member-login.php"));
				}
			}
			elseif($action=="logoff"){
			sessionUnregister("user");
			redirect(hrefLink("index.php"));
			
			}
			
			elseif($action=="register"){
				if(isset($_POST["_method"]) && ($_POST["_method"] == "access request")){
					$name=dbPrepareInput($_POST["name"]);
                    $comp_name=dbPrepareInput($_POST["comp_name"]);
                    $logo=dbPrepareInput($_POST["logo"]);
					$userEmail=dbPrepareInput($_POST["user_email"]);
					$hearAbout=dbPrepareInput($_POST["hear_about"]);
					$check=dbPrepareInput($_POST["check"]);
					$userName=dbPrepareInput($_POST["user_name"]);
					$userPassword=md5($_POST["user_password"]);
                    $userLogo=new fileUpload("logo");
                    $userLogo->setDestination("../images/user_images/");
                    $userLogo->setCategory("logo");
                    if($userLogo->fileParse() && $userLogo->fileSave()) {
                        $logo=dbPrepareInput($userLogo->fileName);
                        //$sqlDataArray["user_image"]=dbPrepareInput($userImage->fileName);
                    }
					$verifyCode=md5(uniqid(rand()));
					if(checkDuplicateEMail($userEmail) == '1' ){
					if(checkDuplicateUserName($userName) == '1'){
						$sqlDataArray=array("user_name" => $userName, "user_first_name" => $name, "verified_code" => $verifyCode,"comp_name" => $comp_name, "logo" => $logo, "receive_mail" => $check, "hear_about_us" => $hearAbout, "user_email" => $userEmail, "user_password" => $userPassword, "user_registration_date" => "NOW()", "user_status" => 'Deactive');
					//print_r($sqlDataArray);
                       // exit;
							dbPerform("user", $sqlDataArray);
						$userId=dbInsertId();
                        $sqlDataArray=array("user_id" => $userId, "user_last_login" => "NOW()", "user_number_log" => '1');
                        dbPerform("user_logs", $sqlDataArray);
						$messageStack->addMessageSession("Thanks for signing up with us, please verify your email address.", "success");
						$subject="New user join us";
						$message="<html>
									<head>
									<title>New user join us</title>
									</head>
										<body>
											<table width='100%' cellpadding='2' cellspacing='4' border='0' style='border:1px dashed #009966;'>
												<tr>
													<td style='font-family: Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; padding-bottom:10px;'>Dear Admin,</td>
												  </tr>
												  <tr>
													<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'>New User have Joined us, Whose  details are as under:- </td>
												  </tr>
												  <tr>
													<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'><strong>User name </strong> :- $name </td>
												  </tr>
												  <tr>
													<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'><strong> Email address </strong>:- $userEmail</td>
												  </tr>
												  <tr>
													<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;'>Thanks & regards <br />homesguru.co.uk</td>
												  </tr>
											</table>
										</body>
									</html>";
						
						$headers = "From:  New user join us <$from>\n";
						$headers .= "MIME-Version: 1.0\n";
						$headers .= "Return-Path: $siteName<$from>\n";
						$headers .= "Content-Type: text/html;\n";
						$headers .= "X-Mailer: PHP/" . phpversion();
						mail($from,$subject,$message,$headers);
						$subjects="Confirmation link to activate your account";
						$messages="<html>
									<head>
									<title>Confirmation link to activate your account</title>
									</head>
										<body>
											<table width='100%' cellpadding='2' cellspacing='4' border='0' style='border:1px dashed #009966;'>
												<tr>
										<td style='font-family: Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; padding-bottom:10px;'>Dear Client,</td>
									  </tr>
									  <tr>
										<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'>Confirmation link to activate your account</td>
									  </tr>
									  <tr>
										<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'>http://homesguru.co.uk/conformed.php?passkey=$verifyCode </td>
									  </tr>
									  <tr>
										<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;'>Thanks & regards <br />homesguru.co.uk</td>
									  </tr>
											</table>
										</body>
									</html>";
						
						$header = "From:  Confirmation link <$from>\n";
						$header .= "MIME-Version: 1.0\n";
						$header .= "Return-Path: $siteName<$from>\n";
						$header .= "Content-Type: text/html;\n";
						$header .= "X-Mailer: PHP/" . phpversion();
						mail($userEmail,$subjects,$messages,$header);
						$messageStack->addMessageSession("Thanks for join us. confirmation link send to your mail address.", "success");
					
					}else{
						$messageStack->addMessageSession("This User Name already exist with this User Name try another.", "error");
					}
				}
					else{
						$messageStack->addMessageSession("The user already exist with this email id.", "error");
					}
					redirect(hrefLink("index.php"));
				}else{
					$messageStack->addMessageSession("Unauthorized action.", "error");
					redirect(hrefLink("index.php"));
				}
			}	
			elseif($action=="contactus"){
				if(isset($_POST["_method"]) && ($_POST["_method"] == "request")){
					$manageName=dbPrepareInput($_POST["manage_contactus_name"]);
					$manageEmail=dbPrepareInput($_POST["manage_contactus_email"]);
					$manageCountry=dbPrepareInput($_POST["manage_contactus_country"]);
					$manageCity=dbPrepareInput($_POST["manage_contactus_city"]);
					$manageMessage=dbPrepareInput($_POST["manage_contactus_message"]);
					$sqlDataArray=array("manage_contactus_name" => $manageName, "manage_contactus_email" => $manageEmail, "manage_contactus_country" => $manageCountry, "manage_contactus_city" => $manageCity, "manage_contactus_message" => $manageMessage, "manage_contactus_created" => "NOW()", "manage_contactus_status" => '1');
						
						dbPerform("manage_contactus", $sqlDataArray);	
						$to="vikas521990@gmail.com";
						$subject="New user join us";
						$message="<html>
									<head>
									<title>New user join us</title>
									</head>
										<body>
											<table width='100%' cellpadding='2' cellspacing='4' border='0' style='border:1px dashed #009966;'>
												<tr>
													<td style='font-family: Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; padding-bottom:10px;'>Dear Admin,</td>
												  </tr>
												  <tr>
													<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'>New user join us here is some details of user</td>
												  </tr>
												  <tr>
													<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'><strong>User name </strong> :- $userFirstName $userLastName</td>
												  </tr>
												  <tr> 
													<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'><strong>Contact number</strong> :- $userPersonalContactNumber</td>
												  </tr>
												  <tr>
													<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'><strong> Email address </strong>:- $userEmail</td>
												  </tr>
												  <tr>
													<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;'>Thanks & regared <br />xanmar.com</td>
												  </tr>
											</table>
										</body>
									</html>";
						
						$headers = "From:  New user join us <$from>\n";
						$headers .= "MIME-Version: 1.0\n";
						$headers .= "Return-Path: $siteName<$from>\n";
						$headers .= "Content-Type: text/html;\n";
						$headers .= "X-Mailer: PHP/" . phpversion();
						mail($to,$subject,$message,$headers);
					$messageStack->addMessageSession("Your Query Submit successfully.", "success");
					redirect(hrefLink("contact-us.php"));
					}
			
			}	
			elseif($action=="password"){
				if(isset($_POST["_method"]) && ($_POST["_method"]=="password request")){
					$requestEmailAddress=dbPrepareInput($_POST["email_address"]);
					$requestCurrentPassword=md5($_POST["current_password"]);
					$requestNewPassword=md5($_POST["new_password"]);
					$userPasswordQuery=dbQuery("SELECT * from  user WHERE user_email ='".dbInput($requestEmailAddress)."' AND user_password ='".dbInput($requestCurrentPassword)."' AND user_status ='Activate'");
						if(dbNumRows($userPasswordQuery)==1){
							dbQuery("update user set  user_password='".dbInput($requestNewPassword)."' WHERE user_email ='".dbInput($requestEmailAddress)."' AND user_password ='".dbInput($requestCurrentPassword)."' AND user_status ='Activate'");
							$messageStack->addMessageSession("Your password has been changed successfully.", "success");
							}else{
								$messageStack->addMessageSession("Your old password is not matched .", "error");
							}
					}else{
					$messageStack->addMessage("Unauthorized action.", "error");
				}
				redirect(hrefLink("change-password.php"));
			}
			elseif($action=="change-password"){
				if(isset($_POST["_method"]) && ($_POST["_method"]=="password request")){
					$userId=$_SESSION["user"]["id"];
					$requestCurrentPassword=md5($_POST["old_pwd"]);
					$requestNewPassword=md5($_POST["new_pwd"]);
					//echo "old=".$requestCurrentPassword." New".$requestNewPassword;die;
					//echo "SELECT * from  user WHERE user_id ='".$userId."' AND user_password ='".$requestCurrentPassword."' AND user_status ='Active'";die;
					$userPasswordQuery=dbQuery("SELECT * from  user WHERE user_id ='".$userId."' AND user_password ='".$requestCurrentPassword."' ");
						if(dbNumRows($userPasswordQuery)==1){
						$userIn=dbFetchArray($userPasswordQuery);
							dbQuery("update user set  user_password='".$requestNewPassword."' WHERE user_id ='".$userIn["user_id"]."'");
							$messageStack->addMessageSession("Your password has been changed successfully.", "success");
							}else{
								$messageStack->addMessageSession("Your old password is not matched .", "error");
							}
					}else{
					$messageStack->addMessage("Unauthorized action.", "error");
				}
				redirect(hrefLink("my-account.php"));
			}
			elseif($action=="forgot_password"){
				if(isset($_POST["_method"]) && ($_POST["_method"]=="forgot password")){
						
					
					$requestEmailAddress=$_POST["user_name"]; 	
					$verifyCode=md5(uniqid(rand()));
					$strQuery=dbQuery("SELECT * from  user WHERE user_email ='".$requestEmailAddress."' OR user_name ='".$requestEmailAddress."' AND user_status ='Active'");
					$checkForgetQuery=dbNumRows($strQuery);
					if($checkForgetQuery == 1){
						$resultUser=dbFetchArray($strQuery);
						$email1=base64_encode($resultUser["user_email"]);
						$email=$resultUser["user_email"];
						$userName=$resultUser["user_name"];
						dbQuery("update user set  verified_code='".$verifyCode."' WHERE user_id ='".$resultUser["user_id"]."' AND user_status ='Active'");
						$subjects= "Recovering forgot password link to your account";
						$messages="<html>
									<head>
									<title>Recovering forgot password link to activate your account</title>
									</head>
										<body>
											<table width='100%' cellpadding='2' cellspacing='4' border='0' style='border:1px dashed #009966;'>
												<tr>
										<td style='font-family: Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; padding-bottom:10px;'>Dear sir,</td>
									  </tr>
									  <tr>
										<td style='font-family: Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; padding-bottom:10px;'>User name :- $userName</td>
									  </tr>
									  <tr>
										<td style='font-family: Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold; padding-bottom:10px;'>Email address :- $email</td>
									  </tr>
									
									  <tr>
										<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'>Recovering forgot password link to activate your account</td>
									  </tr>
									  <tr>
										<td style='font-family:Arial, Helvetica, sans-serif; font-size:13px;'>http://homesguru.co.uk/recovering-password.php?passkey=$verifyCode&id=$email1 </td>
									  </tr>
									  <tr>
										<td style='font-family:Verdana, Arial, Helvetica, sans-serif; font-size:13px; font-weight:bold;'>Thanks & regared <br />homeguru.com</td>
									  </tr>
											</table>
										</body>
									</html>";
						
						$header = "From:  Recovering paasword link <$from>\n";
						$header .= "MIME-Version: 1.0\n";
						$header .= "Return-Path: $siteName<$from>\n";
						$header .= "Content-Type: text/html;\n";
						$header .= "X-Mailer: PHP/" . phpversion();
						mail($email,$subjects,$messages,$header);
					$messageStack->addMessageSession("Your new password link has been sent to your mail aadress successfully.", "success");
					redirect(hrefLink("login.php"));
					}else{
						$messageStack->addMessageSession("Please enter correct username or email aadress.", "error");
						redirect(hrefLink("forgot.php"));
					}
					
				}
				else{
					$messageStack->addMessage("Unauthorized action.", "error");
					redirect(hrefLink("forgot.php"));
					}
				}
			elseif($action=="recover-password"){
				if(isset($_POST["_method"]) && ($_POST["_method"]=="recovering process")){
					$code=dbPrepareInput($_POST["passkey"]);
					$id=$_POST["id"];
					$uid=dbPrepareInput(base64_decode($_POST["id"]));
					$requestNewPassword=md5($_POST["new_password"]);
					$userPasswordQuery=dbQuery("SELECT * from  user WHERE verified_code='".$code."' and user_email='".$uid."'");
						if(dbNumRows($userPasswordQuery)==1){
							$userInfo=dbFetchArray($userPasswordQuery);
							dbQuery("update user set  user_password='".dbInput($requestNewPassword)."',verified_code='verified' WHERE user_id ='".$userInfo["user_id"]."' AND user_status ='Active'");
							$messageStack->addMessageSession("Your password has been changed successfully.", "success");
							redirect(hrefLink("index.php"));
							}else{
								$messageStack->addMessageSession("Your code not matched try again .", "error");
								redirect(hrefLink("recovering-password.php","passkey=$code&id=$id"));
							}
					}else{
					$messageStack->addMessage("Unauthorized action.", "error");
					redirect(hrefLink("recovering-password.php","passkey=$code&id=$id"));
				}
				
			}
			elseif($action=="recover-step-password"){
				if(isset($_POST["_method"]) && ($_POST["_method"]=="recover code")){
					$code=dbPrepareInput($_POST["code"]);
					$userPasswordQuery=dbQuery("SELECT * from user WHERE user_verify_code='".$code."'");
						if(dbNumRows($userPasswordQuery)==1){
							$userInfo=dbFetchArray($userPasswordQuery);
							$uid=$userInfo["user_id"];
							$codeing=$userInfo["user_verify_code"];
							$messageStack->addMessageSession("Your code matched changed your password","success");
							redirect(hrefLink("recover.php","uid=$uid&code=$codeing"));
							}else{
								$messageStack->addMessageSession("Your code not matched try again .", "error");
								redirect(hrefLink("recover-step.php"));
							}
					}else{
					$messageStack->addMessage("Unauthorized action.", "error");
					redirect(hrefLink("recover-step.php"));
				}
				
			}
			elseif($action=="forgot-password"){
				if(isset($_POST["_method"]) && ($_POST["_method"]=="reset password request")){
					$requestEmailAddress=dbPrepareInput($_POST["request_email"]);
						$check=checkDuplicateMember($requestEmailAddress);
						if($check==0){
							$code=createRandomValue(5);
							$strUser=dbQuery("select * from user WHERE user_email ='".dbInput($requestEmailAddress)."'  and user_status ='Active'");
							$userInfo=dbFetchArray($strUser);
							$name=$userInfo["user_first_name"];
							$codeno=$userInfo["user_id"];
							$emailAdd=$userInfo["user_email"];
							dbQuery("update user set  user_verify_code='$code' WHERE user_email ='".$userInfo["user_email"]."' and user_status ='Active'");
							$subjects="Reset Password Link";
							$messages="<html>
<head>
<title>Reset Password Link</title>
</head>
<body>
<table border='0' cellpadding='0' cellspacing='0'>
  <tbody>
    <tr>
      <td><table width='620' height='19' cellpadding='0' cellspacing='0' bgcolor='#009999'>
          <tbody >
            <tr >
              <td ><a href='https://www.urwom.com/urwom/recover.php?uid=$codeno&code=$code' style='color:#FFFFFF; text-decoration:none;' target='_blank'><strong>Ourbook</strong></a></td>
            </tr>
          </tbody>
        </table>
        <table border='0' cellpadding='0' cellspacing='0' width='620px'>
          <tbody>
            <tr>
              <td><table cellpadding='0' cellspacing='0' width='620px'>
                  <tbody>
                    <tr>
                      <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tbody>
                            <tr>
                              <td><table cellpadding='0' cellspacing='0'>
                                  <tbody>
                                    <tr>
                                      <td>Hi $name,<br />
                                        <br />
                                        You recently asked to reset your ourbook password.<a href='https://www.urwom.com/urwom/recover.php?uid=$codeno&;code=$code' target='_blank'><br />
                                        Click here to change your password.</a><br />
                                        <br />
                                        Alternatively, you can enter the following password reset code:</td>
                                    </tr>
                                    <tr>
                                      <td><div>$code</div></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                    <tr>
                      <td><table border='0' cellpadding='0' cellspacing='0'>
                          <tbody>
                            <tr>
                              <td><table cellpadding='0' cellspacing='0'>
                                  <tbody>
                                    <tr>
                                      <td><table cellpadding='0' cellspacing='0'>
                                          <tbody>
                                            <tr>
                                              <td></td>
                                            </tr>
                                          </tbody>
                                        </table></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
          </tbody>
        </table>
        <table border='0' cellpadding='0' cellspacing='0'>
          <tbody>
            <tr>
              <td>This message was sent to <a href='mailto:$emailAdd' target='_blank'>$emailAdd</a> at your request.</td>
            </tr>
          </tbody>
        </table></td>
    </tr>
  </tbody>
</table>
</body>
</html>
";
						
						$header = "From:  Reset Password code <$from>\n";
						$header .= "MIME-Version: 1.0\n";
						$header .= "Return-Path: $siteName<$from>\n";
						$header .= "Content-Type: text/html;\n";
						$header .= "X-Mailer: PHP/" . phpversion();
						mail($emailAdd,$subjects,$messages,$header);
						
						
							$messageStack->addMessageSession("We sent you an email with a 5 digit confirmation code.", "success");
							redirect(hrefLink("recover-step.php"));
							}else{
								$messageStack->addMessageSession("This email address not found .", "error");
								redirect(hrefLink("forget_password.php"));
							}
					}else{
					$messageStack->addMessage("Unauthorized action.", "error");
					redirect(hrefLink("forget_password.php"));
				}
				
			}
			elseif($action=="update-profile"){
				if(isset($_POST["_method"]) && ($_POST["_method"]=="update account")){
					
					$userId=$_SESSION['user']['id'];
					$userFirstName=dbPrepareInput($_POST["name"]);
					$public=dbPrepareInput($_POST["public"]);
					$aboutMe=dbPrepareInput($_POST["about_me"]);
					$userAddress=dbPrepareInput($_POST["user_address"]);
					$stateId=dbPrepareInput($_POST["state_id"]);
					$cityId=dbPrepareInput($_POST["city_id"]);
					$userLastName=dbPrepareInput($_POST["user_last_name"]);
					$userMobileNumber=dbPrepareInput($_POST["user_number"]);
					$userType=dbPrepareInput($_POST["Agent"]);   
					$userCompany=dbPrepareInput($_POST["user_company"]); 
					$Buyer=dbPrepareInput($_POST["Buyer"]); 
					$userTypeOwner=dbPrepareInput($_POST["Owner"]);   
					$sqlDataArray=array("user_company" => $userCompany,"city_id" => $cityId,"user_type_buyer" => $Buyer,"user_type_owner" => $userTypeOwner,"user_type_agent" => $userType,"state_id" => $stateId,"user_address" => $userAddress, "contact_to_public" => $public, "about_me" => $aboutMe, "user_first_name" => $userFirstName,  "user_mobile_number" => $userMobileNumber,  "modified" => "NOW()");
					dbPerform("user", $sqlDataArray, "update", "user_id=".(int)$userId);
					$messageStack->addMessageSession("Your account has been successfully updated.", "success");
					redirect(hrefLink("my-account.php"));
					}else{
					$messageStack->addMessageSession("Unauthorized action.", "error");
					redirect(hrefLink("my-account.php"));
					}
				}
			elseif($action=="upload_pic"){
				if(isset($_POST["_method"]) && ($_POST["_method"]=="update picture")){
					
					$userId=$_SESSION['user']['id'];
					
						$userImage=new fileUpload("upload_file");
						$userImage->setDestination("../images/user_images/");
						$userImage->setCategory("user_image");
						if($userImage->fileParse() && $userImage->fileSave()) {
						$sqlDataArray["user_image"]=dbPrepareInput($userImage->fileName);
						}
					dbPerform("user", $sqlDataArray, "update", "user_id=".(int)$userId);
					
					$messageStack->addMessageSession("Your account has been successfully updated.", "success");
					redirect(hrefLink("my-account.php"));
					}else{
					$messageStack->addMessageSession("Unauthorized action.", "error");
					redirect(hrefLink("my-account.php"));
					}
					
				}
			elseif($action=="property_step_one"){
				if(isset($_POST["_method"]) && ($_POST["_method"]=="Add Property")){
					
					$userId=$_SESSION['user']['id'];
					$ownerType='User';
					$propertyCategoryId=dbPrepareInput($_POST["property_category_id"]);
					$propertyTransactionType=dbPrepareInput($_POST["property_transaction_type"]);
					if($propertyTransactionType=='sell'){
						$proChangeType='Unsold';
					}else{
					$proChangeType='Rentable';
					}
					$propertyType=dbPrepareInput($_POST["property_type"]);
					$stateId=dbPrepareInput($_POST["state_id"]);
					$cityId=dbPrepareInput($_POST["city_id"]);
					$propertyTotalPrice=dbPrepareInput($_POST["property_total_price"]);
					$propertyBedrooms=dbPrepareInput($_POST["property_bedrooms"]);
					$propertyBathrooms=dbPrepareInput($_POST["property_bathrooms"]);
					$propertyArea=dbPrepareInput($_POST["property_area"]." ".$_POST["unit"]);
					$propertyFloorNumber=dbPrepareInput($_POST["property_floor_number"]);
					$propertyDescription=dbPrepareInput($_POST["property_description"]);
                    $propertyHouse=dbPrepareInput($_POST["house_no"]);
					$verifyCode=md5(uniqid(rand()));//$cityId=dbPrepareInput($_POST["addr"]);
                                                                        $addr=explode('|',base64_decode($_POST['addr']));
                                                                        $postcode=dbPrepareInput($_POST["postal_id"]);$postal_id=$addr[0];
                                                                        $propertyAddress=$addr[1];   if(!$propertyAddress&&count($_POST["new_addr"])){$propertyAddress=dbPrepareInput(implode(' ',$_POST["new_addr"]));}
                                                                        $_SESSION['postcode']=$postcode; $postcode=str_replace(' ','',$postcode);
					$sqlDataArray=array("user_id" => $userId, "property_owner_type" => $ownerType,"house_no" => $propertyHouse,"property_change_status" => $proChangeType, "property_area" => $propertyArea, "property_category_id" => $propertyCategoryId, "property_transaction_type" => $propertyTransactionType, "property_type" => $propertyType, "state_id" => $stateId,  "city_id" => $cityId, "property_total_price" => $propertyTotalPrice,"property_postal_code" => $postcode,"postal_id"=>$postal_id, "property_address" => $propertyAddress,  "property_bedrooms" => $propertyBedrooms, "property_bathrooms" => $propertyBathrooms, "property_floor_number" => $propertyFloorNumber, "property_description" => $propertyDescription,  "property_created_date" => "NOW()");
                    //echo $new_addr[0];
                    //print_r($sqlDataArray);
                    //exit;
                    dbPerform("property", $sqlDataArray);
					$sourceq=dbInsertId();
					$_SESSION["source1"]=$sourceq;
					$source=base64_encode($sourceq);
					redirect(hrefLink("property_step_two.php","source=$source&step=two&addId=$verifyCode"));
				}else{
					$messageStack->addMessageSession("Unauthorized action.", "error");
					redirect(hrefLink("property_step_one.php"));
					}
					
				}
			elseif($action=="edit_step_one"){
				$propertyId=dbPrepareInput($_POST["source"]);
				if(isset($_POST["_method"]) && ($_POST["_method"]=="Add Property")){
					
					$propertyCategoryId=dbPrepareInput($_POST["property_category_id"]);
					$propertyTransactionType=dbPrepareInput($_POST["property_transaction_type"]);
					$propertyType=dbPrepareInput($_POST["property_type"]);
					$stateId=dbPrepareInput($_POST["state_id"]);
					$cityId=dbPrepareInput($_POST["city_id"]);
					$propertyTotalPrice=dbPrepareInput($_POST["property_total_price"]);
					$propertyBedrooms=dbPrepareInput($_POST["property_bedrooms"]);
					$propertyBathrooms=dbPrepareInput($_POST["property_bathrooms"]);
					$propertyArea=dbPrepareInput($_POST["property_area"]." ".$_POST["unit"]);
					$propertyFloorNumber=dbPrepareInput($_POST["property_floor_number"]);
					$propertyDescription=dbPrepareInput($_POST["property_description"]);
					$verifyCode=md5(uniqid(rand()));
					$sqlDataArray=array("property_owner_type" => $ownerType, "property_area" => $propertyArea, "property_category_id" => $propertyCategoryId, "property_transaction_type" => $propertyTransactionType, "property_type" => $propertyType, "state_id" => $stateId,  "city_id" => $cityId, "property_total_price" => $propertyTotalPrice, "property_bedrooms" => $propertyBedrooms, "property_bathrooms" => $propertyBathrooms, "property_floor_number" => $propertyFloorNumber, "property_description" => $propertyDescription,  "property_created_date" => "NOW()");
						$alue=dbPerform("property", $sqlDataArray, "update", "property_id =".(int)base64_decode($propertyId));
		
					redirect(hrefLink("edit_step_two.php","source=$propertyId"));
				}else{
					$messageStack->addMessageSession("Unauthorized action.", "error");
					redirect(hrefLink("edit_step_one.php","source=$propertyId"));
					}
					
				} 
				
		//	prperty Steping two Start Here 
			
			elseif($action=="property_step_two"){
			$propertyId=dbPrepareInput($_POST["source"]);
				if(isset($_POST["_method"]) && ($_POST["_method"]=="Add Step Two") && (base64_decode($_POST["source"])==$_SESSION["source1"])){
					
					$userId=$_SESSION['user']['id'];
				
					$propertyAmenties=dbPrepareInput(implode(",",$_POST["amenities"]));
					$landmarks=dbPrepareInput($_POST["shopping"].",".$_POST["school"].",".$_POST["hospital"].",".$_POST["atm"]);
					$propertyTotalFloorNumber=dbPrepareInput($_POST["property_total_floor_number"]);
					$propertylatitude=dbPrepareInput($_POST["lat"]);
					$propertylongitude=dbPrepareInput($_POST["lag"]);
					$propertyConstruction=dbPrepareInput($_POST["property_construction"]);
					$propertyFurnishing=dbPrepareInput($_POST["property_furnishing"]);
					$propertyDirectionalFacing=dbPrepareInput($_POST["property_directional_facing"]);
					$propertyOwnershipType=dbPrepareInput($_POST["property_ownership_type"]);
					$verifyCode=dbPrepareInput($_POST["addId"]);
					$propertyAddress=dbPrepareInput($_POST["location13"]);
					$postalCade=dbPrepareInput($_POST["postal_cade"]);
					//echo $propertyId;die;
					$sqlDataArray=array("property_longitude" => $propertylongitude, "property_latitude" => $propertylatitude, "property_total_floor_number" => $propertyTotalFloorNumber, "property_construction" => $propertyConstruction, "property_furnishing" => $propertyFurnishing, "property_directional_facing" => $propertyDirectionalFacing,  "property_ownership_type" => $propertyOwnershipType, "	property_amenties" => $propertyAmenties, "property_landmarks" => $landmarks);			
					dbPerform("property", $sqlDataArray, "update", "property_id =".(int)base64_decode($propertyId));
					$proImage=count($_FILES["property_images"]["name"]);
					for($j=0;$j<$proImage;$j++)
					{ 
						$actual_filename = basename($_FILES['property_images']['name'][$j]);
						if($actual_filename!=''){
						$filename=time().$actual_filename;
						dbQuery("insert into property_images set property_id='".$_SESSION["source1"]."',property_images='".$filename."',property_file_type='image'");
						if (move_uploaded_file($_FILES['property_images']['tmp_name'][$j], "../images/property_images/$filename")) {
					   // ...
						}	
						}
					}
					$proImage=count($_FILES["property_video"]["name"]);
					for($j=0;$j<$proImage;$j++)
					{ 
						$actual_filename = basename($_FILES['property_video']['name'][$j]);
						if($actual_filename!=''){
						$filename=time().$actual_filename;
						dbQuery("insert into property_images set property_id='".$_SESSION["source1"]."',property_images='".$filename."',property_file_type='video'");
						if (move_uploaded_file($_FILES['property_video']['tmp_name'][$j], "../images/property_video/$filename")) {
					   // ...
						}	
						}
					}	
						$source=$_POST["source"];
						redirect(hrefLink("property_step_three.php","source=$source&step=three&addId=$verifyCode"));
			
				
				}else{
					$messageStack->addMessageSession("Unauthorized action.", "error");
					redirect(hrefLink("property_step_two.php","source=$source&step=three&addId=$verifyCode"));
					}
					
				}
			elseif($action=="edit_step_two"){
			$propertyId=dbPrepareInput($_POST["source"]);
				if(isset($_POST["_method"]) && ($_POST["_method"]=="Add Step Two")){
					
					$userId=$_SESSION['user']['id'];
					$propertyAddress=dbPrepareInput($_POST["property_address"]);
					$propertyAmenties=dbPrepareInput(implode(",",$_POST["amenities"]));
					$landmarks=dbPrepareInput($_POST["shopping"].",".$_POST["school"].",".$_POST["hospital"].",".$_POST["atm"]);
					$propertyTotalFloorNumber=dbPrepareInput($_POST["property_total_floor_number"]);
					$propertyConstruction=dbPrepareInput($_POST["property_construction"]);
					$propertyFurnishing=dbPrepareInput($_POST["property_furnishing"]);
					$propertyDirectionalFacing=dbPrepareInput($_POST["property_directional_facing"]);
					$propertyOwnershipType=dbPrepareInput($_POST["property_ownership_type"]);
					$verifyCode=dbPrepareInput($_POST["addId"]);
					$sqlDataArray=array("property_total_floor_number" => $propertyTotalFloorNumber,"property_address" => $propertyAddress, "property_construction" => $propertyConstruction, "property_furnishing" => $propertyFurnishing, "property_directional_facing" => $propertyDirectionalFacing,  "property_ownership_type" => $propertyOwnershipType, "	property_amenties" => $propertyAmenties, "property_landmarks" => $landmarks);			
					dbPerform("property", $sqlDataArray, "update", "property_id =".(int)base64_decode($propertyId));
					$proImage=count($_FILES["property_images"]["name"]);
					for($j=0;$j<$proImage;$j++)
					{ 
						$actual_filename = basename($_FILES['property_images']['name'][$j]);
						if($actual_filename!=''){
						$filename=time().$actual_filename;
						dbQuery("insert into property_images set property_id='".base64_decode($propertyId)."',property_images='".$filename."',property_file_type='image'");
						if (move_uploaded_file($_FILES['property_images']['tmp_name'][$j], "../images/property_images/$filename")) {
					   // ...
						}	
						}
					}
					$proImage=count($_FILES["property_video"]["name"]);
					for($j=0;$j<$proImage;$j++)
					{ 
						$actual_filename = basename($_FILES['property_video']['name'][$j]);
						if($actual_filename!=''){
						$filename=time().$actual_filename;
						dbQuery("insert into property_images set property_id='".base64_decode($propertyId)."',property_images='".$filename."',property_file_type='video'");
						if (move_uploaded_file($_FILES['property_video']['tmp_name'][$j], "../images/property_video/$filename")) {
					   // ...
						}	
						}
					}	
						
						redirect(hrefLink("edit_step_three.php","source=$propertyId"));
			
				
				}else{
					$messageStack->addMessageSession("Unauthorized action.", "error");
					redirect(hrefLink("edit_step_two.php","source=$propertyId"));
					}
					
				}
			elseif($action=="property_step_three"){
				if(isset($_POST["_method"]) && ($_POST["_method"]=="Add Step three") && (base64_decode($_POST["source"])==$_SESSION["source1"])){
					
					$userId=$_SESSION['user']['id'];
				
					$landline=dbPrepareInput(implode(",",$_POST["landline"]));
					$mobileNumber=dbPrepareInput(implode(",",$_POST["mobile_number"]));
					$contactPerson=dbPrepareInput($_POST["contact_person"]);
					$propertyOwnershipType=dbPrepareInput($_POST["email"]);
					$verifyCode=dbPrepareInput($_POST["addId"]);
					$sqlDataArray=array("property_contact_person" => $contactPerson, "property_contact_numer" => $landline, "property_mobile_number" => $mobileNumber, "property_contact_email" => $email, "property_status"=>'Deactive');			
					dbPerform("property", $sqlDataArray, "update", "property_id =".(int)$_SESSION["source1"]);
					unset($_SESSION["source1"]);
						redirect(hrefLink("property_list.php"));
			
				
				}else{
					$messageStack->addMessageSession("Unauthorized action.", "error");
					redirect(hrefLink("property_step_three.php"));
					}
					
				}
			elseif($action=="edit_step_three"){
				$propertyId=dbPrepareInput($_POST["source"]);
				if(isset($_POST["_method"]) && ($_POST["_method"]=="Add Step three")){
				
				
					$landline=dbPrepareInput(implode(",",$_POST["landline"]));
					$mobileNumber=dbPrepareInput(implode(",",$_POST["mobile_number"]));
					$contactPerson=dbPrepareInput($_POST["contact_person"]);
					$propertyOwnershipType=dbPrepareInput($_POST["email"]);
					$verifyCode=dbPrepareInput($_POST["addId"]);
					$sqlDataArray=array("property_contact_person" => $contactPerson, "property_contact_numer" => $landline, "property_mobile_number" => $mobileNumber, "property_contact_email" => $email, "property_status"=>'Deactive');			
					dbPerform("property", $sqlDataArray, "update", "property_id =".(int)base64_decode($propertyId));
					redirect(hrefLink("property_list.php"));
			
				
				}else{
					$messageStack->addMessageSession("Unauthorized action.", "error");
					redirect(hrefLink("property_step_three.php"));
					}
					
				}
			elseif($action=="agent_contact_form"){
					if(isset($_POST["_method"]) && ($_POST["_method"]=="agent contact")){
						$proid=dbPrepareInput($_POST["proid"]);
						$userId=dbPrepareInput($_POST["agent"]);
						$msgBodyName=dbPrepareInput($_POST["msg_body_name"]);
						$msgBodyEmail=dbPrepareInput($_POST["msg_body_email"]);
						$msgBodyPhone=dbPrepareInput($_POST["msg_body_phone"]);
						$msgTypeOfEnquiry=dbPrepareInput($_POST["msg_type_of_enquiry"]);
						$msgBody=dbPrepareInput($_POST["msg_body"]);
						$msgBodyAboutMe=dbPrepareInput($_POST["msg_body_about_me"]);
						$AboutMe=showBodyAboutMe($msgBodyAboutMe);
						
						$msgBodyPostcode=dbPrepareInput($_POST["msg_body_postcode"]);
						$msgBodyAddress=dbPrepareInput($_POST["msg_body_address"]);
						$msgBodyAskanagent=dbPrepareInput($_POST["msg_body_askanagent"]);
						$sqlDataArray=array("user_id" => $userId,"property_id" => $proid, "msg_body" => $msgBody,  "msg_body_about_me" => $msgBodyAboutMe, "msg_body_postcode" => $msgBodyPostcode, "msg_body_postcode" => $msgBodyPostcode,"msg_body_address" => $msgBodyAddress, "msg_body_askanagent" => $msgBodyAskanagent, "msg_body_name" => $msgBodyName, "msg_body_email" => $msgBodyEmail, "msg_body_phone" => $msgBodyPhone, "msg_type_of_enquiry" => $msgTypeOfEnquiry, "msg_created" => "NOW()");	
						$userResult=dbFetchArray(dbQuery("SELECT * FROM user WHERE user_id=".$userId));		
						$userProperty=dbFetchArray(dbQuery("SELECT * FROM property WHERE property_id=".$proid));		
						dbPerform("contact_to_agent", $sqlDataArray);
						$VisiterSubject="Enquiry successfully submit to agent.";
						$VisiterContent="hello ,<br><strong>$msgBodyName</strong>
							Your enquiry send to agent  shortly agent get back to you .<br>
						<strong>	Here your details submit:</strong><br>
						<strong>Email address: </strong>$msgBodyEmail <br>
							<strong>Contact number:</strong> $msgBodyPhone <br>
							<strong>Enquiry Type: </strong>$msgTypeOfEnquiry <br>
								<strong>About me : </strong>$AboutMe <br>
							<strong>Enquiry By $msgBodyName :</strong> $msgBody <br>
						<strong>Address:</strong> $msgBodyAddress <br>
							<a href='http://homesguru.co.uk/'> 
							  <img src='http://homesguru.co.uk/images/homesguru.jpg' alt='Homesguru' width='196' height='43' />
							</a>";
						$adminSubject="Enquiry successfully submit to agent.";
						$adminContent="hello ,<br><strong>Admin</strong>
							New visiter have enquiry send to agent.<br>
							<strong>	Here visiter details submited:</strong><br>
							strong>Agent name: </strong>".$userResult['user_first_name']."<br>
							strong>Email address: </strong>".$userResult['user_email']." <br>
							<strong>Contact number:</strong> $msgBodyPhone <br>
							<strong>Enquiry Type: </strong>$msgTypeOfEnquiry <br>
							
						<strong>	Here visiter details submited:</strong><br>
						<strong>Email address: </strong>$msgBodyEmail <br>
							<strong>Contact number:</strong> $msgBodyPhone <br>
							<strong>Enquiry Type: </strong>$msgTypeOfEnquiry <br>
							<strong>About me : </strong>$AboutMe <br>
							<strong>Enquiry By $msgBodyName :</strong> $msgBody <br>
						<strong>Address:</strong> $msgBodyAddress <br>
							<a href='http://homesguru.co.uk/'> 
							  <img src='http://homesguru.co.uk/images/homesguru.jpg' alt='Homesguru' width='196' height='43' />
							</a>";
						$subject="Visiter have some query  to you.";
						$content="hello ,<br>".
							$userResult['user_first_name']."
							One of visiter send you a messsage.<br>
							<strong>Contact Person address:</strong> $msgBodyName <br>
							<strong>Email Address:</strong> $msgBodyEmail <br>
							<strong>Contact Number:</strong> $msgBodyPhone <br>
							<strong>Enquiry Type:</strong> $msgTypeOfEnquiry <br>
							<strong>About me : </strong>$AboutMe <br>
							<strong>Enquiry By $msgBodyName :</strong> $msgBody <br>
							<strong>Address:</strong> $msgBodyAddress <br>
							<a href='http://homesguru.co.uk/'> 
							  <img src='http://homesguru.co.uk/images/homesguru.jpg' alt='Homesguru' width='196' height='43' />
							</a>";
						//echo $content;	die;
						sendMail($userResult["user_first_name"], $userResult["user_email"], $subject, $content, SITE_OWNER, SITE_OWNER_EMAIL_ADDRESS);
					sendMail($msgBodyName, $msgBodyEmail, $VisiterSubject, $VisiterContent, SITE_OWNER, SITE_OWNER_EMAIL_ADDRESS);
					sendMail($msgBodyName, SITE_OWNER_EMAIL_ADDRESS, $adminSubject, $adminContent, SITE_OWNER, SITE_OWNER_EMAIL_ADDRESS);
						$messageStack->addMessageSession("Your message send to agent.", "success");
						redirect(hrefLink("contactForProperty.php","source=".$_GET["source"]."&proid=".base64_encode($proid)));
			
				
				}else{
					$messageStack->addMessageSession("Unauthorized action.", "error");
					redirect(hrefLink("contactForProperty.php"));
					}
					
				}
				/*seeker section*/
			
				else{
					$messageStack->addMessageSession("Unauthorized action.", "error");
					redirect(hrefLink("index.php"));
					}
					
		
?>
