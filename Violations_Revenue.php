<?php

$page_roles = array("admin");

require_once 'dbinfo.php';

require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);


echo <<<_END
<html>
	<head>
		<title>Violations Revenue</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<b>Violations Revenue</b>
	
	<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
	
	<form action  ='Violations_Revenue_output.php' method='post'>
	
	Start Date: <input type='date' name='start'><br>
	Finish Date: <input type='date' name='end'><br><br>
	
		<input type='hidden' name='date' value='yes'>
		<input type='submit' value='SEND REQUEST'>	
	</form>
	

	</body>

<p>
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
</p>
</html>
_END;
?>