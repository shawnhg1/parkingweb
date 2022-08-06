<?php
require_once 'dbinfo.php';
include 'security/sanitize.php';
$page_roles = array("admin");


require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);

if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['LotID'])){
	
	$LotID = $_POST['LotID'];
	
	
$query = "select * from parkinglot where LotID = $LotID";

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
	
	<form action  ='updatelot.php' method='post'>
	
	<p>
    Lot ID: $row[LotID]<br>
	Permit Types: Student <input type='radio' name='type' value='Student'>
	Faculty <input type='radio' name='type' value='Faculty'>
	Mixed <input type='radio' name='type' value='Mixed'><br>
	Address:<input type='text' name='address' value=$row[Address]><br>
	Capacity: <input type='text' name='cap' value=$row[Capacity]><br><br>

	</p>
	
		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='LotID' value='$row[LotID]'>
		<input type='submit' value='UPDATE RECORD'>	
	</form>
		
_END;
}
}


if(isset($_POST['update'])){
	$LotID = $_POST['LotID'];
	$address = $_POST['address'];
	$type= $_POST['type'];
	$cap = $_POST['cap'];
	
	
	$query = "update parkinglot set Address='$address', PermitType='$type', Capacity='$cap' where LotID = '$LotID' ";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Parking_info.php");
}
$conn->close();
?>