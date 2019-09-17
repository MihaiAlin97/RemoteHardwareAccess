<?php

//fetch_data.php

$connect = new PDO("mysql:host=localhost;dbname=remotedebugging", "root", "");

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET')
{
 $data = array(
  ':hardware_name'   => "%" . $_GET['hardware_name'] . "%",
  ':ip'   => "%" . $_GET['ip'] . "%",
  ':port'     => "%" . $_GET['port'] . "%",
  ':used'    => "%" . $_GET['used'] . "%",
  ':com_port'    => "%" . $_GET['com_port'] . "%"
 );
 $query = "SELECT * FROM hardwaresets WHERE hardware_name LIKE :hardware_name AND ip LIKE :ip AND port LIKE :port AND used LIKE :used AND com_port LIKE :com_port ORDER BY hardware_id ASC";

 $statement = $connect->prepare($query);
 $statement->execute($data);
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'hardware_id'    => $row['hardware_id'],   
   'hardware_name'  => $row['hardware_name'],
   'ip'   => $row['ip'],
   'port'    => $row['port'],
   'used'   => $row['used'],
   'com_port'   => $row['com_port'],
  );
 }
 header("Content-Type: application/json");
 echo json_encode($output);
}

if($method == "POST")
{
 $data = array( 
   'hardware_name'  => $_POST['hardware_name'],
   'ip'   => $_POST['ip'],
   'port'    => $_POST['port'],
   'used'   => $_POST['used'],
   'com_port'   => $_POST['com_port']
 );

 $query = "INSERT INTO hardwaresets (hardware_name, ip, port,used,com_port) VALUES (:hardware_name, :ip, :port, :used,:com_port)";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

if($method == 'PUT')
{
 parse_str(file_get_contents("php://input"), $_PUT);
 $data = array(
   'hardware_id'    => $_PUT['hardware_id'],   
   'hardware_name'  => $_PUT['hardware_name'],
   'ip'   => $_PUT['ip'],
   'port'    => $_PUT['port'],
   'used'   => $_PUT['used'],
   'com_port'   => $_PUT['com_port'],
 );
 $query = "
 UPDATE hardwaresets
 SET hardware_name = :hardware_name, 
 ip = :ip, 
 port = :port, 
 used = :used,
 com_port = :com_port 
 WHERE hardware_id = :hardware_id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

if($method == "DELETE")
{
 parse_str(file_get_contents("php://input"), $_DELETE);
 $query = "DELETE FROM hardwaresets WHERE hardware_id = '".$_DELETE["hardware_id"]."'";
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>