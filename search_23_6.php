<?php
//echo time();
/**************************************
/	 Code by: Neeraj Krishna Maurya   /
/       Date: 24/05/2013              /
/    whole code updated               /
/*************************************/
include 'includes/config.php';
mysqli_connect(DB_SERVER,DB_SERVER_USERNAME,DB_SERVER_PASSWORD);
mysql_select_db(DB_DATABASE);
	   
if($_GET["action"]=='header1'){

echo $_REQUEST['query'];
$search_string = $_REQUEST['query'];
$search_string1 = rtrim(chunk_split($_REQUEST['query'],3,' '));
// Check Length More Than One Character
if (strlen($search_string) > 0)
{
//$query=mysqli_query("select * from area where place_name like '$search_string%' OR county like '$search_string%' OR country like '$search_string%' OR postcode like '$search_string%' ");
//$q="select SQL_CACHE * from kode1 where (postcode like '$search_string%' OR  postcode like '$search_string1%' OR district  like '%$search_string%' OR ward like '%$search_string%' OR county like '%$search_string%')  limit 250";
//$q="select SQL_CACHE postcode as post from kode1 where (postcode like '$search_string%' OR  postcode like '$search_string1%') union select SQL_CACHE name from citydata where name like '$search_string%'  limit 250";
//echo $q;
$q="select SQL_CACHE postcode as post from kode3 where (postcode like '$search_string%' OR  postcode like '$search_string1%') union all select SQL_CACHE name as post from citydata where name like '$search_string%'  limit 250";
//echo $q;

$query=mysqli_query($q);

//echo "select * from kode1 where REPLACE('postcode',' ','') like '$search_string%' OR  postcode like '$search_string1%' OR district  like '$search_string%' OR ward like '$search_string%' OR county like '$search_string%' OR country like '$search_string%' OR postcode like '$search_string%' limit 250";
while($row=mysql_fetch_assoc($query))
{
?>		
<!--<li class="result" onclick="document.getElementById('searching1').value='<?php echo  $row['district'].' , '.$row['ward'].' , '.$row['postcode'];?>';document.getElementById('searchid1').value='<?php echo str_replace(' ','',$row['postcode']);?>';document.getElementById('off1').style.display='none';"><a  href="javaScript:void(0)"  ><?php echo  $row['district'].' , '.$row['ward'].' , '.$row['postcode'];?></a></li>-->
<li class="result" onclick="document.getElementById('searching1').value='<?php echo  $row['post'];?>';document.getElementById('searchid1').value='<?php echo str_replace(' ','',$row['post']);?>';document.getElementById('off1').style.display='none';"><a  href="javaScript:void(0)"  ><?php echo  $row['post'];?></a></li>
<?
}
}
}
//echo time();
if($_GET["action"]=='header2'){

    echo $_REQUEST['query'];
    $search_string = $_REQUEST['query'];
    $search_string1 = rtrim(chunk_split($_REQUEST['query'],3,' '));
// Check Length More Than One Character
    if (strlen($search_string) > 0)
    {
//$query=mysqli_query("select * from area where place_name like '$search_string%' OR county like '$search_string%' OR country like '$search_string%' OR postcode like '$search_string%' ");
//$q="select SQL_CACHE * from kode1 where (postcode like '$search_string%' OR  postcode like '$search_string1%' OR district  like '%$search_string%' OR ward like '%$search_string%' OR county like '%$search_string%')  limit 250";
//$q="select SQL_CACHE postcode as post from kode1 where (postcode like '$search_string%' OR  postcode like '$search_string1%') union select SQL_CACHE name from citydata where name like '$search_string%'  limit 250";
//echo $q;
        $q="select SQL_CACHE postcode as post from kode3 where (postcode like '$search_string%' OR  postcode like '$search_string1%') union all select SQL_CACHE name as post from citydata where name like '$search_string%'  limit 250";
//echo $q;

        $query=mysqli_query($q);

//echo "select * from kode1 where REPLACE('postcode',' ','') like '$search_string%' OR  postcode like '$search_string1%' OR district  like '$search_string%' OR ward like '$search_string%' OR county like '$search_string%' OR country like '$search_string%' OR postcode like '$search_string%' limit 250";
        while($row=mysql_fetch_assoc($query))
        {
            ?>
            <!--<li class="result" onclick="document.getElementById('searching1').value='<?php echo  $row['district'].' , '.$row['ward'].' , '.$row['postcode'];?>';document.getElementById('searchid1').value='<?php echo str_replace(' ','',$row['postcode']);?>';document.getElementById('off1').style.display='none';"><a  href="javaScript:void(0)"  ><?php echo  $row['district'].' , '.$row['ward'].' , '.$row['postcode'];?></a></li>-->
            <li class="result2" onclick="document.getElementById('searching2').value='<?php echo  $row['post'];?>';document.getElementById('searchid2').value='<?php echo str_replace(' ','',$row['post']);?>';document.getElementById('off2').style.display='none';"><a  href="javaScript:void(0)"  ><?php echo  $row['post'];?></a></li>
        <?
        }
    }
}
?>