<?php
	$host = "localhost";
	$benutzername = "root";
	$password = "";
	$db = "umfrage";
	
	$con = mysqli_connect($host, $benutzername, $password);
	mysqli_select_db($con, $db);

?>