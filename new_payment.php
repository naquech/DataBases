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
	if (!($stmt = $mysqli->prepare("INSERT INTO transaction (transdate, credit, cash, locationId, userId) VALUES (?,?,?,?,?)"))){
		echo "Prepare Failed: " . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param('siiii',$_POST['transdate'],$_POST['credit'],$_POST['cash'],$_POST['locationId'],$_POST['userId']))){
		echo "Bind Failed: " . $stmt->errno . " " . $stmt->error;
	} 
	if(!$stmt->execute()){
		echo "Execute Failed: " . $stmt->errno . " " . $stmt->error;
	}
	else{
		echo "payment Added." . $stmt->affected_rows . " rows to transaction table.";
	} 
?>