<?php 
  include('includes/application.php');
  if(isSessionRegistered('user'))
    echo "no";
   else
    echo "yes";  
  exit;
?>  
