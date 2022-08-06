<?php
require_once 'dbinfo.php';
include 'security/sanitize.php';
$page_roles = array("user");


require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);

if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['PaymentID'])){
	$DriverID = $_POST['DID'];
	$VID = $_POST['VID'];
	$type= $_POST['type'];
	$date = date('Y-m-d');
	$PID = $_POST['PaymentID'];
	$cost = $_POST['Cost'];
		if($type == 'Semester'){
		$exdate =  date('Y-m-d', strtotime('+6 months'));
		
$query = "insert into permit (PermitType, PurchaseDate, VehicleID, DriverID, Cost, Expirydate, PaymentID) Values ('$type','$date', '$VID', '$DriverID', '$cost', '$exdate', '$PID')";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Check_Permit_info.php");
			}elseif($type=='Year'){
		$exdate =  date('Y-m-d', strtotime('+1 years'));
		
		$query = "insert into permit (PermitType, PurchaseDate, VehicleID, DriverID, Cost, Expirydate, PaymentID) Values ('$type','$date', '$VID', '$DriverID', '$cost', '$exdate', '$PID')";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Check_Permit_info.php");
			}else{
				echo 'Im borked';
			}
		}
	
?>