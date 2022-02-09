<?php
/**************************************
/	 Code by: Stephin Nadar   /
/       Date: 23/02/2014              /
/                  /
/*************************************/

$search_string = urlencode($_REQUEST['query']);
$url="http://ws.epostcode.com/uk/postcodeservices13.asmx/GetPremiseAddressesFromPostcode?MaxRecords=200&Postcode=$search_string&AccountName=AJRGLOBA01&LicenceID=0c0b57dc-a0fe-4ce8-b348-0e31e6b8d51a&MachineID=";
$ch = curl_init();
curl_setopt_array($ch, array(
CURLOPT_URL => $url,
CURLOPT_RETURNTRANSFER => true,
CURLOPT_SSL_VERIFYPEER => false,
CURLOPT_VERBOSE => true
));
$result = curl_exec($ch);
$json=simplexml_load_string($result);
$json=json_decode(json_encode($json),1);
if($json['RecCount'])
{
foreach($json['List']['AddressPremise'] as $row)
{
$array[]=array('id'=>base64_encode($row['Unique_Delivery_Point'].'|'.$row['FullAddress']),'addr'=>str_replace('\r\n',' ',$row['FullAddress']));
}
echo json_encode($array);
}
else
{
echo '0';
}
?>