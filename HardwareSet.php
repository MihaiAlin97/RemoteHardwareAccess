<?php
include 'Functions.php';
ini_set("display_errors", "off");
session_start();
$activeset=explode('&',$_SERVER['QUERY_STRING']);

//separate cw01/ from uid in url;not usedhere
$cmp1=explode('\\',$_SESSION['login_user']);//separate cw01/ from uid






$conn=new mysqli("localhost","root","","Remotedebugging");

$sql = "SELECT com_port from hardwaresets  where hardware_id=".$activeset[0].";";
$result=mysqli_query($conn, $sql);

$com_port=array();
   $row= mysqli_fetch_assoc($result);

      array_push($com_port,$row['com_port']);
   



$sql = "SELECT hardware_name,used from hardwaresets  where hardware_id=".$activeset[0].";";
$result=mysqli_query($conn, $sql);

$namehard=array();
$usednow=array();
   $row= mysqli_fetch_assoc($result);

      array_push($namehard,$row['hardware_name']);
      array_push($usednow,$row['used']);

 



$cmp2=explode('u',$usednow[0]);
$cmp2[1]='u'.$cmp2[1];

$cmp3=explode('u',$activeset[1]);
$cmp3[1]='u'.$cmp3[1];

//cmp1 is session-user
//cmp2 is user from used column
//cmp3 is user from url

if(($usednow[0]!='' && $cmp1[1]!=$cmp2[1])||($usednow[0]!='' && $cmp1[1]!=$cmp3[1]))header('Location:main.php');

else{
$nodevices=count($usb_ports);
$hard=file_get_contents("HardwareSet.html");
$hard=$hard.$functions;


$hard=$hard."<script>

GoToDownloadPage('".$activeset[0]."');


 </script>";
//above we pass to download page the name of used set


$i=0;
while($i<count($usb_ports)){

$hard=$hard."<script>

ShowSetPage('".($i+1)."','".$dev_names[$i]."','".$dev_types[$i]."','".$usb_ports[$i]."');


 </script>";

$i=$i+1;
}
//adds devices to set table

$hard=str_replace("Hardware Set Name",$namehard[0],$hard);//hwset name display on page
$hard=str_replace("user", $_SESSION['login_user'],$hard);//username display





if(!$conn){

	die("Connection failed: ".mysqli_connect_error());

}

$sql = "UPDATE hardwaresets SET used='".$activeset[1]."' WHERE hardware_id=".$activeset[0].";";

mysqli_query($conn, $sql);









mysqli_close($conn);

$create = fopen("PSUData\\outputCOM".$com_port[0].".txt","w");
fwrite($create,"070500OK");
fclose($create);
$hard=$hard."<script>

RedirectToEND_SESSIONfromHWSET('".$activeset[0]."');
SourceButtons(".$com_port[0].");
 </script>";

echo $hard;
}

?>