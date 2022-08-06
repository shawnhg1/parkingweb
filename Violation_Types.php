<?php

$page_roles = array("admin");

require_once 'dbinfo.php';

require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query="select * from violationtype";
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
	
	
<a href='admin_Violations_Page.php' class="center"> Return to Violations </a><br>
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>


	<form action="Add_Type.php" method="post">
	<input type="submit" value="ADD TYPE">
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
Violation Type: $row[ViolationType]<br>
Violation: $row[ViolationName]<br>
Amount Due: $row[AmountDue]<br>

	</p>
<form action="updatetype.php" method="post">
<input type="hidden" name="ID" value=$row[ViolationTypeID]>
<input type="submit" value="UPDATE TYPE">
	</form>
<form action="delete_Type.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="ID" value=$row[ViolationTypeID]>
<input type="submit" value="DELETE TYPE">
	</form>
	 
	
_END;

	
}
echo <<<_END
<a href='admin_Violations_Page.php' class="center"> Return to Violations </a><br>
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
_END;

$result->close();
$conn->close();

?>