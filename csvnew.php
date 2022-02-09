<?php
ini_set('memory_limit','512M');
ini_set('max_execution_time', 300);
//echo ini_get('max_execution_time');exit;
include 'includes/config.php';
mysqli_connect(DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD);
mysql_select_db(DB_DATABASE);
$data=file_get_contents('csv/xaa');
$data=explode("\n",$data);
unset($data[0]);
foreach($data as $row)
{
$data=explode(',',htmlentities($row,ENT_QUOTES,'UTF-8'));
//echo "insert into postcode (district,ward,county,country,postcode,long,lati)values('$data[4]','$data[5]','$data[3]','$data[6]','$data[0]','$data[1]','$data[2]')";
mysqli_query("insert into postcode (district,ward,county,country,postcode,longi,lati)values('$data[4]','$data[5]','$data[3]','$data[6]','$data[0]','$data[1]','$data[2]')") or die(mysqli_error());
}