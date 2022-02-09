<?php
ini_set('memory_limit','512M');
ini_set('max_execution_time', 300);
//echo ini_get('max_execution_time');exit;
include 'includes/config.php';
mysqli_connect(DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD);
mysql_select_db(DB_DATABASE);

mysqli_query("LOAD DATA LOCAL INFILE '/var/chroot/home/content/34/8477334/html/Homeguru/csv/xaa' INTO TABLE kode COLUMNS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"' ESCAPED BY '"' LINES TERMINATED BY '\n';");