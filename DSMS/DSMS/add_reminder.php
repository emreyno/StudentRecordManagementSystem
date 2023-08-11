<?php
session_Start();
include('connection.php');
if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}
 
        $title = $_POST['title'];
        $content = $_POST['content'];

        //for the login history
        $log_name = $_SESSION['ln'];
        $status = $_SESSION['stat'];

        $action = "Added a New Reminder Note";
        $sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
        $result1 = mysqli_query($con, $sql1);
       

        $query = "INSERT into reminder (reminder_title, reminder_content, ts) values ('$title', '$content', NOW())";
        echo $title;
        echo $query;
        $query_run = mysqli_query($con, $query);

        if($query_run)
        {
            echo '<script> alert("Data Updated"); </script>';
        
           header("Location:home.php");
        }
        else
        {
            echo '<script> alert("Data Not Updated"); </script>';
        }
    
?>