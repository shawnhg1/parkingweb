<?php

$page_roles = array("admin");

require_once 'dbinfo.php';

require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query="select * from parkinglot";
$result=$conn->query($query);
if(!$result) die ($conn->error);
echo <<<_END
<html>
	<head>
		<title>Parking Lots</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<b>Parking Lots</b>
	

<a href='Home_Page.php' class="center"> Return to Home Page </a><br>

	<form action="Add_lot.php" method="post">
	<input type="submit" value="ADD LOT">
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
Lot ID: $row[LotID]<br>
Permit Type: $row[PermitType]<br>
Address: $row[Address]<br>
Capcity: $row[Capacity]<br>

	</p>
<form action="space_info.php" method="post">
<input type="hidden" name="LotID" value=$row[LotID]>
<input type="submit" value="VIEW PARKING SPACES">
	</form>
<form action="updatelot.php" method="post">
<input type="hidden" name="LotID" value=$row[LotID]>
<input type="submit" value="UPDATE LOT">
	</form>
<form action="delete_lot.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="LotID" value=$row[LotID]>
<input type="submit" value="DELETE LOT">
	</form>
	 
	
_END;

	
}
echo <<<_END
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
_END;

$result->close();
$conn->close();

?>