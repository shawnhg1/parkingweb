<?php

require_once 'dbinfo.php';
include 'security/sanitize.php';
$page_roles = array("admin");


require_once 'security/checksession.php';


$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);


if(isset($_POST['delete']))
{
	$ViolationID = $_POST['ViolationID'];

	$query = "DELETE FROM violation WHERE ViolationID='$ViolationID' ";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	header("Location: Check_Violation_info.php");
	
}


?>