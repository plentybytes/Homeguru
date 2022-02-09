<?php 
if ($_POST["email"]<>'') { 
    $ToEmail = 'info@homesguru.co.uk'; 
    $EmailSubject = 'Enquiry from Client'; 
    $mailheader = "From: ".$_POST["email"]."\r\n"; 
    $mailheader .= "Reply-To: ".$_POST["email"]."\r\n"; 
    $mailheader .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
    $MESSAGE_BODY = "Name: ".$_POST["name"]."<br />"; 
    $MESSAGE_BODY .= "Email: ".$_POST["email"]."<br />";
    
    $MESSAGE_BODY .= "Message: ".nl2br($_POST["message"]).""; 
    mail($ToEmail, $EmailSubject, $MESSAGE_BODY, $mailheader) or die ("Failure"); 
?>
<?php   
header("Location: http://homesguru.co.uk/index.php");
?><?php 
} else { 
echo "some issue occurs";}
?>