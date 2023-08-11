<?php
session_start(); 
include('connection.php');
error_reporting(0);

  if($_SESSION['user_status'] != "admin"){
    header("Location: home.php");
    exit;
  }

$sql = "TRUNCATE TABLE login_history";
$results = mysqli_query($con, $sql);

//for log
//for the login history
$log_name = $_SESSION['ln'];
$status = $_SESSION['stat'];
$action = "Cleared History Log";
$sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
$result1 = mysqli_query($con, $sql1);
$_SESSION['log_cleared']=true;
header("Location: loghistory.php");

?>