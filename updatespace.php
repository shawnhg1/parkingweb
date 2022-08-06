<?php
require_once 'dbinfo.php';
include 'security/sanitize.php';
$page_roles = array("admin");


require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);

if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['SpaceID'])){
	
	$SpaceID = $_POST['SpaceID'];
	
	
$query = "select * from parkingspace where SpaceID = $SpaceID";

$result = $conn->query($query);
if(!$result) die($conn->error);
	
$rows = $result->num_rows;

for($j=0; $j<$rows; ++$j){
	$row = $result->fetch_array(MYSQLI_ASSOC);
	
	echo <<<_END
	
	<html>
	<head>
		<title> Parking Lots</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<b>Parking Lots</b>
	
	</body>
	
	<form action  ='updatespace.php' method='post'>
	
	<p>
	Space ID: $row[SpaceID]<br>
	Lot ID:  <input type='text' name='LotID'><br>
	Field: A <input type='radio' name='Field' value='A'>
	B <input type='radio' name='Field' value='B'>
	C<input type='radio' name='Field' value='C'><br><br>

	</p>
		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='SpaceID' value=$row[SpaceID]>
		<input type='submit' value='UPDATE RECORD'>	
	</form>
		
_END;
}
}


if(isset($_POST['update'])){
	$LotID = $_POST['LotID'];
	$Field = $_POST['address'];

	
	$query = "update parkingspace set Field='$Field', LotID='$LotID' where SpaceID = '$SpaceID'";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Parking_info.php");
}
$conn->close();
?>