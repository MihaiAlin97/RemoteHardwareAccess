<?php 
//this is used for the leds and usage of sets
$q = $_GET['q'];
$conn=new mysqli("localhost","root","","Remotedebugging");
if (!$conn) {
    die('Could not connect: ' . mysqli_error($conn));
}
$sql = "SELECT used from hardwaresets  where hardware_id=".($q+1).";";
$result=mysqli_query($conn, $sql);

$id=array();
   $row= mysqli_fetch_assoc($result);

      array_push($id,$row['used']);
     
mysqli_close($conn);

if($id[0]=='')echo 'greenled|'.$id[0];
else echo 'redled|'.$id[0];
?>