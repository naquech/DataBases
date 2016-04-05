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
	if (!($stmt = $mysqli->prepare("INSERT INTO user (fName, lName, age, birthday, locationId, classId) VALUES (?,?,?,?,?,?)"))){
		echo "Prepare Failed: " . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param('ssisii',$_POST['fName'],$_POST['lName'],$_POST['age'],$_POST['birthday'],$_POST['locationId'],$_POST['classId']))){
		echo "Bind Failed: " . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute Failed: " . $stmt->errno . " " . $stmt->error;
	}
	else{
		echo "Client Added." . $stmt->affected_rows . " rows to user table.";
	} 
?>