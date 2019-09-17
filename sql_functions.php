<?php
session_start(); 
function execute_sql_function($query)
{
	$conn = new mysqli($GLOBALS['server'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database_table']);
	$results = $conn->query($query);

	return $results;	
}

function execute_non_query($query)
{
	$conn = new mysqli($GLOBALS['server'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database_table']);
	$sql = $query;
	
	if (!mysqli_query($conn, $sql))
	{
		$_SESSION['error'] = mysqli_error($conn);
	}
	else
		return mysqli_query($conn, $sql);
}

function escape_special_chars($input)
{
	$conn = new mysqli($GLOBALS['server'], $GLOBALS['username'], $GLOBALS['password'], $GLOBALS['database_table']);
	return $conn->real_escape_string($input);
}

function get_groupid_from_groupname($input)
{

	$results = execute_sql_function("SELECT Group_ID FROM groups WHERE Group_Name = '$input'");

	if ($row = $results->fetch_assoc())
		return $row["Group_ID"];
}

function get_groupname_from_groupid($input)
{
	if (!empty($input))
	{
	    $results = execute_sql_function("SELECT Group_Name FROM groups WHERE Group_ID = ".$input);
	    if ($row = $results->fetch_assoc())
	      return $row["Group_Name"];
	}
	else return null;
}

function get_next_camera_port()
{
	$results = execute_sql_function("SELECT MAX(Port_Name) FROM camera");

	if ($row = $results->fetch_assoc())
		return $row["MAX(Port_Name)"]+1;
}

function populate_group_dropdown($input)
{
	$return_value="";
	$results = execute_sql_function("SELECT * FROM groups");

	while($row = $results->fetch_assoc())
		if ($row["Group_ID"] != $input)
			$return_value .= '<option value="'.$row["Group_Name"].'">'.$row["Group_Name"].'</option>';
		else
			$return_value .= '<option selected value="'.$row["Group_Name"].'">'.$row["Group_Name"].'</option>';
	
	return $return_value;
}

?>