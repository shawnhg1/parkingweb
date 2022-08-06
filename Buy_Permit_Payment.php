<?php
require_once 'dbinfo.php';
include 'security/sanitize.php';
$page_roles = array("user");


require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);

if($conn->connect_error) die($conn->connect_error);

if(isset($_POST['VehicleID'])){
	$DriverID = $_POST['DriverID'];
	$VID = $_POST['VehicleID'];
	$type= $_POST['Type'];
	$date = date('Y-m-d');
	
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
    Vehicle ID: $_POST[VehicleID]<br>
	Driver ID: $_POST[DriverID]<br>
	Permit Type: $_POST[Type] <br>
	Cost: $_POST[Cost] <br>
	</p>
_END;

	

	
$rows = $result->num_rows;
for($j=0; $j<$rows; ++$j){
	$row = $result->fetch_array(MYSQLI_ASSOC);
if(isset($row['CreditCardNo'])){
echo <<<_END
	<p>
	Credit Card Number: $row[CreditCardNo]<br>
	Date: $row[Date]<br>
	</p>
	
	<form action  ='insert_Permit_Payment.php' method='post'>
	<input type='hidden' name='update2' value='yes'>
	<input type='hidden' name='DID' value='$_POST[DriverID]'>
	<input type='hidden' name='VID' value='$_POST[VehicleID]'>
	<input type='hidden' name='type' value='$_POST[Type]'>
	<input type='hidden' name='Cost' value='$_POST[Cost]'>
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
Date: $row[Date]<br>
	</p>

	<form action  ='insert_Permit_Payment.php' method='post'>
	<input type='hidden' name='update2' value='yes'>
	<input type='hidden' name='DID' value='$_POST[DriverID]'>
	<input type='hidden' name='VID' value='$_POST[VehicleID]'>
	<input type='hidden' name='type' value='$_POST[Type]'>
	<input type='hidden' name='Cost' value='$_POST[Cost]'>
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
Date: $row[Date]<br>
	</p>

	<form action  ='insert_Permit_Payment.php' method='post'>
	<input type='hidden' name='update2' value='yes'>
	<input type='hidden' name='DID' value='$_POST[DriverID]'>
	<input type='hidden' name='VID' value='$_POST[VehicleID]'>
	<input type='hidden' name='type' value='$_POST[Type]'>
	<input type='hidden' name='Cost' value='$_POST[Cost]'>
	<input type='hidden' name='PaymentID' value='$row[PaymentID]'>
	<input type='submit' value='SELECT PAYMENT'>
	</form>
</html>
_END;
		}
		
	}

}
	
	?>