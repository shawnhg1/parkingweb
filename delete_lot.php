<?php

require_once 'dbinfo.php';


$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if(isset($_POST['delete']))
{
	$LotID = $_POST['LotID'];

	$query = "DELETE FROM parkinglot WHERE LotID='$LotID' ";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	header("Location: Parking_info.php");
	
}


?>