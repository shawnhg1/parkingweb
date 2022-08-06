<?php
require_once 'dbinfo.php';
include 'security/sanitize.php';

$conn = new mysqli($hn, $un, $pw, $db);

if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['DriverID'])){
	
	$driverID = $_POST['DriverID'];
	
	
$query = "select * from driver where DriverID = $driverID";

$result = $conn->query($query);
if(!$result) die($conn->error);
	
$rows = $result->num_rows;

for($j=0; $j<$rows; ++$j){
	
	//$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	
	echo <<<_END
	
	<html>
	<head>
		<title> Account Info</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<b>Account Information</b>
	
	</body>
	
	<form action  ='updateRecord.php' method='post'>
	
	<p>
    DriverID: $row[DriverID]<br>
	Role: User <input type='radio' name='role' value='user' checked='checked'>
	Admin <input type='radio' name='role' value='admin'><br>
	Account Type: Student <input type='radio' name='AccountType' value='student' checked='checked'>
	Faculty <input type='radio' name='AccountType' value='Faculty'><br>
	First Name: <input type='text' name='FN' value='$row[FirstName]'><br>
	Last Name: <input type='text' name='LN' value='$row[LastName]'><br>
	Address: <input type='text' name='Address' value='$row[Address]'><br>
	Email: <input type='text' name='Email' value='$row[Email]'><br>
	Username: <input type='text' name='UN' value='$row[Username]'><br>
	Password: <input type='password' name='PW' value><br>
	Confirm Password: <input type='password' name='CPW' value><br>
	</p>
	
		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='DriverID' value='$row[DriverID]'>
		<input type='submit' value='UPDATE RECORD'>	
	</form>
	
_END;
}
}


if(isset($_POST['update'])){
	if($_POST['PW']==$_POST['CPW']){
	$accounttype = sanitizestring($_POST['AccountType']);
	$fn = sanitizestring($_POST['FN']);
	$ln = sanitizestring($_POST['LN']);
	$address = sanitizestring($_POST['Address']);
	$email = sanitizestring($_POST['Email']);
	$username = sanitizestring($_POST['UN']);
	$password = sanitizestring($_POST['PW']);
	$confirmed_password = sanitizestring($_POST['CPW']);
	$role = $_POST['role'];
	
	if($password != $confirmed_password){
		echo "Passwords do not Match";
		header("Location: Add_User.php");
	}
	
	$token = password_hash($password,PASSWORD_DEFAULT); 
	
	$query = "update driver set Type='$accounttype', FirstName='$fn', LastName='$ln', Address='$address', email='$email', Username='$username', Password_='$token', Role = '$role' where DriverID = $driverID";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Check_Account_info.php");
	}
}

$conn->close();

?>