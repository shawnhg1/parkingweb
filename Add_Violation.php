<html>
	<head>
		<title> Vehicle Info</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<a> <img src='images/u_of_u.png' class="center"></img> </a><br>
	
	<b>Violations</b>
	 
	


	<form action  ='Add_Violation.php' method='post'>
	Violation Type: AV <input type='radio' name='ViolationType' value='AV'>
	BV <input type='radio' name='ViolationType' value='BV' checked='checked'>
	CV <input type='radio' name='ViolationType' value='CV'>
	DV <input type='radio' name='ViolationType' value='DV'><br>
	Vehicle ID: <input type='text' name='VehicleID' value><br>
	<input type='hidden' name='add' value='yes'>
	<input type='submit' value='ADD RECORD'>	
	</form>
		</body>
</html>

<?php

require_once 'dbinfo.php';
include 'security/sanitize.php';
$page_roles = array("admin");


require_once 'security/checksession.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

	
if(isset($_POST['ViolationType'])){
	$VT = $_POST['ViolationType'];
	$date = date('Y-m-d h:i:s', time());
	$VID = sanitizestring($_POST['VehicleID']);
	
	
	
	$query = "insert into violation (ViolationType, DateTime, VehicleID) Values ('$VT','$date', '$VID')";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Check_Violation_info.php");
    }

$conn->close();
?>
