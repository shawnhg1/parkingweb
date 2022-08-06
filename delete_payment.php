<?php

require_once 'dbinfo.php';


$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if(isset($_POST['delete']))
{
	$PaymentID	= $_POST['PaymentID'];

	$query = "DELETE FROM payment WHERE PaymentID='$PaymentID' ";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	header("Location: Check_Payment_info.php");
	
}


?>