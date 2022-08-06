<?php

$page_roles = array("user");

require_once 'dbinfo.php';

require_once 'security/checksession.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query="select * from Permit where DriverID in (select DriverID from driver where Username='$username')";
$result=$conn->query($query);
if(!$result) die ($conn->error);

echo <<<_END
<html>
	<head>
		<title> Permits</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<b>Permits</b>
	
	<form action="Check_Vehicle_info.php" method="post">
	<input type="hidden" name="add" value="yes">
	<input type="submit" value="ADD PERMIT">
	</form>
	 
	</body>
_END;

$rows=$result->num_rows;
for($j=0; $j<$rows; $j++) {
	$result->data_seek($j);
	$row=$result->fetch_array(MYSQLI_BOTH);
echo <<<_END
    <link rel='stylesheet' href='styles.css'>
	<p>
Permit Type: $row[PermitType]<br>
VehicleID: $row[VehicleID]<br>
Purchase Date: $row[PurchaseDate]<br>
Expriation Date: $row[ExpiryDate]<br>
Cost: $row[Cost]<br>
	</p>
	 
	
_END;
}
echo <<<_END
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
_END;
	

$result->close();
$conn->close();

?>