<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "week";

	// create connection
	$connection = new mysqli($servername, $username, $password, $dbname);

	// check connection
	if ($connection->connect_error) {
		return null;
	}
	
	return $connection;
?>
