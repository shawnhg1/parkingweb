
<html>
	<head>
		<title> Vehicle Info</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<a> <img src='images/u_of_u.png' class="center"></img> </a><br>
	
	<b>Account Information</b>
	 
	


	<form action  ='Add_User.php' method='post'>
	Role: User <input type='radio' name='role' value='user' checked='checked'>
	Admin <input type='radio' name='role' value='admin'><br>
	Account Type: Student <input type='radio' name='AccountType' value='student' checked='checked'>
	Faculty <input type='radio' name='AccountType' value='Faculty'><br>
	First Name: <input type='text' name='FN'><br>
	Last Name: <input type='text' name='LN' value><br>
	Address: <input type='text' name='address' value><br>
	Email: <input type='text' name='email' value><br>
	Username: <input type='text' name='UN' value><br>
	Password: <input type='password' name='PW' value><br>
	Confirm Password: <input type='password' name='CPW' value><br><br>
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

	
if(isset($_POST['UN'])){
	if($_POST['PW']==$_POST['CPW']){
	$accounttype = sanitizestring($_POST['AccountType']);
	$fn = sanitizestring($_POST['FN']);
	$ln = sanitizestring($_POST['LN']);
	$address = sanitizestring($_POST['address']);
	$email = sanitizestring($_POST['email']);
	$username = sanitizestring($_POST['UN']);
	$password = sanitizestring($_POST['PW']);
	$confirmed_password = sanitizestring($_POST['CPW']);
	$role = $_POST['role'];
	
	if($password != $confirmed_password){
		echo "Passwords do not Match";
		header("Location: Add_User.php");
	}
	
	$token = password_hash($password,PASSWORD_DEFAULT); 
	
	
	$query = "insert into driver (Type, FirstName, LastName, Address, Email, Username, Password_, role) Values ('$accounttype','$fn','$ln', '$address', '$email', '$username', '$token', '$role')";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
		
	header("Location: Check_Account_info.php");
    }
}
echo <<<_END
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
_END;


$conn->close();
?>