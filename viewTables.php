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

<!DOCTYPE html PUBLIC>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Project - CS340</title>
		<link rel = "stylesheet" type = "text/css" href =  "style.css"/>
	</head>

	<body>
		<div id="headerVT">
			<h1 align="center">Dance Studio Database<h1>
			</div><br><br>
			
		<FORM METHOD="link" ACTION="home.php"><INPUT TYPE="submit" VALUE="Home"></form>
		<form METHOD="link" ACTION="forms.php"><INPUT TYPE="submit" VALUE="Add Query"></form>
		<form METHOD="link" ACTION="generalQueries.php"><INPUT TYPE="submit" VALUE="Update"></form>
		
			<!-- Select query to find what classes users are taking -->
			<div id="clasesUsers"><table align="center"> 
				<tr>
					<h2 align="center">Clases users are taking</h2>
					<td>User ID</td>
					<td>First Name</td>
					<td>Last Name</td>
					<td>Class</td>
				</tr>
				
				<?php
					if(!($stmt = $mysqli->prepare("SELECT user.userId, user.fName, user.lName, class.cName FROM user INNER JOIN class ON class.classId = user.classId ORDER BY userId"))){
						echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
					}
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($userId, $fName, $lName, $cName)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
						echo "<tr>\n<td>\n" . $userId . "\n</td>\n<td>\n" . $fName . "\n</td>\n<td>\n" . $lName . "\n</td>\n<td>\n" . $cName . "\n</td>\n</tr>";
					}
					$stmt->close();
				?>
			</table></div><br><br>
		
		
		 <!-- Select query to find schedule of classes in all locations -->
			<div id="schedule"><table align="center"> 
				<tr>
					<h2 align="center">Schedule for all Locations</h2>
					<td>Class</td>
					<td>Day</td>
					<td>Location</td>
				</tr>
				
				<?php
					if(!($stmt = $mysqli->prepare("SELECT class.cName, class.days, location.zipcode FROM class INNER JOIN offered ON class.classId = offered.classId INNER JOIN location ON location.locationId = offered.locationId ORDER BY zipcode"))){
						echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
					} 
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($cName, $days, $zipcode)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
						echo "<tr>\n<td>\n" . $cName . "\n</td>\n<td>\n" . $days . "\n</td>\n<td>\n" . $zipcode . "\n</td>\n</tr>";
					}
					$stmt->close();
				?>
			</table></div><br><br>
			
			
		 <!-- Select query finds the total amount of transactions at each location. 
			Adds all credit and cash columns for payments made partially -->
			<div id="totalMoney"><table align="center"> 
				<tr>
					<h2 align="center"> Total Ammount of transactions by location</h2>
					<td>Location ID</td>
					<td>Total Ammount (Cash and Credit)</td>
				</tr>
				
				<?php
					if(!($stmt = $mysqli->prepare("SELECT transaction.locationId, SUM(transaction.credit + transaction.cash) AS 'TotalAmount' FROM transaction GROUP BY locationId"))){
						echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
					} 
					if(!$stmt->execute()){
						echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					if(!$stmt->bind_result($locationId, $TotalAmount)){
						echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
					}
					while($stmt->fetch()){
						echo "<tr>\n<td>\n" . $locationId . "\n</td>\n<td>\n" . $TotalAmount . "\n</td>\n</tr>";
					}
					$stmt->close();
				?>
			</table></div><br><br>
		
		<div id="footer">Natalia Q. Echeverri - CS340 - March 2016</div>
	</body>
</html>