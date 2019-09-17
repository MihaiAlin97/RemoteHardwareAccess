<?php 
include 'Setup.php';

$conn=new mysqli("localhost","root","","Remotedebugging");
//take ports that belong to current set
$sql = "SELECT usb_port,hardcoded_port
FROM devices where  hardware_id IN (SELECT hardware_id
FROM hardwaresets
where hardware_id='".$_SERVER['QUERY_STRING']."')
";
$result=mysqli_query($conn,$sql);

$usb_ports=array();
$hardcoded_ports=array();

   while($row= mysqli_fetch_assoc($result)){
   array_push($usb_ports,$row['usb_port']);
   array_push($hardcoded_ports,$row['hardcoded_port']);
   }


if(!$conn){

	die("Connection failed: ".mysqli_connect_error());

}


//'UsbService64.exe share-usb-port id:id:id:id --tcp=IPclient:PortHardcoded

$i=0;
while($i<count($usb_ports)){
exec('UsbService64.exe share-usb-port '.$usb_ports[$i].' --tcp='.$_SERVER['REMOTE_ADDR'].':'.$hardcoded_ports[$i]);
//run cmd commands for sharing all devices
$i=$i+1;
}

$i=0;
$myfile = fopen("setdevices.bat", "w") or die("Unable to open file!");

while($i<count($usb_ports)){
$txt = "UsbService64.exe add-remote-device ".$hardcoded_ports[$i]."\r\n";
$txt=$txt."UsbService64.exe connect-remote-device ".$hardcoded_ports[$i]."\r\n";
fwrite($myfile, $txt);


$i=$i+1;
}
fclose($myfile);
//creating the bat for add and connect 







download("setdevices.bat");

mysqli_close($conn);

?>