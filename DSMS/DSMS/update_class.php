<?php 
include('connection.php');
session_start();

if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}

$course_num = $_POST['course_num'];
$course_description = $_POST['course_description'];
$course_title = $_POST['course_title'];
$course_year = $_POST['course_year'];
$course_sem = $_POST['course_sem'];
$id = $_POST['id'];




$sql = "UPDATE `class` SET  `course_num`='$course_num' , `course_description`= '$course_description', `course_title`='$course_title',  `course_year`='$course_year',  `course_sem`='$course_sem' WHERE course_num='$id' ";

$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
    $_SESSION['class_updated']=true;
    $data = array(
        'status'=>'true',
       
    );

    echo json_encode($data);
}
else
{
     $data = array(
        'status'=>'false',
      
    );

    echo json_encode($data);
} 
//for the login history
$log_name = $_SESSION['ln'];
$status = $_SESSION['stat'];
$action = "Updates Class Information - [".$course_num."] ".$course_title."";
$sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
$result1 = mysqli_query($con, $sql1);
?>