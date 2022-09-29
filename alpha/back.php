<?php

/*
	Kasper Kolasinski, Group 11
	CS490-105
	Alpha: Back End
*/

//File containing login info for database
include ("account.php");

//Connect to database
$db = mysqli_connect($hostname, $username, $password, $project);

//Connection Error
if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }

//Select database
mysqli_select_db($db, $project);

//Receive post fields from middle
$userinp = $_POST['username'];
$passinp = $_POST['password'];

//SQL query to retrieve data from database table
$s = "SELECT Name, Role 
		FROM alpha
		WHERE Username='$userinp' AND Password='$passinp'";

//Sends query ~ stores result or gives error
($result = mysqli_query($db, $s))  or  die( mysqli_error($db) );

//If result has data
if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
	$valid = 1; 
	$role = $row["Role"];
	$name = $row["Name"];
  }
} else { //no results
	$valid = 0; $role = NULL; $name = NULL;
}

//Closes connection
mysqli_close($db); 

//Stores data into array and echoes json encoding
$data = ['valid' => $valid, 'role' => $role, 'name' => $name];
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
?>






