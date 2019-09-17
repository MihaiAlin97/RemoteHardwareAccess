<?php 


$tst=file_get_contents("PSUData\\output.txt");
$minus=intval(substr($tst,0,3))-10;
$plus=intval(substr($tst,0,3))+10;
if($plus<100)$plus='0'.$plus;
if($plus<100)$minus='0'.$minus;

echo $plus;
echo"\r\n";
echo $minus;
?>