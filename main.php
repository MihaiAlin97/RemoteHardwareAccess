
<?php include 'Functions.php';

session_start();
  
  if(!isset($_SESSION['login_user'])){
    header("location: index.php");
    die();
  }

$index=file_get_contents("main.html");
$index=$index.$functions;


//generate sets
$index=$index."<script>
Admin();

CreateHWSETS(".(count($hardware_names)-1).");


 </script>";





//put set names in divs
$i=0;
while($i<count($hardware_names)){

 $index=$index."<script>
DisplayHWSETS(".$i.",'".$hardware_names[$i]."');
 </script>";

$i=$i+1;
}

//put devices in the sets
$i=0;
while($i<count($devices)){

 $index=$index."<script>
AppendDevices('".($devices[$i]['hardware_id']-1)."','".$devices[$i]['device_name']."');
 </script>";

$i=$i+1;
}

$index=str_replace("user", $_SESSION['login_user'],$index);//username display


$i=0;

$_SESSION['max_users']=FALSE;
echo $_SESSION['max_users'];
while($i<count($hardware_names)){
	
	$index=$index."<script>

 ShowHSNAME(".$i.",".$hwids[$i].",'".$usage[$i]."',".$ports[$i].");

 </script>";
     $i=$i+1;
}

$i=0;
while($i<count($hardware_names)){
$index=$index."<script>
 window.setInterval(function(){
  ShowUsage(".$i.");
 
  
}, 200);


 </script>";
$i=$i+1;
}

$cmp1=explode('\\',$_SESSION['login_user']);

$conn=new mysqli("localhost","root","","Remotedebugging");

$sql = "SELECT user_uid from special_users  where user_uid='".$cmp1[1]."';";
$result=mysqli_query($conn, $sql);

$adm=array();

   if($row= mysqli_fetch_assoc($result)){

      array_push($adm,$row['user_uid']);
  $index=str_replace('id="admin" style="display:none"','id="admin"',$index);}
    
      
mysqli_close($conn);



 echo $index;


?>