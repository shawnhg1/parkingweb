<?php

require_once 'dbinfo.php';


$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if(isset($_POST['delete']))
{
	$SpaceID = $_POST['SpaceID'];

	$query = "DELETE FROM parkingspace WHERE SpaceID='$SpaceID' ";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	header("Location: Parking_info.php");
	
}


?>