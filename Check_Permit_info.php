<?php
$page_roles = array("admin","user");

require_once 'dbinfo.php';

require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if(!isset($_SESSION['user'])){
	header("Location: Login_Page.php");
	exit();
}
if(in_array('admin',$user_roles, false)){
	header("Location: admin_Permit_info.php");
	exit();
}elseif(in_array('user',$user_roles, false)){
	header("Location: User_Permit_info.php");
	exit();
}
?>
