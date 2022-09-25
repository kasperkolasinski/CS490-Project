<?php

include ("account.php");

$db = mysqli_connect($hostname, $username, $password, $project);

if (mysqli_connect_errno())
  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
  }
//print "Successfully connected to MySQL.<br><br><br>";

mysqli_select_db($db, $project);

//$ch = curl_init("https://afsaccess4.njit.edu/~dfs23/alpha/middle.php");

//curl_setopt();

//curl_close($ch);

$unamepost = $_POST['username'];
$passpost = $_POST['password'];

//echo "<br>$unamepost<br>";

//echo "<br>CURL succeeded i guess lole";

$userinp = "$unamepost";
//$userinp = "jgrish985";
$passinp = hash('sha256', "$passpost");

$s = "SELECT Name, Role 
		FROM alpha
		WHERE Username='$userinp' AND Password='$passinp'";
//echo "<br>sql insert: $s <br><br>";
($result = mysqli_query($db, $s))  or  die( mysqli_error($db) );
//echo "<br>SQL succeeded";

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    //echo "<br>Name: " . $row["Name"] . "<br>";
	$valid = 1; 
	$role = $row["Role"];
	$name = $row["Name"];
  }
} else { //no results
  //echo "<br>0 results";
  $valid = 0; $role = NULL; $name = NULL;
}

mysqli_close($db);

//echo $role; 

$data = ['valid' => $valid, 'role' => $role, 'name' => $name];
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
?>






