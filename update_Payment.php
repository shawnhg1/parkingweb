<?php
require_once 'dbinfo.php';
include 'security/sanitize.php';

$conn = new mysqli($hn, $un, $pw, $db);

if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['PaymentID'])){
	
	$PaymentID = $_POST['PaymentID'];
	
	
$query = "select * from payment where PaymentID = $PaymentID";

$result = $conn->query($query);
if(!$result) die($conn->error);
	
$rows = $result->num_rows;

for($j=0; $j<$rows; ++$j){
	
	//$result->data_seek($j);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	
	echo <<<_END
	
	<html>
	<head>
		<title> Payment Info</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<b>Account Information</b>
	
	</body>
_END;
if(isset($row['CreditCardNo'])){
	echo <<<_END
	<form action  ='update_Payment.php' method='post'>
	
	<p>
	Credit Card Number: <input type='text' name='CCN' value='$row[CreditCardNo]'><br>
	</p>
	
		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='PaymentID' value='$row[PaymentID]'>
		<input type='submit' value='UPDATE RECORD'>	
	</form>
	
_END;
}
if(isset($row['CheckNo'])){
	echo <<<_END
	<form action  ='update_Payment.php' method='post'>
	
	<p>
	Check Number: <input type='text' name='CheckNo' value='$row[CheckNo]'><br>
	</p>
	
		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='PaymentID' value='$row[PaymentID]'>
		<input type='submit' value='UPDATE RECORD'>	
	</form>
	
_END;
}
if(isset($row['Cash'])){
	echo <<<_END
	<form action  ='update_Payment.php' method='post'>
	
	<p>
	Cash Amount: <input type='text' name='Cash' value='$row[Cash]'><br>
	</p>
	
		<input type='hidden' name='update' value='yes'>
		<input type='hidden' name='PaymentID' value='$row[PaymentID]'>
		<input type='submit' value='UPDATE RECORD'>	
	</form>
	
_END;
}
}
}


if(isset($_POST['update'])){
	if(isset($_POST['CCN'])){
	$PaymentID = $_POST['PaymentID'];
	$info = sanitizestring($_POST['CCN']);

	
	$query = "update Payment set CreditCardNo='$info' where PaymentID = $PaymentID";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Check_Payment_info.php");
	}
	if(isset($_POST['CheckNo'])){
	$PaymentID = $_POST['PaymentID'];
	$info = sanitizestring($_POST['CheckNo']);

	
	$query = "update Payment set CheckNo='$info' where PaymentID = $PaymentID";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Check_Payment_info.php");
	}
	if(isset($_POST['Cash'])){
	$PaymentID = $_POST['PaymentID'];
	$info = sanitizestring($_POST['Cash']);

	
	$query = "update Payment set Cash='$info' where PaymentID = $PaymentID";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Check_Payment_info.php");
	}
}

$conn->close();

?>