<!--
Natalia Q. Echeverri
CS340 Final Project
-->

<!-- Code to connect to onid data base -->

<?php

ini_set('display_errors', 'On');
//Connects to the database
$mysqli = new mysqli("localhost","user","password","database");
if($mysqli->connect_errno){
	echo "Connection error " . $mysqli->connect_errno . " " . $mysqli->connect_error;
	}
	echo "conected to quintern-db...";
?>
 

<!-- HTML -->

<!DOCTYPE html PUBLIC>

<html>
  <head>
   <meta charset="UTF-8">
    <title>Project - CS340</title>
	<link rel = "stylesheet" type = "text/css" href =  "style.css"/>
  </head>
 
 
  <body>
  
		<div id="headerF">
		<h1 align="center">Dance Studio Database<h1>
		</div><br><br>		
		
		<form METHOD="link" ACTION="home.php"><INPUT TYPE="submit" VALUE="Home"></form>
		<form METHOD="link" ACTION="generalQueries.php"><INPUT TYPE="submit" VALUE="Update"></form>
		<form METHOD="link" ACTION="viewTables.php"><INPUT TYPE="submit" VALUE="DB Info"></form>
  
			<form method="post" action="add_class.php"> 			
				<fieldset><br>
					<legend>Add a Class</legend>
					Class Name <input type="text" name="cName"><br>
					Days Offered <input type="text" name="Days"><br>
					Type <select name="type"><option value="solo">Solo</option><option value="partner">Partner</option></select><br>
					Length <input type="text" name="Length"><br>
					Price <input type="text" name="Price"><br>
					Location ID <input type="text" name="Location"><br>
					<br><input type="submit" value="Submit">
				</fieldset>
			</form><br>	
			
			<form method="post" action="add_client.php">
				<fieldset><br>
					<legend>Add a Client</legend>
					First Name <input type="text" name="fName">
					Last Name <input type="text" name="lName"><br>
					Age <input type="text" name="age">
					Birthday <input type="text" name="birthday"><br>
					Location ID <input type="text" name="locationId">
					Class ID <input type="text" name="classId"><br>
					<br><input type="submit" value="Submit"></br>
				</fieldset>
			</form><br>	
		
			<form method="post" action="new_payment.php">
				<fieldset><br>
					<legend>New Payment</legend>
					Date <input type="text" name="transdate"><br>
					Total Paid: Credit <input type="text" name="credit"> Cash <input type="text" name="cash"><br>
					Location ID <input type="text" name="locationId"><br>
					Client ID <input type="text" name="userId"><br>
					<br><input type="submit" value="Submit"></br>
				</fieldset>
			</form><br>
		
		
			<form method="post" action="add_location.php"> 
				<fieldset><br>
					<legend>New Location</legend>
					Zip Code <input type="text" name="zipcode">
					<br><br><input type="submit" value="Submit"></br>
				</fieldset>
			</form><br>
			
			
		<div id="footer">Natalia Q. Echeverri - CS340 - March 2016</div>
  </body>
 
 </html>