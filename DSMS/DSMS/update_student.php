<?php
session_start(); 
include('connection.php');

if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}

$f_name = $_POST['f_name'];
$m_name = $_POST['m_name'];
$l_name = $_POST['l_name'];
$college = $_POST['college'];
$degreeProg = $_POST['degreeProg'];
$sex = $_POST['sex'];
$id = $_POST['id'];



$sql = "UPDATE `student` SET  `f_name`='$f_name' , `m_name`= '$m_name', `l_name`='$l_name', `college`='$college',  `degreeProg`='$degreeProg',  `sex`='$sex' WHERE stud_num='$id' ";
$query= mysqli_query($con,$sql);
$lastId = mysqli_insert_id($con);
if($query ==true)
{
    $_SESSION['stud_updated']=true;
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
$name = "".$f_name." ".$m_name." ".$l_name."";
$action = "Updated Student Information - [".$id."] ".$name."";
$sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
$result1 = mysqli_query($con, $sql1);
?>