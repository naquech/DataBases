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
	
		<div id="headerGQ">
		<h1 align="center">Dance Studio Database<h1>
		</div><br><br>
		
		<FORM METHOD="link" ACTION="home.php"><INPUT TYPE="submit" VALUE="Home"></form>
		<form METHOD="link" ACTION="forms.php"><INPUT TYPE="submit" VALUE="Add Query"></form>
		<form METHOD="link" ACTION="viewTables.php"><INPUT TYPE="submit" VALUE="DB Info"></form>
	
			<!-- Select query to find which classes are available on a given day.-->	
			
		    <h2 align="center"> Filter Classes by day</h2>
			<form method="post" action="generalQueries.php">
				<fieldset>
					<legend>Select a day of the week:</legend>
						<select name="filterDay">
							<?php
								if(!($stmt=$mysqli->prepare("SELECT DISTINCT days FROM class"))){
									echo "Prepared Failed" . $stmt->errno . " " . $stmt->error;
								}
								if(!$stmt->execute()){
									echo "Execute Failed" . $mysqli->connect_errno . " " . $mysqli->connect_error;
								}
								if(!$stmt->bind_result($days)){
									echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
								}
								while($stmt->fetch()){
									echo '<option>' . $days . '</option>\n';
								}
								$stmt->close();
							?>
						</select>
						<input type="submit" value="View classes from selected day" />
						
						<!--Display filter results -->
						<table>
							<tr><td>Classes on day selected:</td></tr>
							<?php
								if (!($stmt = $mysqli->prepare("SELECT class.cName FROM class WHERE class.days = ?"))){
									echo "Prepare Failed: " . $stmt->errno . " " . $stmt->error;
								}
								if(!($stmt->bind_param("s",$_POST['filterDay']))){
									echo "Bind Failed: " . $stmt->errno . " " . $stmt->error;
								}
								if(!$stmt->execute()){
									echo "Execute Failed: " . $stmt->errno . " " . $stmt->error;
								}
								if(!$stmt->bind_result($cName)){
									echo "Bind Failed: " . $mysqli->connect_errno . " " . $mysqli->connect_error;
								}
								while($stmt->fetch()){
									echo"<tr>\n<td>\n" . $cName . "\n</td>\n</tr>";
								}
								$stmt->close();
							?>
						</table>
				</fieldset>
			</form><br><br> 
				
			
		  <!--Update query: day and price of a class -->

			<h2 align="center"> Update Classes</h2>
			<form method="post" action="updateClass.php">
				<fieldset>
					<legend> Select a class to update: </legend>
					<select name="updateClass">
				
						<?php
						 if(!($stmt = $mysqli->prepare("SELECT cName FROM class"))){
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}
						if(!$stmt->execute()){
							echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						if(!$stmt->bind_result($cName)){
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						while($stmt->fetch()){
							echo '<option>' . $cName . '</option>\n';
						}
						$stmt->close(); 
						?>
					</select>
				
					<br><label>Update days: </label>
					<input type="text" name="updateClassDays">
					<br><label> update price: </label>
					<input type="text" name="updateClassPrice">
					<br><input type="submit" value="Update Class">
				</fieldset>
			</form><br>
			
			
		  <!-- Update query. Move a class to a different location -->
		  
		  <h2 align="center">Update Class Location</h2>
			<table align=center>
				<tr>
					<td>Class ID</td>
					<td>Class Name</td>
					<td>Location</td>
				</tr>
			
				<?php
				if(!($stmt = $mysqli->prepare("SELECT class.classId, class.cName, class.location FROM class ORDER BY classId"))){
					echo "Prepare failed: " . $stmt->errno . " " . $stmt->error;
				}
				if(!$stmt->execute()){
					echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				if(!$stmt->bind_result($classId, $cName, $location)){
					echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
				}
				while($stmt->fetch()){
					echo "<tr>\n<td>\n" . $classId . "\n</td>\n<td>\n" . $cName . "\n</td>\n<td>\n" . $location . "\n</td>\n</tr>";
				}
				$stmt->close();
				?>
				
			</table><br>
		  
			<form method="post" action="updateLocation.php">
				<fieldset>
					<legend>Select a class ID to relocate: </legend>
					<select name="updateClassLocation">
				
						<?php
						 if(!($stmt = $mysqli->prepare("SELECT classId FROM class"))){
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}
						if(!$stmt->execute()){
							echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						if(!$stmt->bind_result($classId)){
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						while($stmt->fetch()){
							echo '<option>' . $classId . '</option>\n';
						}
						$stmt->close(); 
						?>
					</select>
				
					<br><label>Update Location: </label>
					<input type="text" name="LocationId">
					<br><input type="submit" value="Update Class">
				</fieldset>
			</form><br>

		  
		  <!-- Delete a user from the DB -->
		  
		  <h2 align="center">Delete a Class</h2>
			<form method="post" action="deleteClass.php">		
				<fieldset>		
					<legend> Select a class to delete: </legend>
					<select name="deleteClass">
	
						<?php
						 if(!($stmt = $mysqli->prepare("SELECT cName FROM class ORDER BY cName"))){
							echo "Prepare failed: "  . $stmt->errno . " " . $stmt->error;
						}
						if(!$stmt->execute()){
							echo "Execute failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						if(!$stmt->bind_result($cName)){
							echo "Bind failed: "  . $mysqli->connect_errno . " " . $mysqli->connect_error;
						}
						while($stmt->fetch()){
							echo '<option>' . $cName . '</option>\n';
						}
						$stmt->close(); 
						?>
					</select>
					<input type="submit" value="Delete">
				</fieldset>
			</form>
			
			<div id="footer">Natalia Q. Echeverri - CS340 - March 2016</div>
	</body>
</html>