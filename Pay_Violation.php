<?php
require_once 'dbinfo.php';
include 'security/sanitize.php';
$page_roles = array("user");


require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);

if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['ViolationID'])){
	$DriverID = $_POST['DriverID'];
	$ViolationID= $_POST['ViolationID'];
	$type = $_POST['Vtype'];
	$cost = $_POST['amount'];

	
	$query = "select * from Payment where DriverID = $DriverID";

$result = $conn->query($query);
if(!$result) die($conn->error);


	echo <<<_END
	
	<html>
	<head>
		<title> Buy Permit </title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<b>Purchase Permit</b>
	
	
	<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
	</body>
	
	<p>
	Violation Type: $type <br>
	Amount Due: $cost <br>
	</p>
_END;

	

	
$rows = $result->num_rows;
for($j=0; $j<$rows; ++$j){
	$row = $result->fetch_array(MYSQLI_ASSOC);
if(isset($row['CreditCardNo'])){
echo <<<_END
	<p>
	Credit Card Number: $row[CreditCardNo]<br>
	</p>
	
	<form action  ='Pay_Violation.php' method='post'>
	<input type='hidden' name='update' value='yes'>
	<input type='hidden' name='VID' value='$_POST[ViolationID]'>
	<input type='hidden' name='PaymentID' value='$row[PaymentID]'>
	<input type='submit' value='SELECT PAYMENT'>
	</form>

	</body>
</html>
_END;
}

if(isset($row['CheckNo'])){
echo <<<_END
	<p>
Check Number: $row[CheckNo]<br>
	</p>
	
	<form action  ='Pay_Violation.php' method='post'>
	<input type='hidden' name='update' value='yes'>
	<input type='hidden' name='VID' value='$_POST[ViolationID]'>
	<input type='hidden' name='PaymentID' value='$row[PaymentID]'>
	<input type='submit' value='SELECT PAYMENT'>
	</form>
</html>
_END;
}
if(isset($row['Cash'])){
echo <<<_END
	<p>
Cash Credit: $row[Cash]<br>
	</p>
	
	<form action  ='Pay_Violation.php' method='post'>
	<input type='hidden' name='update' value='yes'>
	<input type='hidden' name='VID' value='$_POST[ViolationID]'>
	<input type='hidden' name='PaymentID' value='$row[PaymentID]'>
	<input type='submit' value='SELECT PAYMENT'>
	</form>
</html>
_END;
		}
		
	}

}
	if(isset($_POST['update'])){
		$PID = $_POST['PaymentID'];
		$ViolationID = $_POST['VID'];
	
	
	$query = "update violation set PaymentID='$PID' where ViolationID = $ViolationID";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Check_Violation_info.php");
	
}
	?>