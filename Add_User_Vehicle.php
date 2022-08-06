<?php

$page_roles = array("user");
require_once 'dbinfo.php';
include 'security/sanitize.php';
require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query="SELECT DriverID FROM driver WHERE Username='$username'";

$result=$conn->query($query);
if(!$result) die ($conn->error);

$rows=$result->num_rows;
for($j=0; $j<$rows; $j++) {
	$result->data_seek($j);
	$row=$result->fetch_array(MYSQLI_BOTH);
}


echo <<<_END
<html>
		<head>
		<title> Vehicle Info</title>
		<link rel='stylesheet' href='styles.css'>
		</head>
			<body>
				<h1> U of U Parking </h1>
	
					<a> <img src='images/u_of_u.png' class="center"></img> </a><br>
	
					<b>Vehicle Information</b>
	 
	


					<form action  ='Add_User_Vehicle.php' method='post'>
					Driver ID:$row[DriverID]<br>
					License Plate: <input type='text' name='LP'><br>
					Make: <input type='text' name='Make' value><br>
					Model: <input type='text' name='Model' value><br>
					Color: <input type='text' name='Color' value><br>
					Year: <input type='text' name='Year' value><br>
					<input type='hidden' name='add' value='yes'>
					<input type='submit' value='ADD RECORD'>	
					</form>
			</body>
	</html>
_END;
	
if(isset($_POST['LP'])){
	$drID= $row[DriverID];
	$LP = sanitizestring($_POST['LP']);
	$make = sanitizestring($_POST['Make']);
	$model = sanitizestring($_POST['Model']);
	$color = sanitizestring($_POST['Color']);
	$year = sanitizestring($_POST['Year']);
	
	
	$query = "insert into vehicle (DriverID, LicensePlate, Make, Model, Color, Year) Values ('$drID','$LP', '$make', '$model', '$color', '$year')";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: User_Vehicle_info.php");
    }

$conn->close();
?>