<?php

session_start();

destroy_session_and_data();

function destroy_session_and_data(){
	$_SESSION = array();
	setcookie(session_name(), '', time()-2592000, '/');
	session_destroy();
}
echo <<<_END
<html>
	<head>
		<title> Home Page</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br><br>
	<p>
	You Have Successfully Logged Out<br><a href='Home_Page.php'> Return to Home Page </a>
	</p>
	</body>
	
</html>
_END;
?>