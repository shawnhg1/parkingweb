<?php
require_once 'dbinfo.php';

$conn = new mysqli($hn, $un, $pw, $db);

if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['PermitID'])){
	
	$PermitID = $_POST['PermitID'];
	
	
$query = "select * from permit where PermitID = $PermitID";

$result = $conn->query($query);
if(!$result) die($conn->error);
	
$rows = $result->num_rows;

for($j=0; $j<$rows; ++$j){
	$row = $result->fetch_array(MYSQLI_ASSOC);
	
	echo <<<_END
	
	<html>
	<head>
		<title> Permit Info</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<b><Permit/b>
	
	</body>
	
	<form action  ='updatepermit.php' method='post'>
	<p>
	Permit ID: $row[PermitID]<br>
    Vehicle ID: <input type = 'text' name='VehicleID' value= $row[VehicleID]><br>
	Permit Type: Semester <input type='radio' name='type' value='Semester'>
	Year <input type='radio' name='Type' value='Year'><br>
	Expiration Date: <input type = 'date' name='date' value= $row[ExpiryDate]><br>
	</p>
		<input type='hidden' name='PermitID' value='$row[PermitID]'>
		<input type='hidden' name='update' value='yes'>
		<input type='submit' value='UPDATE RECORD'>	
	</form>
		
_END;
}



if(isset($_POST['update'])){
	$PID = $_POST['PermitID'];
	$VehicleID = $_POST['VehicleID'];
	$PT = $_POST['type'];
	$date = $_POST['date'];
	
	$query = "update permit set VehicleID= '$VehicleID', PermitType='$VT', Expirydate ='$date' where PermitID = $PID ";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Check_Permit_info.php");
}
$conn->close();
}
?>