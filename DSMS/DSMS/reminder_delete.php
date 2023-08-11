<?php include('connection.php');
session_start();

if($_SESSION['user_status'] == "guest"){
    header("Location: index.php");
    exit;
}

 if (isset($_GET['id'])){

    $id = $_GET['id'];

    //for the login history
    $log_name = $_SESSION['ln'];
    $status = $_SESSION['stat'];

    $action = "Deleted a Reminder Note";
    $sql1 = "INSERT INTO login_history (log_name,log_status,action) VALUES ('$log_name', '$status', '$action')";
    $result1 = mysqli_query($con, $sql1);

    $query = "DELETE  FROM reminder WHERE reminder_id = $id";
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
}

