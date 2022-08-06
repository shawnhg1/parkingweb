<?php

$page_roles = array("user");

require_once 'dbinfo.php';

require_once 'security/checksession.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query="select violation.*, vehicle.DriverID, ViolationType.AmountDue, ViolationType.ViolationName from violation LEFT JOIN vehicle on vehicle.VehicleID = violation.VehicleID left join violationtype on violation.ViolationType = violationtype.ViolationType  where DriverID in (select DriverID from driver where Username='$username')";
$result=$conn->query($query);
if(!$result) die ($conn->error);

echo <<<_END
<html>
	<head>
		<title> Violations</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<b>Violations</b>
	
	<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
	
	</body>
</html>
_END;

$rows=$result->num_rows;
for($j=0; $j<$rows; $j++) {
	$result->data_seek($j);
	$row=$result->fetch_array(MYSQLI_BOTH);
		if(isset($row['PaymentID'])){
echo <<<_END
    <link rel='stylesheet' href='styles.css'>
	<p>
Violation Type: $row[ViolationType]<br>
Violation: $row[ViolationName]<br>
Date: $row[DateTime]<br>
Vehicle: $row[VehicleID]<br>
Payment: Paid <br><br><br>
 
	
_END;
	}else if(!isset($row['PaymentID'])){
echo <<<_END
    <link rel='stylesheet' href='styles.css'>
	<p>
Violation Type: $row[ViolationType]<br>
Violation: $row[ViolationName]<br>
Date: $row[DateTime]<br>
Vehicle: $row[VehicleID]<br>
Amount Due: $row[AmountDue]<br>
	</p>
<form action="Pay_Violation.php" method="post">
<input type="hidden" name="ViolationID" value="$row[ViolationID]">
<input type="hidden" name="DriverID" value="$row[DriverID]">
<input type="hidden" name="Vtype" value="$row[ViolationType]">
<input type="hidden" name="amount" value="$row[AmountDue]">
<input type="submit" value="PAY VIOLATION"><br><br><br>
		 
	
_END;
	}
}
echo <<<_END
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
_END;

$result->close();
$conn->close();
?>