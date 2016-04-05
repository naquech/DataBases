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
	if (!($stmt = $mysqli->prepare("UPDATE class SET class.location=? WHERE class.classId=?"))){
		echo "Prepare Failed: " . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("ii",$_POST['LocationId'],$_POST['updateClassLocation']))){
		echo "Bind Failed: " . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute Failed: " . $stmt->errno . " " . $stmt->error;
	}
	else{
		echo "Class updated " . $stmt->affected_rows . " row.";
	}
?>