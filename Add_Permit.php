
<html>
	<head>
		<title> Permit </title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<a> <img src='images/u_of_u.png' class="center"></img> </a><br>
	
	<b>Permit</b>
	 
	


	<form action  ='Add_Permit.php' method='post'>
	Permit Type: Semester <input type='radio' name='type' value='Semester'>
	Year <input type='radio' name='type' value='Year'><br>
	Driver ID:<input type='text' name='DID'><br>
	Vehicle ID:<input type='text' name='VID'><br>
	Payment ID: <input type='text' name='PID'><br><br>
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

	
if(isset($_POST['type'])){
	
	$type = ($_POST['type']);
	$DID = sanitizestring($_POST['DID']);
	$VID = sanitizestring($_POST['VID']);
	$PID = sanitizestring($_POST['PID']);
	$date = date('Y-m-d');
	
	if($type == 'Semester'){
		$exdate =  date('Y-m-d', strtotime('+6 months'));
		$cost = 50;
		
		$query = "insert into permit (PermitType, PurchaseDate, VehicleID, DriverID, Cost, Expirydate, PaymentID) Values ('$type','$date', '$VID', '$DID', '$cost', '$exdate', '$PID')";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Check_Permit_info.php");

			}elseif($type=='Year'){
		$exdate =  date('Y-m-d', strtotime('+1 years'));
		$cost = 90;
		
		$query = "insert into permit (PermitType, PurchaseDate, VehicleID, DriverID, Cost, Expirydate, PaymentID) Values ('$type','$date', '$VID', '$DriverID', '$cost', '$exdate', '$PID')";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Check_Permit_info.php");
			}
echo <<<_END
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
_END;
}
$conn->close();
?>