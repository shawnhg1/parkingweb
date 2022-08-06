<?php

require_once 'dbinfo.php';


$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if(isset($_POST['delete']))
{
	$PermitID = $_POST['PermitID'];

	$query = "DELETE FROM permit WHERE PermitID='$PermitID' ";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	header("Location: Check_Permit_info.php");
	
}


?>