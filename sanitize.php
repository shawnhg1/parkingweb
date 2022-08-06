<?php

function sanitizestring($var){
	$var = stripslashes($var);
	$var = strip_tags($var);
	$var = htmlentities($var);
	return $var;
}
Function SanitizeMySQL($connection, $var){
	$var = sanitizestring($var);
	$var = $connection->real_escape_string($var);
	return $var;
}
?>