
<html>
	<head>
		<title> Parking Lots </title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<a> <img src='images/u_of_u.png' class="center"></img> </a><br>
	
	<b>Parking Lots</b>
	 
	


	<form action  ='Add_lot.php' method='post'>
	Permit Type: Student <input type='radio' name='type' value='Student'>
	Faculty <input type='radio' name='type' value='Faculty'>
	Mixed <input type='radio' name='type' value='Mixed'><br>
	Address:<input type='text' name='address'><br>
	Capacity: <input type='text' name='cap'><br><br>
	<input type='hidden' name='add' value='yes'>
	<input type='submit' value='ADD RECORD'>	
	</form>
		</body>
</html>

<?php

require_once 'dbinfo.php';
include 'security/sanitize.php';
$page_roles = array("admin");


require_once 'security/checksession.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

	
if(isset($_POST['add'])){
	
	$type = ($_POST['type']);
	$address = sanitizestring($_POST['address']);
	$cap = sanitizestring($_POST['cap']);
	
	
	
		
	$query = "insert into parkinglot (PermitType, Address, Capacity) Values ('$type','$address', '$cap')";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Parking_info.php");

			
echo <<<_END
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
_END;
}
$conn->close();
?>