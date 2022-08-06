<?php

require_once 'dbinfo.php';
include 'security/sanitize.php';
$page_roles = array("admin","user");


require_once 'security/checksession.php';

	
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

if(in_array('admin',$user_roles, false)){

$DriverID = $_POST['DriverID'];
echo <<<_END
<html>
	<head>
		<title> Forms of Payment</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<img src='images/u_of_u.png' class="center"></img></a><br>
	
	<b>Forms of Payment</b>
	
	<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
	
	
	<form action  ='Add_Cash.php' method='post'>
	
	DriverID:<input type='text' name='DriverID' value><br>
	Cash Amount: <input type='text' name='CreditCardNumber' value><br>
	<input type='hidden' name='add' value='yes'>
	<input type='submit' value='ADD RECORD'>	
	</form>
		</body>
	 
	</body>
</html>
_END;

if(isset($_POST['CreditCardNumber'])){
	$driverID = sanitizestring($_POST['DriverID']);
	$CC = sanitizestring($_POST['CreditCardNumber']);
	$date = date('Y-m-d h:i:s', time());

	
	
	
	$query = "insert into payment (DriverID, Cash, Date) Values ('$driverID','$CC','$date')";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Check_Payment_info.php");
    }
}else{
	
$query="select DriverID from driver where Username='$username'";
$result=$conn->query($query);
if(!$result) die ($conn->error);


$rows=$result->num_rows;
for($j=0; $j<$rows; $j++) {
	$result->data_seek($j);
	$row=$result->fetch_array(MYSQLI_BOTH);

	echo <<<_END

<html>
	<head>
		<title> Payment Info</title>
		<link rel='stylesheet' href='styles.css'>
	</head>
	<body>
	<h1> U of U Parking </h1>
	
	<a> <img src='images/u_of_u.png' class="center"></img> </a><br>
	
	<b>Forms of Payment</b>
	 
	


	<form action  ='Add_Cash.php' method='post'>
	
	DriverID: $row[DriverID]<br>
	Cash Amount: <input type='text' name='CreditCardNumber' value><br>
	<input type='hidden' name='add' value='yes'>
	<input type='submit' value='ADD RECORD'>	
	</form>
		</body>
</html>

_END;

if(isset($_POST['CreditCardNumber'])){
	$driverID = $row[DriverID];
	$CC = sanitizestring($_POST['CreditCardNumber']);
	$date = date('Y-m-d h:i:s', time());

	
	
	
	$query = "insert into payment (DriverID, Cash, Date) Values ('$driverID','$CC','$date')";
	
	$result = $conn->query($query);
	if(!$result) die($conn->error);
	
	header("Location: Check_Payment_info.php");
    }
}

}
$conn->close();
?>