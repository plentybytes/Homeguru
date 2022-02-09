<?php
     
   $server     = '50.63.7.218';
$username   = 'urwomco_mukesh';
$password   = 'mukesh123';
$database   = 'urwomco_homeguru';
 
$dsn        = "mysql:host=$server;dbname=$database";
     
    try {
     
        $db = new PDO($dsn, $username, $password);
        $db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
         
        $sth = $db->query("SELECT * FROM property");
        $locations = $sth->fetchAll();
         
        echo json_encode( $locations );
         
    } catch (Exception $e) {
        echo $e->getMessage();
    }
	?>