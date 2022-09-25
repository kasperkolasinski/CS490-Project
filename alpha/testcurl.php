<?php

$post = [
    'username' => 'jgrish985',
	'password' => 'test1',
];

$ch = curl_init('https://afsaccess4.njit.edu/~kk577/alpha/back.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);

// execute!
$response = curl_exec($ch);

// close the connection, release resources used
curl_close($ch);

// do anything you want with your response
$data = json_decode($response);

echo "$data->valid<br>";
echo "$data->role<br>";
echo "$data->name<br>"; 

?>