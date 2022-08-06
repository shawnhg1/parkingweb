<?php

$page_roles = array("admin");

require_once 'dbinfo.php';

require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query="SELECT * FROM driver";
$result=$conn->query($query);
if(!$result) die ($conn->error);

echo <<<_END
<html>
	<head>
		<title> Account Information</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<b>Account Information</b>
	<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
	<form action="Add_User.php" method="post">
	<input type="hidden" name="add" value="yes">
	<input type="submit" value="ADD RECORD">
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
Type: $row[Type]<br>
First Name: $row[FirstName]<br>
Last Name: $row[LastName]<br>
Address: $row[Address]<br>
Email: $row[Email]<br>
Username:$row[Username]<br>
	</p>
	<href='updateRecord.php?DriverID=$row[DriverID]>
<form action="updateRecord.php" method="post">
<input type="hidden" name="DriverID" value="$row[DriverID]">
<input type="submit" value="UPDATE RECORD">
	</form>
<form action="delete_driver.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="DriverID" value="$row[DriverID]">
<input type="submit" value="DELETE RECORD">
	</form>
	 
	
_END;
}
echo <<<_END
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
_END;

$result->close();
$conn->close();

?>