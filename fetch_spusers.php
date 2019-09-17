<?php

//fetch_data.php

$connect = new PDO("mysql:host=localhost;dbname=remotedebugging", "root", "");

$method = $_SERVER['REQUEST_METHOD'];

if($method == 'GET')
{
 $data = array(
  ':role'   => "%" . $_GET['role'] . "%",
  ':user_uid'   => "%" . $_GET['user_uid'] . "%"
 
 );
 $query = "SELECT * FROM special_users WHERE role LIKE :role AND user_uid LIKE :user_uid ORDER BY id ASC";

 $statement = $connect->prepare($query);
 $statement->execute($data);
 $result = $statement->fetchAll();
 foreach($result as $row)
 {
  $output[] = array(
   'id'    => $row['id'],   
   'role'  => $row['role'],
   'user_uid'   => $row['user_uid']
   
  );
 }
 header("Content-Type: application/json");
 echo json_encode($output);
}

if($method == "POST")
{
 $data = array( 
   'role'  => $_POST['role'],
   'user_uid'   => $_POST['user_uid']
 );

 $query = "INSERT INTO special_users (role,user_uid) VALUES (:role, :user_uid)";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

if($method == 'PUT')
{
 parse_str(file_get_contents("php://input"), $_PUT);
 $data = array(
   'id'    => $_PUT['id'],   
   'role'  => $_PUT['role'],
   'user_uid'   => $_PUT['user_uid']
    
 );
 $query = "
 UPDATE special_users
 SET role = :role, 
 user_uid = :user_uid
 
 WHERE id = :id
 ";
 $statement = $connect->prepare($query);
 $statement->execute($data);
}

if($method == "DELETE")
{
 parse_str(file_get_contents("php://input"), $_DELETE);
 $query = "DELETE FROM special_users WHERE id = '".$_DELETE["id"]."'";
 $statement = $connect->prepare($query);
 $statement->execute();
}

?>