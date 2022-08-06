<html>
	<head>
		<title> Login Page</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<body>
		<form method='post' action='Login_Page.php'>
			Username: <input type='text' name='username'><br>
			Password: <input type='password' name='password'><br><br>
			<input type='submit' value='Login'>
		</form>
		<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
	</body>

</html>

<?php

require_once 'dbinfo.php';
require_once 'user.php';

$conn = new mysqli($hn, $un, $pw, $db);
if($conn->connect_error) die($conn->connect_error);

if (isset($_POST['username']) && isset($_POST['password'])) {
	
	//Get values from login screen
	$tmp_username = mysql_entities_fix_string($conn, $_POST['username']);
	$tmp_password = mysql_entities_fix_string($conn, $_POST['password']);
	
	//get password from DB w/ SQL
	$query = "SELECT Password_ FROM driver WHERE Username = '$tmp_username'";
	
	$result = $conn->query($query); 
	if(!$result) die($conn->error);
	
	$rows = $result->num_rows;
	$passwordFromDB="";
	for($j=0; $j<$rows; $j++)
	{
		$result->data_seek($j); 
		$row = $result->fetch_array(MYSQLI_ASSOC);
		$passwordFromDB = $row['Password_'];
	
	}
	
	//Compare passwords
	if(password_verify($tmp_password,$passwordFromDB))
	{

		$user = new User($tmp_username);

		session_start();
		$_SESSION['user'] = $user;
		
		header("Location: Home_Page.php");
	}
	else
	{
		echo "Your Username or Password is incorrect<br>";
	}	
	
}

$conn->close();


//sanitization functions
function mysql_entities_fix_string($conn, $string){
	return htmlentities(mysql_fix_string($conn, $string));	
}

function mysql_fix_string($conn, $string){
	$string = stripslashes($string);
	return $conn->real_escape_string($string);
}
?>