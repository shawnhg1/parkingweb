<?php

$page_roles = array("user");

require_once 'dbinfo.php';

require_once 'security/checksession.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query="select vehicle.*, Violation.ViolationID, Violation.ViolationType from vehicle LEFT JOIN violation on vehicle.VehicleID = violation.VehicleID where DriverID in (select DriverID from driver where Username='$username')";
$result=$conn->query($query);
if(!$result) die ($conn->error);

echo <<<_END
<html>
	<head>
		<title> Vehicle Info</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<b>Vehicle Information</b>

<a href='Home_Page.php' class="center"> Return to Home Page </a><br><br>

	
	<form action="Add_User_Vehicle.php" method="post">
	<input type="hidden" name="add" value="yes">
	<input type="submit" value="ADD VEHICILE">
	</form>
	 
	</body>
_END;

$rows=$result->num_rows;
for($j=0; $j<$rows; $j++) {
	$result->data_seek($j);
	$row=$result->fetch_array(MYSQLI_BOTH);
	if(isset($row['ViolationID'])){
echo <<<_END
    <link rel='stylesheet' href='styles.css'>
	<p>
License Plate: $row[LicensePlate]<br>
Make: $row[Make]<br>
Model: $row[Model]<br>
Color: $row[Color]<br>
Year: $row[Year]<br>
Violations: $row[ViolationID]<br>
Violation Type: $row[ViolationType]<br>
	</p>
<form action="Buy_Permit.php" method="post">
<input type="hidden" name="VehicleID" value="$row[VehicleID]">
	<input type="hidden" name="add" value="yes">
	<input type="submit" value="ADD PERMIT">
	</form>

<form action="Check_Violation_info.php" method="post">
<input type="hidden" name="ViolationID" value="$row[ViolationID]">
<input type="submit" value="PAY VIOLATION">
	</form>
<form action="User_updatevehicle.php" method="post">
<input type="hidden" name="VehicleID" value="$row[VehicleID]">
<input type="submit" value="UPDATE RECORD">
	</form>
<form action="delete_vehicle.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="VehicleID" value="$row[VehicleID]">
<input type="submit" value="DELETE RECORD">
	</form>
	 
	
_END;
}else{

	echo <<<_END
    <link rel='stylesheet' href='styles.css'>
	<p>
License Plate: $row[LicensePlate]<br>
Make: $row[Make]<br>
Model: $row[Model]<br>
Color: $row[Color]<br>
Year: $row[Year]<br>
	</p>
<form action="Buy_Permit.php" method="post">
<input type="hidden" name="VehicleID" value="$row[VehicleID]">
	<input type="hidden" name="add" value="yes">
	<input type="submit" value="ADD PERMIT">
	</form>

<form action="User_updatevehicle.php" method="post">
<input type="hidden" name="VehicleID" value="$row[VehicleID]">
<input type="submit" value="UPDATE RECORD">
	</form>
<form action="delete_vehicle.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="VehicleID" value="$row[VehicleID]">
<input type="submit" value="DELETE RECORD">
	</form>
	 
	
_END;
}
}
echo <<<_END
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
_END;
	

$result->close();
$conn->close();

?>