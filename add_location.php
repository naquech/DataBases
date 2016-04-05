<!--
Natalia Q. Echeverri
CS340 Final Project
-->

<?php

ini_set('display_errors', 'On');

$mysqli = new mysqli("localhost","user","password","database");
	if(!$mysqli || $mysqli->connect_errno){
		echo "Connection Error". $mysqli->connect_errno. " " . $mysqli->connect_error;
	}
	if (!($stmt = $mysqli->prepare("INSERT INTO location (zipcode) VALUES (?)"))){
		echo "Prepare Failed: " . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("i",$_POST['zipcode']))){
		echo "Bind Failed: " . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute Failed: " . $stmt->errno . " " . $stmt->error;
	}
	else{
		echo "Location Added." . $stmt->affected_rows . " rows to location.";
	}
?>