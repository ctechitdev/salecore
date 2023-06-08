<?php
function getaddress($lat,$lng)
{
$url = '//maps.googleapis.com/maps/api/geocode/json?latlng='.trim($lat).','.trim($lng).'&sensor=false';
$json = @file_get_contents($url);
$data=json_decode($json);
$status = $data->status;
if($status=="OK") return $data->results[0]->formatted_address;
else
return false;
}
$lat=$_POST['latitude'];
$lng=$_POST['longitude'];
$address= getaddress($lat,$lng);
if($address)
{
echo $address;
}
else
{
echo "Not found";
}
?>