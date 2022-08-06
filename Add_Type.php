<?php

require_once 'dbinfo.php';
include 'security/sanitize.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

echo <<<_END
<html>
	<head>
		<title> Parking Lots </title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<a> <img src='images/u_of_u.png' class="center"></img> </a><br>
	
	<b>Parking Lots</b>
	 
	


	<form action  ='Add_Type.php' method='post'>
	Type: <input type='text' name='type'><br>
	Violation: <input type='text' name='violation'><br>
	Amount Due: <input type='text' name='due'><br>
	<input type='hidden' name='add' value='yes'>
	<input type='submit' value='ADD RECORD'>	
	</form>
		</body>
</html>

_END;

if(isset($_POST['add'])){
	
	$type = $_POST['type'];
	$vio = $_POST['violation'];
	$due = $_POST['due'];
	$query = "insert into violationtype (ViolationName, AmountDue, ViolationType) Values ('$vio','$due','$type')";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Violation_Types.php");

			
echo <<<_END
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
_END;
}
$conn->close();
?>