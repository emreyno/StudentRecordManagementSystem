<?php 
session_start();
include 'connection.php';

//for the login history
$log_name = $_SESSION['ln'];
$status = $_SESSION['stat'];

$action = "Logged Out";
$sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
$result1 = mysqli_query($con, $sql1);

session_unset();
session_destroy();

header("Location: index.php");

?>