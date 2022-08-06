<?php

$page_roles = array("admin");

require_once 'dbinfo.php';

require_once 'security/checksession.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query="select violation.*, ViolationType.AmountDue, ViolationType.ViolationName from violation LEFT JOIN violationtype on violation.ViolationType = violationtype.ViolationType";
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
	
	<form action="Outstanding_Violations.php" method="post">
	<input type="hidden" name="add" value="yes">
	<input type="submit" value="OUTSTANDING VIOLATIONS">
	</form>
	
	<form action="Violation_Types.php" method="post">
	<input type="hidden" name="add" value="yes">
	<input type="submit" value="VIOLATION TYPES">
	</form>
	
	<form action="Add_Violation.php?dt=DateTime" method="post">
	<input type="hidden" name="add" value="yes">
	<input type="submit" value="ADD Violation">
	</form>
	
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
Payment: Paid<br>
	</p>

<form action="updateviolation.php" method="post">
<input type="hidden" name="ViolationID" value="$row[ViolationID]">
<input type="submit" value="UPDATE RECORD">
	</form>
<form action="delete_violation.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="ViolationID" value="$row[ViolationID]">
<input type="submit" value="DELETE RECORD">
	</form>
	 
	
_END;
}else{
echo <<<_END
    <link rel='stylesheet' href='styles.css'>
	<p>
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