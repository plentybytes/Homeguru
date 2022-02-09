<?php
//include('config/config.php');

//$content=$_POST['txtcontent'];
$email= $_POST['txtmail'];
$message= "Hi ".$_POST['txtname']."<br>".$_POST['txtcontent']."<br>";
$subject="Thank you for reporting the listing error";
$to=$email;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <bikash.chakraborty@amstech.co.in>' . "\r\n";

$send_mail=mail($to,$subject,$message,$headers);
if(!$send_mail)
{
    echo "Failed To Send Mail";
}
else{
    echo "Mail Send Successfully";
  
}
?>
