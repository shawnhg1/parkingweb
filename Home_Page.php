<?php
$page_roles = array("admin","user");

require_once 'dbinfo.php';

require_once 'security/checksession.php';

$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if(isset($_SESSION['user'])){
	if(in_array('admin',$user_roles, false)){
	echo <<<_END
<html>
	<head>
		<title> Home Page</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a>
	
	<p>
	<a href='Login_Page.php' class="center"> Login </a><br>
	<a href='Check_Account_info.php' class="center"> Account Info </a><br>
	<a href='Check_Vehicle_info.php' class="center"> Vehcile Info </a><br>
	<a href='Check_Permit_info.php' class="center"> Permits </a><br>
	<a href='Check_Violation_info.php' class="center"> Violations </a><br>
	<a href='Check_Payment_info.php' class="center"> Forms of Payment</a><br>
	<a href='Parking_info.php' class="center"> Parking Lots</a><br>
	<a href='Outstanding_Violations.php' class="center"> Outstanding Violations</a><br>
	<a href='Permits_Revenue.php' class="center"> Permit Revenue</a><br>
	<a href='Violations_Revenue.php' class="center"> Violations Revenue</a><br>
	<a href='logout.php' class="center"> Logout </a><br>
	</p>
	
	</body>
	
</html>
_END;



}else{




echo <<<_END
<html>
	<head>
		<title> Home Page</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a>
	
	<p>
	<a href='Login_Page.php' class="center"> Login </a><br>
	<a href='Check_Account_info.php' class="center"> Account Info </a><br>
	<a href='Check_Vehicle_info.php' class="center"> Vehcile Info </a><br>
	<a href='Check_Permit_info.php' class="center"> Permits </a><br>
	<a href='Check_Violation_info.php' class="center"> Violations </a><br>
	<a href='Check_Payment_info.php' class="center"> Forms of Payment</a><br>
	<a href='logout.php' class="center"> Logout </a><br>
	</p>
	
	</body>
	
</html>
_END;
}
}

?>