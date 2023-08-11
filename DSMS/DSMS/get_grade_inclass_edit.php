<?php include('connection.php');
session_start();

if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}

if (isset($_POST['updateId'])){ 

   //for the query
$id=$_POST['updateId'];
$sql ="SELECT * FROM `enrolled` left join class using(class_id) 
left join student using(stud_num) 
WHERE enrolled_id=$id" ;

$query=mysqli_query($con,$sql);


$response=array();

    while ($item_row = mysqli_fetch_assoc($query)){
        $response = $item_row;
     
    };
echo json_encode($response);

$sql ="SELECT * FROM `enrolled` left join class using(class_id) 
left join student using(stud_num) 
WHERE enrolled_id=$id" ;
$query=mysqli_query($con,$sql);
$result=mysqli_fetch_array($query);
   //for the login history
   $log_name = $_SESSION['ln'];
   $status = $_SESSION['stat'];
  
   $name = "".$result['f_name']. " ".$result['m_name']. " ".$result['l_name']."";
   $class_title = "".$result['course_title']."";
   
   $action = "Edited Grade For ".$name." in Course ".$class_title."";
   $sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
   $result1 = mysqli_query($con, $sql1);   
   
}else{

// header('location: adminHome.php');
$response['status']=200;
$response['message']="Invalid or data not found";
};


//REmoval grade



if (isset($_POST['removal'])){ 

    //for the query
    $id=$_POST['removal'];
                $sql = "SELECT * FROM `removal_grade` left join class using(class_id) 
                left join student using(stud_num) 
                WHERE removal_id=$id";
 
 $query=mysqli_query($con,$sql);
 
 
 $response=array();
 
     while ($item_row = mysqli_fetch_assoc($query)){
         $response = $item_row;
      
     };
 echo json_encode($response);
 
 $sql = "SELECT * FROM `removal_grade` left join class using(class_id) 
 left join student using(stud_num) 
 WHERE removal_id=$id";
 $query=mysqli_query($con,$sql);
 $result=mysqli_fetch_array($query);
    //for the login history
    $log_name = $_SESSION['ln'];
    $status = $_SESSION['stat'];
   
    $name = "".$result['f_name']. " ".$result['m_name']. " ".$result['l_name']."";
    $class_title = "".$result['course_title']."";
    
    $action = "Edited Grade For ".$name." in Course ".$class_title."";
    $sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
    $result1 = mysqli_query($con, $sql1);   
    
 }else{
 
 // header('location: adminHome.php');
 $response['status']=200;
 $response['message']="Invalid or data not found";
 };
 
?>
