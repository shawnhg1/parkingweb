<?php

require_once 'dbinfo.php';
include 'security/sanitize.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$LotID = $_POST['LotID'];
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
	 
	


	<form action  ='Add_Space.php' method='post'>
	Field: A <input type='radio' name='Field' value='A'>
	B <input type='radio' name='Field' value='B'>
	C<input type='radio' name='Field' value='C'><br><br>
	<input type='hidden' name='LotID' value=$LotID>
	<input type='hidden' name='add' value='yes'>
	<input type='submit' value='ADD RECORD'>	
	</form>
		</body>
</html>

_END;

if(isset($_POST['add'])){
	
	$field = $_POST['Field'];
	$LotID = $_POST['LotID'];
	$query = "insert into parkingspace (Field, LotID) Values ('$field','$LotID')";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Parking_info.php");

			
echo <<<_END
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
_END;
}
$conn->close();
?>