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
	if (!($stmt = $mysqli->prepare("INSERT INTO class (cName, days, type, length, price, location) VALUES (?,?,?,?,?,?)"))){
		echo "Prepare Failed: " . $stmt->errno . " " . $stmt->error;
	}
	if(!($stmt->bind_param("sssiii",$_POST['cName'],$_POST['Days'],$_POST['type'],$_POST['Length'],$_POST['Price'],$_POST['Location']))){
		echo "Bind Failed: " . $stmt->errno . " " . $stmt->error;
	}
	if(!$stmt->execute()){
		echo "Execute Failed: " . $stmt->errno . " " . $stmt->error;
	}
	else{
		echo "Class Added." . $stmt->affected_rows . " rows to class.";
	}
?>