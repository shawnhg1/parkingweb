<?php

require_once 'dbinfo.php';


$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if(isset($_POST['delete']))
{
	$DriverID	= $_POST['DriverID'];

	$query = "DELETE FROM driver WHERE DriverID='$DriverID' ";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	header("Location: Check_Account_info.php");
	
}


?>