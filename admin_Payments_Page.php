<?php

$page_roles = array("admin");

require_once 'dbinfo.php';

require_once 'security/checksession.php';


$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);

$query="SELECT * FROM payment";
$result=$conn->query($query);
if(!$result) die ($conn->error);

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
	
	<form action="Add_CreditCard.php" method="post">
	<input type="hidden" name="add" value="yes">
	<input type="hidden" name="DriverID" value="null">
	<input type="submit" value="ADD CREDIT CARD">
	</form>
	<form action="Add_Check.php" method="post">
	<input type="hidden" name="add" value="yes">
	<input type="hidden" name="DriverID" value="null">
	<input type="submit" value="ADD CHECK">
	</form>
	<form action="Add_Cash.php" method="post">
	<input type="hidden" name="add" value="yes">
	<input type="hidden" name="DriverID" value="null">
	<input type="submit" value="ADD CASH">
	</form>
	</body>
</html>
_END;

$rows=$result->num_rows;
for($j=0; $j<$rows; $j++) {
	$result->data_seek($j);
	$row=$result->fetch_array(MYSQLI_BOTH);
if(isset($row['CreditCardNo'])){
echo <<<_END
    <link rel='stylesheet' href='styles.css'>
	<p>
Credit Card Number: $row[CreditCardNo]<br>
Date: $row[Date]<br>
	</p>

<form action="update_Payment.php" method="post">
<input type="hidden" name="PaymentID" value="$row[PaymentID]">
<input type="submit" value="UPDATE RECORD">
	</form>
<form action="delete_payment.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="PaymentID" value="$row[PaymentID]">
<input type="submit" value="DELETE RECORD">
	</form>
	 
	
_END;
}
if(isset($row['CheckNo'])){
echo <<<_END
    <link rel='stylesheet' href='styles.css'>
	<p>
Check Number: $row[CheckNo]<br>
Date: $row[Date]<br>
	</p>

<form action="update_payment.php" method="post">
<input type="hidden" name="PaymentID" value="$row[PaymentID]">
<input type="submit" value="UPDATE RECORD">
	</form>
<form action="delete_payment.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="PaymentID" value="$row[PaymentID]">
<input type="submit" value="DELETE RECORD">
	</form>
	 
	
_END;
}
if(isset($row['Cash'])){
echo <<<_END
    <link rel='stylesheet' href='styles.css'>
	<p>
Cash Credit: $row[Cash]<br>
Date: $row[Date]<br>
	</p>

<form action="update_payment.php" method="post">
<input type="hidden" name="PaymentID" value="$row[PaymentID]">
<input type="submit" value="UPDATE RECORD">
	</form>
<form action="delete_payment.php" method="post">
<input type="hidden" name="delete" value="yes">
<input type="hidden" name="PaymentID" value="$row[PaymentID]">
<input type="submit" value="DELETE RECORD">
	</form>
	 
	
_END;
}

}
echo <<<_END
<a href='Home_Page.php' class="center"> Return to Home Page </a><br>
_END;

$result->close();
$conn->close();
?>