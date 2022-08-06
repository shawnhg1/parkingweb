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
		<title> Buy Permit</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<b>Purchase Permit</b>
	
	<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
	
	</body>
	
	<form action  ='Buy_Permit_Payment.php' method='post'>
	
	<p>
    Vehicle ID: $row[VehicleID]<br>
	Driver ID: $row[DriverID]<br>

	
		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='VehicleID' value='$row[VehicleID]'>
		<input type='hidden' name='DriverID' value='$row[DriverID]'>
		<input type='hidden' name='Type' value='Semester'>
		<input type='hidden' name='Cost' value=50>
		<input type='submit' value='SELECT SEMESTER PERMIT'>	
	</form>
	</p>
	
	<p>
	<form action  ='Buy_Permit_Payment.php' method='post'>
		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='VehicleID' value='$row[VehicleID]'>
		<input type='hidden' name='DriverID' value='$row[DriverID]'>
		<input type='hidden' name='Type' value='Year'>
		<input type='hidden' name='Cost' value=90>
		<input type='submit' value='SELECT YEAR PERMIT'>	
	</form>
	</p>
_END;
}
}


if(isset($_POST['update'])){
	$DriverID = $_POST['DriverID'];
	$VID = $_POST['VehicleID'];
	$type= $_POST['Type'];
	$date = date('Y-m-d');
		if($type == 'Semester'){
		
		$exdate =  date('Y-m-d', strtotime('+6 months'));
		$cost = 50;
		
	$query = "insert into permit (PermitType, PurchaseDate, VehicleID, DriverID, Cost, Expirydate, PaymentID) Values ('$type','$date', '$VID', '$DriverID', '$cost', '$exdate', '$PID')";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Check_Permit_info.php");
	}
		
	}

	?>