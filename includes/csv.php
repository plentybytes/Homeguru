<?php
include 'config.php';
mysqli_connect(DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD);
mysql_select_db(DB_DATABASE);
$data=file_get_contents('sample.csv');
$data=explode("\n",$data);
unset($data[0]);
foreach($data as $row)
{
$data=explode(',',$row);
mysqli_query("insert into area (place_name,county,country,postalcode,long_lati)values('$data[1]','$data[2]','$data[3]','$data[9]','$data[7],$data[8]')") or echo mysqli_error();
}