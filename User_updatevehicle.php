<?php

require_once 'dbinfo.php';
include 'security/sanitize.php';
$page_roles = array("user");


require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);

if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['VehicleID'])){
	
	$VehicleID = $_POST['VehicleID'];
	
	
$query = "select * from vehicle where VehicleID = $VehicleID";

$result = $conn->query($query);
if(!$result) die($conn->error);
	
$rows = $result->num_rows;

for($j=0; $j<$rows; ++$j){
	$row = $result->fetch_array(MYSQLI_ASSOC);
	
	echo <<<_END
	
	<html>
	<head>
		<title> VehicleID Info</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<b>Vehicle Information</b>
	
	</body>
	
	<form action  ='User_updatevehicle.php' method='post'>
	
	<p>
    Vehicle ID: $row[VehicleID]<br>
	License Plate: <input type='text' name='LP' value='$row[LicensePlate]'><br>
	Make: <input type='text' name='Make' value='$row[Make]'><br>
	Model: <input type='text' name='Model' value='$row[Model]'><br>
	Color: <input type='text' name='Color' value='$row[Color]'><br>
	Year: <input type='text' name='Year' value='$row[Year]'><br>
	</p>
	
		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='VehicleID' value='$row[VehicleID]'>
		<input type='submit' value='UPDATE RECORD'>	
	</form>
		
_END;
}
}


if(isset($_POST['update'])){
	$DriverID = $_POST['DriverID'];
	$LP = $_POST['LP'];
	$make= $_POST['Make'];
	$model = $_POST['Model'];
	$color = $_POST['Color'];
	$year = $_POST['Year'];
	
	
	$query = "update vehicle set LicensePlate='$LP', Make='$make', Model='$model', Color='$color', Year='$year' where VehicleID = $VehicleID ";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Check_Vehicle_info.php");
}
$conn->close();
?>