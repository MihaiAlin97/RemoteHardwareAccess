<?php 
session_start();
$admin=file_get_contents("admin.html");
$admin=str_replace('actusr',$_SESSION['login_user'],$admin);


$cmp1=explode('\\',$_SESSION['login_user']);

$conn=new mysqli("localhost","root","","Remotedebugging");

$sql = "SELECT user_uid from special_users  where user_uid='".$cmp1[1]."';";
$result=mysqli_query($conn, $sql);

$adm=array();

   if($row= mysqli_fetch_assoc($result)){

      array_push($adm,$row['user_uid']);}
      else header('Location:main.php');
      
mysqli_close($conn);
echo $admin;
?>