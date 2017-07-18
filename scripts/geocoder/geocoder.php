<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once('HttpGeocoder.php');

$output='text';
$lat=40.714224;
$lng=-73.961452;

if(isset($_GET['output']))
{
    $output=$_GET['output'];
}
if(isset($_GET['lat']))
{
    $lat=$_GET['lat'];
}
if(isset($_GET['lng']))
{
    $lng=$_GET['lng'];
}

$geo=HttpGeocoder::getSingleton();

if($output=='xml')
{
    header ("Content-Type:text/xml");
    echo $geo->getAddressXmlFile($lat, $lng);
}
else if($output=='json')
{
    header('Content-type: application/json');
    echo $geo->getAddressJsonFile($lat, $lng);
}
else if($output=='text')
{
    echo $geo->getAddressJsonData($lat, $lng);
}

?>
