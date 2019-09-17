<?php 
session_start();


if (isset($_POST['user_login'])) {
	user_login();
}
else if (isset($_POST['user_logout'])){
	user_logout();
}

function user_logout()
{
	if(session_destroy()) // Destroying All Sessions
	{
		header("Location: index.php"); // Redirecting To Home Page
		die();
	}
}

function user_login()
{
	$ldap = ldap_connect("cw01") or die("Could not connect to LDAP server.");

	$username = validate_username($_POST['Username_Textbox']);
	$password = $_POST['Password_Textbox'];

	if ($bind = ldap_bind($ldap,$username, $password))
	{
		$_SESSION['login_user'] = $username;

		header('Location: main.php');
		die();
	}
	else
	{
		$_SESSION['error']= "Invalid Username or Password";
		header('Location: index.php');
		die();
	}
}

function validate_username($data)
{
	if (strpos($data, "cw01\\") !== 0){
		$data = "cw01\\" . $data;
	}	
	return $data;
}


function findUser(){

	$username =$_POST['Username_Textbox'];
	return $username;
}
?>