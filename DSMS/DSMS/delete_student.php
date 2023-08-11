<?php 
session_start(); 
include('connection.php');

if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}

$stud_num = $_POST['id'];

$grab = "SELECT * FROM student WHERE stud_num = '$stud_num'";
$grabquery = mysqli_query($con, $grab);
$grabrow = $grabquery->fetch_assoc();

$name = "".$grabrow['f_name']." ".$grabrow['m_name']." ".$grabrow['l_name']."";

//for the login history
$log_name = $_SESSION['ln'];
$status = $_SESSION['stat'];
$action = "Deleted Student - [".$stud_num."] ".$name."";
$sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
$result1 = mysqli_query($con, $sql1);
//$stud_num = $_POST['id'];

$sql = "DELETE FROM student WHERE stud_num='$stud_num'";
$delQuery =mysqli_query($con,$sql);
if($delQuery==true)
{
    $_SESSION['stud_removed']=true;
	 $data = array(
        'status'=>'success',
       
    );
    
    echo json_encode($data);
    // header("Location:studentList.php");
    
}
else
{
     $data = array(
        'status'=>'failed',
      
    );

    echo json_encode($data);

} 

?>