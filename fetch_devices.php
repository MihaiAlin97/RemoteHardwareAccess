<?php

//fetch_data.php

$connect = new PDO("mysql:host=localhost;dbname=remotedebugging", "root", "");

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET')
{
 $data = array(
  ':device_name'   => "%" . $_GET['device_name'] . "%",
  ':hardware_id'   => "%" . $_GET['hardware_id'] . "%",
  ':device_type'     => "%" . $_GET['device_type'] . "%",
  ':usb_port'    => "%" . $_GET['usb_port'] . "%",
  ':hardcoded_port'     => "%" . $_GET['hardcoded_port'] . "%"
 );
 $query = "SELECT * FROM devices WHERE device_name LIKE :device_name AND hardware_id LIKE :hardware_id AND device_type LIKE :device_type AND usb_port LIKE :usb_port AND hardcoded_port LIKE :hardcoded_port ORDER BY device_id ASC";

 $statement = $connect->prepare($query);
 $statement->execute($data);
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array( 
   'device_id'   => $row['device_id'],
   'device_name'   => $row['device_name'],
   'hardware_id'   => $row['hardware_id'],
   'device_type'     => $row['device_type'] ,
   'usb_port'    => $row['usb_port'] ,
   'hardcoded_port'     =>$row['hardcoded_port']
  );
 }
 header("Content-Type: application/json");
 echo json_encode($output);
}

if($method == "POST")
{
 $data = array( 
   'device_name'   => $_POST['device_name'],
   'hardware_id'   => $_POST['hardware_id'] ,
   'device_type'     => $_POST['device_type'] ,
   'usb_port'    => $_POST['usb_port'],
   'hardcoded_port'     => $_POST['hardcoded_port']
 );

 $query = "INSERT INTO devices (device_name,hardware_id,device_type,usb_port,hardcoded_port) VALUES (:device_name, :hardware_id, :device_type, :usb_port,:hardcoded_port)";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

if($method == 'PUT')
{
 parse_str(file_get_contents("php://input"), $_PUT);
 $data = array(
   'device_id'    => $_PUT['device_id'],   
   'device_name'   => $_PUT['device_name'],
   'hardware_id'   =>  $_PUT['hardware_id'] ,
   'device_type'     =>  $_PUT['device_type'],
   'usb_port'    =>  $_PUT['usb_port'] ,
   'hardcoded_port'     =>  $_PUT['hardcoded_port'] 
 );
 $query = "
 UPDATE devices
 SET device_name = :device_name,  
 hardware_id = :hardware_id, 
 device_type = :device_type, 
 usb_port = :usb_port, 
 hardcoded_port= :hardcoded_port
 WHERE device_id = :device_id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

if($method == "DELETE")
{
 parse_str(file_get_contents("php://input"), $_DELETE);
 $query = "DELETE FROM devices WHERE device_id = '".$_DELETE["device_id"]."'";
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>