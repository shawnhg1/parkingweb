<?php

require_once 'dbinfo.php';


$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if(isset($_POST['delete']))
{
	$VehicleID = $_POST['VehicleID'];

	$query = "DELETE FROM vehicle WHERE VehicleID='$VehicleID' ";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	header("Location: Check_Vehicle_info.php");
	
}


?>