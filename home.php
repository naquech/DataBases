<!--
Natalia Q. Echeverri
CS340 Final Project
-->

<!-- Code to connect to onid data base -->

<?php
ini_set('display_errors', 'On');
$mysqli = new mysqli("localhost","user","password","database");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	echo "conected to quintern-db...";
?>


<html>
	<head>
		<meta charset="UTF-8">
		<title>Project - CS340</title>
		<link rel = "stylesheet"  href =  "style.css"/>
	</head>
	
	<body>
	
		<div id="headerH"><h1 align="center">Dance Studio Database<h1></div>
	
		<div id="nav">
			<a href="forms.php">New Class</a><br> 
			<a href="forms.php">New Client</a><br>
			<a href="forms.php">New Payment</a><br>
			<a href="forms.php">New Location</a><br>
			<a href="generalQueries.php">Updates</a><br>
			<a href="viewTables.php">View DB Info</a>
		</div>

		<div id="section"><img STYLE="position:absolute; LEFT: 500px"; src="image1.jpg"></div>

		<div id="footer">Natalia Q. Echeverri - CS340 - March 2016</div>

	</body>
</html>