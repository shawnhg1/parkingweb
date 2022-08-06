<?php

$page_roles = array("admin");

require_once 'dbinfo.php';

require_once 'security/checksession.php';

$sum =0;
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query="select violation.*, vehicle.DriverID, ViolationType.AmountDue, ViolationType.ViolationName from violation LEFT JOIN vehicle on vehicle.VehicleID = violation.VehicleID left join violationtype on violation.ViolationType = violationtype.ViolationType";
$result=$conn->query($query);
if(!$result) die ($conn->error);

echo <<<_END
<html>
	<head>
		<title>Outstanding Violations</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<b>Outstanding Violations</b>
	
	<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
	

	</body>
</html>
_END;

$rows=$result->num_rows;
for($j=0; $j<$rows; $j++) {
	$result->data_seek($j);
	$row=$result->fetch_array(MYSQLI_BOTH);

if(!isset($row['PaymentID'])){
	$sum = $sum + $row['AmountDue'];
echo <<<_END
    <link rel='stylesheet' href='styles.css'>
	<p>
Driver ID: $row[DriverID]<br>
Violation Type: $row[ViolationType]<br>
Violation: $row[ViolationName]<br>
Date: $row[DateTime]<br>
Vehicle: $row[VehicleID]<br>
Amount Due: $row[AmountDue]<br>
	</p>

<form action="updateviolation.php" method="post">
<input type="hidden" name="ViolationID" value="$row[ViolationID]">
<input type="submit" value="UPDATE RECORD">
	</form>
<form action="delete_violation.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="ViolationID" value="$row[ViolationID]">
<input type="submit" value="DELETE RECORD">
	</form><br>
	 
	
_END;

}
}
echo <<<_END
<p>
Total Due: $sum<br><br>
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
</p>
_END;

$result->close();
$conn->close();
?>