<?php
//include('config/config.php');
$source=$_POST['source'];
$proid=$_POST['proid'];
$name=$_POST['name'];
$email= $_POST['email'];
$frnd_mail= $_POST['frnd_email'];
$message= $_POST['message']."<br>";
$message.="http://homesguru.co.uk/details.php?source=".$source."&proid=".$proid;
$subject=$name." has shared a property on homesguru";
$to=$email;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <info@homesguru.co.uk>' . "\r\n";

$send_mail=mail($to,$subject,$message,$headers);
if(!$send_mail)
{
    echo "Failed To Send Mail";
}
else{
    echo "Mail Send Successfully";
  
}
?>
