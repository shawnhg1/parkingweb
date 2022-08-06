<?php
require_once 'dbinfo.php';
include 'security/sanitize.php';
$page_roles = array("admin");


require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);

if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['ID'])){
	
	$ID = $_POST['ID'];
	
	
$query = "select * from violationtype where ViolationTypeID = $ID";

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
	
	<form action  ='updatetype.php' method='post'>
	
	<p>
	Violation Type: Violation Type: AV <input type='radio' name='ViolationType' value='AV'>
	BV <input type='radio' name='ViolationType' value='BV' checked='checked'>
	CV <input type='radio' name='ViolationType' value='CV'>
	DV <input type='radio' name='ViolationType' value='DV'><br>
	Amount Due:  <input type='text' name='name' value='$row[ViolationName]'><br>
	Amount Due:  <input type='text' name='due' value='$row[AmountDue]'><br><br>

	</p>
		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='ID' value=$row[ViolationTypeID]>
		<input type='submit' value='UPDATE RECORD'>	
	</form>
		
_END;
}
}


if(isset($_POST['update'])){
	$name = $_POST['name'];
	$type = $_POST['type'];
	$due = $_POST['due'];
	$id = $_POST['ID'];

	
	$query = "update violationtype set ViolationName='$name', AmountDue='$due', ViolationType = '$type' where ViolationTypeID = '$id'";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Violation_Types.php");
}
$conn->close();
?>