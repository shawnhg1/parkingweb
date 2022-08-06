
<html>
	<head>
		<title> Vehicle Info</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<a> <img src='images/u_of_u.png' class="center"></img> </a><br>
	
	<b>Vehicle Information</b>
	 
	


	<form action  ='Add_Vehicle.php' method='post'>
	Driver ID:  <input type='text' name='DRID'><br>
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

<?php

require_once 'dbinfo.php';
include 'security/sanitize.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

	
if(isset($_POST['DRID'])){
	$drID = sanitizestring($_POST['DRID']);
	$LP = sanitizestring($_POST['LP']);
	$make = sanitizestring($_POST['Make']);
	$model = sanitizestring($_POST['Model']);
	$color = sanitizestring($_POST['Color']);
	$year = sanitizestring($_POST['Year']);
	
	
	$query = "insert into vehicle (DriverID, LicensePlate, Make, Model, Color, Year) Values ('$drID','$LP', '$make', '$model', '$color', '$year')";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Vehicle_info.php");
    }

$conn->close();
?>
