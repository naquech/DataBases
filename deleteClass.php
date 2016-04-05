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
	if (!($stmt = $mysqli->prepare("DELETE FROM class WHERE class.cName=?"))){
		echo "Prepare Failed: " . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("s",$_POST['deleteClass']))){
		echo "Bind Failed: " . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute Failed: " . $stmt->errno . " " . $stmt->error;
	}
	else{
		echo "Class deleted " . $stmt->affected_rows . " rows to class.";
	} 
?>