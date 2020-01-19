<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "demoapi";

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
	echo "Connection failed! " . $conn->connect_error;
}

?>