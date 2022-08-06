<?php

$page_roles = array("admin");

require_once 'dbinfo.php';

require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$LotID = $_POST['LotID'];

$query="select * from parkingspace where LotID = $LotID";

$result=$conn->query($query);
if(!$result) die ($conn->error);

echo <<<_END
<html>
	<head>
		<title>Parking Spaces</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<b>Parking Spaces</b>
	

<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
<a href='Parking_info.php' class="center"> Back to Parking Lots </a><br>

	<form action="Add_Space.php" method="post">
	<input type="hidden" name="LotID" value=$LotID>
	<input type="submit" value="ADD SPACE">
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
Space ID: $row[SpaceID]<br>
Field: $row[Field]<br>


	</p>
<form action="updatespace.php" method="post">
<input type="hidden" name="SpaceID" value=$row[SpaceID]>
<input type="submit" value="UPDATE SPACE">
	</form>
<form action="delete_space.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="SpaceID" value=$row[SpaceID]>
<input type="submit" value="DELETE SPACE">
	</form>
	 
	
_END;

	
}
echo <<<_END
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
<a href='Parking_info.php' class="center"> Back to Parking Lots </a><br>
_END;

$result->close();
$conn->close();

?>