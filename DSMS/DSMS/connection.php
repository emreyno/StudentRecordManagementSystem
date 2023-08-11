<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "DSMS";
$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(mysqli_connect_errno())
{
	echo 'Database Connection Error';
	die("Connection error!");
}

?>

