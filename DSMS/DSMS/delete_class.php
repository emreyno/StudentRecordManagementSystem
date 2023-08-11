<?php
session_start(); 
include('connection.php');

if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}

$course_num = $_POST['id'];

$grab = "SELECT * FROM class WHERE course_num = '$course_num'";
$grabquery = mysqli_query($con, $grab);
$grabrow = $grabquery->fetch_assoc();

$class_title = $grabrow['course_title'];

//for the login history
$log_name = $_SESSION['ln'];
$status = $_SESSION['stat'];
$action = "Deleted Class - [".$course_num."] ".$class_title."";
$sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
$result1 = mysqli_query($con, $sql1);

$sql = "DELETE FROM class WHERE course_num='$course_num'";
$delQuery =mysqli_query($con,$sql);

if($delQuery==true)
{
   
	 $data = array(
        'status'=>'success',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'failed',
      
    );

    echo json_encode($data);
} 

?>