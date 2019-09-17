<?php 


$q=$_GET['q'];
$p=$_GET['p'];
$tst=file_get_contents("PSUData\\outputCOM".$p.".txt");
$minus=intval(substr($tst,0,3))-10;
$plus=intval(substr($tst,0,3))+10;


if($plus<100)$plus='0'.$plus;
if($minus<100)$minus='0'.$minus;

//C:\xampp\htdocs\PSUData\getPSUData.py  -p COM64 -c volt110 
if($q==0)exec('C:\xampp\htdocs\PSUData\getPSUData.py  -p COM'.$p.' -c on');


if($q==1 && $plus<=140){
	exec('C:\xampp\htdocs\PSUData\getPSUData.py  -p COM'.$p.' -c volt'.$plus.'');
	$tst=file_get_contents("PSUData\\outputCOM".$p.".txt");
    echo substr($tst,0,3);}

if($q==1 && $plus>140)echo "Upper limit";



if($q==2 && $minus>=70){
	exec('C:\xampp\htdocs\PSUData\getPSUData.py  -p COM'.$p.' -c volt'.$minus.'');
    $tst=file_get_contents("PSUData\\outputCOM".$p.".txt");
    echo substr($tst,0,3);}
if($q==2 && $minus<70)echo "Lower limit";




if($q==3)exec('C:\xampp\htdocs\PSUData\getPSUData.py  -p COM'.$p.' -c off');

exec('C:\xampp\htdocs\PSUData\getPSUData.py  -p COM'.$p.' -c dis');



?>