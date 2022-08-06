<?php
require_once 'dbinfo.php';
$page_roles = array("admin");

require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);

if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['ViolationID'])){
	
	$ViolationID = $_POST['ViolationID'];
	
	
$query = "select * from violation where ViolationID = $ViolationID";

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
	
	<form action  ='updateviolation.php' method='post'>
	<p>
	Violation ID: $row[ViolationID]<br>
    Vehicle ID: <input type='Text' name='VehicleID' value=$row[VehicleID]><br>
	Violation Type: AV <input type='radio' name='ViolationType' value='AV'>
	BV <input type='radio' name='ViolationType' value='BV' checked='checked'>
	CV <input type='radio' name='ViolationType' value='CV'><br>
	</p>
		<input type='hidden' name='ViolationID' value='$row[ViolationID]'>
		<input type='hidden' name='update' value='yes'>
		<input type='submit' value='UPDATE RECORD'>	
	</form>
		
_END;
}



if(isset($_POST['update'])){
	$VID = $_POST['ViolationID'];
	$VehicleID = $_POST['VehicleID'];
	$VT = $_POST['ViolationType'];
	
	$query = "update violation set VehicleID= '$VehicleID', ViolationType='$VT' where ViolationID = $VID ";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Check_Violation_info.php");
}
$conn->close();
}
?>