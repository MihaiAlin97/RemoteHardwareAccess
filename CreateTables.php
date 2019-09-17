<?php
$conn = mysqli_connect("localhost","root","","remotedebugging");
$i=4;
$j=1;

while($i<25){

$sql = "INSERT INTO devices (device_name,hardware_id,device_type,usb_port,hardcoded_port)
VALUES (device".$i.",'".$j."','type".$i."','1:".$i."','600".$i."');";


// Check connection
 mysqli_query($conn,$sql);
 echo mysqli_error($conn);

if($j==4)$j=0;
$i=$i+1;
$j=$j+1;

}
  mysqli_close($conn);
?>