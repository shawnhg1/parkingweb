<?php

$page_roles = array("admin");

require_once 'dbinfo.php';

require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

	
$sum=0;
$start=$_POST['start'];
$end=$_POST['end'];
	
$query="select Permit.Cost from permit where PermitID in(Select PermitID from permit where '$start' <= PurchaseDate <= '$end')";

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
	
	<b>Permit Revenue</b>
	
	<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
	

	</body>
</html>
_END;

$rows=$result->num_rows;
for($j=0; $j<$rows; $j++) {
	$result->data_seek($j);
	$row=$result->fetch_array(MYSQLI_BOTH);
	$sum = $sum + $row['Cost'];
}


echo <<<_END
<p>
Total Revenue from Permits: $ $sum<br><br>
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
</p>
_END;

$result->close();
$conn->close();



?>